<template>
    <form @submit.prevent="store">
        <app-text-input v-model="form.name" :error="form.errors.name" class="form-group" label="Nama" />
        <app-file-input v-model="form.image" :error="form.errors.image" class="form-group" label="Gambar" type="file" accept="image/*" />
        <app-switch-input v-model="form.recomendation" :error="form.errors.recomendation" class="form-group" label="Rekomendasi"/>

        <div class="float-end">
            <app-loading-button :loading="form.processing" class="btn btn-primary mx-2" type="submit">Simpan</app-loading-button>
            <Link :href="route('category.index')" class="btn btn-warning">Kembali</Link>
        </div>
    </form>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3'
    import LayoutApp from '../../Layouts/App.vue'
    import TextInput from '../../Components/Shared/TextInput.vue'
    import FileInput from '../../Components/Shared/FileInput.vue'
    import SwitchInput from '../../Components/Shared/SwitchInput.vue'
    import LoadingButton from '../../Components/Shared/LoadingButton.vue'

    export default {
        layout: LayoutApp,
        components: {
            'app-text-input': TextInput,
            'app-file-input': FileInput,
            'app-switch-input': SwitchInput,
            'app-loading-button': LoadingButton,
            'Link': Link
        },
        remember: 'form',
        data() {
            return {
                form: this.$inertia.form({
                    name: null,
                    image: null,
                    recomendation: false
                })
            }
        },
        methods: {
            store() {
                this.form.post(route('category.store'))
            }
        }
    }
</script>
