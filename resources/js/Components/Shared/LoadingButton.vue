<template>
    <button :disabled="loading" class="btn btn-success text-center">
        <div v-if="loading" class="spinner-grow text-primary spinner-grow-sm" />
        <slot />
    </button>
</template>

<script>
export default {
    props: {
        loading: Boolean,
    },
}
</script>
