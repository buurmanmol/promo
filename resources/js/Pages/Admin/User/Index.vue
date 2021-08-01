<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <app-layout-admin :user="currentUser" :page="page">
    <div class="flex flex-col">
        <div class="my-2 sm:overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <div class="flex">
                    <a href="/admin/users/create" class="my-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-azure-radiance-600 hover:bg-azure-radiance-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-azure-radiance-500">
                        Gebruiker toevoegen +
                    </a>
                        <input @input="searchUsers" v-model="search" type="text" placeholder="Gebruiker zoeken..." class="h-10 my-4 items-center nline-flex ml-8 shadow-sm focus:ring-indigo-500 align-middle focus:border-indigo-500 block max-w-md sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <table class="min-w-full rounded-md divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Naam
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Adres
                            </th>
<!--                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">-->
<!--                                Postcode-->
<!--                            </th>-->
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Bedrijf
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-if="users" v-for="person in newUsers.data || users.data" :key="person.email">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" :src="person.profile_photo_path" alt="" />
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ person.first_name }} {{person.last_name}}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ person.email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 text-sm text-gray-900 max-w-sm overflow-x-scroll py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ person.address }}</div>
                                <div class="text-sm text-gray-500">{{ person.role }}</div>
                            </td>
                            <td v-if="person.company" class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><a :href="'/admin/company/' + person.company.id">{{ person.company.name }}</a></div>
                                <div class="text-sm text-gray-500">{{ person.company.phone_number }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a :href="'/admin/user/' + person.id + '/update'" class="text-azure-radiance-600 hover:text-azure-radiance-900">Edit</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <pagination v-if="users.links" :links="users.links" :data="users"></pagination>
                </div>
            </div>
        </div>
    </div>
    </app-layout-admin>
</template>

<script>
import AppLayoutAdmin from "@/Layouts/AppLayoutAdmin";
import CreateUser from "@/Pages/Admin/User/Create";
import Pagination from "../../../Components/Pagination";
export default {
    props:['users', 'currentUser'],
    components: {
      AppLayoutAdmin,
        CreateUser,
        Pagination
    },
    setup() {
        return {
        }
    },
    data() {
      return {
          createModal: false,
          page:"users",
          search: null,
          loading:false,
          newUsers: {
              data: null
          },
      }
    },
    methods: {
        searchUsers() {
            this.loading = true;
            axios.post('/api/users/search',
                {search: this.search})
                .then((response) => {
                    console.log(response);
                    this.newUsers = response.data.users;
                    this.loading = false;
                }, (error) => {
                    console.log(error);
                });
        },
        getUsers() {
            axios.get('/api/users')
                .then((response) => {
                    console.log(response);
                    this.newUsers = response.data.users;
                }, (error) => {
                    console.log(error);
                });
        },
        deleteUser() {

        }
    }
}
</script>
