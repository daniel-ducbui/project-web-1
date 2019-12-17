<template>
    <div class="message self">
        <strong class="user">{{ message.user.name }}</strong>
        <p class="body">{{ message.content }}</p>
    </div>
</template>

<script>
    export default {
        props: ['message']
    }
</script>

<style>
    .user {
        font-weight: 800;
    }
    .body {
        margin-bottom: 0;
        white-space: pre-wrap;
    }
    .message {
        border-bottom: 1px solid #000000
    }
    .self {
        background-color: #f6f6f6;
        padding: 10px;
    }
</style>
