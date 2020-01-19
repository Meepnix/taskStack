<template>
    <div id="app">
        <div class="container-fluid">
            <div class="row">
                <div class="col-1">
                </div>

                <div class="col-10">
                    <message-component
                        v-for="message in messages"
                        v-bind:message="message"
                        :key="message.id"
                    ></message-component>


                    <h1>
                        <strong>taskSTACK</strong>
                        <label> {{ tasks.period }}</label>
                    </h1>
                    <div class="accordion" id="accordion">
                        <task-component
                            v-for="task in tasks"
                            v-bind:task="task"
                            :key="task.id"
                        ></task-component>
                    </div>
                </div>
                <div class="col-1">
                </div>
            </div>
        </div>

        <!-- View PDF -->
        <div 
        class="modal fade" 
        id="pdfview" 
        tabindex="-1" 
        role="dialog" 
        aria-labelledby="view_pdf" 
        aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="view_pdf">View PDF</h5>
                        <button 
                        type="button" 
                        class="close" 
                        data-dismiss="modal" 
                        aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div id="pdf"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>

    import TaskComponent from './Task.vue';
    import MessageComponent from './Message.vue';

    export default {
        data() {
            return {
                tasks: [],
                errors: [],
                messages: [],
                timer:'',
                options: {
                    height: "600px",
                    width: "100%",
                },
                path: null
            }
        },

        methods: {
            read: function () {
                window.axios.get('/task/index').then( response => {
                    this.tasks = response.data;
                })
                .catch(e => {
                    this.errors.push(e);
                })

                window.axios.get('/message/index').then( response => {
                    this.messages = response.data;
                })
                .catch(e => {
                    this.errors.push(e);
                })

            },
            submitFile: function (path) {
                console.log("submit"); 
                PDFObject.embed(path, "#pdf", this.options);
                $('#pdfview').modal('show');
                
            }
            
        },
        
        components: {
            TaskComponent,
            MessageComponent,
        },

        created() {
            
            this.read();
            //Refresh
            this.timer = setInterval(this.read, 30000)

            //Focus on opened accordion card
            $(document).ready(function() {
                $('#accordion').on('shown.bs.collapse', function(e) {

                    var $card = $(this).find('.collapse.show').prev();
                    $('html,body').animate({
                    scrollTop: $card.offset().top
                    }, 500);
                });
            });
        },

        beforeDestroy () {
            clearInterval(this.timer);
        },
    }
</script>

<style scoped>

.bg-black {
  background-color: black;
}


</style>

