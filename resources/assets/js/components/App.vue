<template>
    <div id="app">
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
                errors: [],
                options: {
                    height: "600px",
                    width: "100%",
                },
                path: null
            }
        },

        methods: {
            read() {
                console.log("read"); 
                window.axios.get('/task/index').then( response => {
                    this.tasks = response.data;
                })
                .catch(e => {
                    this.error.push(e);
                })
            },
            submitFile: function (path) {
                console.log("submit"); 
                PDFObject.embed(path, "#pdf", this.options);
                $('#pdfview').modal('show');
                
            }
            
        },
        
        components: {
            TaskComponent
        },

        created() {
            this.submitFile('http://localhost/storage/pdf/kPzNhG7EcQ1GAOuKXFuS4uASzNuiQ8dCWfs0Jg6I.pdf');
            this.read();
        }
    }
</script>

