<template>
    <app-layout-admin :user="user" :page="page">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <div class="flex">
                            <a href="/admin/repairs/create" type="button" class="my-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-azure-radiance-600 hover:bg-azure-radiance-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-azure-radiance-500">
                                Reparatie toevoegen +
                            </a>
                            <input @input="searchRepairs" v-model="search" type="text" placeholder="Reparatie zoeken..." class="h-10 my-4 items-center nline-flex ml-8 shadow-sm focus:ring-indigo-500 align-middle focus:border-indigo-500 block max-w-md sm:text-sm border-gray-300 rounded-md">
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
                                    Aantal reparaties
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <template v-if="users"  v-for="(user, key) in newRepairs.data || users.data" :key="user.id">
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
                                    <td class="px-6 py-4 text-bold whitespace-nowrap text-sm text-gray-700">
                                        <span>{{ user.repairs.length }} Reparaties</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <Disclosure v-if="checkRepaired(user.repairs) < user.repairs.length">
                                            <DisclosureButton
                                                @click="selectDisclosure(key, selectedDisclosure)"
                                                class="flex justify-between w-full px-4 py-2 text-sm font-medium text-left text-azure-radiance-900 bg-azure-radiance-100 rounded-lg hover:bg-azure-radiance-200 focus:outline-none focus-visible:ring focus-visible:ring-azure-radiance-500 focus-visible:ring-opacity-75"
                                            >
                                                <span>Reparaties</span>
                                                <ChevronUpIcon
                                                    :class="key === selectedDisclosure ? 'transform transition duration-200 rotate-180' : ''"
                                                    class="w-5 h-5 text-azure-radiance-500"
                                                />
                                            </DisclosureButton>
                                        </Disclosure>
                                        <div class="px-4 py-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800" v-else>
                                            <span>Alle apparaten gerepareerd</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-bold whitespace-nowrap text-sm text-gray-700">
                                        <BanIcon v-if="checkRepaired(user.repairs) < user.repairs.length" class="text-red-600 text-md w-5 h-5 " />
                                        <BadgeCheckIcon v-if="checkRepaired(user.repairs) > 0" class="text-green-600 w-5 h-5 text-md" />
                                    </td>
                                    <td class="px-6 py-4 text-bold whitespace-nowrap text-sm text-gray-700">
                                        <a :href="'/admin/repair/' + user.id">
                                            <EyeIcon class="text-azure-radiance-800 w-5 h-5 text-md" />
                                        </a>
                                    </td>
                                </tr>
                                        <tr  v-if="key === selectedDisclosure">
                                            <td colspan="6">
                                                <table class="min-w-full rounded-md divide-y divide-gray-200">
                                                    <tbody class="bg-white max-h-96 overflow-y-scroll divide-y divide-gray-200">
                                                    <template v-if="checkRepaired(user.repairs) < user.repairs.length" v-for="(repair, key) in user.repairs" >
                                                        <tr>
                                                            <td class="px-6 py-2 whitespace-nowrap">
                                                                <div class="text-sm text-bold text-gray-500">
                                                                    # {{ key + 1}}
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-2 whitespace-nowrap">
                                                                <div class="text-sm text-gray-500">
                                                                    {{repair.device.brands_models.brand}}
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-2 whitespace-nowrap">
                                                                <div class="text-sm text-gray-500">
                                                                    {{repair.device.brands_models.model}}
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-2 whitespace-nowrap">
                                                                <div class="text-sm text-gray-500">
                                                                    {{repair.product_type.name}}
                                                                </div>
                                                            </td>

