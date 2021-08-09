<template>
    <app-layout-admin :user="user"  :page="page" :company="company">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <div class="flex">
                        <a href="/admin/phones/create" type="button" class="my-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-azure-radiance-600 hover:bg-azure-radiance-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-azure-radiance-500">
                            Telefoon toevoegen +
                        </a>
                        <input @input="searchModel" v-model="search" type="text" placeholder="Model zoeken..." class="h-10 my-4 items-center inline-flex ml-8 shadow-sm focus:ring-indigo-500 align-middle focus:border-indigo-500 block max-w-md sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <table v-if="phonesList" class="min-w-full rounded-md divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-20 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Merk
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Model
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <!--                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">-->
                                <!--                                    Aanpassen-->
                                <!--                                </th>-->
                                <!--                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">-->
                                <!--                                    Verwijderen-->
                                <!--                                </th>-->
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
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
                            <tr v-if="phonesList" v-for="phone in searchModels.data || phonesList.data" :key="phone.model" >
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm text-gray-600">
                                                {{ phone.brand }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{phone.model}}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    Active
                  </span>
                                </td>
                                <!--                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">-->
                                <td>
                                    <PencilIcon @click="editPhone(phone.id)" class="text-azure-radiance-800 w-5 h-5 text-md" />
                                    <!--                                    <a :href="'/admin/phone/' + phone.id +  '/update'" class="text-azure-radiance-600 hover:text-azure-radiance-900">Aanpassen</a>-->
                                </td>

                                <!--                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">-->
                                <td>
                                    <XIcon @click="deletePhone(phone.id)" class="text-azure-radiance-800 w-5 h-5 text-md" />
                                    <!--                                    <button type="button" @click="deletePhone(phone.id)" class="text-red-700 hover:text-red-800">Verwijderen</button>-->
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div v-if="phonesList">
                            <pagination v-if="phonesList.links" class="mt-6" :links="phones.links" :data="phones" >

                            </pagination>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </app-layout-admin>
</template>

<script>
import AppLayoutAdmin from "../../../Layouts/AppLayoutAdmin";
import Pagination from "../../../Components/Pagination";
import Swal from "sweetalert2";
import { XIcon, PencilIcon } from "@heroicons/vue/outline";
export default {
    props:['phones','user','company'],
    components: {
        AppLayoutAdmin,
        Pagination,
        XIcon,
        PencilIcon,
    },
    data:() => {
        return{
            search: null,
            loading: false,
            phonesList: '',
            page: 'phones',
            searchModels: [],
        }
    },
    methods: {
        searchModel() {
            this.loading = true;
            axios.post('/admin/api/phones/search',
                {search: this.search})
                .then((response) => {
                    this.searchModels = response.data.phones;
                    this.loading = false;
                }, (error) => {
                    console.log(error);
                });
        },
        setPhonesList(){
            this.phonesList = this.phones;
        },
        deletePhone(phone){
            Swal.fire({
                title: "Weet u zeker dat u dit toestel wilt verwijderen?",
                text: "Hierdoor zal dit toestel verwijdert worden!. ",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ja, verwijder",
                cancelButtonText: "Annuleren",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/admin/api/phone/' + phone + '/delete')
                        .then(() => {
                            this.getPhones();
                        }).catch(() => {
                        console.log(error);
                        console.log("FAILURE!!");
                    });
                    Swal.fire(
                        "Succes!",
                        "Dit toestel is verwijderd.",
                        "success"
                    );
                }
            });
        },
        getPhones(){
            const formData= new FormData();
            formData.set('page', this.phones.current_page);
            axios.post('/admin/api/phones', formData)
                .then((response) => {
                    this.phonesList = response.data.brandsModel;
                    this.searchModels = response.data.brandsModel 
                }, (error) => {
                    console.log(error);
                });
        },
        editPhone(phone){
            window.location = '/admin/phone/' + phone +  '/update';
        }
    },
    mounted() {
        this.setPhonesList();
    },
    setup() {
        return {
        }
    },
}
</script>
