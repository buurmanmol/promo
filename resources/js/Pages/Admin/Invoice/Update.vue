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
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Factuur bekijken
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Selecteer een gebruiker en upload een bijbehorend
                            factuur.
                        </p>
                    </div>
                    <div
                        class="
                            mt-6
                            grid grid-cols-1
                            gap-y-6 gap-x-4
                            sm:grid-cols-6
                        "
                    >
                        <div class="sm:col-span-6">
                            <label
                                for="country"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Voornaam
                            </label>
                            <div class="mt-1 flex flex-col">
                                <input
                                    disabled
                                    v-model="fullname"
                                    name="first_name"
                                    type="text"
                                    class="
                                        shadow-sm
                                        focus:ring-indigo-500
                                        focus:border-indigo-500
                                        block
                                        w-full
                                        sm:text-sm
                                        border-gray-300
                                        rounded-md
                                    "
                                />
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label
                                for="email"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Email address
                            </label>
                            <div class="mt-1">
                                <input
                                    disabled
                                    id="email"
                                    name="email"
                                    type="email"
                                    class="
                                        shadow-sm
                                        focus:ring-indigo-500
                                        focus:border-indigo-500
                                        block
                                        w-full
                                        sm:text-sm
                                        border-gray-300
                                        rounded-md
                                    "
                                    v-model="client.email"
                                />
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label
                                for="user_id"
                                class="block text-sm font-medium text-gray-700"
                            >
                                User ID
                            </label>
                            <div class="mt-1">
                                <input
                                    disabled
                                    id="user_id"
                                    name="user_id"
                                    type="text"
                                    class="
                                        shadow-sm
                                        focus:ring-indigo-500
                                        focus:border-indigo-500
                                        block
                                        w-full
                                        sm:text-sm
                                        border-gray-300
                                        rounded-md
                                    "
                                    v-model="client.id"
                                />
                            </div>
                        </div>

                        <div class="sm:col-span-4">
                            <label
                                for="invoice_name"
                                class="block text-sm font-medium text-gray-700"
                                >Factuur naam</label
                            >
                            <div class="mt-1">
                                <input
                                    type="text"
                                    name="invoice_name"
                                    class="
                                        shadow-sm
                                        focus:ring-indigo-500
                                        focus:border-indigo-500
                                        block
                                        w-full
                                        sm:text-sm
                                        border-gray-300
                                        rounded-md
                                    "
                                    placeholder="F12345678"
                                    v-model="invoice.invoice_name"
                                />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label
                                for="user_id"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Factuur betaald
                            </label>
                            <div class="mt-1">
                                <Switch
                                    v-model="enabled"
                                    :class="[
                                        enabled
                                            ? 'bg-indigo-600'
                                            : 'bg-gray-200',
                                        'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500',
                                    ]"
                                >
                                    <span class="sr-only">Use setting</span>
                                    <span
                                        :class="[
                                            enabled
                                                ? 'translate-x-5'
                                                : 'translate-x-0',
                                            'pointer-events-none relative inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200',
                                        ]"
                                    >
                                        <span
                                            :class="[
                                                enabled
                                                    ? 'opacity-0 ease-out duration-100'
                                                    : 'opacity-100 ease-in duration-200',
                                                'absolute inset-0 h-full w-full flex items-center justify-center transition-opacity',
                                            ]"
                                            aria-hidden="true"
                                        >
                                            <svg
                                                class="h-3 w-3 text-gray-400"
                                                fill="none"
                                                viewBox="0 0 12 12"
                                            >
                                                <path
                                                    d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                />
                                            </svg>
                                        </span>
                                        <span
                                            :class="[
                                                enabled
                                                    ? 'opacity-100 ease-in duration-200'
                                                    : 'opacity-0 ease-out duration-100',
                                                'absolute inset-0 h-full w-full flex items-center justify-center transition-opacity',
                                            ]"
                                            aria-hidden="true"
                                        >
                                            <svg
                                                class="h-3 w-3 text-indigo-600"
                                                fill="currentColor"
                                                viewBox="0 0 12 12"
                                            >
                                                <path
                                                    d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z"
                                                />
                                            </svg>
                                        </span>
                                    </span>
                                </Switch>
                            </div>
                        </div>

                        <section class="sm:col-span-3">
                            <a
                                @click="downloadInvoice"
                                type="button"
                                class="
                                    my-4
                                    inline-flex
                                    items-center
                                    px-3
                                    py-2
                                    border border-transparent
                                    text-sm
                                    leading-4
                                    font-medium
                                    rounded-md
                                    shadow-sm
                                    text-white
                                    bg-azure-radiance-600
                                    hover:bg-azure-radiance-700
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-offset-2
                                    focus:ring-azure-radiance-500
                                "
                            >
                                Factuur downloaden
                            </a>
                        </section>
                    </div>
                </div>
            </div>
            <div v-if="errors.length" class="rounded-md bg-red-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <XCircleIcon
                            class="h-5 w-5 text-red-400"
                            aria-hidden="true"
                        />
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                            There were {{ errors.length }} errors with your
                            submission
                        </h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                <li v-for="error in errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="
                            ml-3
                            inline-flex
                            justify-center
                            py-2
                            px-4
                            border border-transparent
                            shadow-sm
                            text-sm
                            font-medium
                            rounded-md
                            text-white
                            bg-indigo-600
                            hover:bg-indigo-700
                            focus:outline-none
                            focus:ring-2
                            focus:ring-offset-2
                            focus:ring-indigo-500
                        "
                    >
                        Save
                    </button>
                </div>
            </div>
        </form>
    </app-layout-admin>
