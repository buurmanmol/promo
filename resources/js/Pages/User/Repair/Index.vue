<template>
    <app-layout-user :user="user" :company="company" :page="page">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <a href="/user/repair/create" type="button" class="my-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-azure-radiance-600 hover:bg-azure-radiance-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-azure-radiance-500">
                            Reparatie toevoegen +
                        </a>
                        <div class="w-full px-4">
                            <div class="w-full p-2 mx-auto bg-white rounded-2xl">
                                <Disclosure  v-for="repair in repairs" v-slot="{ open }">
                                    <DisclosureButton
                                        class="flex justify-between w-full px-4 py-4 my-2 text-md font-medium text-left text-azure-radiance-900 bg-azure-radiance-100 rounded-lg hover:bg-azure-radiance-200 focus:outline-none focus-visible:ring focus-visible:ring-azure-radiance-500 focus-visible:ring-opacity-75"
                                    >
                                        <span>Reparatie batch: {{formatDate(repair[0].created_at)}}</span>
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
                                                    Datum
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Prijs
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
                                                        {{ formatDateNormal(rep.repair_date) || '' }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                      <span v-if="rep.price" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        {{ rep.price || 'To be announced'}}F
                                      </span>
                                                        <span v-else class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                           {{ rep.price || 'To be announced'}}
                                    </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </DisclosurePanel>
                                    </transition>
                                </Disclosure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout-user>
</template>

<script>

import moment from 'moment';

import AppLayoutUser from "../../../Layouts/AppLayoutUser";
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
import { ChevronUpIcon } from '@heroicons/vue/solid'
export default {
    name: "Index",
    props:['company','repairs', 'user'],
    components: {
        AppLayoutUser,
        Disclosure,
        DisclosureButton,
        DisclosurePanel,
        ChevronUpIcon,
    },
    data: () =>{
        return {
            page:"reparaties",
        }
    },
    methods: {
        formatDate(date) {
            moment.locale('nl');
            return moment(date).format('dddd DD MMMM Y')
        },
        formatDateNormal(date) {
            moment.locale('nl');
            return moment(date).format('DD-MM-YYYY')
        }
    }
}
</script>

<style scoped>

</style>
