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
                    {{ invoice }}

                    {{ client }}
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

                        <div class="sm:col-span-6">
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

                        <section class="sm:col-span-3">
                            <iframe :src="pdfsrc"></iframe>

                            <!-- <pdf src="invoice.invoice_path"></pdf> -->
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
//import pdf from "vue-pdf";
import AppLayoutAdmin from "@/Layouts/AppLayoutAdmin";
export default {
    props: ["client", "invoice"],
    components: {
        AppLayoutAdmin,
        // pdf,
    },

    data: function () {
        return {
            fullname: "",
            pdfsrc: this.invoice.invoice_path,
            errors: [],
        };
    },
    mounted() {
        this.fullname = this.client.first_name + " " + this.client.last_name;
        this.getPDFPath();
    },

    methods: {
        getPDFPath() {
            return axios
                .get("api/invoice/" + this.invoice.id + "/pdf", {
                    invoice: this.invoice.invoice_path,
                    responseType: "blob",
                })
                .then((response) => {
                    console.log("Success", response);
                    const blob = new Blob([response.data]);
                    const objectUrl = URL.createObjectURL(blob);
                    this.pdfsrc = objectUrl;
                })
                .catch(console.error); //
        },

        checkForm: function (e) {
            this.errors = [];
            if (!this.invoice.userName) this.errors.push("Name required.");
            if (!this.invoice.invoiceName)
                this.errors.push("Invoice name required.");

            if (!this.errors.length) {
                this.submit();
                return true;
            }
            e.preventDefault();
        },

        submit() {
            const formData = new FormData();
            formData.set("userId", this.invoice.userId);
            formData.set("invoiceName", this.invoice.invoiceName);
            formData.set("file", this.invoice.file);

            axios
                .post("/api/invoice/create", formData)
                .then(function () {
                    window.location = "/admin/facturen";
                })
                .catch(function (response) {
                    console.log(response);
                    console.log("FAILURE!!");
                });
        },
    },

    setup() {
        return {};
    },
};
</script>
