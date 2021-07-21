<template>
    <app-layout-user :user="user">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
<!--                        <a href="/user/device/create" type="button" class="my-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-azure-radiance-600 hover:bg-azure-radiance-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-azure-radiance-500">-->
<!--                            Apparaat(en) toevoegen +-->
<!--                        </a>-->
                            <div class="w-full p-2 mx-auto bg-white rounded-2xl">
                                        <table class="min-w-full rounded-md divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Brand
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Model
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <tr v-for="device in devices.data">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            {{ device.brands_models.brand }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            {{ device.brands_models.model }}
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                <pagination :data="devices" :links="devices.links"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout-user>
</template>

<script>

import moment from 'moment';
import Pagination from "../../../Components/Pagination";
import AppLayoutUser from "../../../Layouts/AppLayoutUser";
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
import { ChevronUpIcon } from '@heroicons/vue/solid'
export default {
    name: "Index",
    props:['devices', 'user'],
    components: {
        AppLayoutUser,
        Disclosure,
        DisclosureButton,
        Pagination,
        DisclosurePanel,
        ChevronUpIcon,
    },
    methods: {
        formatDate(date) {
            moment.locale('nl');
            return moment(date).format('dddd DD MMMM Y')
        }
    }
}
</script>

<style scoped>

</style>
