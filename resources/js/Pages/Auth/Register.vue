<template>
    <div class="min-h-screen bg-white flex">
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <jet-validation-errors class="mb-4" />
                <div>
                    <img class="h-20 w-384" src="images/logo.png" alt="Workflow" />
                    <h2 class="mt-6 text-3xl text-center font-extrabold text-gray-900">
                        Registreer uw account
                    </h2>
                </div>
                <div class="mt-8 text-center">
                    <div class="mt-6 text-center">
                        <form @submit.prevent="submit">
                            <div>
                                <jet-label for="name" value="Naam" class="block text-sm font-medium text-gray-700" />
                                <jet-input id="name" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.name" required autofocus autocomplete="name" />
                            </div>

                            <div class="mt-4">
                                <jet-label for="email" value="E-mailadres" class="block text-sm font-medium text-gray-700" />
                                <jet-input id="email" type="email" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.email" required />
                            </div>

                            <div class="mt-4">
                                <jet-label for="password" value="Wachtwoord" class="block text-sm font-medium text-gray-700" />
                                <jet-input id="password" type="password" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.password" required autocomplete="new-password" />
                            </div>

                            <div class="mt-4">
                                <jet-label for="password_confirmation" value="Bevestig uw wachtwoord" class="block text-sm font-medium text-gray-700" />
                                <jet-input id="password_confirmation" type="password" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.password_confirmation" required autocomplete="new-password" />
                            </div>

                            <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                                <jet-label for="terms" class="block text-sm font-medium text-gray-700">
                                    <div class="flex items-center">
                                        <jet-checkbox name="terms" id="terms"  lass="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model:checked="form.terms"  />

                                        <div class="space-y-1">
                                            Ik ga akkoord met de <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Gebruiksvoorwaarden</a> en het <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacybeleid</a>
                                        </div>
                                    </div>
                                </jet-label>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <inertia-link :href="route('login')" class="font-medium text-indigo-600 hover:text-indigo-500">
                                    Heeft u al een account?
                                </inertia-link>

                                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Registeren
                                </jet-button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden lg:block relative w-0 flex-1">
            <img class="absolute inset-0 h-full w-full object-cover" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fedm.com%2F.image%2Ft_share%2FMTc0NjYyNjI0ODg4MjM1Mzg2%2Fscience-of-earworms-explain-why-never-gonna-give-you-up-is-stuck-in-our-heads-30-years-later.png&f=1&nofb=1" alt="" />
        </div>
    </div>
</template>

<script>
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetCheckbox from "@/Jetstream/Checkbox";
import JetLabel from '@/Jetstream/Label'
import JetValidationErrors from '@/Jetstream/ValidationErrors'

export default {
    components: {
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        JetValidationErrors
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
}
</script>
