<template>
  <div class="card card-margin bg-light">
    <div class="card-header" v-bind:id="'heading' + task.id">
      <h2 class="mb-0">
        <div class="container-fluid">
          <div class="row">
            <div class="col-8">
              <h3>{{ task.title }}</h3>
              
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
      <div class="card-body" v-html="task.message">

      </div>

    </div>
  </div>

</template>
<script>
    

    export default {
        props: ['task'],
        data() {
            return {
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

button.btn.collapsed:before
{
  content:'Expand more';
    
}
button.btn:before
{
  content:'Expand less';
    
}


/* Resolve bottom border missing in accordion card child */
.accordion div.card:only-child 
{ 
  border-bottom: 1px solid rgba(0, 0, 0, 0.125);
  border-radius: calc(0.25rem - 1px); 
} 

</style>
