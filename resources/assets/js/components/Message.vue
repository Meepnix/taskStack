<template>
    <div class="alert alert-primary" role="alert">
        {{ message.message }}
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