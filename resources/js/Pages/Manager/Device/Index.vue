<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <app-layout-manager :user="user" :company="company" :page="page">
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
                                href="/manager/device/create"
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
                                Apparaat toevoegen +
                            </a>
                        </div>
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
                                        Medewerker Naam
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
                                        Aantal apparaten
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <template
                                    v-for="(user, key) in staffList.data"
                                    :key="user.id"
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
                                                {{ user.first_name }}
                                                {{ user.last_name }}
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
                                                    <span
                                                        >{{
                                                            user.devices.length
                                                        }}
                                                        Apparaten</span
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
                                                            device, key
                                                        ) in user.devices"
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
                                                                    py-2
                                                                    whitespace-nowrap
                                                                "
                                                            >
                                                                <div
                                                                    class="
                                                                        text-sm
                                                                        text-gray-500
                                                                    "
                                                                >
                                                                    {{
                                                                        device
                                                                            .brands_models
                                                                            .brand
                                                                    }}
                                                                </div>
                                                            </td>

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
                                                                        text-gray-500
                                                                    "
                                                                >
                                                                    {{
                                                                        device
                                                                            .brands_models
                                                                            .model
                                                                    }}
                                                                </div>
                                                            </td>
                                                            <td
                                                                class="
                                                                    whitespace-nowrap
                                                                    text-right
                                                                    text-sm
                                                                    font-medium
                                                                "
                                                            >
                                                                <XIcon
                                                                    @click="
                                                                        deleteDevice(
                                                                            device.id
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
                        <pagination
                            :data="staff.data"
                            :links="staff.links"
                        ></pagination>
                    </div>
                </div>
            </div>
        </div>
    </app-layout-manager>
</template>

<script>
import AppLayoutManager from "@/Layouts/AppLayoutManager";
import { ChevronUpIcon } from "@heroicons/vue/solid";
import { DownloadIcon, PencilIcon, XIcon } from "@heroicons/vue/outline";

import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import Swal from "sweetalert2";
import Pagination from "../../../Components/Pagination";
import "sweetalert2/src/sweetalert2.scss";

import moment from "moment";

export default {
    name: "invoices",
    props: ["staff", "user", "company"],
    components: {
        DownloadIcon,
        AppLayoutManager,
        Disclosure,
        DisclosureButton,
        DisclosurePanel,
        Pagination,
        ChevronUpIcon,
        PencilIcon,
        XIcon,
    },
    data: () => {
        return {
            page: "apparaten",
            open: false,
            enabled: false,
            sortedUsers: [],
            models: [],
            selectedDisclosure: null,
            selectedRepairEdit: null,
            staffList: [],
        };
    },
    mounted() {
        this.setStaffList();
    },
    watch: {},
    methods: {
        setStaffList() {
            this.staffList = this.staff;
        },
        deleteDevice(selected) {
            Swal.fire({
                title: "Weet u zeker dat u deze gebruiker wilt verwijderen?",
                text: "Hierdoor zal deze gebruiker verloren gaan!. ",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ja, verwijder",
                cancelButtonText: "Annuleren",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete("/api/device/" + selected + "/delete")
                        .then(() => {
                            this.getDevices();
                        })
                        .catch((response) => {
                            console.log(response);
                            console.log("FAILURE!!");
                        });
                    Swal.fire(
                        "Poof!",
                        "Deze gebruiker is nu verwijderd.",
                        "success"
                    );
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
         * fetches a new list of the invoices.
         *
         * @author Kevin
         *
         * @version 1.0.0
         */
        getDevices() {
            const formData = new FormData();
            formData.set("page", this.staff.current_page);
            axios
                .post("/api/manager/devices", formData)
                .then((response) => {
                    this.staffList = response.data.staff;
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
