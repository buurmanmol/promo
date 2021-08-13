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
                        <table  v-if="companyList" class="min-w-full rounded-md divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Naam
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Adres
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
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Verwijderen</span>
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Details</span>
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
                            <tr v-for="company in  searchCompanies.data || companyList.data" :key="company.id">
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
<!--                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">-->
<!--                                    {{ company.phone_number }}-->
<!--                                </td>-->
<!--                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">-->
<!--                                    {{ company.postal_code }}-->
<!--                                </td>-->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-bold text-gray-500">
                                    € {{ company.wallet }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <!-- <a :href="'/admin/company/' + company.id +  '/update'" class="text-azure-radiance-600 hover:text-azure-radiance-900">Edit</a> -->
                                    <PencilIcon @click="editCompany(company.id)" class="text-azure-radiance-800 w-5 h-5 text-md" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <XIcon @click="deleteCompany(company.id)" class="text-azure-radiance-800 w-5 h-5 text-md" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div v-if="company.users.length > 0">
                                        <a :href="'/company/' + company.id + '/details'">
                                            <EyeIcon class="text-azure-radiance-800 w-5 h-5 text-md" />
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div v-if="companyList">
                            <pagination  :links="companies.links" :data="companies"></pagination>
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
import Swal from "sweetalert2";
import { XIcon, PencilIcon, EyeIcon } from "@heroicons/vue/outline";
export default {
    props:['user' , 'companies'],
    components: {
        AppLayoutAdmin,
        EyeIcon,
        TableLoader,
        Pagination,
        PencilIcon,
        XIcon
    },
    data: () => {
        return {
            search: null,
           searchCompanies: [],
            loading:false,
            page:'companies',
            companyList: '',
        }
    },
    created() {
        // this.getCompanies();
        this.setCompanyList();
    },
    methods: {
        setCompanyList(){
            this.companyList = this.companies;
        },
        editCompany(selected){
            window.location = "/admin/company/" + selected + "/update";
        },

        deleteCompany(selected) {
            Swal.fire({
                title: "Weet u zeker dat u dit bedrijf wilt verwijderen?",
                text: "Hierdoor zal dit bedrijf en alle gebruikers hieronder verloren gaan!. ",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ja, verwijder",
                cancelButtonText: "Annuleren",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                    title: "Weet u ECHT zeker dat u dit bedrijf wilt verwijderen?",
                    text: "Hierdoor zal dit bedrijf en alle gebruikers hier onder voor altijd verloren gaan!! ",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ja, verwijder",
                    cancelButtonText: "Annuleren",
                    }).then((result2) => {
                        if (result2.isConfirmed) {
                            axios
                                .delete("/api/company/" + selected + "/delete")
                                .then((response) => {
                                    if(!response.data.error){
                                        this.getPaginatedCompanies();
                                        Swal.fire(
                                            "Poof!",
                                            "Het bedrijf is nu verwijderd.",
                                            "success"
                                        );
                                    }
                                    else{
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Uw eigen bedrijf kan niet verwijderd worden'
                                        });
                                    }
                                })
                                .catch((response) => {
                                    console.log(response);
                                    console.log("FAILURE!!");
                                });

                        }
                    });
                }
            });
        },

        searchCompany() {
            this.loading = true;
            axios.post('/api/companies/search',
                {search: this.search})
                .then((response) => {
                    this.searchCompanies = response.data.companies;
                    this.loading = false;
                }, (error) => {
                    console.log(error);
                });
        },
        getCompanies() {
            axios.get('/api/companies')
                .then((response) => {
                    this.searchCompanies = response.data.companies;
                }, (error) => {
                    console.log(error);
                });
        },

        getPaginatedCompanies() {
            const formData = new FormData();
            formData.set("page", this.companies.current_page);
            axios.post('/api/companies/paginated', formData)
                .then((response) => {
                    this.companyList = response.data.companies;
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
