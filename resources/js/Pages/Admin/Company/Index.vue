<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <app-layout-admin :user="user" :page="page">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden  border-b border-gray-200 sm:rounded-lg">
                        <div class="flex">
                        <a href="/admin/company/create" type="button" class="my-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-azure-radiance-600 hover:bg-azure-radiance-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-azure-radiance-500">
                            Bedrijf toevoegen +
                        </a>

                            <input @input="searchCompany" v-model="search" type="text" placeholder="Bedrijf zoeken..." class="h-10 my-4 items-center nline-flex ml-8 shadow-sm focus:ring-indigo-500 align-middle focus:border-indigo-500 block max-w-md sm:text-sm border-gray-300 rounded-md">

                        </div>

<!--                        <table-loader v-if="loading"></table-loader>-->
                        <table  v-if="companies" class="min-w-full rounded-md divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Naam
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Adres
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Telefoonnummer
                                </th>
<!--                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">-->
<!--                                    Postcode-->
<!--                                </th>-->
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Wallet
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Aanpassen</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <template v-if="loading">
                                <tr>
                                    <td colspan="6">
                                        <svg v-if="loading" class="animate-spin h-5 w-5 mr-3 text-azure-radiance-600" viewBox="0 0 24 24">
                                            <!-- ... -->
                                        </svg>
                                    </td>
                                </tr>
                            </template>
                            <tr v-if="companies" v-for="company in  searchCompanies.data || companies.data" :key="company.email">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ company.name }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ company.email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td colspan="1" class="px-6 py-4 max-w-3xl	 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ company.address }}
                                        </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ company.phone_number }}
                                </td>
<!--                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">-->
<!--                                    {{ company.postal_code }}-->
<!--                                </td>-->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-bold text-gray-500">
                                    € {{ company.wallet }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a :href="'/admin/company/' + company.id +  '/update'" class="text-azure-radiance-600 hover:text-azure-radiance-900">Edit</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div v-if="companies">
                            <pagination v-if="companies.links"  :links="companies.links" :data="companies"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout-admin>
</template>

<script>
import TableLoader from "../../../Components/TableLoader";
import AppLayoutAdmin from "@/Layouts/AppLayoutAdmin";
import Pagination from "../../../Components/Pagination";
export default {
    props:['user' , 'companies'],
    components: {
        AppLayoutAdmin,
        TableLoader,
        Pagination
    },
    data: () => {
        return {
            search: null,
           searchCompanies: [],
            loading:false,
            page:'companies',
        }
    },
    created() {
        // this.getCompanies();
    },
    methods: {
        searchCompany() {
            this.loading = true;
            axios.post('/api/companies/search',
                {search: this.search})
                .then((response) => {
                    console.log(response);
                    this.searchCompanies = response.data.companies;
                    this.loading = false;
                }, (error) => {
                    console.log(error);
                });
        },
        getCompanies() {
            axios.get('/api/companies')
                .then((response) => {
                    console.log(response);
                    this.searchCompanies = response.data.companies;
                }, (error) => {
                    console.log(error);
                });
        },
    },

    setup() {
        return {
        }
    },
}
</script>
