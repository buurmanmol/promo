<template>
    <app-layout-admin :company="company" :user="currentUser" :page="page">
        <div class="bg-white pb-4 shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <div class="md:grid-cols-2 grid grid-cols-1">
                    <div class="col">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{company.name}} Reparatie & apparaat informatie
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Alle aangemeldde reparaties en apparaten van het bedrijf {{company.name}}
                        </p>
                    </div>
                    <div class="col">

                        <button @click="showModal = true" class="inline-flex ml-2 float-right items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-azure-radiance-600 hover:bg-azure-radiance-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">Create subscription</button>
                        <dialog-modal :show="showModal" @close="showModal = false">
                            <template #title>
                                Create subscription for: {{company.name}}
                            </template>
                            <template #content>
                                <create-subscription :user="user" @closeModal="setModal"></create-subscription>
                            </template>
                        </dialog-modal>
                        <!--                            <button @click="showModalTwo = true" class="mr-2 inline-flex float-right items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-azure-radiance-600 hover:bg-azure-radiance-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">Update subscription</button>-->
                        <!--                            <dialog-modal :show="showModalTwo" @close="showModalTwo = false">-->
                        <!--                                <template #title>-->
                        <!--                                    Update subscription for: {{user.first_name}} {{user.last_name}}-->
                        <!--                                </template>-->
                        <!--                                <template #content>-->
                        <!--                                    <update-subscription></update-subscription>-->
                        <!--                                </template>-->
                        <!--                            </dialog-modal>-->
                    </div>
                </div>
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
                    </nav>
                </div>
            </div>
            <div class="grid-cols-1">
                <div v-if="selectedTab === 0" class="col">
                    <repairs :is-company="true" :repairs="repairs"></repairs>
                </div>
                <div v-if="selectedTab === 1" class="col">
                    <devices :devices="devices"></devices>
                </div>
            </div>
        </div>
        <div>
        </div>
    </app-layout-admin>
</template>

<script>
import AppLayoutAdmin from "../../../Layouts/AppLayoutAdmin";
import {DeviceMobileIcon, TicketIcon } from '@heroicons/vue/outline'
import Repairs from "../Repair/Repairs";
import Devices from "../Repair/Devices";
import Invoices from "../../Company/Invoice/Invoices"
import UpdateSubscription from "../Payment/UpdateSubscription";
import DialogModal from "../../../Jetstream/DialogModal";
import CreateSubscription from "../Payment/CreateSubscription";

export default {
    name: "Details.vue",
    props:['currentUser','user', 'repairs', 'devices', 'invoices','company'],
    components: {
        Devices,
        Invoices,
        AppLayoutAdmin,
        UpdateSubscription,
        CreateSubscription,
        DeviceMobileIcon,
        DialogModal,
        TicketIcon,
        Repairs
    },
    data() {
        return {
            showModal: false,
            showModalTwo: false,
            selectedTab: 0,
            page:'bedrijven',
        }
    },
    methods: {
        setModal(value) {
            this.showModal = value;
        }
    }
}
</script>

<style scoped>

</style>
