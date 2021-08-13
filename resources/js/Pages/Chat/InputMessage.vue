<template>
    <div class="input items-center w-full mt-1 ml-1">
        <div v-if="authenticated" class="flex flex-row flex-grow-0">
            <input type="text"
                   class="outline-none p-1 rounded w-5/6 mr-1 bg-black text-white dark:bg-white dark:text-black"
                   v-model="message"
                   placeholder="Say something"
                   @keyup.enter="sendMessage()"
            >
            <button
                @click="sendMessage()"
                class="bg-blue-500 hover:bg-blue-700 mr-2 p-1 rounded text-white w-1/6"
            >Send</button>
        </div>
    </div>
</template>

<script>
import Input from '../../Jetstream/Input.vue';
export default {
    components: { Input},
    props: ['room', 'authenticated'],
    data() {
        return {
            message: '',
        }
    },
    methods: {
        sendMessage() {
            if( this.message == '') {
                return;
            }
            axios.post('/chat/room/' + this.room.id + '/messages', {
                message: this.message
            })
            .then( response => {
                if( response.status == 201) {
                    this.message = '';
                    this.$emit('messageSent');
                }
            })
            .catch( error => {
                console.log(error);
            })
        }
    }
}

</script>

<style scoped>
/*::placeholder {*/
/*    color: white;*/
/*    opacity: 0.8;*/
/*}*/

 .input {
     margin-bottom: 7px;
     margin-top: 0;
 }

</style>
