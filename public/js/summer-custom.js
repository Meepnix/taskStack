
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

var FileButton = function (context) {
    var ui = $.summernote.ui;
  
    // create button
    var button = ui.button({
      contents: '<i class="fas fa-file-pdf"/>',
      tooltip: 'Insert PDF',
      click: function () {
          // invoke file selection modal
          $('#fileselect').modal('show');
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
            ['file', ['file']],
            ['view', ['codeview']]
        ],

        buttons: {
            image: ImageButton,
            file: FileButton
        },

        //Fix firefox popover
        popatmouse: false,

        popover: {
            image: [
                ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']]
            ]
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
            console.log(SiteRoute + url);
            $('#summernote').summernote('insertImage', SiteRoute + url);
        
        }
    }   

})

var app = new Vue({
    el: '#app',
    data: {
        images: null,
        files: null,
        errors: []
    },
    methods: {
        read: function () {
            axios.get('/admin/location/index/images').then( response => {
                this.images = response.data;
            })
            .catch(e => {
                this.error.push(e);
            })
        }


    },
    created: function () {
            
        this.read();
    }
})

Vue.config.devtools = true;


