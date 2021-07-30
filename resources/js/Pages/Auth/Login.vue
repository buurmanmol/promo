<template>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <div class="min-h-screen bg-white flex">
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <jet-validation-errors class="mb-4" />
                    <img class="h-20 w-384" src="images/logo.png" alt="Workflow" />
                    <h2 class="mt-6 text-3xl text-center font-extrabold text-gray-900">
                        Log in op uw account
                    </h2>
                </div>
                <div class="mt-8 text-center">
                    <div class="mt-6 text-center">
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <jet-label for="email" value="E-mailadres" class="block text-sm font-medium text-gray-700" />
                                <div class="mt-1">
                                    <jet-input id="email" type="email" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.email" required autofocus />
                                </div>
                            </div>

                            <div class="mt-4">
                                <jet-label for="password" value="Wachtwoord" class="block text-sm font-medium text-gray-700" />
                                <div class="mt-1">
                                    <jet-input id="password" type="password" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.password" required autocomplete="current-password" />
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <jet-checkbox name="remember" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"  v-model:checked="form.remember" />
                                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                                        Onthoud mij
                                    </label>
                                </div>

                                <div class="text-sm">

                                    <inertia-link v-if="canResetPassword" :href="route('password.request')" class="font-medium text-indigo-600 hover:text-indigo-500">
                                        Wachtwoord vergeten?
                                    </inertia-link>
                                </div>
                            </div>

                            <div>
                                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" >
                                    Log in
                                </jet-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden lg:block relative w-0 flex-1">
            <img class="absolute inset-0 h-full w-full object-cover" src="https://images.pexels.com/photos/3183197/pexels-photo-3183197.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="" />
        </div>
    </div>
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
