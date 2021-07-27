<template>
    <app-layout-admin :page="page"  :company="company">
    </app-layout-admin>
</template>

<script>
import AppLayoutAdmin from "@/Layouts/AppLayoutAdmin";
export default {
    props:['company'],
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
