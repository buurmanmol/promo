<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <app-layout-admin :user="user">
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
                                        Name
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
                                        Title
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
                                        Status
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
                                        Role
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
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
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="
                                                px-2
                                                inline-flex
                                                text-xs
                                                leading-5
                                                font-semibold
                                                rounded-full
                                                bg-green-100
                                                text-green-800
                                            "
                                        >
                                            Active
                                        </span>
                                    </td>
                                    <td
                                        class="
                                            px-6
                                            py-4
                                            whitespace-nowrap
                                            text-sm text-gray-500
                                        "
                                    >
                                        {{ invoice.company_id }}
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
                                        <a
                                            :href="
                                                '/admin/factuur/' +
                                                invoice.id +
                                                '/update'
                                            "
                                            class="
                                                text-azure-radiance-600
                                                hover:text-azure-radiance-900
                                            "
                                            >Edit</a
                                        >
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
export default {
    props: ["invoices", "user"],
    components: {
        AppLayoutAdmin,
    },
    mounted() {
        console.log(this.invoices);
    },
    setup() {
        return {};
    },
};
</script>
