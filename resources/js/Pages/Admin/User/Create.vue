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
                            Personal Information
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Use a permanent address where you can receive mail.
                        </p>
                    </div>
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="first_name" class="block text-sm font-medium text-gray-700">
                                First name
                            </label>
                            <div class="mt-1">
                                <input v-model="user.first_name" type="text" name="first_name" id="first_name" autocomplete="given-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="last_name" class="block text-sm font-medium text-gray-700">
                                Last name
                            </label>
                            <div class="mt-1">
                                <input v-model="user.last_name" type="text" name="last_name" id="last_name" autocomplete="family-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>

                        <div class="sm:col-span-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email address
                            </label>
                            <div class="mt-1">
                                <input v-model="user.email" id="email" name="email" type="email" autocomplete="email" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Password
                            </label>
                            <div class="mt-1">
                                <input v-model="user.password" id="password" name="password" type="password" autocomplete="password" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Phone number
                            </label>
                            <div class="mt-1">
                                <input v-model="user.phone_number" id="phone_number" name="phone_number" type="text" autocomplete="tel" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>

                        <div class="sm:col-span-6">
                            <label for="street_address" class="block text-sm font-medium text-gray-700">
                                Street address
                            </label>
                            <div class="mt-1">
                                <input v-model="user.address" type="text" name="street_address" id="street_address" autocomplete="street-address" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="city" class="block text-sm font-medium text-gray-700">
                                City
                            </label>
                            <div class="mt-1">
                                <input v-model="user.city" autocomplete="address-level2" type="text" name="city" id="city" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="state" class="block text-sm font-medium text-gray-700">
                                State / Province
                            </label>
                            <div class="mt-1">
                                <input v-model="user.province" autocomplete="address-level1" type="text" name="state" id="state" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="zip" class="block text-sm font-medium text-gray-700">
                                ZIP / Postal
                            </label>
                            <div class="mt-1">
                                <input v-model="user.postal_code" type="text" name="zip" id="zip" autocomplete="postal-code" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="zip" class="block text-sm font-medium text-gray-700">
                                Company
                            </label>
                            <div class="mt-1">
                                {{user.company_id}}
                                <select v-model="user.company_id" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  name="company" id="company">
                                    <option v-for="company in companies" :value="company.id">{{company.name}}</option>
                                </select>
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
    props:['user'],
    components: {
        AppLayoutAdmin,
        XCircleIcon
    },
    data() {
      return {
          errors: [],
          selectedCompany: [],
          companies: [],
          user: {
              first_name: '',
              last_name: '',
              city: '',
              address:'',
              province: '',
              postal_code: '',
              phone_number: '',
              company_id: '',
              email: '',
              password: '',
          },
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
            if(!this.user.first_name) this.errors.push("First name required.");
            if(!this.user.last_name) this.errors.push("Last name required.");
            if(!this.user.city) this.errors.push("city required.");
            if(!this.user.province) this.errors.push("province required.");
            if(!this.user.email) this.errors.push("E-mail required.");
            if(!this.user.address) this.errors.push("Address required.");
            if(!this.user.phone_number) this.errors.push("Phone number required.");
            if(!this.user.postal_code) this.errors.push("Postal Code required.");
            if(!this.user.password) this.errors.push("Password Code required.");
            if(!this.user.company_id) this.errors.push("Select a company.");

            if (!this.errors.length) {
                this.createUser()
                return true;
            }
            e.preventDefault();
        },
        createUser(){
            axios.post('/api/users/create', this.user)
                .then((response) => {
                    console.log(response);
                    window.location = '/admin/users'
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
