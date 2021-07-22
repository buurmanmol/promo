<template>
    <app-layout-admin :user="user">
        <div class="p-4 bg-white space-y-8 divide-y divide-gray-200">
            <div class="space-y-8 divide-y divide-gray-200">
                <div class="pt-8">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Phone information
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Add a new phone to the database by filling in the data into the fields.
                        </p>
                    </div>
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="first_name" class="block text-sm font-medium text-gray-700">
                                Brand
                            </label>
                            <div class="mt-1">
                                <select v-model="phone.brand"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option v-for="brand in phones" :value="brand.name">{{brand.name}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="last_name" class="block text-sm font-medium text-gray-700">
                                Model
                            </label>
                            <div class="mt-1">
                                <input v-model="phone.model" type="text" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
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
                            There were {{ errors.length }} errors with your submission
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
                        Save
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
    props:['phone', 'user', 'phones'],

    components: {
        AppLayoutAdmin,
        XCircleIcon
    },
    data() {
        return {
            errors: [],
            model:'',
        }
    },
    methods: {
        checkForm:function(e) {
            this.errors = [];
            if(!this.phone.brand) this.errors.push("Brand required");
            if(!this.phone.model) this.errors.push("Model required.");

            if (!this.errors.length) {
                this.updatePhone()
                return true;
            }
            e.preventDefault();
        },
        updatePhone(){
            let tellie={
                brand:this.phone.brand,
                model:this.phone.model,
            }
            axios.put('/admin/api/phone/' + this.phone.id +  '/update', tellie)
                .then((response) => {
                    console.log(response);
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
