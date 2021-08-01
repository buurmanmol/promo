<template>
    <app-layout-user :user="user" :company="company" :page="page">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">
                    <!-- <welcome /> -->
                    <section aria-labelledby="profile-overview-title">
                        <div class="rounded-lg bg-white overflow-hidden shadow">
                            <h2 class="sr-only" id="profile-overview-title">
                                Profile Overview
                            </h2>
                            <div class="bg-white p-6">
                                <div
                                    class="
                                        sm:flex
                                        sm:items-center
                                        sm:justify-between
                                    "
                                >
                                    <div class="sm:flex sm:space-x-5">
                                        <div
                                            class="
                                                mt-4
                                                text-center
                                                sm:mt-0 sm:pt-1 sm:text-left
                                            "
                                        >
                                            <p
                                                class="
                                                    text-xl
                                                    font-bold
                                                    text-gray-900
                                                    sm:text-2xl
                                                "
                                            >
                                                Welkom,
                                                {{ user.first_name }}
                                                {{ user.last_name }}!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section aria-labelledby="quick-links-title">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 p-6">
                            <div
                                v-for="action in actions"
                                :key="action.name"
                                class="
                                    relative
                                    rounded-lg
                                    border border-gray-300
                                    bg-white
                                    px-6
                                    py-5
                                    shadow-sm
                                    flex
                                    items-center
                                    hover:border-gray-600
                                    focus-within:ring-2
                                    focus-within:ring-offset-2
                                    focus-within:ring-indigo-500
                                "
                            >
                                <div class="mt-8 mb-10">
                                    <h3 class="text-lg font-medium">
                                        <a
                                            :href="action.href"
                                            class="focus:outline-none"
                                        >
                                            <span
                                                class="absolute inset-0"
                                                aria-hidden="true"
                                            />
                                            <p
                                                class="
                                                    text-sm
                                                    font-medium
                                                    text-gray-900
                                                "
                                            >
                                                {{ action.name }}
                                            </p>
                                            <p
                                                class="
                                                    text-sm text-gray-500
                                                    truncate
                                                "
                                            >
                                                {{ action.subname }}
                                            </p>
                                        </a>
                                    </h3>
                                    <p class="mt-2 text-sm text-gray-500">
                                        {{ action.message }}
                                    </p>
                                    <span
                                        class="
                                            pointer-events-none
                                            absolute
                                            top-6
                                            right-6
                                            text-gray-300
                                            group-hover:text-gray-400
                                        "
                                        aria-hidden="true"
                                    >
                                        <span
                                            :class="[
                                                'text-azure-radiance-600 prounded-lg inline-flex p-3 ring-4 ring-white',
                                            ]"
                                        >
                                            <component
                                                :is="action.icon"
                                                class="
                                                    h-20
                                                    w-20
                                                    dark:bg-gray-800
                                                "
                                                aria-hidden="true"
                                            />
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </app-layout-user>
</template>

<script>
import AppLayoutUser from "@/Layouts/AppLayoutUser";
import Welcome from "@/Jetstream/Welcome";
import {
    PhoneIcon,
    ClipboardListIcon,
    DeviceMobileIcon,
    PlusCircleIcon,
    BookOpenIcon,
} from "@heroicons/vue/outline";

export default {
    props: ["user", "company"],
    components: {
        AppLayoutUser,
        Welcome,
        PhoneIcon,
        DeviceMobileIcon,
        BookOpenIcon,
        PlusCircleIcon,
        ClipboardListIcon,
    },
    data: () => {
        return {
            page: "dashboard",
            actions: [
                {
                    name: "Mijn facturen",
                    subname: "",
                    message:
                        "Klik hier om naar de pagina te gaan met uw persoonlijke facatures.",
                    href: "/user/facturen",
                    icon: ClipboardListIcon,
                },
                {
                    name: "Nieuwe reparatie",
                    subname: "",
                    message:
                        "Klik hier om een nieuwe reparatieaanvraag te doen!",
                    href: "/user/repair/create",
                    icon: PlusCircleIcon,
                },
                {
                    name: "Mijn apparaten",
                    subname: "",
                    message:
                        "Klik hier om naar de lijst te gaan met al uw apparaten.",
                    href: "/user/apparaten",
                    icon: DeviceMobileIcon,
                },
                {
                    name: "Min reparaties",
                    subname: "",
                    message:
                        "Klik hier om naar het overzicht te gaan met al uw huidige reparaties.",
                    href: "/user/reparaties",
                    icon: BookOpenIcon,
                },
            ],
        };
    },
};
</script>