</template>

<script>
import AppLayoutAdmin from "@/Layouts/AppLayoutAdmin";
import { ref } from "vue";
import { Switch } from "@headlessui/vue";
import moment from "moment";

export default {
    props: ["client", "invoice"],
    components: {
        AppLayoutAdmin,
        Switch,
    },

    data: function () {
        return {
            fullname: "",
            pdfsrc: "",
            errors: [],
        };
    },
    mounted() {
        this.fullname = this.client.first_name + " " + this.client.last_name;
        this.invoice.status === 1
            ? (this.enabled = true)
            : (this.enabled = false);
    },

    watch: {
        /**
         * Checks if enabled is true or false and updates invoice.status correctly.
         */
        enabled: function () {
            this.enabled === true
                ? (this.invoice.status = 1)
                : (this.invoice.status = 0);
        },
    },

    methods: {
        /**
         * Downloads the invoice, sets the name to "invoice_dd/mm/yyyy.pdf"
         *
         * @author Kevin
         *
         * @version 1.0.0
         */
        downloadInvoice() {
            return axios({
                url: "/api/invoice/" + this.invoice.id + "/pdf",
                method: "GET",
                responseType: "blob",
            }).then((response) => {
                const url = window.URL.createObjectURL(
                    new Blob([response.data])
                );
                const link = document.createElement("a");
                link.href = url;
                link.setAttribute(
                    "download",
                    "invoice_" +
                        this.formatDate(this.invoice.created_at) +
                        ".pdf"
                );
                document.body.appendChild(link);
                link.click();
            });
        },

        /**
         * Formats the date from something like "2021-07-20T07:29:02.000000Z" to "20/07/2021"
         *
         * @author Kevin
         *
         * @version 1.0.0
         */
        formatDate(value) {
            if (value) {
                return moment(String(value)).format("DD/MM/YYYY");
            }
        },

        /**
         * Checks if form is filled in
         *
         * @author Kevin
         *
         * @version 1.0.0
         */
        checkForm: function (e) {
            this.errors = [];
            if (!this.invoice.user_id) this.errors.push("User required.");
            if (!this.invoice.invoice_name)
                this.errors.push("Invoice name required.");

            if (!this.errors.length) {
                this.submit();
                return true;
            }
            e.preventDefault();
        },

        /**
         * Submits the update and reroutes to /admin/facturen
         *
         * @author Kevin
         *
         * @version 1.0.0
         */
        submit() {
            axios
                .put(
                    "/api/invoice/" + this.invoice.id + "/update",
                    this.invoice
                )
                .then(
                    (response) => {
                        window.location = "/admin/facturen";
                    },
                    (error) => {
                        console.log(error);
                    }
                );
        },
    },

    setup() {
        const enabled = ref(false);
        return {
            enabled,
        };
    },
};
</script>
