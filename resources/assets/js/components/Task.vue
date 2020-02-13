<template>
  <div class="card bg-transparent border-task border-right-1 mb-3">
    <div class="card-header" v-bind:id="'heading' + task.id">
      
      <div class="container-fluid">
        <div class="row">
          <div class="col-8">
            <h4><strong>{{ task.title }}</strong><span v-if="createDate(task.created_at)" class="badge badge-new ml-1">NEW*</span><span v-if="updateDate(task.updated_at, task.created_at)" class="badge badge-dark ml-1">UPDATED</span></h4>
            <p class="mb-0"><i class="far fa-calendar-alt"></i> <strong>Created:</strong> {{ task.created_at | formatDate }} <strong>Updated:</strong> {{ task.updated_at | formatDate }}</p>
            <!-- Label tags -->
            <p>
              <i class="fas fa-tags"></i>
              <label v-for="label in task.labels" :key="label.id" v-html="label.html" class="mr-2 mt-1 mb-1">
        
              </label>

            </p>
          </div>

          <div class="col-4 text-center">
            <h3>
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" v-bind:data-target="'#collapse' + task.id" aria-expanded="false" v-bind:aria-controls="'collapse' + task.id">
              
            </button>
            </h3>
          </div>
        </div>
      </div>
      
    </div>

    <div v-bind:id="'collapse' + task.id" class="collapse" v-bind:aria-labelledby="'heading' + task.id" data-parent="#accordion">

      <!-- Content -->
      <div class="card-body" v-html="task.message">

      </div>

      <div v-if="task.files.length > 0" class="card-body">
        <h5><i class="fas fa-paperclip"></i><strong> Attached files</strong> (Click on files below to open)</h5>
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
        data: function () {
            return {
              SiteRoute: SiteRoute,
                options: {
                  height: "38vw",
                  width: "100%",
                },
                path: null
            }
        },

        filters: {
            formatDate: function (value) {
              if (value) {
                return window.moment(String(value)).format("Do MMM YYYY")
              }
            }
        },

        methods: {
            submitFile: function (path) {
              PDFObject.embed(path, "#pdf", this.options);
              $('#pdfview').modal('show');
                
            },

            createDate: function (created) {
              let current = window.moment();
              let create = window.moment(created)
              let diff = current.diff(create, 'days');

              //Check current and create difference
              if (diff < 7) {
                return true;
              } else {
                return false;
              }

            },

            updateDate: function (updated, created) {

              let current = window.moment();
              let update = window.moment(updated);
              let create = window.moment(created);
              let cdiff = update.diff(create, 'days');
              let diff = current.diff(update, 'days');
              // Check create and update difference in days
              if (cdiff > 7)
              {
                //Check current and update difference in days
                if (diff < 7) {
                  return true;
                } else {
                  return false;
                }

              } else {

                return false;
              }
              
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


button.btn-link.collapsed:before {
  content:'+ Click Here to Read More';
    
}
button.btn-link:before {
  content:'- Click Here to Read Less';
    
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


.badge-new {
  color: #fff;
  background-color: #8050bf;
}

</style>
