<template>
    <form @submit.prevent="store">
        <div class="row">
            <div class="col-md-6">
                <app-text-input v-model="form.name" :error="form.errors.name" class="form-group" label="Nama" />
                <app-text-input v-model="form.username" :error="form.errors.username" class="form-group" label="Username" />
                <app-text-input v-model="form.email" :error="form.errors.email" class="form-group" label="Email" type="email"/>
            </div>
            <div class="col-md-6">
                <app-text-input v-model="form.password_old" :error="form.errors.password_old" class="form-group" label="Password Lama" type="password" warning="Kosongkan jika tidak ingin mengganti"/>
                <app-text-input v-model="form.password" :error="form.errors.password" class="form-group" label="Password" type="password" />
                <app-text-input v-model="form.password_confirmation" :error="form.errors.password_confirmation" class="form-group" label="Konfirmasi Password" type="password" />
            </div>
        </div>

        <app-file-input v-model="form.image" :error="form.errors.image" class="form-group" label="Gambar" type="file" accept="image/*" />
        <p class="text-sm text-warning">Kosongkan jika tidak ingin mengganti gambar</p>

        <img :src="user.image_url" :alt="user.name" class="img-fluid img-thumbnail" style="max-height: 400px">
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
        props: {
            user: Object
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: this.user.name,
                    username: this.user.username,
                    email: this.user.email,
                    password_old: null,
                    password: null,
                    password_confirmation: null,
                    image: null
                })
            }
        },
        methods: {
            store() {
                this.form.put(route('user.update', this.user.id))
            }
        }
    }
</script>
