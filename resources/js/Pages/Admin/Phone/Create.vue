<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <app-layout-admin :user="user"  :company="company">

        <div class="p-4 bg-white space-y-8 divide-y divide-gray-200">
            <div class="space-y-8 divide-y divide-gray-200">
                <div class="pt-8">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Telefoon informatie
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Voeg een nieuwe telefoon toe mbv het invullen van de velden.
                        </p>
                    </div>
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="first_name" class="block text-sm font-medium text-gray-700">
                                Merk
                            </label>
                            <div class="mt-1">
                                <select v-model="phone" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option v-for="brand in phones" :value="brand.name">{{brand.name}}</option>
                                </select>{{}}
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="last_name" class="block text-sm font-medium text-gray-700">
                                Model
                            </label>
                            <div class="mt-1">
                                <input v-model="model" type="text" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
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
                    <button @click="checkForm" type="button"  class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
    props:['user', 'phones','company'],
    components: {
        AppLayoutAdmin,
        XCircleIcon
    },
    data() {
        return {
            errors: [],
            phone:'',
            model:'',
        }
    },

    methods: {
        checkForm:function(e) {
            this.errors = [];
            if(!this.phone) this.errors.push("Merk vereist");
            if(!this.model) this.errors.push("Model vereist.");

            if (!this.errors.length) {
                this.createPhone()
                return true;
            }
            e.preventDefault();
        },
        createPhone(){
            let tellie={
                brand:this.phone,
                model:this.model,
            }
            axios.post('/admin/api/phone/create', tellie)
                .then((response) => {
                    window.location = '/admin/phones'
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
