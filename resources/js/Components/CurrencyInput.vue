<template>
    <input
        class="shadow-sm px-2 focus:ring-indigo-500 py-2 focus:border-indigo-500 block w-full sm:text-sm border border-solid border-gray-300 rounded-md"
        ref="inputRef"
        :value="formattedValue"
    >
</template>

<script>
import useCurrencyInput from 'vue-currency-input'

export default {
    name: 'CurrencyInput',
    props: {
        modelValue: Number, // Vue 2: value
        options: Object,
    },
    setup (props) {
        const { formattedValue, inputRef } = useCurrencyInput(props.options)

        return { inputRef, formattedValue }
    }
}
</script>
