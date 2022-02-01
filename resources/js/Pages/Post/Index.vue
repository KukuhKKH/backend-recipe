<template>
    <h1 class="page-header">
        Resep Masakan
    </h1>
    <hr class="mb-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div>
                <Link :href="route('post.create')" class="btn btn-theme"><i class="far fa-plus"></i> Tambah Resep Masakan</Link>
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
                        <th scope="col">Kategori</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="post in posts.data" :key="post.id">
                        <app-numbering-table scope="row" v-bind:array="posts" v-bind:object="post"/>
                        <th scope="row">{{ post.category.name }}</th>
                        <th scope="row">{{ textLimiterFilter(post.title) }}</th>
                        <th scope="row">
                            <img :src="post.image_url" alt="404 Not Found" class="img-fluid img-thumbnail">
                        </th>
                        <td scope="row">
                            <Link :href="route('post.edit', post.id)" class="btn btn-sm btn-warning"><i class="fas fa-pencil"></i></Link>
                            <button @click="destroy(post.id)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <app-pagination class="mt-2" :links="posts.links" />
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
            posts: Array,
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
                        this.$inertia.delete(route('post.destroy', id))
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
                    this.$inertia.get(route('post.index'), pickBy(this.form), { preserveState: true })
                }, 150)
            }
        }
    }
</script>

<style scoped>
    .img-fluid {
        max-height: 75px;
    }
</style>
