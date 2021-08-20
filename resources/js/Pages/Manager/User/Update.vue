<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <app-layout-manager :company="company" :user="currentUser" :page="page">
        <div class="p-4 bg-white space-y-8 divide-y divide-gray-200">
            <div class="space-y-8 divide-y divide-gray-200">
                <div class="pt-8">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Persoonlijke informatie
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Gebruik een permanent e-mailadres waarop u e-mails
                            kan ontvangen.
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
                        <div class="sm:col-span-3">
                            <label
                                for="first_name"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Voornaam
                            </label>
                            <div class="mt-1">
                                <input
                                    v-model="user.first_name"
                                    type="text"
                                    name="first_name"
                                    id="first_name"
                                    autocomplete="given-name"
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

                        <div class="sm:col-span-3">
                            <label
                                for="last_name"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Achternaam
                            </label>
                            <div class="mt-1">
                                <input
                                    v-model="user.last_name"
                                    type="text"
                                    name="last_name"
                                    id="last_name"
                                    autocomplete="family-name"
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
                                    v-model="user.email"
                                    id="email"
                                    name="email"
                                    type="email"
                                    autocomplete="email"
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
                                Telefoonnummer
                            </label>
                            <div class="mt-1">
                                <input
                                    v-model="user.phone_number"
                                    id="phone_number"
                                    name="phone_number"
                                    type="text"
                                    autocomplete="telephone"
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

                        <div class="sm:col-span-6">
                            <label
                                for="street_address"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Straatnaam
                            </label>
                            <div class="mt-1">
                                <input
                                    v-model="user.address"
                                    type="text"
                                    name="street_address"
                                    id="street_address"
                                    autocomplete="street-address"
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

                        <div class="sm:col-span-2">
                            <label
                                for="city"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Stad
                            </label>
                            <div class="mt-1">
                                <input
                                    v-model="user.city"
                                    type="text"
                                    name="city"
                                    id="city"
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

                        <div class="sm:col-span-2">
                            <label
                                for="state"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Provincie
                            </label>
                            <div class="mt-1">
                                <input
                                    v-model="user.province"
                                    type="text"
                                    name="state"
                                    id="state"
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

                        <div class="sm:col-span-2">
                            <label
                                for="zip"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Postcode
                            </label>
                            <div class="mt-1">
                                <input
                                    v-model="user.postal_code"
                                    type="text"
                                    name="zip"
                                    id="zip"
                                    autocomplete="postal-code"
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
                            <h1 v-if="errors.length == 1">
                                Er is 1 probleem gevonden.
                            </h1>
                            <h1 v-else>
                                Er zijn {{ errors.length }} problemen gevonden.
                            </h1>
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
                        @click="checkForm"
                        type="button"
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
                        Opslaan
                    </button>
                </div>
            </div>
        </div>
    </app-layout-manager>
</template>

<script>
import AppLayoutManager from "@/Layouts/AppLayoutManager";
import VueNextSelect from "vue-next-select";

export default {
    name: "UserUpdate",
    props: ["user", "currentUser", "company"],
    components: {
        AppLayoutManager,
        "vue-select": VueNextSelect,
    },
    data() {
        return {
            message: "",
            errors: [],
            companies: [],
            selectedCompany: "",
            page: "users",
            companiesJson: [],
            companyUser: [],
            managers: [],
        };
    },
    mounted() {},
    watch: {},
    methods: {
        checkForm: function (e) {
            this.errors = [];
            if (!this.user.manager_id) this.user.manager_id = this.user.id;
            if (!this.user.first_name) this.errors.push("Voornaam vereist.");
            if (!this.user.last_name) this.errors.push("Achternaam vereist.");
            if (!this.user.city) this.errors.push("Stad vereist.");
            if (!this.user.province) this.errors.push("Provincie vereist.");
            if (!this.user.email) this.errors.push("E-mailadres vereist.");
            if (!this.user.address) this.errors.push("Adres vereist.");
            if (!this.user.phone_number)
                this.errors.push("Telefoonnummer vereist.");
            if (!this.user.postal_code) this.errors.push("Postcode vereist.");

            if (!this.errors.length) {
                this.updateUser();
                return true;
            }
            e.preventDefault();
        },
        updateUser() {
            axios.post("/api/user/" + this.user.id + "/update", this.user).then(
                (response) => {
                    this.message = "Reservation updated";
                    window.location = "/admin/users";
                },
                (error) => {
                    console.log(error);
                }
            );
        },
    },
};
</script>
