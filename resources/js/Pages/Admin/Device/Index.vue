<template>
    <app-layout-admin :user="user" :page="page">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <div class="flex">
                        <a href="/admin/device/create" type="button" class="my-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-azure-radiance-600 hover:bg-azure-radiance-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-azure-radiance-500">
                            Apparaten toevoegen +
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
                                    Bedrijf
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aantal apparaten
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <template
                                v-if="users" v-for="(user, key) in searchUser.data || users.data" :key="user.id">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-bold text-gray-700">
                                            {{ user.first_name }} {{ user.last_name }}

                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-bold text-gray-700">
                                            {{user.company.name}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <Disclosure>
                                            <DisclosureButton
                                                @click="selectDisclosure(key, selectedDisclosure)"
                                                class="flex justify-between w-full px-4 py-2 text-sm font-medium text-left text-azure-radiance-900 bg-azure-radiance-100 rounded-lg hover:bg-azure-radiance-200 focus:outline-none focus-visible:ring focus-visible:ring-azure-radiance-500 focus-visible:ring-opacity-75"
                                            >
                                                <span>{{user.devices.length}} Apparaten</span>
                                                <ChevronUpIcon
                                                    :class="key === selectedDisclosure ? 'transform transition duration-200 rotate-180' : ''"
                                                    class="w-5 h-5 text-azure-radiance-500"
                                                />
                                            </DisclosureButton>
                                        </Disclosure>
                                    </td>
                                </tr>
                                        <tr  v-if="key === selectedDisclosure">
                                            <td colspan="6">
                                                <table class="min-w-full rounded-md divide-y divide-gray-200">
                                                    <tbody class="bg-white max-h-96 overflow-y-scroll divide-y divide-gray-200">
                                                    <template v-for="(device, key) in user.devices" >
                                                        <tr>
                                                            <td class="px-6 py-2 whitespace-nowrap">
                                                                <div class="text-sm text-bold text-gray-500">
                                                                    # {{ key + 1}}
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-2 whitespace-nowrap">
                                                                <div class="text-sm text-gray-500">
                                                                    {{device.brands_models.brand}}
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-2 whitespace-nowrap">
                                                                <div class="text-sm text-gray-500">
                                                                    {{device.brands_models.model}}
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-2 whitespace-nowrap">
                                                                <div class="text-sm text-gray-500">
                                                                     <XIcon @click="deleteDevice(device.id)" class="text-azure-radiance-800 w-5 h-5 text-md" />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </template>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                            </template>
                            </tbody>
                        </table>
                        <pagination v-if="userList.links" :data="users.data" :links="users.links"></pagination>
                    </div>
                </div>
            </div>
        </div>
    </app-layout-admin>
</template>

<script>
import AppLayoutAdmin from "../../../Layouts/AppLayoutAdmin";
import { ChevronUpIcon } from '@heroicons/vue/solid'
import { EyeIcon, XIcon, BadgeCheckIcon, BanIcon } from '@heroicons/vue/outline'

import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
import { Switch } from '@headlessui/vue'
import VueNextSelect from 'vue-next-select';
import Swal from 'sweetalert2';
import Pagination from "../../../Components/Pagination";
import 'sweetalert2/src/sweetalert2.scss'
export default {
    name: "Index",
    props:['users','user'],
    components: {
        Disclosure,
        DisclosureButton,
        'vue-select': VueNextSelect,
        Switch,
        EyeIcon,
        XIcon,
        DisclosurePanel,
        Pagination,
        BanIcon,
        BadgeCheckIcon,
        AppLayoutAdmin,
        ChevronUpIcon
    },
    data() {
      return {
          open: false,
          model: null,
          productType: null,
          enabled: false,
          sortedUsers: [],
          brand: null,
          models: [],
          selectedDisclosure: null,
          selectedRepairEdit: null,
          page:'devices',
          userList: '',
          search: null,
          loading:false,
          searchUser: [],
      }
    },
    mounted() {
        this.setUserList();
    },
    watch: {
        brand: function (val) {
            // console.log(val)
          this.getModels(val.name);
        }
    },
    computed: {

    },
    methods: {
        searchUsers() {
            this.loading = true;
            axios.post('/api/devices/search',
                {search: this.search})
                .then((response) => {
                    console.log(this.users);
                    console.log(response.data);
                    this.searchUser = response.data.users;
                    this.loading = false;
                }, (error) => {
                    console.log(error);
                });
        },
        setUserList(){
            this.userList = this.users;
        },
        selectDisclosure(key, selectedValue) {
            if(key === selectedValue) {
                this.selectedDisclosure = null;
            } else {
                this.selectedDisclosure = key;
            }
        },
        selectRepairEdit(key, selectedEdit,brand) {
            // this.setRepairEdit(repair.brands_models.brand, repair.brands_models, repair.product_type);
            if(key === selectedEdit) {
                this.selectedRepairEdit = null;
            } else {
                this.selectedRepairEdit = key;
            }
            this.getModels(brand);
        },

        setRepairEdit(brand, model, productType) {
            this.model = model;
            this.brand = brand;
            this.productType = productType;
        },
        postRepair(repair, brand, model){
            axios.post('/api/repair/' + repair.id + '/update' , repair)
                .then((response) => {
                    console.log(response);
                    this.models = response.data.data;
                }, (error) => {
                    console.log(error);
                });
        },
        repairAll(user) {
            Swal.fire({
                title: 'Weet u het zeker?',
                text: "Hierdoor zullen alle reparaties op \" Gerepareerd \" worden gezet. ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ja, repareer alles!',
                cancelButtonText:'Annuleren'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('/api/user/' + this.user.id + '/repair-all', user.repairs)
                        .then((response) => {
                            console.log(response);
                            this.models = response.data.data;
                        }, (error) => {
                            console.log(error);
                        });
                    Swal.fire(
                        'Poof!',
                        'Alle reperaties van deze user zijn op \" Gerepareerd \" gezet.',
                        'success'
                    )
                }
            })

        },
       deleteDevice(id) {
            Swal.fire({
                title: 'Weet u het zeker?',
                text: "Hierdoor zal dit apparaat verwijderd worden van de gebruiker!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ja, verwijder het!',
                cancelButtonText:'Annuleren'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/device/' + id + '/delete')
                        .then((response) => {
                            console.log(response);
                            this.getDevices();
                            // this.models = response.data.data;
                        }, (error) => {
                            console.log(error);
                        });
                    Swal.fire(
                        'Poof!',
                        'Het apparaat is nu verwijderd!',
                        'success'
                    )
                }
            })

        },
        getModels(brand) {
            let newBrand = {'brand': brand}
            console.log(brand)

            axios.post('/api/brand/models', newBrand)
                .then((response) => {
                    console.log(response);
                    this.models = response.data.data;
                }, (error) => {
                    console.log(error);
                });
        },
        getDevices() {
            const formData = new FormData();
            formData.set("page", this.users.current_page);
            axios
                .post("/api/devices", formData)
                .then((response) => {

                    this.searchUser = response.data;

                })
                .catch((response) => {
                    console.log(response);
                    console.log("FAILURE!");
                });
        },
    }
}
</script>

<style scoped>

</style>
