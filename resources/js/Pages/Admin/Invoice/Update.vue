<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <app-layout-admin :user="user" :page="page">
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
                                Gebruiker
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
                                E-mailadres
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
                                Gebruiker ID
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
                            <div>
                                <label
                                    for="price"
                                    class="
                                        block
                                        text-sm
                                        font-medium
                                        text-gray-700
                                    "
                                    >Factuur prijs</label
                                >
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div
                                        class="
                                            absolute
                                            inset-y-0
                                            left-0
                                            pl-3
                                            flex
                                            items-center
                                            pointer-events-none
                                        "
                                    >
                                        <span class="text-gray-500 sm:text-sm">
                                            €
                                        </span>
                                    </div>
                                    <input
                                        type="text"
                                        name="price"
                                        v-model="invoice.price"
                                        id="price"
                                        class="
                                            focus:ring-indigo-500
                                            focus:border-indigo-500
                                            block
                                            w-full
                                            pl-7
                                            pr-12
                                            sm:text-sm
                                            border-gray-300
                                            rounded-md
                                        "
                                        placeholder="0,00"
                                        aria-describedby="price-currency"
                                    />
                                    <div
                                        class="
                                            absolute
                                            inset-y-0
                                            right-0
                                            pr-3
                                            flex
                                            items-center
                                            pointer-events-none
                                        "
                                    ></div>
                                </div>
                            </div>
                        </div>

                        <section
                            v-if="invoice.invoice_path !== null"
                            class="sm:col-span-3"
                        >
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
                        <section v-else class="sm:col-span-3">
                            <div>
                                Er is nog geen factuur geupload voor deze klant!
                            </div>
                            <label
                                for="cover_photo"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Factuur upload
                            </label>
                            <div
                                class="
                                    border-dashed border-2 border-gray-400
                                    py-12
                                    flex flex-col
                                    justify-center
                                    items-center
                                "
                            >
                                <p
                                    class="
                                        mb-3
                                        font-semibold
                                        text-gray-900
                                        flex flex-wrap
                                        justify-center
                                    "
                                >
                                    <span
                                        >Klik hier om een factuur te
                                        uploaden</span
                                    >
                                </p>
                                <input
                                    type="file"
                                    name="file"
                                    v-on:change="handleFileUpload"
                                    class="
                                        mt-2
                                        rounded-sm
                                        px-3
                                        py-1
                                        bg-gray-200
                                        hover:bg-gray-300
                                        focus:shadow-outline focus:outline-none
                                    "
                                />
                            </div>
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
                            <h1 v-if="errors.length== 1"> Er is 1 probleem gevonden.</h1>
                            <h1 v-else>Er zijn {{ errors.length }} problemen gevonden.</h1>
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
            page:'invoices',
        };
    },
    mounted() {
        this.fullname = this.client.first_name + " " + this.client.last_name;
    },

    watch: {},

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
         * @version 1.0.1
         */
        checkForm: function (e) {
            this.errors = [];
            if (!this.invoice.user_id) this.errors.push("Gebruiker vereist.");
            if (!this.invoice.invoice_name)
                this.errors.push("Factuur naam vereist");

            if (this.invoice.price.toString().includes(","))
                this.errors.push("De prijs moet een punt bevatten ipv een komma.");

            if (this.hasLetters(this.invoice.price))
                this.errors.push("De prijs kan geen letters bevatten");

            if (!this.invoice.price)
                this.errors.push("Factuur prijs vereist");


            if (!this.errors.length) {
                if (this.invoice.file !== undefined) {
                    this.uploadPdf();
                } else {
                    this.submit();
                }

                return true;
            }
            e.preventDefault();
        },

        /**
         * Uploads a pdf;
         */
        uploadPdf() {
            const formData = new FormData();
            formData.set("file", this.invoice.file);

            axios
                .post("/api/invoice/uploadPdf", formData)
                .then((response) => {
                    this.invoice.invoice_path = response.data;
                    this.submit();
                    console.log("WIN");
                })
                .catch((response) => {
                    console.log(response);
                    console.log("FAILURE!!");
                });
        },

        /**
         * Submits the update and reroutes to /admin/facturen
         *
         * @author Kevin
         *
         * @version 1.0.0
         */
        submit() {
            const formData = new FormData();
            formData.set("file", this.invoice.file);

            axios
                .put(
                    "/api/invoice/" + this.invoice.id + "/update",
                    this.invoice
                )
                .then(
                    (response) => {
                        console.log(response);
                        window.location = "/admin/facturen";
                    },
                    (error) => {
                        console.log(error);
                    }
                );
        },

        /**
         * Tests if string contains only letters, returns true or false
         *
         * @author Kevin
         *
         * @version 1.0.0
         */
        hasLetters(val) {
            if (/[a-zA-Z]/.test(val)) return true;
            return false;
        },

        /**
         * Handles the upload of a file.
         *
         * @author Kevin
         *
         * @version 1.0.0
         */
        handleFileUpload(e) {
            this.invoice.file = e.target.files[0];
            console.log(this.invoice.file);
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
