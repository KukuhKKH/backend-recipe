<template>
    <form @submit.prevent="store">
        <div class="row">
            <div class="col-md-6">
                <app-text-input v-model="form.name" :error="form.errors.name" class="form-group" label="Nama" />
                <app-text-input v-model="form.username" :error="form.errors.username" class="form-group" label="Username" />
            </div>
            <div class="col-md-6">
                <app-text-input v-model="form.password" :error="form.errors.password" class="form-group" label="Password" type="password" />
                <app-text-input v-model="form.password_confirmation" :error="form.errors.password_confirmation" class="form-group" label="Konfirmasi Password" type="password" />
            </div>
            <app-text-input v-model="form.email" :error="form.errors.email" class="form-group" label="Email" type="email"/>
        </div>

        <app-file-input v-model="form.image" :error="form.errors.image" class="form-group" label="Gambar" type="file" accept="image/*" />

        <div class="float-end">
            <app-loading-button :loading="form.processing" class="btn btn-theme mx-2" type="submit">Simpan</app-loading-button>
            <Link :href="route('user.index')" class="btn btn-warning">Kembali</Link>
        </div>
    </form>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3'
    import LayoutApp from '../../Layouts/App.vue'
    import TextInput from '../../Components/Shared/TextInput.vue'
    import FileInput from '../../Components/Shared/FileInput.vue'
    import LoadingButton from '../../Components/Shared/LoadingButton.vue'

    export default {
        layout: LayoutApp,
        components: {
            'app-text-input': TextInput,
            'app-file-input': FileInput,
            'app-loading-button': LoadingButton,
            'Link': Link
        },
        remember: 'form',
        data() {
            return {
                form: this.$inertia.form({
                    name: null,
                    username: null,
                    email: null,
                    password: null,
                    password_confirmation: null,
                    image: null
                })
            }
        },
        methods: {
            store() {
                this.form.post(route('user.store'))
            }
        }
    }
</script>
