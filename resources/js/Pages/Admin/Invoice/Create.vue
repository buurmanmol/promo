<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <app-layout-admin :user="user">
        <form
            class="p-4 bg-white space-y-8 divide-y divide-gray-200"
            @submit.prevent="checkForm"
            method="POST"
            enctype="multipart/form-data"
        >
            <div class="space-y-8 divide-y divide-gray-200">
                <div class="pt-8">
                    <div class="sm:hidden">
                        <label for="tabs" class="sr-only">Select a tab</label>
                        <select
                            v-model="selectedTab"
                            id="tabs"
                            name="tabs"
                            class="
                                block
                                w-full
                                focus:ring-azure-radiance-500
                                focus:border-azure-radiance-500
                                border-gray-300
                                rounded-md
                            "
                        >
                            <option :value="0" selected>Nieuwe factuur</option>
                            <option :value="1">Upload factuur</option>
                        </select>
                    </div>
                    <div class="hidden px-4 sm:block">
                        <div class="border-b border-gray-200">
                            <nav
                                class="-mb-px flex space-x-8"
                                aria-label="Tabs"
                            >
                                <a
                                    @click="setTab(0)"
                                    :class="[
                                        selectedTab === 0
                                            ? 'border-azure-radiance-500 text-azure-radiance-600'
                                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                                        'group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm',
                                    ]"
                                >
                                    <span>Nieuwe factuur</span>
                                </a>
                                <a
                                    @click="setTab(1)"
                                    :class="[
                                        selectedTab === 1
                                            ? 'border-azure-radiance-500 text-azure-radiance-600'
                                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                                        'group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm',
                                    ]"
                                >
                                    <span>Upload factuur</span>
                                </a>
                            </nav>
                        </div>
                    </div>
                    <div class="grid-cols-1">
                        <div v-if="selectedTab === 0" class="col">
                            <invoice :usersList="usersList"></invoice>
                        </div>
                        <div v-if="selectedTab === 1" class="col">
                            <newInvoice :usersList="usersList"></newInvoice>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </app-layout-admin>
</template>

<script>
import AppLayoutAdmin from "@/Layouts/AppLayoutAdmin";
import NewInvoice from "./NewInvoice";
import Invoice from "./Invoice";

export default {
    name: "Create.vue",
    props: ["user", "usersList"],

    components: {
        AppLayoutAdmin,
        NewInvoice,
        Invoice,
    },
    mounted() {},

    data: function () {
        return {
            selectedTab: 0,
        };
    },

    watch: {},
    methods: {
        setTab(tab) {
            this.selectedTab = tab;
        },
    },

    setup() {
        return {};
    },
};
</script>
