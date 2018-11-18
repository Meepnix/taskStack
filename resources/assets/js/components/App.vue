<template>
    <div id="app">
        <h1>Task</h1>
        <task-component>
        </task-component>
    </div>

</template>

<script>
    function Task({id, name, message}) {

        this.id = id;
        this.name = name;
        this.message = message;

    }

    import TaskComponent from './Task.vue';

    export default {
        data() {
            return {
                tasks: []
            }
        },

        methods: {
            read() {
                window.axios.get('/api/cruds').then(({ data }) => {
                    data.forEach(task => {
                        this.tasks.push(new Task(task));
                    });
                });
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

