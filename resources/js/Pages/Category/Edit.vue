<template>
    <form @submit.prevent="update">
        <app-text-input v-model="form.name" :error="form.errors.name" class="form-group" label="Nama" />
        <app-file-input v-model="form.image" :error="form.errors.image" class="form-group" label="Gambar" type="file" accept="image/*" />
        <p class="text-sm text-warning">Kosongkan jika tidak ingin mengganti gambar</p>
        <app-switch-input v-model="form.recomendation" :error="form.errors.recomendation" class="form-group" label="Rekomendasi"/>

        <img :src="category.image_url" :alt="category.name" class="img-fluid img-thumbnail" style="max-height: 400px">

        <div class="float-end">
            <app-loading-button :loading="form.processing" class="btn btn-theme mx-2" type="submit">Ubah</app-loading-button>
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
        props: {
            category: Object
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: this.category.name,
                    image: null,
                    recomendation: this.category.recomendation
                })
            }
        },
        methods: {
            update() {
                this.form.put(route('category.update', this.category.id))
            }
        }
    }
</script>
