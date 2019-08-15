<template>
  <div class="card card-margin bg-light">
    <div class="card-header" v-bind:id="'heading' + task.id">
      <h5 class="mb-0">
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
      </h5>
    </div>

    <div v-bind:id="'collapse' + task.id" class="collapse" v-bind:aria-labelledby="'heading' + task.id" data-parent="#accordion">
      <div class="card-body" v-html="task.message">

      </div>

    </div>
  </div>

</template>
<script>
    export default {
        props: ['task']
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
    content:'Read more';
    
}
button.btn:before
{
    content:'Read less';
    
}

</style>
