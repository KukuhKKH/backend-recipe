<template>
    <h1 class="page-header">
        Tag
    </h1>
    <hr class="mb-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div>
                <Link :href="route('tag.create')" class="btn btn-theme"><i class="far fa-plus"></i> Tambah Tag</Link>
            </div>
            <div>
                <app-search-filter v-model="form.search" @reset="reset"/>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="tag in tags.data" :key="tag.id">
                        <app-numbering-table scope="row" :array="tags" :object="tag" />
                        <th scope="row">{{ tag.name }}</th>
                        <td scope="row">
                            <Link :href="route('tag.edit', tag.id)" class="btn btn-sm btn-warning"><i class="fas fa-pencil"></i></Link>
                            <button @click="destroy(tag.id)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <app-pagination class="mt-2" :links="tags.links" />
        </div>
    </div>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3'
    import throttle from 'lodash/throttle'
    import pickBy from 'lodash/pickBy'
    import mapValues from 'lodash/mapValues'
    import LayoutApp from '../../Layouts/App.vue'
    import Pagination from '../../Components/Shared/Pagination'
    import SearchFilter from '../../Components/Shared/SearchFilter'
    import NumeringTable from '../../Components/Shared/NumeringTable'

    export default {
        layout: LayoutApp,
        props: {
            tags: Array,
            filters: Object
        },
        data() {
            return {
                form: {
                    search: this.filters.search
                }
            }
        },
        methods: {
            destroy(id) {
                this.$swal({
                    title: 'Apakah Anda Yakin ?',
                    text: "Ingin menghapus data ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Tidak',
                    confirmButtonText: 'Ya !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$inertia.delete(route('tag.destroy', id))
                    }
                })
            },
            reset() {
                this.form = mapValues(this.form, () => null)
            },
        },
        components: {
            'app-pagination' : Pagination,
            'app-search-filter' : SearchFilter,
            'app-numbering-table' : NumeringTable,
            'Link' : Link
        },
        watch: {
            form: {
                deep: true,
                handler: throttle(function() {
                    this.$inertia.get(route('tag.index'), pickBy(this.form), { preserveState: true })
                }, 150)
            }
        }
    }
</script>