<!--                                                            <td class="px-6 py-2 whitespace-nowrap">-->
<!--                                                                <div class="text-sm text-gray-500">-->
<!--                                                                    <button @click="selectRepairEdit(key, selectedRepairEdit, repair.device.brands_models.brand ,repair)">Edit</button>-->
<!--                                                                </div>-->
<!--                                                            </td>-->
                                                            <td>
                                                                <popover-repair :data="repair.comment"></popover-repair>

                                                            </td>
                                                            <td>
                                                                <div class="flex content-center flex-wrap">
                                                                    <div class="flex-initial">
                                                                        <Switch
                                                                            @click="postIsRepaired(repair)"
                                                                            v-model="repair.is_repaired"
                                                                            :class="repair.is_repaired ? 'bg-green-600' : 'bg-red-600'"
                                                                            class="relative inline-flex items-center h-7 rounded-full w-14"
                                                                        >
                                                                            <span class="sr-only">Enable notifications</span>
                                                                            <span
                                                                                :class="repair.is_repaired ? 'translate-x-8' : 'translate-x-1'"
                                                                                class="inline-block transition duration-200 ease-in-out transform w-5 h-5 transform bg-white rounded-full"
                                                                            />
                                                                        </Switch>
                                                                    </div>
                                                                    <div class="flex-initial ml-4">
                                                                          <span v-if="repair.is_repaired" class="px-2 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                            Gerepareerd
                                                                          </span>
                                                                        <span v-else class="px-4 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                                               In behandeling
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div v-if="repair.repair_date" class="text-sm text-gray-500">
                                                                    <a :href="'/admin/facturen/' + repair.id + '/create'"><DocumentAddIcon class="h-5 w-5 text-azure-radiance-900"></DocumentAddIcon></a>
                                                                </div>
                                                            </td>
                                                            <td >
                                                                <div v-if="repair.repair_date" class="text-sm text-gray-500">
                                                                    {{formatDate(repair.repair_date)}}
                                                                </div>
                                                                <div v-else class=" py-1 inline-flex text-xs leading-5 font-semibold text-red-800">
                                                                    Geen reparatiedatum
                                                                </div>
                                                            </td>
                                                            <td class="relative">
                                                                <button class="mr-6"  @click="setDateToggle(repair)">
                                                                    <calendar-icon class="w-6 h-6 mt-1 text-azure-radiance-600" />
                                                                </button>
                                                                <dialog-modal :show="toggleDate === repair.id" @close="toggleDate = null">
                                                                    <template #title>
                                                                        Plan de reparatie in
                                                                    </template>
                                                                    <template #content>
                                                                        <div>
                                                                            <datepicker placeholder="Reparatie datum" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300" v-model="repair.repair_date" />
                                                                        </div>
                                                                        <button @click="postDate(repair); setDateToggle(repair)" class="-ml-px mt-4 relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-green-900 bg-green-300 hover:bg-green-400 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                                                            Save
                                                                        </button>
                                                                    </template>
                                                                </dialog-modal>
<!--                                                                <date-planner :repair="repair"></date-planner>-->
                                                            </td>
                                                        </tr>
                                                        <tr v-if="selectedRepairEdit === key">
                                                            <td class="px-6 py-2 whitespace-nowrap"></td>
                                                            <td class="px-6 py-2 whitespace-nowrap">
                                                                <vue-select  searchable v-model="brand" :options="brands" label-by="name" :close-on-select="true" class="shadow-sm z-30 focus:ring-azure-radiance-500 focus:border-azure-radiance-500 block w-full sm:text-sm border-gray-300 rounded-md"></vue-select>
                                                            </td>
                                                            <td class="px-6 py-2 whitespace-nowrap">
                                                                <vue-select  searchable v-model="model" :options="models" label-by="model" :close-on-select="true" class="shadow-sm z-30 focus:ring-azure-radiance-500 focus:border-azure-radiance-500 block w-full sm:text-sm border-gray-300 rounded-md"></vue-select>
                                                            </td>
                                                            <td class="px-6 py-2 whitespace-nowrap">
                                                                <vue-select  searchable v-model="productType" :options="productTypes" label-by="name" :close-on-select="true" class="shadow-sm z-30 focus:ring-azure-radiance-500 focus:border-azure-radiance-500 block w-full sm:text-sm border-gray-300 rounded-md"></vue-select>
                                                            </td>
                                                            <td class="px-6 py-2 whitespace-nowrap"></td>
                                                            <td class="px-6 py-2 whitespace-nowrap"></td>
                                                        </tr>
                                                    </template>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                            </template>
                            </tbody>
                        </table>
                        <pagination v-if="users" :links="sortedUsers.links || users.links" :data="sortedUsers || users"></pagination>
                    </div>
                </div>
            </div>
        </div>
    </app-layout-admin>
</template>

