<template>
    <div>
        <div>
            <form class="form">
            <textarea
                cols="25"
                rows="5"
                class="form-input"
                @keydown="typing"
                v-model="content">
            </textarea>
                <span class="notice">
                Hit Enter to send a message
            </span>
            </form>
        </div>
    </div>
</template>

<script>
    import Event from '../event.js';

    export default {
        data() {
            return {
                content: null
            }
        },
        methods: {
            typing(e) {
                if(e.keyCode === 13 && !e.shiftKey) {
                    e.preventDefault();
                    this.sendMessage();
                }
            },
            sendMessage() {
                if(!this.content || this.content.trim() === '') {
                    return
                }
                let messageObj = this.buildMessage();
                Event.$emit('added_message', messageObj);
                axios.post('/message', {
                    content: this.content.trim()
                }).catch(() => {
                    console.log('failed');
                });
                this.content = null;
            },
            buildMessage() {
                return {
                    id: Date.now(),
                    content: this.content,
                    selfMessage: true,
                    user: {
                        name: Laravel.user.name
                    }
                }
            }
        }
    }
</script>

<style>
    .form {
        padding: 8px;
    }
    .form-input {
        width: 100%;
        border: 1px solid #d3e0e9;
        padding: 5px 10px;
        outline: none;
    }
    .notice {
        color: #aaa
    }

</style>
