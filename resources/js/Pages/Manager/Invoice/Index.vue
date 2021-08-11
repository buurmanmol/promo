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
                                        Totale prijs
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
                                    v-for="(user, key) in staff.data"
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
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div
                                                class="
                                                    text-sm
                                                    text-bold
                                                    text-gray-700
                                                "
                                            >
                                                €{{ getTotalPrice(user.invoices)}}
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
                                                            user.invoices.length
                                                        }}
                                                        Facturen</span
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
                                                            invoice, key
                                                        ) in user.invoices"
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
                                                                        invoice.invoice_name
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
                                                                        formatDate(
                                                                            invoice.created_at
                                                                        )
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
                                                                    €{{
                                                                        invoice.price
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
                                                                    <DownloadIcon
                                                                        @click="
                                                                            downloadInvoice(
                                                                                invoice.id,
                                                                                invoice.created_at
                                                                            )
                                                                        "
                                                                        class="
                                                                            text-azure-radiance-800
                                                                            w-5
                                                                            h-5
                                                                            text-md
                                                                        "
                                                                    />
                                                                </div>
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
import { DownloadIcon } from "@heroicons/vue/outline";

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
    },
    data: () => {
        return {
            page: "invoices",
            open: false,
            enabled: false,
            sortedUsers: [],
            models: [],
            selectedDisclosure: null,
            selectedRepairEdit: null,
        };
    },
    mounted() {},
    watch: {
        brand: function (val) {
            this.getModels(val.name);
        },
    },
    methods: {
        selectDisclosure(key, selectedValue) {
            if (key === selectedValue) {
                this.selectedDisclosure = null;
            } else {
                this.selectedDisclosure = key;
            }
        },

        /**
         * Downloads the invoice, sets the name to "invoice_dd/mm/yyyy.pdf"
         *
         * @author Kevin
         *
         * @version 1.0.0
         */
        downloadInvoice(invoice_id, invoice_date) {
            return axios({
                url: "/api/invoice/" + invoice_id + "/pdf",
                method: "GET",
                responseType: "blob",
            })
                .then((response) => {
                    const url = window.URL.createObjectURL(
                        new Blob([response.data])
                    );
                    const link = document.createElement("a");
                    link.href = url;
                    link.setAttribute(
                        "download",
                        "invoice_" + this.formatDate(invoice_date) + ".pdf"
                    );
                    document.body.appendChild(link);
                    link.click();
                })
                .catch((response) => {
                    Swal.fire("Dit factuur kan niet worden gevonden!");
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
                return moment(String(value)).format("DD/MM/YYYY, h:mm:ss");
            }
        },

        /**
         * fetches a new list of the invoices.
         *
         * @author Kevin
         *
         * @version 1.0.0
         */
        getInvoices() {
            const formData = new FormData();
            formData.set("page", this.invoices.current_page);
            axios
                .post("/api/invoice", formData)
                .then((response) => {
                    this.invoiceList = response.data.invoices;
                })
                .catch((response) => {
                    console.log(response);
                    console.log("FAILURE!");
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
                return moment(String(value)).format("DD/MM/YYYY, h:mm:ss");
            }
        },

        getTotalPrice(invoiceList){
            let totalPrice = 0;
            Object.keys(invoiceList).forEach(function(key) {
                totalPrice+= invoiceList[key].price;
            });
            return totalPrice;
        },
        getTotalManagerPrice(userList){
            let totalPrice = 0;
            Object.keys(userList).forEach(function(key) {
               Object.keys(userList[key].invoices).forEach(function(key2) {
                    totalPrice+= userList[key].invoices[key2].price;
                }); 
            });
            return totalPrice;
        },

    },
    setup() {
        return {};
    },
};
</script>
