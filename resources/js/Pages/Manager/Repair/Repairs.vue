<template>
    <div class="w-full px-4">
        <div class="w-full p-2 mx-auto bg-white rounded-2xl">
            <Disclosure  v-for="repair in repairs" v-slot="{ open }">
                <DisclosureButton
                    class="relative flex justify-between w-full px-4 py-4 my-2 text-md font-medium text-left text-azure-radiance-900 bg-azure-radiance-100 rounded-lg hover:bg-azure-radiance-200 focus:outline-none focus-visible:ring focus-visible:ring-azure-radiance-500 focus-visible:ring-opacity-75"
                >
                    <span v-if="repairs.length >= 0">Reparatie batch: {{formatDate(repair[0].created_at)}}</span>
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
                                    Brand
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Model
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Part
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Repaired
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
                                <td>
                                        <div  v-if="rep.is_repaired" class="px-4 py-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            <span >Gerepareerd</span>
                                        </div>
                                    <div  v-else class="px-4 py-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        <span >Niet gerepareerd</span>
                                    </div>
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
import { Switch } from '@headlessui/vue'
// import VueCurrencyInput from 'vue-currency-input'
import CurrencyInput from "../../../Components/CurrencyInput";
export default {
    name: "Repairs",
    props: ['repairs'],
    components: {
        AppLayoutUser,
        Disclosure,
        CurrencyInput,
        DisclosureButton,
        DisclosurePanel,
        Switch,
        ChevronUpIcon,
    },
    data() {
        return {
            value: 1234
        }
    },
    methods: {
        formatDate(date) {
            moment.locale('nl');
            return moment(date).format('dddd DD MMMM Y')
        },
        postBatch(repairs) {
            axios.post('/api/repairs/invoice/' + repair.id + '/batch' , repair)
                .then((response) => {
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
