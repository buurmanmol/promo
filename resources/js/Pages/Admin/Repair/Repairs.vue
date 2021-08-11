<template>
    <div class="w-full px-4">
        <div class="w-full p-2 mx-auto bg-white rounded-2xl">
            <Disclosure  v-for="repair in repairs" v-slot="{ open }">
                <DisclosureButton
                    class="relative flex justify-between w-full px-4 py-4 my-2 text-md font-medium text-left text-azure-radiance-900 bg-azure-radiance-100 rounded-lg hover:bg-azure-radiance-200 focus:outline-none focus-visible:ring focus-visible:ring-azure-radiance-500 focus-visible:ring-opacity-75"
                >
                     <span v-if="!isCompany">Reparatie batch:</span> <span v-else>{{repair[0].user.first_name}} {{repair[0].user.last_name}} </span> {{formatDate(repair[0].created_at)}}

                    <ChevronUpIcon
                        :class="open ? 'transform rotate-180' : ''"
                        class="w-5 h-5 text-azure-radiance-500"
                    />
                </DisclosureButton>
                <transition
                    enter-active-class="transition duration-300 origin-top ease-out"
                    enter-from-class="transform scale-y-0 opacity-0"
                    enter-to-class="transform scale-y-100 opacity-100"
                    leave-active-class="transition origin-top duration-300 ease-out"
                    leave-from-class="transform scale-y-100 opacity-100"
                    leave-to-class="transform scale-y-0 opacity-0"
                >
                    <DisclosurePanel class="px-4 pt-4 pb-2 sca text-sm text-gray-500">
                        <table class="min-w-full rounded-md divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Merk
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Model
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Onderdeel
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Prijs
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Gerepareerd
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Reparatie datum
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="rep in repair">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ rep.device.brands_models.brand }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ rep.device.brands_models.model }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ rep.product_type.name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                                        <popover-repair-price :repair="rep"></popover-repair-price>
                                    </div>
                                </td>
                                <td>
                                    <Switch
                                        @click="postRepairRepaired(rep)"
                                        v-model="rep.is_repaired"
                                        :class="rep.is_repaired ? 'bg-green-600' : 'bg-red-600'"
                                        class="relative inline-flex items-center h-7 rounded-full w-14"
                                    >
                                        <span class="sr-only">Notificaties inschakelen</span>
                                        <span
                                            :class="rep.is_repaired ? 'translate-x-8' : 'translate-x-1'"
                                            class="inline-block transition duration-200 ease-in-out transform w-5 h-5 transform bg-white rounded-full"
                                        />
                                    </Switch>
                                </td>
                                <td >
                                    <div v-if="rep.repair_date" class="text-sm text-gray-500">
                                        {{formatDateNormal(rep.repair_date)}}
                                    </div>
                                    <div v-else class=" py-1 inline-flex text-xs leading-5 font-semibold text-red-800">
                                        Geen reparatiedatum
                                    </div>
                                </td>
                                <td class="relative">
                                    <button class="mr-6"  @click="setDateToggle(rep)">
                                        <calendar-icon class="w-6 h-6 mt-1 text-azure-radiance-600" />
                                    </button>
                                    <dialog-modal :show="toggleDate === rep.id" @close="toggleDate = null">
                                        <template #title>
                                            Plan de reparatie in
                                        </template>
                                        <template #content>
                                            <div>
                                                <datepicker placeholder="Reparatie datum" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300" v-model="rep.repair_date" />
                                            </div>
                                            <button @click="postDate(rep); setDateToggle(rep)" class="-ml-px mt-4 relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-green-900 bg-green-300 hover:bg-green-400 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                                Save
                                            </button>
                                        </template>
                                    </dialog-modal>
                                    <!--                                                                <date-planner :repair="repair"></date-planner>-->
                                </td>
                                <td>
                                    <button @click="deleteRepair(rep)">
                                        <TrashIcon class="w-5 h-5 text-red-600" />
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </DisclosurePanel>
                </transition>
            </Disclosure>
        </div>
    </div>
</template>

<script>
import moment from "moment";
import AppLayoutUser from "../../../Layouts/AppLayoutUser";
import {Disclosure, DisclosureButton, DisclosurePanel} from "@headlessui/vue";
import {ChevronUpIcon} from "@heroicons/vue/solid/esm";
import PopoverRepairPrice from "./PopoverRepairPrice";
import { Switch } from '@headlessui/vue'
// import VueCurrencyInput from 'vue-currency-input'
import { TrashIcon, CalendarIcon } from '@heroicons/vue/outline'
import DialogModal from "../../../Jetstream/DialogModal";
import CurrencyInput from "../../../Components/CurrencyInput";
import Datepicker from "vue3-datepicker";
import Swal from "sweetalert2";
export default {
    name: "Repairs",
    props: ['repairs', 'isCompany'],
    components: {
        AppLayoutUser,
        Datepicker,
        DialogModal,
        CalendarIcon,
        PopoverRepairPrice,
        Disclosure,
        CurrencyInput,
        DisclosureButton,
        TrashIcon,
        DisclosurePanel,
        Switch,
        ChevronUpIcon,
    },
    data() {
        return {
            value: 1234,
            toggleDate: null,
        }
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
        getRepairs(user) {
            axios.get('/api/repairs/' + user)
                .then((response) => {
                    this.newRepairs = response.data.data
                }, (error) => {
                    console.log(error);
                });
        },
        deleteRepair(repair) {
            axios.delete('/api/repair/' + repair.id + '/delete')
                .then((response) => {
                    this.getRepairs(repair.user_id);
                }, (error) => {
                    console.log(error);
                });
        },
        formatDate(date) {
            moment.locale('nl');
            return moment(date).format('dddd DD MMMM Y')
        },
        formatDateNormal(date) {
            moment.locale('nl');
            return moment(date).format('DD-MM-YYYY')
        },
        postBatch(repairs) {
            axios.post('/api/repairs/invoice/' + repair.id + '/batch' , repair)
                .then((response) => {
                }, (error) => {
                    console.log(error);
                });
        },
        postRepairRepaired(repair, brand, model){
            axios.post('/api/repair/' + repair.id + '/update' , repair)
                .then((response) => {
                    if(repair.is_repaired) {
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
                            title: 'Toestel '  + repair.device.brands_models.brand + ' ' + repair.device.brands_models.model + ' Is nu gerepareerd.'
                        })
                    } else {
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
                            icon: 'warning',
                            title: 'Toestel '  + repair.device.brands_models.brand + ' ' + repair.device.brands_models.model + ' Is nu niet meer gerepareerd.'
                        })
                    }
                }, (error) => {
                    console.log(error);
                });
        },
        postRepair(repair, brand, model){
            axios.post('/api/repair/' + repair.id + '/update' , repair)
                .then((response) => {
                }, (error) => {
                    console.log(error);
                });
        },
    }
}
</script>

<style scoped>
</style>
