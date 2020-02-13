<template>
    <div class="alert alert-primary" role="alert">
        <div class="container-fluid">
            <div class="row">
                <div class="col-1 text-right">
                    <i class="fas fa-info-circle fa-2x"></i>
                </div>
                <div class="col-11 text-left">
                    <div v-html="message.message"></div>
                </div>
            </div>
        </div>  
    </div>

</template>

<script>
    export default {
        props: ['message'],
        mounted() {
            console.log('Component message.')
        }

    }
</script>