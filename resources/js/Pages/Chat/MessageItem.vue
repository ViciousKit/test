<template>
    <div v-bind:style="{color: activeColor}" class="break-all">
        <div class="bg-white rounded-lg mb-1 pl-1 bg-opacity-20">
            {{message.user.name}}: {{message.message}}
        </div>
    </div>
</template>

<script>
export default {
    props: ['message'],
    data () {
        return {
            activeColor: this.message.user.color,
        }
    }
}

</script>
