<template>
    <app-layout-admin  :company="company">

    </app-layout-admin>
</template>

<script>
import AppLayoutAdmin from "@/Layouts/AppLayoutAdmin";
export default {
    props:['company'],
    name: "Details",
    components: {
        AppLayoutAdmin
    },
}
</script>

<style scoped>

</style>
