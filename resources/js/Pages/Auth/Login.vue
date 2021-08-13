<template>
    <jet-authentication-card>

        <jet-validation-errors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="text-white p-12">
            <div>
                <jet-input placeholder="Email" id="email" type="email" class="box mt-1 block text-center" v-model="form.email" required autofocus />
            </div>

            <div class="mt-4">
                <jet-input placeholder="Password" id="password" type="password" class="box mt-1 block text-center" v-model="form.password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <jet-checkbox name="remember" class="bg-gray-200" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-300">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-300 hover:text-white">
                    Forgot your password?
                </inertia-link>

                <jet-button id="button" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </jet-button>
            </div>
        </form>
    </jet-authentication-card>
</template>

<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from '@/Jetstream/Checkbox'
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors
        },

        props: {
            canResetPassword: Boolean,
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    }
</script>

<style scoped>
    .box {
        box-shadow: none;
        width: 65%;
        margin: auto;
        border-radius: 24px;
        border: 2px solid #3498db;
        background: none;
        outline: none;
        cursor: pointer;
        transition: 0.25s;
        /*color: white;*/
    }
    input:-webkit-autofill {
        -webkit-box-shadow: inset 0 0 0 50px black !important; /* цвет вашего фона */
        -webkit-text-fill-color: white; /* цвет текста */
    }

    #button {
        margin: auto;
        background: none;
        border: 2px solid #219654;
        border-radius: 24px;
    }

    .box:focus {
        border-color: #219654;
        width: 85%;
        box-shadow: 0 0 10px #219654, 0 0 40px #219654, 0 0 80px #219654;
    }

    #button:hover {
        background: #219654;
        box-shadow: 0 0 10px #219654, 0 0 40px #219654, 0 0 80px #219654;
    }
</style>
