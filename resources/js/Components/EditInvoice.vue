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
        Invoice Uploaden
    </a>
    <div v-show="error">Er is niet genoeg data meegegeven. Aborting.</div>
</template>

<script>
export default {
    name: "EditInvoice",
    props: ["id", "invoice_name", "price", "user"],
    data: () => {
        return {
            error: false,
        };
    },
    mounted() {
        this.uploadInvoice();
    },
    methods: {
        uploadInvoice() {
            if (
                this.id === undefined ||
                this.invoice_name === undefined ||
                this.price === undefined ||
                this.user === undefined
            ) {
                this.error = true;
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
                    // window.location = "/admin/facturen";
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
