<template>
    <div class="alert alert-primary" role="alert" v-html="message.message">
        
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