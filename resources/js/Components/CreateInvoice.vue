<template>
    <a
        @click="uploadInvoice()"
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
        Factuur maken
    </a>
    <div v-show="error">Er is niet genoeg data meegegeven. Aborting.</div>
    <div v-show="success">Het factuur is succesvol gemaakt!.</div>
</template>

<script>
export default {
    name: "CreateInvoice",
    props: ["invoice", "user"],
    data: () => {
        return {
            error: false,
            success: false,
        };
    },
    mounted() {},
    methods: {
        /**
         * create an invoice from a button
         *
         * Requires:
         * invoice name "F12341234"
         * User ID "1"
         *
         * EXAMPLE:
         * <CreateInvoice :invoice="invoiceName" :user="targetUser" />
         */
        uploadInvoice() {
            if (this.user === undefined || this.invoice === undefined) {
                this.error = true;
                return;
            }
            if (this.success) {
                return;
            }
            const formData = new FormData();
            formData.set("userId", this.user);
            formData.set("invoiceName", this.invoice);

            axios
                .post("/api/invoice/create", formData)
                .then((response) => {
                    console.log(response);
                    console.log("WIN");
                    this.success = true;
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
