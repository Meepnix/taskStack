<template>
    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">taskSTACK</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" v-on:click="setPeriod('/task/index')" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" v-on:click="setPeriod('/task/morning')" href="#">Morning</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" v-on:click="setPeriod('/task/afternoon')" href="#">Early Afternoon</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" v-on:click="setPeriod('/task/evening')" href="#">Late Afternoon</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    {{ tasks.username }}
                </span>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <message-component
                        v-for="message in messages"
                        v-bind:message="message"
                        :key="message.id"
                    ></message-component>
                </div>

                
            </div>
            <div class="row">
                <div class="col-1">
                </div>

                <div class="col-10">
                    <h1>
                        <label> {{ correctPeriod(tasks.period) }} <strong>TASKS</strong></label>
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
        data: function() {
            return {
                tasks: [],
                errors: [],
                messages: [],
                timer:'',
                options: {
                    height: "800 rem",
                    width: "100%",
                },
                period: "/task/index",
                path: null
            }
        },

        methods: {
            read: function () {
                window.axios.get(this.period).then( response => {
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
                
            },
            correctPeriod: function (period) {
                if (period === 'afternoon') {
                    return 'Early Afternoon';

                } else if (period === 'evening') {
                    return 'Late Afternoon';
                } else {
                    return 'Morning';
                }
            },
            setPeriod: function (period) {
                this.period = period;
                //Refresh
                this.read();
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



.modal-xl {
      min-width: 100%;
}



</style>

