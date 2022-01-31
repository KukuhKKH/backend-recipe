<template>
    <div class="mt-1">
        <label v-if="label" class="form-label">{{ label }}:</label>
        <div class="form-input p-0" :class="{ 'is-invalid': error }">
            <input ref="file" type="file" :accept="accept" class="d-none" @change="change" />
            <div v-if="!modelValue" class="my-1">
                <button type="button" class="btn btn-success" @click="browse">Browse</button>
            </div>
            <div v-else class="d-flex justify-content-between">
                <div>
                {{ modelValue.name }} <span class="text-gray-500 text-xs">({{ filesize(modelValue.size) }})</span>
                </div>
                <button type="button" class="btn btn-danger" @click="remove">Remove</button>
            </div>
        </div>
        <div v-if="error" class="form-error invalid-feedback">{{ error }}</div>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: File,
        label: String,
        accept: String,
        error: String,
        errors: {
            type: Array,
            default: () => [],
        },
    },
    emits: ['update:modelValue'],
    watch: {
        modelValue(value) {
            if (!value) {
                this.$refs.file.value = ''
            }
        },
    },
    methods: {
        filesize(size) {
            var i = Math.floor(Math.log(size) / Math.log(1024))
            return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i]
        },
        browse() {
            this.$refs.file.click()
        },
        change(e) {
            this.$emit('update:modelValue', e.target.files[0])
        },
        remove() {
            this.$emit('update:modelValue', null)
        },
    },
}
</script>
