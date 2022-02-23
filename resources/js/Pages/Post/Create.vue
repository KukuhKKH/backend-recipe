<template>
    <form @submit.prevent="store">
        <div class="row">
            <div class="col-md-6">
                <app-select-input v-model="form.category_id" :error="form.errors.category_id" label="Kategori">
                    <option :value="null" selected disabled>Pilih Kategori</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                </app-select-input>
                <app-text-input v-model="form.title" :error="form.errors.title" class="form-group" label="Judul" />
                <app-text-input v-model="form.time" :error="form.errors.time" class="form-group" label="Waktu" />
                <app-text-input v-model="form.total" :error="form.errors.total" class="form-group" label="Total Hasil" />
            </div>
            <div class="col-md-6">
                <app-select-input v-model="form.level" :error="form.errors.level" label="Tingkat Kesulitan">
                    <option :value="null" selected disabled>Pilih Level</option>
                    <option v-for="(value, index) in levels" :key="index" :value="index">{{ value }}</option>
                </app-select-input>
                <app-text-input v-model="form.sub_title" :error="form.errors.sub_title" class="form-group" label="Sub Judul" />
                <app-text-input v-model="form.time_unit" :error="form.errors.time_unit" class="form-group" label="Satuan Waktu" />
                <app-text-input v-model="form.total_unit" :error="form.errors.total_unit" class="form-group" label="Satuan Total" />
            </div>
            <app-file-input v-model="form.image" :error="form.errors.image" class="form-group" label="Gambar" type="file" accept="image/*" />
        </div>

        <div class="float-end">
            <app-loading-button :loading="form.processing" class="btn btn-theme mx-2" type="submit">Simpan</app-loading-button>
            <Link :href="route('post.index')" class="btn btn-warning">Kembali</Link>
        </div>
    </form>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3'
    import LayoutApp from '../../Layouts/App.vue'
    import TextInput from '../../Components/Shared/TextInput.vue'
    import FileInput from '../../Components/Shared/FileInput.vue'
    import SelectInput from '../../Components/Shared/SelectInput.vue'
    import LoadingButton from '../../Components/Shared/LoadingButton.vue'

    export default {
        layout: LayoutApp,
        components: {
            'app-text-input': TextInput,
            'app-file-input': FileInput,
            'app-select-input': SelectInput,
            'app-loading-button': LoadingButton,
            'Link': Link
        },
        remember: 'form',
        props: {
            'categories': Array,
            'levels': Array
        },
        data() {
            return {
                form: this.$inertia.form({
                    category_id: null,
                    title: null,
                    sub_title: null,
                    time: null,
                    time_unit: null,
                    total: null,
                    total_unit: null,
                    image: null,
                    level: null
                })
            }
        },
        methods: {
            store() {
                this.form.post(route('post.store'))
            }
        }
    }
</script>
