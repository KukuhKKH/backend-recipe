<template>
    <div class="input-group mb-3">
        <input type="text" class="form-control" autocomplete="off" placeholder="search" name="search" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
        <button class="btn btn-outline-primary" type="button" @click="$emit('reset')">Reset</button>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: String
    },
    emits: [
        'update:modelValue',
        'reset'
    ]
}
</script>
