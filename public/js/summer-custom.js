
// Summernotes

var ImageButton = function (context) {
  var ui = $.summernote.ui;

  // create button
  var button = ui.button({
    contents: '<i class="fas fa-image"/>',
    tooltip: 'Insert Image',
    click: function () {
        // invoke image selection modal
        $('#imgselect').modal('show');
    }
  });

  return button.render();   // return button as jquery object
}


$(document).ready(function() {
    $('#summernote').summernote({

        toolbar: [
            ['style', ['style']],
            ['fontstyle', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontcolor' ['fontcolor']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['media', ['link', 'video', 'hr']],
            ['image', ['image']],
            ['view', ['codeview']]
        ],

        buttons: {
            image: ImageButton,
        },

        //Fix firefox popover
        popatmouse: false,

        popover: {
            image: [
                ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']]
            ]
        },

        //Add summernote content to Vue message field.
        callbacks: {
            onChange: function(contents, $editable) {
              app.fields.message = contents;
            }
          }
    });
});



// Vue app

//Insert image component

Vue.component('location-image', {
    props: ['image'],
    template: `
    <div class="card">
        <div class="card-header" v-bind:id="'heading' + image.id">
            <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" v-bind:data-target="'#collapse' + image.id" aria-expanded="false" v-bind:aria-controls="'collapse' + image.id">
                    {{ image.name }}
                </button> 
            </h5> 
        </div> 
        <div v-bind:id="'collapse' + image.id" class="collapse" v-bind:aria-labelledby="'heading' + image.id" data-parent="#accordion">
        
            <div class="card-body">
                <table class="table"> 
                    <thead> 
                        <tr> 
                            <th scope="col">Filename</th>
                            <th scope="col">Image preview</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <tr v-for="img in image.images" :key="img.id"> 
                            <td>{{ img.name }}</td>
                            <td>
                                <img v-bind:src="SiteRoute + 'storage' + img.public_path" height="100px">
                            </td>
                            <td>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="insertImage('storage' + img.public_path)">Insert image</button>
                            </td>
                        </tr> 
                    </tbody> 
                </table>
            </div> 
        </div>
    </div>`,

    methods: {

        insertImage: function (url) {
            //insert image into summernote
            $('#summernote').summernote('insertImage', SiteRoute + url);
        
        }
    }   

})



//Insert file link component

Vue.component('location-file', {
    props: ['file'],
    template: `
    <div class="card">
        <div class="card-header" v-bind:id="'heading' + file.id">
            <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" v-bind:data-target="'#collapse' + file.id" aria-expanded="false" v-bind:aria-controls="'collapse' + file.id">
                    {{ file.name }}
                </button> 
            </h5> 
        </div> 
        <div v-bind:id="'collapse' + file.id" class="collapse" v-bind:aria-labelledby="'heading' + file.id" data-parent="#accordion">
        
            <div class="card-body">
                <table class="table"> 
                    <thead> 
                        <tr> 
                            <th scope="col">Filename</th>
                            <th scope="col">Image preview</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <tr v-for="pdf in file.files" :key="pdf.id"> 
                            <td>{{ pdf.name }}</td>
                            <td>
                                <a v-bind:href="SiteRoute + 'storage' + pdf.public_path" target="_blank">{{ pdf.name }}</a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="addLink(pdf.id, pdf.name)">Insert file</button>
                            </td>
                        </tr> 
                    </tbody> 
                </table>
            </div> 
        </div>
    </div>`,

    methods: {

        insertFile: function (url, name) {
            //insert file link into summernote
            console.log(SiteRoute + url);
            //var HTMLstring = "<p> Test </p>";

            var HTMLstring = `<button type="button" class="btn btn-link" v-on:click="submitFile('`+ SiteRoute + url +`')"><i class="fa fa-btn fa-file-pdf" aria-hidden="true"></i>` + name + `</button>`;
            $('#summernote').summernote('pasteHTML', HTMLstring);
        },

        addLink: function (id, name) {

            this.$emit('add-link', id, name);

        }
    }   

})


// List File links

Vue.component('list-file', {
    props: ['file'],
    template: `

    <li class="list-group-item">{{ file.name }}
    <button type="button" class="btn btn-primary" v-on:click="removeLink(file)">X</button></li>
    
    `,
    methods: {

        removeLink: function (link) {
            this.$emit('remove-link', link);
            console.log('emitted remove');
        },
    }
})




var app = new Vue({
    el: '#app',
    data: {
        images: null,
        test: null,
        files: null,
        success: false,
        loaded: true,
        fields: {
            links: [],
            label_check: [],
            title: null,
            message: null,

        },
        links: [],
        errors: {},
        labels: 0
    },
    methods: {
        read: function () {
            //get image json
            axios.get('/admin/location/index/images').then( response => {
                this.images = response.data;
            })
            .catch(e => {
                this.error.push(e);
            })

            //get file json
            axios.get('/admin/location/index/files').then( response => {
                this.files = response.data;
            })
            .catch(e => {
                this.error.push(e);
            })
        },

        addLink: function (linkid, linkname) {
            this.fields.links.push({id: linkid, name: linkname});
        },

        removeLink: function (link) {
            console.log(link);
            this.fields.links.splice(this.fields.links.indexOf(link), 1);

        },

        submit: function () {
            if (this.loaded) {
                this.loaded = false;
                this.success = false;
                this.errors = {};

                axios.patch('/admin/tasks/store', this.fields).then(response => {
                    this.success = true;
                    setTimeout(function(){
                        this.success = false;
                    }, 2000);
                    window.location = response.data.redirect;
                })
                .catch(error => {
                    this.loaded = true;
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            }

        }


    },
    created: function () {
            
        this.read();
    }
})

Vue.config.devtools = true;


