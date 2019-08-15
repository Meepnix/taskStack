<template>
    <div id="app" class="bg-primary">
        <h1 class="text-white"><strong>taskSTACK</strong></h1>
        <div class="accordion" id="accordion">
            <task-component
                v-for="task in tasks"
                v-bind:task="task"
                :key="task.id"
            ></task-component>
        </div>
    </div>

</template>

<script>

    import TaskComponent from './Task.vue';

    export default {
        data() {
            return {
                tasks: [],
                errors: []
            }
        },

        methods: {
            read() {
                window.axios.get('/task/index').then( response => {
                    this.tasks = response.data;
                })
                .catch(e => {
                    this.error.push(e);
                })
            }
            
        },
        
        components: {
            TaskComponent
        },

        created() {
            this.read();
        }
    }
</script>

