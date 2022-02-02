<template>
    <h3 v-html="step.name"/>
    <button class="btn btn-theme mb-2" @click="addForm"><i class="fas fa-plus"></i> Tambah Detail Langkah Langkah</button>
    <form @submit.prevent="update">
        <div class="list-group">
            <div v-for="(element, index) in formElement" :key="index" class="list-group-item list-group-item-action">
                <app-text-input v-model="form.id[index]" :error="form.errors.name" class="form-group" v-if="element.id" type="hidden"/>
                <label :for="index" class="text-warning">Detail Langkah Langkah ({{ index + 1 }})</label>
                <tinymce :id="index" v-bind:api-key="app.tinymce_token" :init="init" v-model="form.content[index]"/>
                <div class="float-right mt-1" v-if="!element.id">
                    <button class="btn btn-sm btn-danger" type="button" @click="pop(index)"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        </div>

        <div class="float-end mt-2">
            <app-loading-button :loading="form.processing" class="btn btn-theme mx-2" type="submit">Simpan</app-loading-button>
            <Link :href="route('post.step', step.post.id)" class="btn btn-warning">Kembali</Link>
        </div>
    </form>
</template>

<script>
    import tinymce from '@tinymce/tinymce-vue'
    import { Link } from '@inertiajs/inertia-vue3'
    import LayoutApp from '../../Layouts/App.vue'
    import TextInput from '../../Components/Shared/TextInput.vue'
    import LoadingButton from '../../Components/Shared/LoadingButton.vue'

    export default {
        layout: LayoutApp,
        components: {
            'app-text-input': TextInput,
            'app-loading-button': LoadingButton,
            'Link' : Link,
            'tinymce': tinymce
        },
        remember: 'form',
        props: {
            step: Object,
            app: String
        },
        data() {
            return {
                formElement: [],
                tinyOptions: {
                    'height': 250
                },
                form: this.$inertia.form({
                    id: null,
                    content: [],
                    post_id: this.step.post.id
                }),
                init: {
                    height: 250,
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste code help wordcount'
                    ],
                    toolbar:
                        'undo redo | formatselect | bold italic backcolor | \
                        alignleft aligncenter alignright alignjustify | \
                        bullist numlist outdent indent | removeformat | help'
                }
            }
        },
        mounted() {
            if(this.step.detail.length == 0) {
                this.formElement.push({
                    content: null
                })
            } else {
                let stepDetail = this.step.detail
                this.formElement = stepDetail
                let id = []
                let content = []
                stepDetail.forEach((e, i) => {
                    id.push(e.id)
                    content.push(e.content)
                })
                this.form.id = id
                this.form.content = content
            }
        },
        methods: {
            update() {
                this.form.put(route('step.detail.updateOrCreate', this.step.id))
            },
            addForm() {
                this.formElement.push({
                    content: null
                })
                setTimeout(() => {
                    window.scrollTo(0, document.body.scrollHeight)
                }, 500);
            },
            pop(index) {
                this.formElement.splice(index, 1)
                this.form.content.splice(index, 1)
            }
        }
    }
</script>
