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
                        <a
                            href="/admin/facturen/create"
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
                            Factuur toevoegen +
                        </a>
                        <!-- <CreateInvoice
                            :invoice="invoiceName"
                            :user="targetUser"
                        /> -->
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
                                            py-4
                                            text-left text-xs
                                            font-medium
                                            text-gray-500
                                            uppercase
                                            tracking-wider
                                        "
                                    >
                                        Factuur naam
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
                                        Gebruiker
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
                                        Prijs
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Delete</span>
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Download</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr
                                    v-for="invoice in invoices"
                                    :key="invoice.id"
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
                                                    {{ invoice.invoice_name }}
                                                </div>
                                                <div
                                                    class="
                                                        text-sm text-gray-500
                                                    "
                                                >
                                                    {{ invoice.first_name }}
                                                    {{ invoice.last_name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
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
                                                    {{ invoice.first_name }}
                                                    {{ invoice.last_name }}
                                                </div>
                                                <div
                                                    class="
                                                        text-sm text-gray-500
                                                    "
                                                >
                                                    {{ invoice.email }}
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
                                        {{ formatDate(invoice.created_at) }}
                                    </td>
                                    <td
                                        v-if="invoice.price !== null"
                                        class="
                                            px-6
                                            py-4
                                            whitespace-nowrap
                                            text-sm text-gray-500
                                        "
                                    >
                                        €{{ invoice.price }}
                                    </td>
                                    <td
                                        v-else
                                        class="
                                            px-6
                                            py-4
                                            whitespace-nowrap
                                            text-sm text-gray-500
                                        "
                                    >
                                        To be announced
                                    </td>
                                    <td>
                                        <PencilIcon
                                            @click="editInvoice(invoice.id)"
                                            class="
                                                text-azure-radiance-800
                                                w-5
                                                h-5
                                                text-md
                                            "
                                        />
                                    </td>
                                    <td>
                                        <XIcon
                                            class="
                                                text-azure-radiance-800
                                                w-5
                                                h-5
                                                text-md
                                            "
                                            @click="deleteInvoice(invoice.id)"
                                        />
                                    </td>
                                    <td>
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
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </app-layout-admin>
</template>

<script>
import AppLayoutAdmin from "@/Layouts/AppLayoutAdmin";
import Swal from "sweetalert2";
import { DownloadIcon, XIcon, PencilIcon } from "@heroicons/vue/outline";
import CreateInvoice from "../../../Components/CreateInvoice";

import "sweetalert2/src/sweetalert2.scss";
import moment from "moment";

export default {
    props: ["user", "company"],
    components: {
        AppLayoutAdmin,
        DownloadIcon,
        XIcon,
        CreateInvoice,
        PencilIcon,
    },
    data: () => {
        return {
            invoices: "",
            invoiceName: "F1234101010101",
            targetUser: "1",
            page:'invoices',
        };
    },
    mounted() {
        this.getInvoices();
    },
    methods: {
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
                    console.log(response);
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
         * Deletes invoice with fancy alert box
         *
         * @author Wouter
         * @author Kevin
         *
         * @version 1.2.0
         */
        deleteInvoice(selected) {
            Swal.fire({
                title: "Weet u zeker dat u dit factuur wilt verwijderen?",
                text: "Hierdoor zal dit factuur verloren gaan!. ",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ja, verwijder",
                cancelButtonText: "Annuleren",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete("/api/invoice/" + selected + "/delete")
                        .then(() => {
                            this.getInvoices();
                        })
                        .catch((response) => {
                            console.log(response);
                            console.log("FAILURE!!");
                        });
                    Swal.fire(
                        "Poof!",
                        "Dit factuur is nu verwijderd.",
                        "Success"
                    );
                }
            });
        },

        /**
         * fetches a new list of the invoices.
         *
         * @author Kevin
         *
         * @version 1.0.0
         */
        getInvoices() {
            axios
                .get("/api/invoice")
                .then((response) => {
                    this.invoices = response.data;
                })
                .catch((response) => {
                    console.log(response);
                    console.log("FAILURE!");
                });
        },

        editInvoice(invoice_id) {
            window.location = "/admin/factuur/" + invoice_id + "/update";
        },
    },
    setup() {
        return {};
    },
};
</script>
