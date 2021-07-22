<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <app-layout-user :user="user">
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
                                        class="
                                            px-6
                                            py-4
                                            whitespace-nowrap
                                            text-sm text-gray-500
                                        "
                                    >
                                        €{{ invoice.price }}
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
    </app-layout-user>
</template>

<script>
import AppLayoutUser from "@/Layouts/AppLayoutUser";

import { DownloadIcon } from "@heroicons/vue/outline";
import Swal from "sweetalert2";
import "sweetalert2/src/sweetalert2.scss";
import moment from "moment";

export default {
    props: ["user", "invoices"],
    components: {
        AppLayoutUser,
        DownloadIcon,
    },
    data: () => {
        return {
            invoices: "",
        };
    },
    mounted() {},
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
    },
    setup() {
        return {};
    },
};
</script>
