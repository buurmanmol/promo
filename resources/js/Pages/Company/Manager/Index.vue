<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <app-layout-company :user="user" :company="company" :page="page">
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
                        <a
                            href="/company/managers/create"
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
                            Manager toevoegen +
                        </a>
                        <table
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
                                            py-3
                                            text-left text-xs
                                            font-medium
                                            text-gray-500
                                            uppercase
                                            tracking-wider
                                        "
                                    >
                                        Manager Naam
                                    </th>
                                    <th
                                        scope="col"
                                        class="
                                            px-6
                                            py-3
                                            text-left text-xs
                                            font-medium
                                            text-gray-500
                                            uppercase
                                            tracking-wider
                                        "
                                    >
                                        Adres
                                    </th>
                                    <th
                                        scope="col"
                                        class="
                                            px-6
                                            py-3
                                            text-left text-xs
                                            font-medium
                                            text-gray-500
                                            uppercase
                                            tracking-wider
                                        "
                                    >
                                        Telefoon nummer
                                    </th>
                                    <th
                                        scope="col"
                                        class="
                                            px-6
                                            py-3
                                            text-left text-xs
                                            font-medium
                                            text-gray-500
                                            uppercase
                                            tracking-wider
                                        "
                                    >
                                        Aantal Medewerkers
                                    </th>

                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Details</span>
                                    </th>

                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Delete</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <template
                                    v-for="(manager, key) in managerList"
                                    :key="manager.id"
                                >
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div
                                                class="
                                                    text-sm
                                                    text-bold
                                                    text-gray-700
                                                "
                                            >
                                                {{ manager.first_name }}
                                                {{ manager.last_name }}
                                            </div>
                                            <div
                                                class="
                                                    text-sm
                                                    text-bold
                                                    text-gray-500
                                                "
                                            >
                                                {{ manager.email }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div
                                                class="
                                                    text-sm
                                                    text-bold
                                                    text-gray-700
                                                "
                                            >
                                                {{ manager.address }}
                                            </div>
                                            <div
                                                class="
                                                    text-sm
                                                    text-bold
                                                    text-gray-500
                                                "
                                            >
                                                {{ manager.postal_code }}
                                                {{ manager.province }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div
                                                class="
                                                    text-sm
                                                    text-bold
                                                    text-gray-700
                                                "
                                            >
                                                {{ manager.phone_number }}
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
                                            <Disclosure>
                                                <DisclosureButton
                                                    @click="
                                                        selectDisclosure(
                                                            key,
                                                            selectedDisclosure
                                                        )
                                                    "
                                                    class="
                                                        flex
                                                        justify-between
                                                        w-full
                                                        px-4
                                                        py-2
                                                        text-sm
                                                        font-medium
                                                        text-left
                                                        text-azure-radiance-900
                                                        bg-azure-radiance-100
                                                        rounded-lg
                                                        hover:bg-azure-radiance-200
                                                        focus:outline-none
                                                        focus-visible:ring
                                                        focus-visible:ring-azure-radiance-500
                                                        focus-visible:ring-opacity-75
                                                    "
                                                >
                                                    <span>
                                                        {{
                                                            manager.users.length
                                                        }}
                                                        Medewerkers</span
                                                    >
                                                    <ChevronUpIcon
                                                        :class="
                                                            key ===
                                                            selectedDisclosure
                                                                ? 'transform transition duration-200 rotate-180'
                                                                : ''
                                                        "
                                                        class="
                                                            w-5
                                                            h-5
                                                            text-azure-radiance-500
                                                        "
                                                    />
                                                </DisclosureButton>
                                            </Disclosure>
                                        </td>
                                        <td
                                            class="
                                                px-6
                                                py-4
                                                whitespace-nowrap
                                                text-right text-sm
                                                font-medium
                                            "
                                        >
                                            <PencilIcon
                                                @click="editManager(manager.id)"
                                                class="
                                                    text-azure-radiance-800
                                                    w-5
                                                    h-5
                                                    text-md
                                                "
                                            />
                                        </td>
                                        <td
                                            class="
                                                px-6
                                                py-4
                                                whitespace-nowrap
                                                text-right text-sm
                                                font-medium
                                            "
                                        >
                                            <XIcon
                                                @click="
                                                    deleteManager(manager.id)
                                                "
                                                class="
                                                    text-azure-radiance-800
                                                    w-5
                                                    h-5
                                                    text-md
                                                "
                                            />
                                        </td>
                                    </tr>
                                    <tr v-if="key === selectedDisclosure">
                                        <td colspan="6">
                                            <table
                                                class="
                                                    min-w-full
                                                    rounded-md
                                                    divide-y divide-gray-200
                                                "
                                            >
                                                <tbody
                                                    class="
                                                        bg-white
                                                        max-h-96
                                                        overflow-y-scroll
                                                        divide-y divide-gray-200
                                                    "
                                                >
                                                    <template
                                                        v-for="(
                                                            user, key
                                                        ) in manager.users"
                                                    >
                                                        <tr>
                                                            <td
                                                                class="
                                                                    px-6
                                                                    py-2
                                                                    whitespace-nowrap
                                                                "
                                                            >
                                                                <div
                                                                    class="
                                                                        text-sm
                                                                        text-bold
                                                                        text-gray-500
                                                                    "
                                                                >
                                                                    #
                                                                    {{
                                                                        key + 1
                                                                    }}
                                                                </div>
                                                            </td>
                                                            <td
                                                                class="
                                                                    px-6
                                                                    py-4
                                                                    whitespace-nowrap
                                                                "
                                                            >
                                                                <div
                                                                    class="
                                                                        text-sm
                                                                        text-bold
                                                                        text-gray-700
                                                                    "
                                                                >
                                                                    {{
                                                                        user.first_name
                                                                    }}
                                                                    {{
                                                                        user.last_name
                                                                    }}
                                                                </div>
                                                                <div
                                                                    class="
                                                                        text-sm
                                                                        text-bold
                                                                        text-gray-500
                                                                    "
                                                                >
                                                                    {{
                                                                        user.email
                                                                    }}
                                                                </div>
                                                            </td>
                                                            <td
                                                                class="
                                                                    px-6
                                                                    py-4
                                                                    whitespace-nowrap
                                                                "
                                                            >
                                                                <div
                                                                    class="
                                                                        text-sm
                                                                        text-bold
                                                                        text-gray-700
                                                                    "
                                                                >
                                                                    {{
                                                                        user.address
                                                                    }}
                                                                </div>
                                                                <div
                                                                    class="
                                                                        text-sm
                                                                        text-bold
                                                                        text-gray-500
                                                                    "
                                                                >
                                                                    {{
                                                                        user.postal_code
                                                                    }}
                                                                    {{
                                                                        user.province
                                                                    }}
                                                                </div>
                                                            </td>
                                                            <td
                                                                class="
                                                                    px-6
                                                                    py-4
                                                                    whitespace-nowrap
                                                                "
                                                            >
                                                                <div
                                                                    class="
                                                                        text-sm
                                                                        text-bold
                                                                        text-gray-700
                                                                    "
                                                                >
                                                                    {{
                                                                        user.phone_number
                                                                    }}
                                                                </div>
                                                            </td>
                                                            <td
                                                                class="
                                                                    px-6
                                                                    py-4
                                                                    whitespace-nowrap
                                                                    text-right
                                                                    text-sm
                                                                    font-medium
                                                                "
                                                            >
                                                                <PencilIcon
                                                                    @click="
                                                                        editUser(
                                                                            user.id
                                                                        )
                                                                    "
                                                                    class="
                                                                        text-azure-radiance-800
                                                                        w-5
                                                                        h-5
                                                                        text-md
                                                                    "
                                                                />
                                                            </td>
                                                            <td
                                                                class="
                                                                    px-6
                                                                    py-4
                                                                    whitespace-nowrap
                                                                    text-right
                                                                    text-sm
                                                                    font-medium
                                                                "
                                                            >
                                                                <XIcon
                                                                    v-if="
                                                                        user.id !==
                                                                        manager.id
                                                                    "
                                                                    @click="
                                                                        deleteUser(
                                                                            user.id
                                                                        )
                                                                    "
                                                                    class="
                                                                        text-azure-radiance-800
                                                                        w-5
                                                                        h-5
                                                                        text-md
                                                                    "
                                                                />
                                                            </td>
                                                        </tr>
                                                    </template>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        <!-- <pagination
                            :data="staff.data"
                            :links="staff.links"
                        ></pagination> -->
                    </div>
                </div>
            </div>
        </div>
    </app-layout-company>
</template>

<script>
import AppLayoutCompany from "@/Layouts/AppLayoutCompany";
import { ChevronUpIcon } from "@heroicons/vue/solid";
import { XIcon, PencilIcon, EyeIcon } from "@heroicons/vue/outline";

import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import Swal from "sweetalert2";
import Pagination from "../../../Components/Pagination";
import "sweetalert2/src/sweetalert2.scss";

import moment from "moment";

export default {
    name: "invoices",
    props: ["managers", "user", "company"],
    components: {
        AppLayoutCompany,
        Disclosure,
        DisclosureButton,
        DisclosurePanel,
        Pagination,
        EyeIcon,
        ChevronUpIcon,
        XIcon,
        PencilIcon,
    },
    data: () => {
        return {
            page: "managers",
            open: false,
            enabled: false,
            managerList: [],
            sortedUsers: [],
            models: [],
            selectedDisclosure: null,
            selectedRepairEdit: null,
        };
    },
    mounted() {
        this.setManagerList();
    },
    watch: {},
    methods: {
        setManagerList() {
            this.managerList = this.managers;
        },

        editManager(selected) {
            window.location = "/company/managers/" + selected + "/update";
        },

        deleteManager(selected) {
            Swal.fire({
                title: "Weet u zeker dat u deze manager wilt verwijderen?",
                text: "Hierdoor zal deze manager verloren gaan! Alle gebruikers onder deze manager zullen doorgeschoven worden!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ja, verwijder",
                cancelButtonText: "Annuleren",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Weet u ECHT zeker dat u deze manager wilt verwijderen?",
                        text: "Hierdoor zal deze manager verloren gaan! Alle gebruikers onder deze manager zullen doorgeschoven worden!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ja, verwijder",
                        cancelButtonText: "Annuleren",
                    }).then((result2) => {
                        if (result2.isConfirmed) {
                            axios
                                .delete(
                                    "/api/user/manager/" + selected + "/delete"
                                )
                                .then((response) => {
                                    if (!response.data.error) {
                                        this.getManagers();
                                        Swal.fire(
                                            "Poof!",
                                            "Deze manager is nu verwijderd.",
                                            "success"
                                        );
                                    } else {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Error",
                                            text: "De laatste manager kan niet worden verwijderd! Een bedrijf kan niet zonder managers zijn!",
                                        });
                                    }
                                })
                                .catch((response) => {
                                    console.log(response);
                                    console.log("FAILURE!!");
                                });
                        }
                    });
                }
            });
        },

        editUser(selected) {
            window.location = "/company/users/" + selected + "/update";
        },

        deleteUser(selected) {
            Swal.fire({
                title: "Weet u zeker dat u deze medewerker wilt verwijderen?",
                text: "Hierdoor zal deze medewerker voor altijd verloren gaan!! ",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ja, verwijder",
                cancelButtonText: "Annuleren",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete("/api/user/" + selected + "/delete")
                        .then((response) => {
                            if (!response.data.error) {
                                this.getManagers();
                                Swal.fire(
                                    "Poof!",
                                    "De medewerker is nu verwijderd.",
                                    "success"
                                );
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Error",
                                    text: "U kan deze gebruiker niet verwijderen.",
                                });
                            }
                        })
                        .catch((response) => {
                            console.log(response);
                            console.log("FAILURE!!");
                        });
                }
            });
        },

        selectDisclosure(key, selectedValue) {
            if (key === selectedValue) {
                this.selectedDisclosure = null;
            } else {
                this.selectedDisclosure = key;
            }
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

        getManagers() {
            axios.post("/api/company/getManagers").then(
                (response) => {
                    this.managerList = response.data.managers;
                },
                (error) => {
                    console.log(error);
                }
            );
        },
    },
    setup() {
        return {};
    },
};
</script>
