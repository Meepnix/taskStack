<template>
  <div class="card">
    <div class="card-header" v-bind:id="'heading' + task.id">
      <h5 class="mb-0">
        <h3>{{ task.title }}</h3>
        <span v-for="label in task.labels" :key="label.id" v-html="label.html">
          
        </span>

        <button class="btn btn-link" type="button" data-toggle="collapse" v-bind:data-target="'#collapse' + task.id" aria-expanded="false" v-bind:aria-controls="'collapse' + task.id">
          Click for more
        </button>
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
