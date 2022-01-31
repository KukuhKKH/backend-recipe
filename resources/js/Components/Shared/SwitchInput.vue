<template>
    <div :class="$attrs.class" class="form-check form-switch mt-1">
        <input ref="input" type="checkbox" class="form-check-input" :id="id" :class="{ 'is-invalid': error }" v-bind="{ ...$attrs, class: null }" :value="modelValue" @input="$emit('update:modelValue', $event.target.checked)" :checked="modelValue == 1">
        <label v-if="label" class="form-check-label" :for="id">{{ label }}:</label>
        <div v-if="error" class="form-error invalid-feedback">{{ error }}</div>
    </div>
</template>

<script>
import { v4 as uuid } from 'uuid'
export default {
    inheritAttrs: false,
    props: {
        id: {
            type: String,
            default() {
                return `text-input-${uuid()}`
            }
        },
        error: String,
        label: String,
        modelValue: Boolean
    },
    emits: ['update:modelValue'],
    methods: {
        focus() {
            this.$refs.input.focus()
        },
        select() {
            this.$refs.input.select()
        },
        setSelectionRange(start, end) {
            this.$refs.input.setSelectionRange(start, end)
        }
    }
}
</script>
