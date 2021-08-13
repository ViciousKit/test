<template>
            <div class="overflow-hidden shadow-xl h-full flex flex-col">
                <chat-room-selection class="bg-blue-600 rounded-t w-full"
                    v-if="currentRoom.id"
                    :rooms="chatRooms"
                    :currentRoom="currentRoom"
                    v-on:roomChanged="setRoom($event)"
                />
                <message-container class="h-full dark:bg-gray-100"
                    :messages="messages" />
                <input-message
                    :authenticated="authenticated"
                    :room="currentRoom"
                    @messageSent="getMessages()"
                />
            </div>
</template>

<script>
    import ChatRoomSelection from '../Chat/ChatRoomSelection.vue'
    import MessageContainer from '../Chat/MessageContainer.vue';
    import InputMessage from '../Chat/InputMessage.vue';

export default {
    name: 'ChatApp',
    props: ['authenticated'],
    components: {
        MessageContainer,
        InputMessage,
        ChatRoomSelection,
    },
    data () {
        return {
            chatRooms: [],
            currentRoom: [],
            messages: [],
        }
    },
    watch: {
        currentRoom(val, oldVal) {
            if( oldVal.id ) {
                this.disconnect(oldVal);
            }
            this.connect();
        }
    },
    methods: {
        connect() {
            if( this.currentRoom.id) {
                let vm = this;
                this.getMessages();
                window.Echo.channel("chat." + this.currentRoom.id).listen('NewChatMessage', e => {
                    vm.getMessages();
                })
            }
        },
        disconnect(room) {
            window.Echo.leave("chat." + room.id);
        },
        getRooms() {
            axios.get('/chat/rooms')
            .then(response => {
                this.chatRooms = response.data;
                this.setRoom( response.data[0] );
            })
            .catch( error => {
                console.log(error);
            })
        },
        setRoom(room) {
            this.currentRoom = room;
            // this.getMessages();
        },
        getMessages() {
            axios.get('/chat/room/' + this.currentRoom.id + '/messages')
            .then( response => {
                this.messages = response.data;
            })
            .catch( error => {
                console.log(error);
            })
        }

    },
    created() {
        this.getRooms();
    }
}

</script>
