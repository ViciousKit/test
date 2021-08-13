<template>
        <div>
            <select
                v-model="selected"
                @change="$emit('roomChanged', selected)"
                class="pt-0 pb-0 mt-1 ml-1 mb-1 bg-black dark:bg-white text-white dark:text-black rounded-lg">
                <option
                    class="bg-black dark:bg-white text-white dark:text-black"
                    v-for="(room, index) in rooms"
                    :key="index"
                    :value="room">
                    {{ room.name }}
                </option>
            </select>
        </div>
</template>

<script>
export default {
    props: ['rooms', 'currentRoom'],
    data() {
        return {
            selected: ''
        }
    },
    created() {
        this.selected = this.currentRoom;
    }
}

</script>
