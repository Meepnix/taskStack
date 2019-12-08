<template>
  <div class="card bg-transparent border-task border-right-1 mb-3">
    <div class="card-header" v-bind:id="'heading' + task.id">
      <h2 class="mb-0">
        <div class="container-fluid">
          <div class="row">
            <div class="col-8">
              <h4><strong>{{ task.title }}</strong></h4>


              <!-- Label tags -->
              <label v-for="label in task.labels" :key="label.id" v-html="label.html" class="mr-2 mt-1 mb-1">
          
              </label>
            </div>

            <div class="col-4 text-center">
              <h3>
              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" v-bind:data-target="'#collapse' + task.id" aria-expanded="false" v-bind:aria-controls="'collapse' + task.id">
                
              </button>
              </h3>
            </div>
          </div>
        </div>
      </h2>
    </div>

    <div v-bind:id="'collapse' + task.id" class="collapse" v-bind:aria-labelledby="'heading' + task.id" data-parent="#accordion">

      <!-- Content -->
      <div class="card-body" v-html="task.message">

      </div>

      <div class="card-body">
        <h5>Attached files</h5>
        <!-- Attached Files -->
        <button
        v-for="file in task.files"
        :key="file.id"
        type="button"
        v-on:click="submitFile(SiteRoute + 'storage' + file.public_path)"
        class="btn btn-outline-dark ml-2">
          <i class="fa fa-btn fa-file-pdf" aria-hidden="true"></i> {{file.name}}
        </button>
      </div>

      <div class="card-footer text-center bg-transparent border-task border-bottom-0 border-right-0 border-left-0 border-top-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" v-bind:data-target="'#collapse' + task.id" aria-expanded="false" v-bind:aria-controls="'collapse' + task.id">
                
        </button>
      </div>

    </div>
  </div>

</template>
<script>
    

    export default {
        props: ['task'],
        data() {
            return {
              SiteRoute: SiteRoute,
                options: {
                    height: "600px",
                    width: "100%",
                },
                path: null
            }
        },

        methods: {
            submitFile: function (path) {
                console.log("submit_cheese"); 
                PDFObject.embed(path, "#pdf", this.options);
                $('#pdfview').modal('show');
                
            }
            
        },
    }
</script>


<style scoped>


.btn-link {
  color: #8050bf;
  font-weight: bold;
  font-size: large;

}

.btn-expand {
  color: black;
  background-color: #FFFF80;
  border-color: #FFFF80;
  font-weight: bold;
  font-size: large;
}


button.btn-link.collapsed:before {
  content:'+ Click to Read more';
    
}
button.btn-link:before {
  content:'- Click to Read less';
    
}


.bg-lightblack {
  background-color: #1A1A1B;
}

.border-task {
  border-style: solid;
  border-width: 2px;
  border-bottom-width: 1px;
  border-color: #8050bf;
}

/* Resolve bottom border missing in accordion card child */
.accordion div.card:only-child { 
  border-bottom: 1px solid rgb(128, 80, 191);
  border-radius: 0.25rem
}

.accordion > .card:not(:first-of-type):not(:last-of-type) {
    border-bottom: 1px solid rgb(128, 80, 191);
    border-radius: 0.25rem;
}

.accordion > .card:first-of-type {
    border-bottom: 1px solid rgb(128, 80, 191);
    border-bottom-right-radius: 0.25rem;
    border-bottom-left-radius: 0.25rem;
}

.accordion > .card:last-of-type {
    border-top-left-radius: 0.25rem;
    border-top-right-radius: 0.25rem;
}

</style>
