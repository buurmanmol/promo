<!-- This example requires Tailwind CSS v2.0+ -->
<template>
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
                        Factuur aanmaken
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Selecteer een gebruiker en upload een bijbehorend
                        factuur.
                    </p>
                </div>
                <div
                    class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6"
                >
                    <div class="sm:col-span-6">
                        <label
                            for="country"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Gebruiker
                        </label>
                        <div class="mt-1 flex flex-col">
                            <td class="px-6 py-2 whitespace-nowrap">
                                <vue-select
                                    searchable
                                    v-model="userObject"
                                    :options="usersList"
                                    label-by="first_name"
                                    :close-on-select="true"
                                    class="
                                        shadow-sm
                                        z-30
                                        focus:ring-azure-radiance-500
                                        focus:border-azure-radiance-500
                                        block
                                        w-full
                                        sm:text-sm
                                        border-gray-300
                                        rounded-md
                                    "
                                >
                                    <template #dropdown-item="{ option }">
                                        <div @click="setUser(option)">
                                            {{ option.first_name }}
                                            {{ option.last_name }}
                                        </div>
                                    </template>
                                </vue-select>
                            </td>
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
                                v-model="invoice.userEmail"
                            />
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label
                            for="user_id"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Gebruikers ID
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
                                v-model="invoice.userId"
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
                                v-model="invoice.invoiceName"
                            />
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <div>
                            <label
                                for="price"
                                class="block text-sm font-medium text-gray-700"
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

                    <section class="sm:col-span-3">
                        <label
                            for="cover_photo"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Factuur uploaden
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
                                    >Klik hier om een factuur te uploaden</span
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
</template>
<script>
import AppLayoutAdmin from "@/Layouts/AppLayoutAdmin";
// import UploadInvoice from "../../../Components/UploadInvoice";

export default {
    name: "NewInvoice",
    props: ["usersList"],

    components: {
        // UploadInvoice,
        AppLayoutAdmin,
    },

    data: function () {
        return {};
    },

    mounted() {},

    methods: {
        /**
         * Sets user variables in form in order to check if user is correct. (In case multiple peopleh ave the same name)
         *
         * @author Kevin
         *
         * @version 2.0.0
         */
        setUser(option) {
            this.invoice = {
                userName: option.first_name,
                userEmail: option.email,
                userId: option.id,
            };
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
        },

        /**
         * Checks if form is filled in correctly.
         *
         * @author Kevin
         *
         * @version 1.0.0
         */
        checkForm: function (e) {
            this.errors = [];
            if (!this.invoice.userName) this.errors.push("Naam vereist");
            if (!this.invoice.invoiceName)
                this.errors.push("Factuur naam vereist.");
            if (!this.invoice.file) this.errors.push("Bestand vereist");

            if (this.invoice.price.toString().includes(","))
                this.errors.push("De prijs moet een punt bevatten ipv een komma.");

            if (this.hasLetters(this.invoice.price))
                this.errors.push("De prijs kan geen letters bevatten.");

            if (!this.invoice.price)
                this.errors.push("Factuur prijs vereist.");

            if (!this.errors.length) {
                this.submit();
                return true;
            }
            e.preventDefault();
        },

        /**
         * Submits data and posts it to api
         *
         * @author Kevin
         *
         * @version 1.0.0
         */
        submit() {
            const formData = new FormData();
            formData.set("userId", this.invoice.userId);
            formData.set("invoiceName", this.invoice.invoiceName);
            formData.set("price", this.invoice.price);
            formData.set("file", this.invoice.file);

            axios
                .post("/api/invoice/create", formData)
                .then(() => {
                    window.location = "/admin/facturen";
                })
                .catch((response) => {
                    console.log(response);
                    console.log("FAILURE!!");
                });
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
    },

    watch: {},

    setup() {
        return {};
    },
};
</script>
