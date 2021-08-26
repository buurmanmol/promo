<template>
    <div class="min-h-screen bg-white">
        <header class="relative pb-36 bg-blue-gray-800">

            <div class="absolute inset-0">
                <img class="w-full h-full object-cover" src="https://images.pexels.com/photos/3183150/pexels-photo-3183150.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="" />
                <div class="absolute inset-0 bg-blue-gray-800 mix-blend-multiply" aria-hidden="true" />
            </div>
            <Popover as="div" class="relative z-10">
                <nav class="relative max-w mx-auto flex items-center justify-between bg-white bg-opacity-80  pt-6 pb-2 px-8 sm:px-6 lg:px-80" aria-label="Global">

                    <div class="flex items-center flex-1">
                        <div class="flex items-center justify-between w-full lg:w-auto">
                            <a href="#">
                                <span class="sr-only">Workflow</span>
                                <img class="h-8 w-auto sm:h-10" src="/images/logo.png" alt="" />
                            </a>
                        </div>
                    </div>
                    <div class="hidden lg:flex lg:items-center lg:space-x-6">
                        <a href="javascript:history.back()" class="py-2 px-6 bg-blue-500 border border-transparent rounded-md shadow-md text-base font-medium text-white hover:bg-blue-600">
                            Terug naar Dashboard
                        </a>
                    </div>
                </nav>

                <transition enter-active-class="duration-150 ease-out" enter-from-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100" leave-active-class="duration-100 ease-in" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
                    <PopoverPanel focus class="absolute top-0 inset-x-0 p-2 transition transform origin-top lg:hidden">
                        <div class="rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
                            <div class="px-5 pt-4 flex items-center justify-between">
                                <div>
                                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark.svg?color=blue&shade=500" alt="" />
                                </div>
                                <div class="-mr-2">
                                    <PopoverButton class="bg-white rounded-md p-2 inline-flex items-center justify-center text-blue-gray-400 hover:bg-blue-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                                        <span class="sr-only">Close menu</span>
                                        <XIcon class="h-6 w-6" aria-hidden="true" />
                                    </PopoverButton>
                                </div>
                            </div>
                        </div>
                    </PopoverPanel>
                </transition>
            </Popover>

            <div class="relative mt-24 max-w-md mx-auto px-4 pb-32 sm:max-w-3xl sm:px-6 md:mt-32 lg:max-w-7xl lg:px-8">
                <h1 class="text-4xl font-extrabold tracking-tight text-white md:text-5xl lg:text-6xl">Support</h1>
                <p class="mt-6 font-bold max-w-3xl text-xl text-white">Welkom op de support pagina. Als u een vraag of probleem heeft kunt u contact met ons opnemen via de kanalen hieronder weergeven.
                    Neem ook een kijkje bij de FAQ (Frequentely Asked Questions) of uw vraag daar tussenstaat.</p>
            </div>
        </header>

        <main>
            <div class="bg-blue-gray-50">
                <!-- Cards -->
                <section class="-mt-32 max-w-md mx-auto relative z-10 px-4 sm:max-w-3xl sm:px-6 lg:max-w-7xl lg:px-8" aria-labelledby="contact-heading">
                    <h2 class="sr-only" id="contact-heading">Contact us</h2>
                    <div class="grid grid-cols-1 gap-y-20 lg:grid-cols-3 lg:gap-y-0 lg:gap-x-8">
                        <div class="flex flex-col bg-white rounded-2xl shadow-xl">
                        <div class="flex-1 relative pt-16 px-6 pb-8 md:px-8">
                                <div class="absolute top-0 p-5 inline-block bg-blue-600 rounded-xl shadow-lg transform -translate-y-1/2">
                                    <PhoneIcon class="h-6 w-6 text-white" aria-hidden="true" />
                                </div>
                                <h3 class="text-xl font-medium text-blue-gray-900">{{ "Telefonisch"  }}</h3>
                                <p class="mt-4 text-base text-gray-500">{{ "Bij vragen of problemen kunt u telefonisch contact opnemen met Promofix. Wij zijn doordeweeks tussen 09:00 - 17:00 bereikbaar op 0594-201-550."}}</p>
                            </div>
                        </div>

                            <div class="flex flex-col bg-white rounded-2xl shadow-xl">
                        <div class="flex-1 relative pt-16 px-6 pb-8 md:px-8">
                            <div class="absolute top-0 p-5 inline-block bg-blue-600 rounded-xl shadow-lg transform -translate-y-1/2">
                                <MailIcon class="h-6 w-6 text-white" aria-hidden="true" />
                            </div>
                            <h3 class="text-xl font-medium text-blue-gray-900">{{ "E-Mail"  }}</h3>
                            <p class="mt-4 text-base text-gray-500">{{ "U kunt ons een mail sturen naar help@promofix.nl. Wij zullen ons best doen u zo snel mogelijk te helpen!"}}</p>
                        </div>
                            </div>

                                <div class="flex flex-col bg-white rounded-2xl shadow-xl">
                            <div class="flex-1 relative pt-16 px-6 pb-8 md:px-8">
                            <div class="absolute top-0 p-5 inline-block bg-blue-600 rounded-xl shadow-lg transform -translate-y-1/2">
                                <PencilAltIcon class="h-6 w-6 text-white" aria-hidden="true" />
                            </div>
                            <h3 class="text-xl font-medium text-blue-gray-900">{{ "Contact formulier"}}</h3>
                            <p class="mt-4 text-base text-gray-500">{{ "Wilt u liever een contact formulier invullen? Kijk dan onderaan deze pagina voor een contactformulier en wij zullen u zsm te woord staan!"}}</p>
                                </div>
                                </div>
                    </div>
                </section>

                <!-- FAQ -->
                <section class="max-w-md mx-auto py-24 px-4 divide-y-2 divide-blue-gray-200 sm:max-w-3xl sm:px-6 lg:max-w-7xl lg:py-32 lg:px-8" aria-labelledby="faq-heading">
                    <h2 class="text-3xl font-extrabold text-blue-gray-900" id="faq-heading">
                        Frequently asked questions
                    </h2>
                    <div class="mt-6 pt-10">
                        <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:grid-rows-2 md:gap-x-8 md:gap-y-12">
                            <div v-for="faq in faqs" :key="faq.id">
                                <dt class="text-lg font-medium text-blue-gray-900">
                                    {{ faq.question }}
                                </dt>
                                <dd class="mt-2 text-base text-blue-gray-500">
                                    {{ faq.answer }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </section>
            </div>
        </main>

<!--        Contact formulier-->
        <div class="bg-white py-16 px-4 overflow-hidden sm:px-6 lg:px-8 lg:py-24">
            <div class="relative max-w-xl mx-auto">
                <svg class="absolute left-full transform translate-x-1/2" width="404" height="404" fill="none" viewBox="0 0 404 404" aria-hidden="true">
                    <defs>
                        <pattern id="85737c0e-0916-41d7-917f-596dc7edfa27" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                            <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                        </pattern>
                    </defs>
                    <rect width="404" height="404" fill="url(#85737c0e-0916-41d7-917f-596dc7edfa27)" />
                </svg>
                <svg class="absolute right-full bottom-0 transform -translate-x-1/2" width="404" height="404" fill="none" viewBox="0 0 404 404" aria-hidden="true">
                    <defs>
                        <pattern id="85737c0e-0916-41d7-917f-596dc7edfa27" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                            <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                        </pattern>
                    </defs>
                    <rect width="404" height="404" fill="url(#85737c0e-0916-41d7-917f-596dc7edfa27)" />
                </svg>
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Contact Formulier
                    </h2>
                    <p class="mt-4 text-lg leading-6 text-gray-500">
                        Vul hieronder uw gegevens in en uw vraag of probleem.
                        Probeer zo uitgebreid mogelijk uw vraag en/of probleem te beschrijven zodat we u sneller en beter kunnen helpen.

                    </p>
                </div>
                <div class="mt-12">
                    <form @submit.prevent="submit" action="#" method="POST" class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                        <div>
                            <label for="first-name" class="block text-sm font-medium text-gray-700">Voornaam</label>
                            <div class="mt-1">
                                <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                            </div>
                            <div v-if="errors && errors.first_name" class="text-danger">{{ errors.first_name[0] }}</div>
                        </div>
                        <div>
                            <label for="last-name" class="block text-sm font-medium text-gray-700">Achternaam</label>
                            <div class="mt-1">
                                <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                            </div>
                            <div v-if="errors && errors.last_name" class="text-danger">{{ errors.last_name[0] }}</div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="company" class="block text-sm font-medium text-gray-700">Bedrijf</label>
                            <div class="mt-1">
                                <input type="text" name="company" id="company" autocomplete="organization" class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                            </div>
                            <div v-if="errors && errors.company" class="text-danger">{{ errors.company[0] }}</div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">E-mailadress</label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" autocomplete="email" class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                            </div>
                            <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="phone-number" class="block text-sm font-medium text-gray-700">Telefoonnummer</label>
                            <div class="mt-1">
                                <input type="text" name="phone-number" id="phone-number" autocomplete="tel" class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                            </div>
                            <div v-if="errors && errors.phone_number" class="text-danger">{{ errors.phone_number[0] }}</div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="message" class="block text-sm font-medium text-gray-700">Uw bericht</label>
                            <div class="mt-1">
                                <textarea id="message" name="message" rows="4" class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border border-gray-300 rounded-md" />
                            </div>
                            <div v-if="errors && errors.message" class="text-danger">{{ errors.message[0] }}</div>
                        </div>
                        <div class="sm:col-span-2">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Versturen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <footer class="bg-blue-gray-50" aria-labelledby="footer-heading">
                <div class="mt-12 border-t border-blue-gray-200 pt-8">
                    <p class="text-base text-blue-gray-400 xl:text-center">
                        &copy; 2021 Promofix, Inc. All rights reserved.
                    </p>
                </div>
        </footer>
    </div>
</template>

<script>
import { ref } from 'vue'

import { Popover, PopoverButton, PopoverPanel, Switch } from '@headlessui/vue'
import { MenuIcon, NewspaperIcon, PhoneIcon, SupportIcon, XIcon, MailIcon, PencilAltIcon } from '@heroicons/vue/outline'

const faqs = [
    {
        id: 1,
        question: "What's the best thing about Switzerland?",
        answer:
            "I don't know, but the flag is a big plus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.",
    },
    {
        id: 2,
        question: 'Why do you never see elephants hiding in trees?',
        answer:
            "Because they're so good at it. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.",
    },
    {
        id: 3,
        question: 'How do you make holy water?',
        answer:
            'You boil the hell out of it. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.',
    },
    {
        id: 4,
        question: "Why can't you hear a pterodactyl go to the bathroom?",
        answer:
            'Because the pee is silent. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.',
    },
    {
        id: 5,
        question: 'What do you call someone with no body and no nose?',
        answer: 'Nobody knows. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.',
    },
    {
        id: 6,
        question: 'Why did the invisible man turn down the job offer?',
        answer:
            "He couldn't see himself doing it. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.",
    },
]

export default {
    data(){
        return{
            fields: {},
            errors: {},
        }
    },
    components: {
        Popover,
        PopoverButton,
        PopoverPanel,
        MenuIcon,
        XIcon,
        MailIcon,
        PencilAltIcon,
        PhoneIcon,
        Switch,
    },
    setup() {
        const agreed = ref(false)
        return {
            faqs,
            agreed,
        }
    },
    methods:{
        submit(){
            this.errors = {};
            axios.post('/submit', this.fields).then(response => {
                alert('Message sent!');
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                }
            });
        }
    }
}
</script>
