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
                                href="/admin/company/create"
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
                                Bedrijf toevoegen +
                            </a>

                            <input
                                @input="searchCompany"
                                v-model="search"
                                type="text"
                                placeholder="Bedrijf zoeken..."
                                class="
                                    h-10
                                    my-4
                                    items-center
                                    nline-flex
                                    ml-8
                                    shadow-sm
                                    focus:ring-indigo-500
                                    align-middle
                                    focus:border-indigo-500
                                    block
                                    max-w-md
                                    sm:text-sm
                                    border-gray-300
                                    rounded-md
                                "
                            />
                        </div>

                        <!--                        <table-loader v-if="loading"></table-loader>-->
                        <table
                            v-if="companyList"
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
                                        Naam
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
                                        Wallet
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
                                        Managers en medewerkers
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Aanpassen</span>
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Verwijderen</span>
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Details</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <template v-if="loading">
                                    <tr>
                                        <td colspan="9">
                                            <svg
                                                v-if="loading"
                                                class="
                                                    animate-spin
                                                    h-5
                                                    w-5
                                                    mr-3
                                                    text-azure-radiance-600
                                                "
                                                viewBox="0 0 24 24"
                                            ></svg>
                                        </td>
                                    </tr>
                                </template>
                                <template
                                    v-for="(
                                        company, key
                                    ) in searchCompanies.data ||
                                    companyList.data"
                                    :key="company.id"
                                >
                                    <tr>
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
                                                        {{ company.name }}
                                                    </div>
                                                    <div
                                                        class="
                                                            text-sm
                                                            text-gray-500
                                                        "
                                                    >
                                                        {{ company.email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            colspan="1"
                                            class="
                                                px-6
                                                py-4
                                                max-w-3xl
                                                whitespace-nowrap
                                            "
                                        >
                                            <div class="text-sm text-gray-900">
                                                {{ company.address }}
                                            </div>
                                        </td>
                                        <td
                                            class="
                                                px-6
                                                py-4
                                                whitespace-nowrap
                                                text-sm text-bold text-gray-500
                                            "
                                        >
                                            € {{ company.wallet }}
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
                                                            company.managers
                                                                .length
                                                        }}
                                                        Managers</span
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
                                            <div
                                                v-if="company.users.length > 0"
                                            >
                                                <a
                                                    :href="
                                                        '/company/' +
                                                        company.id +
                                                        '/details'
                                                    "
                                                >
                                                    <EyeIcon
                                                        class="
                                                            text-azure-radiance-800
                                                            w-5
                                                            h-5
                                                            text-md
                                                        "
                                                    />
                                                </a>
                                            </div>
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
                                            <!-- <a :href="'/admin/company/' + company.id +  '/update'" class="text-azure-radiance-600 hover:text-azure-radiance-900">Edit</a> -->
                                            <PencilIcon
                                                @click="editCompany(company.id)"
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
                                                    deleteCompany(company.id)
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
                                    <tr>
                                        <td
                                            colspan="8"
                                            v-if="key === selectedDisclosure"
                                        >
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
                                                            manager, key
                                                        ) in company.managers"
                                                    >
                                                        <tr>
                                                            <td
                                                                class="
                                                                    px-6
                                                                    py-2
                                                                    whitespace-nowrap
                                                                "
                                                            ></td>
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
                                                                        text-gray-900
                                                                    "
                                                                >
                                                                    {{
                                                                        manager.first_name
                                                                    }}
                                                                    {{
                                                                        manager.last_name
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
                                                                        text-gray-900
                                                                    "
                                                                >
                                                                    Aangemaakt
                                                                    op
                                                                </div>
                                                                <div
                                                                    class="
                                                                        text-sm
                                                                        text-gray-500
                                                                    "
                                                                >
                                                                    {{
                                                                        formatDate(
                                                                            manager.created_at
                                                                        )
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
                                                                        text-gray-900
                                                                    "
                                                                >
                                                                    Totale prijs
                                                                    van alle
                                                                    medewerkers
                                                                </div>
                                                                <div
                                                                    class="
                                                                        text-sm
                                                                        text-bold
                                                                        text-gray-500
                                                                    "
                                                                >
                                                                    €{{
                                                                        getTotalManagerPrice(
                                                                            manager.users
                                                                        )
                                                                    }}
                                                                </div>
                                                            </td>
                                                            <td
                                                                class="
                                                                    px-6
                                                                    py-4
                                                                    whitespace-nowrap
                                                                    text-sm
                                                                    text-gray-500
                                                                "
                                                            >
                                                                <Disclosure>
                                                                    <DisclosureButton
                                                                        @click="
                                                                            selectNestedDisclosure(
                                                                                key,
                                                                                selectedNestedDisclosure
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
                                                                                manager
                                                                                    .users
                                                                                    .length
                                                                            }}
                                                                            Medewerkers</span
                                                                        >
                                                                        <ChevronUpIcon
                                                                            :class="
                                                                                key ===
                                                                                selectedNestedDisclosure
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
                                                            <!-- <td
                                                                class="
                                                                    px-6
                                                                    py-4
                                                                    text-bold
                                                                    whitespace-nowrap
                                                                    text-sm
                                                                    text-gray-700
                                                                "
                                                            >
                                                                <a
                                                                    :href="
                                                                        '/company/user/' +
                                                                        manager.id
                                                                    "
                                                                >
                                                                    <EyeIcon
                                                                        class="
                                                                            text-azure-radiance-800
                                                                            w-5
                                                                            h-5
                                                                            text-md
                                                                        "
                                                                    />
                                                                </a>
                                                            </td> -->
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
                                                                        editManager(
                                                                            manager.id
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
                                                                    @click="
                                                                        deleteManager(
                                                                            manager.id
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
                                                        <tr
                                                            v-if="
                                                                key ===
                                                                selectedNestedDisclosure
                                                            "
                                                        >
                                                            <td colspan="9">
                                                                <table
                                                                    class="
                                                                        min-w-full
                                                                        rounded-md
                                                                        divide-y
                                                                        divide-gray-200
                                                                    "
                                                                >
                                                                    <tbody
                                                                        class="
                                                                            bg-white
                                                                            max-h-96
                                                                            overflow-y-scroll
                                                                            divide-y
                                                                            divide-gray-200
                                                                        "
                                                                    >
                                                                        <template
                                                                            v-for="(
                                                                                user,
                                                                                key
                                                                            ) in manager.users"
                                                                        >
                                                                            <tr>
                                                                                <td
                                                                                    class="
                                                                                        px-6
                                                                                        py-2
                                                                                        whitespace-nowrap
                                                                                    "
                                                                                ></td>
                                                                                <td
                                                                                    class="
                                                                                        px-6
                                                                                        py-2
                                                                                        whitespace-nowrap
                                                                                    "
                                                                                ></td>
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
                                                                                            key +
                                                                                            1
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
                                                                                            text-gray-900
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
                                                                                        py-2
                                                                                        whitespace-nowrap
                                                                                    "
                                                                                >
                                                                                    <div
                                                                                        class="
                                                                                            text-sm
                                                                                            text-gray-900
                                                                                        "
                                                                                    >
                                                                                        Aangemaakt
                                                                                        op
                                                                                    </div>
                                                                                    <div
                                                                                        class="
                                                                                            text-sm
                                                                                            text-gray-500
                                                                                        "
                                                                                    >
                                                                                        {{
                                                                                            formatDate(
                                                                                                user.created_at
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
                                                                                            text-gray-900
                                                                                        "
                                                                                    >
                                                                                        Totale
                                                                                        prijs
                                                                                        van
                                                                                        facturen
                                                                                    </div>
                                                                                    <div
                                                                                        class="
                                                                                            text-sm
                                                                                            text-gray-500
                                                                                        "
                                                                                    >
                                                                                        €{{
                                                                                            getTotalPrice(
                                                                                                user.invoices
                                                                                            )
                                                                                        }}
                                                                                    </div>
                                                                                </td>
                                                                                <!-- <td
                                                                                    class="
                                                                                        px-6
                                                                                        py-4
                                                                                        text-bold
                                                                                        whitespace-nowrap
                                                                                        text-sm
                                                                                        text-gray-700
                                                                                    "
                                                                                >
                                                                                    <a
                                                                                        :href="
                                                                                            '/company/user/' +
                                                                                            user.id
                                                                                        "
                                                                                    >
                                                                                        <EyeIcon
                                                                                            class="
                                                                                                text-azure-radiance-800
                                                                                                w-5
                                                                                                h-5
                                                                                                text-md
                                                                                            "
                                                                                        />
                                                                                    </a>
                                                                                </td> -->
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
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        <div v-if="companyList">
                            <pagination
                                :links="companies.links"
                                :data="companies"
                            ></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout-admin>
</template>

<script>
import TableLoader from "../../../Components/TableLoader";
import AppLayoutAdmin from "@/Layouts/AppLayoutAdmin";
import Pagination from "../../../Components/Pagination";
import Swal from "sweetalert2";
import moment from "moment";
import {
    ChevronUpIcon,
    XIcon,
    PencilIcon,
    EyeIcon,
} from "@heroicons/vue/outline";
export default {
    props: ["user", "companies"],
    components: {
        AppLayoutAdmin,
        EyeIcon,
        TableLoader,
        Pagination,
        PencilIcon,
        ChevronUpIcon,
        XIcon,
    },
    data: () => {
        return {
            search: null,
            searchCompanies: [],
            loading: false,
            page: "companies",
            companyList: "",
            selectedDisclosure: null,
            selectedNestedDisclosure: null,
        };
    },
    created() {
        // this.getCompanies();
        this.setCompanyList();
        console.log(this.companies);
    },
    methods: {
        getTotalPrice(invoiceList) {
            let totalPrice = 0;
            Object.keys(invoiceList).forEach(function (key) {
                totalPrice += invoiceList[key].price;
            });
            return totalPrice;
        },

        getTotalManagerPrice(userList) {
            let totalPrice = 0;
            Object.keys(userList).forEach(function (key) {
                Object.keys(userList[key].invoices).forEach(function (key2) {
                    totalPrice += userList[key].invoices[key2].price;
                });
            });
            return totalPrice;
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

        selectDisclosure(key, selectedValue) {
            if (key === selectedValue) {
                this.selectedDisclosure = null;
            } else {
                this.selectedDisclosure = key;
            }
        },
        selectNestedDisclosure(key, selectedValue) {
            if (key === selectedValue) {
                this.selectedNestedDisclosure = null;
            } else {
                this.selectedNestedDisclosure = key;
            }
        },
        setCompanyList() {
            this.companyList = this.companies;
        },
        editCompany(selected) {
            window.location = "/admin/company/" + selected + "/update";
        },

        deleteCompany(selected) {
            Swal.fire({
                title: "Weet u zeker dat u dit bedrijf wilt verwijderen?",
                text: "Hierdoor zal dit bedrijf en alle gebruikers hieronder verloren gaan!. ",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ja, verwijder",
                cancelButtonText: "Annuleren",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Weet u ECHT zeker dat u dit bedrijf wilt verwijderen?",
                        text: "Hierdoor zal dit bedrijf en alle gebruikers hier onder voor altijd verloren gaan!! ",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ja, verwijder",
                        cancelButtonText: "Annuleren",
                    }).then((result2) => {
                        if (result2.isConfirmed) {
                            axios
                                .delete("/api/company/" + selected + "/delete")
                                .then((response) => {
                                    if (!response.data.error) {
                                        this.getPaginatedCompanies();
                                        Swal.fire(
                                            "Poof!",
                                            "Het bedrijf is nu verwijderd.",
                                            "success"
                                        );
                                    } else {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Error",
                                            text: "Uw eigen bedrijf kan niet verwijderd worden",
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

        editManager(selected) {
            window.location = "/admin/user/" + selected + "/update";
        },

        deleteManager(selected) {
            console.log(selected);
            Swal.fire({
                title: "Weet u zeker dat u deze manager wilt verwijderen?",
                text: "Hierdoor zal deze manager en alle gebruikers hieronder verloren gaan!. ",
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
                                    console.log(response.data);
                                    if (!response.data.error) {
                                        this.getPaginatedCompanies();
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
            window.location = "/admin/user/" + selected + "/update";
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
                                this.getPaginatedCompanies();
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

        searchCompany() {
            this.loading = true;
            axios.post("/api/companies/search", { search: this.search }).then(
                (response) => {
                    this.searchCompanies = response.data.companies;
                    this.loading = false;
                },
                (error) => {
                    console.log(error);
                }
            );
        },
        getCompanies() {
            axios.get("/api/companies").then(
                (response) => {
                    this.searchCompanies = response.data.companies;
                },
                (error) => {
                    console.log(error);
                }
            );
        },

        getPaginatedCompanies() {
            const formData = new FormData();
            formData.set("page", this.companies.current_page);
            axios.post("/api/companies/paginated", formData).then(
                (response) => {
                    this.companyList = response.data.companies;
                    this.searchCompanies = response.data.companies;
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
