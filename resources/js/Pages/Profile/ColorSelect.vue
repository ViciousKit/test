<template>
    <jet-form-section>
        <template #description>
            Select color of your messages in chat
        </template>
        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <select
                    v-model="currentColor"
                    @change="console()"
                >
                    <option
                        v-for="(color, index) in colors"
                        :key="index"
                        :value="color">

                        {{ color.chat_text_color }}
                    </option>
                </select>
            </div>
        </template>
        <template #actions>
            <button @click="setColor()">
                Save
            </button>
        </template>
    </jet-form-section>
</template>


<script>
import JetFormSection from '@/Jetstream/FormSection';
import JetButton from '@/Jetstream/Button';
import JetLabel from '@/Jetstream/Label';
import JetActionMessage from '@/Jetstream/ActionMessage';

export default {
    components: {
        JetButton,
        JetFormSection,
        JetLabel,
        JetActionMessage
    },
    props: ['user'],
    data() {
        return {
            colors: [],
            currentColor: []
        }
    },
    methods: {
        getTextColors() {
            axios.get('/chat/colors')
                .then( response => {
                    this.colors = response.data;
                    this.currentColor = this.colors[this.user.chat_text_color_id - 1];
                })
                .catch( error => {
                    console.log(error);
                })
        },
        console() {
            console.log(this.currentColor);
        },
        setColor() {
            axios.post('/chat/setColor', {
                colorId: this.currentColor.id
            })
            .then( response => {
                console.log(response.data);
            })
            .catch( error => {
                console.log(error);
            })

        }
    },
    created() {
        this.getTextColors();
    }

}
</script>
