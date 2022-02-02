<template>
    <button class="btn btn-theme" @click="addForm"><i class="fas fa-plus"></i> Tambah Langkah Langkah</button>
    <form @submit.prevent="update">
        <template v-if="formElement.length > 0">
            <div v-for="(element, index) in formElement" :key="index">
                <app-text-input v-model="form.id[index]" :error="form.errors.name" class="form-group" v-if="index == 0 && element.id" type="hidden"/>
                <app-text-input v-model="form.name[index]" :error="form.errors.name" class="form-group" label="Langkah Langkah" v-if="index == 0"/>
                <div v-else>
                    <app-text-input v-model="form.id[index]" :error="form.errors.name" class="form-group" v-if="element.id" type="hidden"/>
                    <app-text-input v-model="form.name[index]" :error="form.errors.name" class="form-group" label="Langkah Langkah"/>
                    <div class="float-right mt-1" v-if="!element.id">
                        <button class="btn btn-sm btn-danger" type="button" @click="pop(index)"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
        </template>
        <template v-else>
            <app-text-input v-model="form.name" :error="form.errors.name" class="form-group" label="Langkah Langkah" />
        </template>

        <div class="float-end mt-2">
            <app-loading-button :loading="form.processing" class="btn btn-theme mx-2" type="submit">Simpan</app-loading-button>
            <Link :href="route('post.step', post.id)" class="btn btn-warning">Kembali</Link>
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
            post: Object
        },
        data() {
            return {
                formElement: [],
                form: this.$inertia.form({
                    id: null,
                    name: []
                })
            }
        },
        mounted() {
            if(this.post.step.length == 0) {
                this.formElement.push({
                    name: null
                })
            } else {
                let step = this.post.step
                this.formElement = step
                // Element, Index
                let id = []
                let name = []
                step.forEach((e, i) => {
                    id.push(e.id)
                    name.push(e.name)
                })
                this.form.id = id
                this.form.name = name
            }
        },
        methods: {
            update() {
                this.form.put(route('step.updateOrCreate', this.post.id))
            },
            addForm() {
                this.formElement.push({
                    'name': null
                })
            },
            pop(index) {
                this.formElement.splice(index, 1)
                this.form.name.splice(index, 1)
            }
        }
    }
</script>
