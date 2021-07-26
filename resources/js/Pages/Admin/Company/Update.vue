<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <app-layout-admin :user="user">
        <!--
          This example requires Tailwind CSS v2.0+

          This example requires some changes to your config:

          ```
          // tailwind.config.js
          module.exports = {
            // ...
            plugins: [
              // ...
              require('@tailwindcss/forms'),
            ]
          }
          ```
        -->
        <div class="p-4 bg-white space-y-8 divide-y divide-gray-200">
            <div class="space-y-8 divide-y divide-gray-200">
                <div class="pt-8">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Bedrijfsinformatie
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Gebruik svp een permanent e-mailadres waarop het bedrijf e-mails kan ontvangen
                        </p>
                    </div>
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="first_name" class="block text-sm font-medium text-gray-700">
                                Naam
                            </label>
                            <div class="mt-1">
                                <input v-model="company.name" type="text" name="first_name" id="first_name" autocomplete="given-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="last_name" class="block text-sm font-medium text-gray-700">
                                Adres
                            </label>
                            <div class="mt-1">
                                <input v-model="company.address" type="text" name="last_name" id="last_name" autocomplete="family-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>

                        <div class="sm:col-span-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                E-mailadres
                            </label>
                            <div class="mt-1">
                                <input v-model="company.email" id="email" name="email" type="email" autocomplete="email" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Telefoonnummer
                            </label>
                            <div class="mt-1">
                                <input v-model="company.phone_number" id="phone_number" name="phone_number" type="text" autocomplete="tel" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="zip" class="block text-sm font-medium text-gray-700">
                                Postcode
                            </label>
                            <div class="mt-1">
                                <input v-model="company.postal_code" type="text" name="zip" id="zip" autocomplete="postal-code" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="errors.length" class="rounded-md bg-red-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <XCircleIcon class="h-5 w-5 text-red-400" aria-hidden="true" />
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                            <h1 v-if="errors.length== 1"> Er is 1 probleem gevonden.</h1>
                            <h1 v-else>Er zijn {{ errors.length }} problemen gevonden.</h1>
                        </h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                <li v-for="error in errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="pt-5">
                <div class="flex justify-end">
                    <button @click="checkForm" type="button" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Opslaan
                    </button>
                </div>
            </div>
        </div>
    </app-layout-admin>
</template>

<script>
import AppLayoutAdmin from "@/Layouts/AppLayoutAdmin";
import { XCircleIcon } from '@heroicons/vue/solid'
export default {
    props:['company'],
    components: {
        AppLayoutAdmin,
        XCircleIcon
    },
    data() {
        return {
            errors: [],
            selectedCompany: [],
            companies: [],
        }
    },
    mounted() {
        this.getCompanies();
    },
    methods: {
        getCompanies() {
            axios.get('/api/companies')
                .then((response) => {
                    console.log(response);
                    this.companies = response.data.companies;
                }, (error) => {
                    console.log(error);
                });
        },
        checkForm:function(e) {
            this.errors = [];
            if(!this.company.name) this.errors.push("Naam vereist.");
            if(!this.company.email) this.errors.push("E-mail vereist.");
            if(!this.company.address) this.errors.push("Adres vereist.");
            if(!this.company.phone_number) this.errors.push("Telefoonnummer vereist.");
            if(!this.company.postal_code) this.errors.push("Postcode vereist.");


            if (!this.errors.length) {
                this.updateCompany()
                return true;
            }
            e.preventDefault();
        },
        updateCompany(){
            axios.put('/api/company/' + this.company.id +  '/update', this.company)
                .then((response) => {
                    console.log(response);
                    window.location = '/admin/companies'
                }, (error) => {
                    console.log(error);
                });
        }
    },
    setup() {
        return {
        }
    },
}
</script>
