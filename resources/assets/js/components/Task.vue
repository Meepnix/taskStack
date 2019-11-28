<template>
  <div class="card card-margin text-white bg-blacklight border-info mb-3">
    <div class="card-header bg-transparent" v-bind:id="'heading' + task.id">
      <h2 class="mb-0">
        <div class="container-fluid">
          <div class="row">
            <div class="col-8">
              <h3>{{ task.title }}</h3>


              <!-- Label tags -->
              <label v-for="label in task.labels" :key="label.id" v-html="label.html" class="label">
          
              </label>
            </div>

            <div class="col-4">

              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" v-bind:data-target="'#collapse' + task.id" aria-expanded="false" v-bind:aria-controls="'collapse' + task.id">
                
              </button>
            </div>
          </div>
        </div>
      </h2>
    </div>

    <div v-bind:id="'collapse' + task.id" class="collapse" v-bind:aria-labelledby="'heading' + task.id" data-parent="#accordion">

      <!-- Content -->
      <div class="card-body" v-html="task.message">

      </div>

      <!-- Attached Files -->
      <button
      v-for="file in task.files"
      :key="file.id"
      type="button"
      v-on:click="submitFile(SiteRoute + 'storage' + file.public_path)"
      class="btn btn-primary ml-2">
        <i class="fa fa-btn fa-file-pdf" aria-hidden="true"></i> {{file.name}}
      </button>

      <div class="card-footer bg-transparent">

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

.label{

  margin-right: 3px;
}

.card-margin{

  margin-bottom: 3px;
}

button.btn-link.collapsed:before
{
  content:'Expand more';
    
}
button.btn-link:before
{
  content:'Expand less';
    
}


/* Resolve bottom border missing in accordion card child */
.accordion div.card:only-child 
{ 
  border-bottom: 1px solid rgb(255, 255, 255);
  border-radius: calc(0.25rem - 1px); 
}


.bg-lightblack {
    background-color: #1A1A1B;
}


</style>
