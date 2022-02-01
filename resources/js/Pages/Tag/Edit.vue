<template>
    <form @submit.prevent="update">
        <app-text-input v-model="form.name" :error="form.errors.name" class="form-group" label="Nama" />

        <div class="float-end mt-2">
            <app-loading-button :loading="form.processing" class="btn btn-theme mx-2" type="submit">Ubah</app-loading-button>
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
        props: {
            tag: Object
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: this.tag.name
                })
            }
        },
        methods: {
            update() {
                this.form.put(route('tag.update', this.tag.id))
            }
        }
    }
</script>