<script>
import AppLayoutAdmin from "../../../Layouts/AppLayoutAdmin";
import { ChevronUpIcon } from '@heroicons/vue/solid'
import { EyeIcon, BadgeCheckIcon, BanIcon, CalendarIcon, DocumentAddIcon } from '@heroicons/vue/outline'
import Pagination from "../../../Components/Pagination";
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
import { Switch } from '@headlessui/vue'
import moment from "moment";
import VueNextSelect from 'vue-next-select';
import Swal from 'sweetalert2'
import 'sweetalert2/src/sweetalert2.scss'
import Datepicker from 'vue3-datepicker'
import DialogModal from "../../../Jetstream/DialogModal";
import PopoverRepair from "./PopoverRepair";
export default {
    name: "Index",
    props:['users', 'user', 'brands', 'brandsModels','productTypes'],
    components: {
        Disclosure,
        moment,
        DisclosureButton,
        PopoverRepair,
        'vue-select': VueNextSelect,
        Datepicker,
        CalendarIcon,
        Switch,
        DialogModal,
        Pagination,
        EyeIcon,
        DisclosurePanel,
        DocumentAddIcon,
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
          search:null,
          lowerLimit: null,
          newRepairs: [],
          toggleDate: null,
          sortedUsers: [],
          brand: null,
          models: [],
          selectedDisclosure: null,
          selectedRepairEdit: null,
          page:'repairs',
      }
    },
    mounted() {
        // let lower = moment();
        // lower.subtract(1, 'd');
        // this.lowerLimit = lower;    },
    },
    watch: {
        brand: function (val) {
          this.getModels(val.name);
        },
        'users.repair.repair_date': function (newVal, oldVal){
            this.postDate(newVal);
        },
    },
    computed: {

    },
    methods: {
        setDateToggle(repair) {
            if(repair.id === this.toggleDate) {
                this.toggleDate = null;
            } else {
                this.toggleDate = repair.id
            }
        },
        postDate(repair) {
            let date = moment(repair.repair_date)
            date.add(1, 'd');
            axios.post('/api/repair/' + repair.id + '/plan' , {repair_date: date})
                .then((response) => {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Datum van reparatie staat ingeplanned.'
                    })

                }, (error) => {
                    console.log(error);
                });
        },
        formatDate(date) {
            let formatted = moment(date)
            return formatted.format('DD-MM-YYYY')
        },
        searchRepairs() {
            axios.post('/api/repairs/search',
                {search: this.search})
                .then((response) => {
                    this.newRepairs = response.data.users;
                }, (error) => {
                    console.log(error);
                });
        },
        sortRepairs(users) {
            let newArray = [];
            this.sortedUsers = this.users
            // users.forEach((user) => {
            //     let repaired = 0;
            //     user.repairs.forEach((repair) => {
            //         if(repair.is_repaired) {
            //             repaired++
            //         }
            //     })
            //     if(repaired < 1) {
            //         newArray.unshift(user);
            //     } else {
            //         newArray.push(user);
            //     }
            // })

            // this.sortedUsers.data = newArray;
        },
        checkRepaired: function(repairs) {
            var i = 0;

            repairs.forEach((repair) => {
               if(repair.is_repaired) {
                   i++;
               }
            });
            return i
        },
        selectDisclosure(key, selectedValue) {
            if(key === selectedValue) {
                this.selectedDisclosure = null;
            } else {
                this.selectedDisclosure = key;
            }
        },
        selectRepairEdit(key, selectedEdit,brand, repair) {
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
                    this.models = response.data.data;
                }, (error) => {
                    console.log(error);
                });
        },
        postIsRepaired(repair, brand, model){
            axios.post('/api/repair/' + repair.id + '/is-repaired' , repair)
                .then((response) => {
                    this.models = response.data.data;
                }, (error) => {
                    console.log(error);
                });
        },
        repairItem(repair, brand, model){
            axios.post('/api/user/' + repair.id + '/repair-all')
                .then((response) => {

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
                     user.repairs.forEach((repair) => {
                        this.repairItem(repair)
                     });
                     this.searchRepairs();
                    Swal.fire(
                        'Poof!',
                        'Alle reperaties van deze user zijn op \" Gerepareerd \" gezet.',
                        'success'
                    )
                }
            })

        },
        getModels(brand) {
            let newBrand = {'brand': brand}

            axios.post('/api/brand/models', newBrand)
                .then((response) => {
                    this.models = response.data.data;
                }, (error) => {
                    console.log(error);
                });
        },
    }
}
</script>

<style scoped>

</style>
