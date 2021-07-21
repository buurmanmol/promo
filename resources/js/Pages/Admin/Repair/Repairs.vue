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
                                    Price
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
                                        {{ rep.brands_models.brand }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ rep.brands_models.model }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ rep.product_type.name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                                        <currency-input
                                            v-model="rep.price"
                                            :options="{ currency: 'EUR', precision: 2, locale:'nl-NL' }"
                                        />
<!--                                        <input v-model="rep.price" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" type="number">-->
                                        <button @click="postRepair(rep)" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">Save</button>
                                    </div>
                                </td>
                                <td>
                                    <Switch
                                    @click="postRepair(rep)"
                                    v-model="rep.is_repaired"
                                    :class="rep.is_repaired ? 'bg-green-600' : 'bg-red-600'"
                                    class="relative inline-flex items-center h-7 rounded-full w-14"
                                >
                                    <span class="sr-only">Enable notifications</span>
                                    <span
                                        :class="rep.is_repaired ? 'translate-x-8' : 'translate-x-1'"
                                        class="inline-block transition duration-200 ease-in-out transform w-5 h-5 transform bg-white rounded-full"
                                    />
                                </Switch>
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
import CurrencyInput from "../../../Components/VueCurrency";
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
                    console.log(response);
                }, (error) => {
                    console.log(error);
                });
        },
        postRepair(repair, brand, model){
            axios.post('/api/repair/' + repair.id + '/update' , repair)
                .then((response) => {
                    console.log(response);
                }, (error) => {
                    console.log(error);
                });
        },
    }
}
</script>

<style scoped>

</style>
