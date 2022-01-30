<template>
    <form @submit.prevent="store">
        <app-text-input v-model="form.name" :error="form.errors.name" class="form-group" label="Nama" />
        <app-text-input v-model="form.image" :error="form.errors.image" class="form-group" label="Gambar" type="file" />
    </form>
</template>

<script>
    import LayoutApp from '../../Layouts/App.vue'
    import TextInput from '../../Components/Shared/TextInput.vue'

    export default {
        layout: LayoutApp,
        components: {
            'app-text-input': TextInput
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: null,
                    image: null,
                    recomendation: null
                })
            }
        },
        methods: {
            store() {
                this.form.post(`/dashboard/master/category`)
            }
        }
    }
</script>
