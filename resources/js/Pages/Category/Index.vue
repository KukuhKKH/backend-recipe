<template>
    <h1 class="page-header">
        Kateogri
    </h1>
    <hr class="mb-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div>
                <Link :href="route('category.create')" class="btn btn-theme"><i class="far fa-plus"></i> Tambah Kateogri</Link>
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
                        <th scope="col">Gambar</th>
                        <th scope="col">Rekomendasi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in categories.data" :key="category.id">
                        <app-numbering-table scope="row" v-bind:array="categories" v-bind:object="category"/>
                        <th scope="row">{{ category.name }}</th>
                        <th scope="row">
                            <img :src="category.image_url" alt="404 Not Found" class="img-fluid img-thumbnail">
                        </th>
                        <th scope="row">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" @click="changeRecomendation(category.id)" :checked="category.recomendation">
                            </div>
                        </th>
                        <td scope="row">
                            <Link :href="route('category.edit', category.id)" class="btn btn-sm btn-warning"><i class="fas fa-pencil"></i></Link>
                            <button @click="destroy(category.id)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <app-pagination class="mt-2" :links="categories.links" />
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
    import swal from 'sweetalert2'

    export default {
        layout: LayoutApp,
        props: {
            categories: Array,
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
                swal.fire({
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
                        this.$inertia.delete(route('category.destroy', id))
                    }
                })
            },
            changeRecomendation(id) {
                this.$inertia.put(route("category.change", id))
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
                    this.$inertia.get(route('category.index'), pickBy(this.form), { preserveState: true })
                }, 150)
            }
        }
    }
</script>

<style scoped>
    .img-fluid {
        max-height: 100px;
    }
</style>
