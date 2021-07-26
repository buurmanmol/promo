<template>
    <app-layout-admin :user="user" :page="page">

    </app-layout-admin>
</template>

<script>
import AppLayoutAdmin from "@/Layouts/AppLayoutAdmin";
export default {
    name: "Details",
    data: () => {
        return {
            page:'phones'
        }
    },
    components: {
        AppLayoutAdmin
    },
}
</script>

<style scoped>

</style>
