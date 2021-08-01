<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <app-layout-admin :user="user" :page="page">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div
                    class="
                        py-2
                        align-middle
                        inline-block
                        min-w-full
                        sm:px-6
                        lg:px-8
                    "
                >
                    <div
                        class="
                            shadow
                            overflow-hidden
                            border-b border-gray-200
                            sm:rounded-lg
                        "
                    >
                        <div class="flex">
                        <a
                            href="/admin/part/create"
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
                            Onderdeel toevoegen +
                        </a>
                        <input @input="searchPart" v-model="search" type="text" placeholder="Onderdelen zoeken..." class="h-10 my-4 items-center nline-flex ml-8 shadow-sm focus:ring-indigo-500 align-middle focus:border-indigo-500 block max-w-md sm:text-sm border-gray-300 rounded-md">
                    </div>
                        <table v-if="partList"
                            class="
                                min-w-full
                                rounded-md
                                divide-y divide-gray-200
                            "
                        >
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        scope="col"
                                        class="
                                            px-6
                                            py-4
                                            text-left text-xs
                                            font-medium
                                            text-gray-500
                                            uppercase
                                            tracking-wider
                                        "
                                    >
                                        Onderdeel naam
                                    </th>
                                    <th
                                        scope="col"
                                        class="
                                            px-6
                                            py-4
                                            text-left text-xs
                                            font-medium
                                            text-gray-500
                                            uppercase
                                            tracking-wider
                                        "
                                    >
                                        Gemaakt op
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Delete</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <template v-if="loading">
                                <tr>
                                    <td colspan="6">
                                        <svg v-if="loading" class="animate-spin h-5 w-5 mr-3 text-azure-radiance-600" viewBox="0 0 24 24">
                                            <!-- ... -->
                                        </svg>
                                    </td>
                                </tr>
                            </template>
                                <tr
                                    v-if="partList"
                                    v-for="part in searchParts.data || partList.data"
                                    :key="part.id"
                                >
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div
                                                    class="
                                                        text-sm
                                                        font-medium
                                                        text-gray-900
                                                    "
                                                >
                                                    {{ part.name }}
                                                </div>
                                                <div
                                                    class="
                                                        text-sm text-gray-500
                                                    "
                                                >
                                                    <!-- subtitle for name -->
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td
                                        class="
                                            px-6
                                            py-4
                                            whitespace-nowrap
                                            text-sm text-gray-500
                                        "
                                    >
                                        {{ formatDate(part.created_at) }}
                                    </td>
                                    <td>
                                        <XIcon
                                            class="
                                                text-azure-radiance-800
                                                w-5
                                                h-5
                                                text-md
                                            "
                                            @click="deletePart(part.id)"
                                        />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div v-if="partList">
                        <pagination
                            v-if="partList.data"
                            :data="parts"
                            :links="parts.links"
                        ></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout-admin>
</template>

<script>
import AppLayoutAdmin from "@/Layouts/AppLayoutAdmin";
import Swal from "sweetalert2";
import { XIcon } from "@heroicons/vue/outline";
import Pagination from "../../../Components/Pagination";

import "sweetalert2/src/sweetalert2.scss";
import moment from "moment";

export default {
    props: ["parts", "user", "company"],
    components: {
        AppLayoutAdmin,
        XIcon,
        Pagination,
    },
    data: () => {
        return {
            partList: "",
            page: "parts",
            search: null,
            searchParts: [],
            loading:false,
        };
    },
    mounted() {
        this.setPartList();
    },
    methods: {
        searchPart() {
            this.loading = true;
            axios.post('/api/parts/search',
                {search: this.search})
                .then((response) => {
                    console.log(response);
                    this.searchParts = response.data.parts;
                    this.loading = false;
                }, (error) => {
                    console.log(error);
                });
        },
        setPartList() {
            this.partList = this.parts;
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
                return moment(String(value)).format("DD/MM/YYYY, h:mm:ss");
            }
        },

        /**
         * Deletes invoice with fancy alert box
         *
         * @author Wouter
         * @author Kevin
         *
         * @version 1.2.1
         */
        deletePart(selected) {
            Swal.fire({
                title: "Weet u zeker dat u dit onderdeel wilt verwijderen?",
                text: "Hierdoor zal dit onderdeel verloren gaan!. ",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ja, verwijder",
                cancelButtonText: "Annuleren",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete("/api/part/" + selected + "/delete")
                        .then(() => {
                            this.getParts();
                        })
                        .catch((response) => {
                            console.log(response);
                            console.log("FAILURE!!");
                        });
                    Swal.fire(
                        "Poof!",
                        "Dit onderdeel is nu verwijderd.",
                        "success"
                    );
                }
            });
        },

        /**
         * fetches a new list of the parts.
         *
         * @author Kevin
         *
         * @version 1.0.1
         */
        getParts() {
            const formData = new FormData();
            formData.set('page', this.parts.current_page);
            axios
                .post("/api/parts", formData)
                .then((response) => {
                    // console.log(response);
                    this.partList = response.data.parts;
                })
                .catch((response) => {
                    console.log(response);
                    console.log("FAILURE!");
                });
        },
    },
    setup() {
        return {};
    },
};
</script>
