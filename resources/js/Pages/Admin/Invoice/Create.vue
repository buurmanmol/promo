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
                            Factuur aanmaken
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
                                    v-model="invoice.userName"
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
                                    autocomplete="off"
                                    @focus="
                                        modal = true;
                                        $event.target.select();
                                    "
                                />
                                <div v-if="filteredUsers && modal">
                                    <ul>
                                        <li
                                            v-for="filteredUser in filteredUsers"
                                            :key="filteredUser.id"
                                            class="
                                                px-2
                                                py-2
                                                border
                                                cursor-pointer
                                            "
                                            @click="
                                                setUser(
                                                    filteredUser.first_name,
                                                    filteredUser.last_name,
                                                    filteredUser.email,
                                                    filteredUser.id
                                                )
                                            "
                                        >
                                            {{ filteredUser.first_name }}
                                            {{ filteredUser.last_name }}
                                        </li>
                                    </ul>
                                </div>
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
                                    v-model="invoice.userEmail"
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
                                    v-model="invoice.userId"
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
                                    v-model="invoice.invoiceName"
                                />
                            </div>
                        </div>

                        <section class="sm:col-span-3">
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
export default {
    props: ["user", "usersList"],
    components: {
        AppLayoutAdmin,
    },
    data: function () {
        return {
            invoice: {
                userName: "",
                userEmail: "",
                userId: "",
                invoiceName: "",
                file: "",
            },

            modal: false,
            userNameList: this.usersList,
            filteredUsers: [],
            errors: [],
        };
    },
    mounted() {
        this.filterCompanies();
    },

    methods: {
        filterCompanies() {
            var names = JSON.parse(JSON.stringify(this.userNameList));
            this.filteredUsers = names.filter((user) => {
                return user.first_name
                    .toLowerCase()
                    .startsWith(this.invoice.userName.toLowerCase());
            });
        },

        setUser(
            filteredFirstName,
            filteredLastName,
            filteredUserEmail,
            filteredUserId
        ) {
            this.invoice.userName = filteredFirstName + " " + filteredLastName;
            this.invoice.userEmail = filteredUserEmail;
            this.invoice.userId = filteredUserId;
            this.modal = false;
        },

        handleFileUpload(e) {
            this.invoice.file = e.target.files[0];
            console.log(this.invoice.file);
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

    watch: {
        companyName() {
            this.filterCompanies();
        },
    },

    setup() {
        return {};
    },
};
</script>
