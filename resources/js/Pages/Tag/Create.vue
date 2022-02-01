<template>
    <form @submit.prevent="store">
        <app-text-input v-model="form.name" :error="form.errors.name" class="form-group" label="Nama" />

        <div class="float-end mt-2">
            <app-loading-button :loading="form.processing" class="btn btn-theme mx-2" type="submit">Simpan</app-loading-button>
            <Link :href="route('category.index')" class="btn btn-warning">Kembali</Link>
        </div>
    </form>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3'
    import LayoutApp from '../../Layouts/App.vue'
    import TextInput from '../../Components/Shared/TextInput.vue'
    import LoadingButton from '../../Components/Shared/LoadingButton.vue'

    export default {
        layout: LayoutApp,
        components: {
            'app-text-input': TextInput,
            'app-loading-button': LoadingButton,
            'Link': Link
        },
        remember: 'form',
        data() {
            return {
                form: this.$inertia.form({
                    name: null
                })
            }
        },
        methods: {
            store() {
                this.form.post(route('tag.store'))
            }
        }
    }
</script>
