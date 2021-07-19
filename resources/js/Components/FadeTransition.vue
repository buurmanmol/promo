<template>
    <transition name="fade" v-bind="$attrs" v-on="$listeners">
        <slot></slot>
    </transition>
</template>
<script>
export default {
    inheritAttrs: false
};
</script>
<style>
.fade-leave-active {
    opacity: 0;
    transition-delay: .2s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    transition: opacity .5s;
}
.fade-enter-active {
    opacity: 0;

}
</style>
