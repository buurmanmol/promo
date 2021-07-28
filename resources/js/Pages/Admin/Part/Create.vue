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
                            Onderdeel aanmaken
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Type hier de naam van het onderdeel dat u wilt
                            toevoegen.
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
                                for="email"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Onderdeel naam
                            </label>
                            <div class="mt-1">
                                <input
                                    id="naam"
                                    name="naam"
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
                                    v-model="part.name"
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
import { XCircleIcon } from "@heroicons/vue/outline";

export default {
    name: "Part create",
    props: ["parts"],

    components: {
        AppLayoutAdmin,
    },

    data: function () {
        return {
            part: {
                name: "",
            },
            errors: [],
        };
    },

    mounted() {},

    methods: {
        /**
         * Checks if form is filled in correctly.
         *
         * @author Kevin
         *
         * @version 1.0.0
         */
        checkForm: function (e) {
            this.errors = [];
            if (!this.part.name) this.errors.push("Onderdeel naam vereist.");
            if (this.checkIfExists(this.part.name))
                this.errors.push("Dit onderdeel bestaat al!");
            if (!this.errors.length) {
                this.submit();
                return true;
            }
            e.preventDefault();
        },

        checkIfExists(name) {
            this.parts.forEach((part) => {
                if (name.includes(part)) {
                    return true;
                }
            });
            return false;
        },

        /**
         * Submits data and posts it to api
         *
         * @author Kevin
         *
         * @version 1.0.0
         */
        submit() {
            axios
                .post("/api/part/create", this.part)
                .then(() => {
                    window.location = "/admin/parts";
                })
                .catch((response) => {
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
