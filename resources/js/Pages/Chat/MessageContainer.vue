<template>
        <div class="p-2 flex flex-col-reverse overscroll-x-none w-full h-full">
            <div v-for="message in messages" :key="message.id">
            <message-item :message="message" />
            </div>
        </div>
</template>

<script>
import messageItem from "../Chat/MessageItem.vue";

export default {
    components: {messageItem},
    props: ['messages']
}

</script>
