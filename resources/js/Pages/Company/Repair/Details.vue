<template>
    <app-layout-company :company="company" :user="currentUser">
        <div class="bg-white pb-4 shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <div class="md:grid-cols-2 grid grid-cols-1">
                    <div class="col">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{user.first_name}} {{user.last_name}} Reparatie & apparaat informatie
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Alle aangemeldde reparaties en apparaten van de gebruiker {{user.email}}
                        </p>
                    </div>
                    <div class="col">

                    </div>
                </div>

            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Full name
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{user.first_name}} {{user.last_name}}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Application for
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                                <span v-if="user.company">{{ user.company.name }}
                                    </span>
                            <span v-else>Geen bedrijf gevonden</span>
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Email address
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{user.email}}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Telephone
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ user.phone_number }}
                        </dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">
                            About
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim incididunt cillum culpa consequat. Excepteur qui ipsum aliquip consequat sint. Sit id mollit nulla mollit nostrud in ea officia proident. Irure nostrud pariatur mollit ad adipisicing reprehenderit deserunt qui eu.
                        </dd>
                    </div>
                </dl>
            </div>
            <div class="sm:hidden">
                <label for="tabs" class="sr-only">Select a tab</label>
                <select v-model="selectedTab" id="tabs" name="tabs" class="block w-full focus:ring-azure-radiance-500 focus:border-azure-radiance-500 border-gray-300 rounded-md">
                    <option :value="0" selected>Reparaties</option>
                    <option :value="1">Apparaten</option>
                </select>
            </div>
            <div class="hidden px-4 sm:block">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <a @click="selectedTab = 0" :class="[selectedTab === 0 ? 'border-azure-radiance-500 text-azure-radiance-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm']" >
                            <TicketIcon :class="[selectedTab === 0 ? 'text-azure-radiance-500' : 'text-gray-400 group-hover:text-gray-500', '-ml-0.5 mr-2 h-5 w-5']" aria-hidden="true" />
                            <span>Reparaties</span>
                        </a>
                        <a @click="selectedTab = 1" :class="[selectedTab === 1 ? 'border-azure-radiance-500 text-azure-radiance-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm']" >
                            <DeviceMobileIcon :class="[selectedTab === 1 ? 'text-azure-radiance-500' : 'text-gray-400 group-hover:text-gray-500', '-ml-0.5 mr-2 h-5 w-5']" aria-hidden="true" />
                            <span>Apparaten</span>
                        </a>
                        <a @click="selectedTab = 2" :class="[selectedTab === 2 ? 'border-azure-radiance-500 text-azure-radiance-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm']" >
                            <DocumentTextIcon :class="[selectedTab === 2 ? 'text-azure-radiance-500' : 'text-gray-400 group-hover:text-gray-500', '-ml-0.5 mr-2 h-5 w-5']" aria-hidden="true" />
                            <span>Facturen</span>
                        </a>
                    </nav>
                </div>
            </div>
            <div class="grid-cols-1">
                <div v-if="selectedTab === 0" class="col">
                    <repairs :repairs="repairs"></repairs>
                </div>
                <div v-if="selectedTab === 1" class="col">
                    <devices :devices="devices"></devices>
                </div>
                <div v-if="selectedTab === 2" class="col">
                    <invoices :invoices="invoices"></invoices>
                </div>
            </div>
        </div>
        <div>
        </div>
    </app-layout-company>
</template>

<script>
import AppLayoutCompany from "../../../Layouts/AppLayoutCompany";
import {DeviceMobileIcon, TicketIcon, DocumentTextIcon } from '@heroicons/vue/outline'
import Repairs from "../../Manager/Repair/Repairs";
import Devices from "../../Admin/Repair/Devices";
import Invoices from "../../Company/Invoice/Invoices"
import DialogModal from "../../../Jetstream/DialogModal";

export default {
    name: "Details.vue",
    props:['currentUser','user', 'repairs', 'devices', 'invoices', 'company'],
    components: {
        Devices,
        AppLayoutCompany,
        DeviceMobileIcon,
        DocumentTextIcon,
        DialogModal,
        TicketIcon,
        Repairs,
        Invoices
    },
    data() {
        return {
            showModal: false,
            showModalTwo: false,
            selectedTab: 0,
        }
    }
}
</script>

<style scoped>

</style>
