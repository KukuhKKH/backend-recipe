<template>
    <div :class="$attrs.class" class="mt-1">
        <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
        <span v-if="warning" class="text-sm text-warning">({{ warning }})</span>
        <input :id="id" ref="input" v-bind="{ ...$attrs, class: null }" class="form-control" :class="{ 'is-invalid': error }" :type="type" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
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
        type: {
            type: String,
            default: 'text'
        },
        error: String,
        label: String,
        modelValue: String,
        warning: String
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

<style scoped>
    .text-sm.text-warning {
        margin-left: 10px;
    }
</style>
