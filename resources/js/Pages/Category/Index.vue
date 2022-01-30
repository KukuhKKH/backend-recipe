<template>
    <h1 class="page-header">
        Kateogri
    </h1>
    <hr class="mb-4">
    <div class="card">
        <div class="card-header">
            <a :href="`/dashboard/master/category/create`" class="btn btn-primary"><i class="far fa-plus"></i> Tambah Kateogri</a>
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
                        <th scope="row">1</th>
                        <th scope="row">{{ category.name }}</th>
                        <th scope="row">{{ category.image_url }}</th>
                        <th scope="row">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" @click="changeRecomendation" :checked="category.recomendation">
                            </div>
                        </th>
                        <td scope="row">
                            <a :href="`/dashboard/master/category/${category.id}/edit`" class="btn btn-sm btn-warning"><i class="far fa-pencil"></i></a>
                            <button @click="destroy" class="btn btn-sm btn-danger"><i class="far fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <app-pagination class="mt-2" :links="categories.links" />
        </div>
    </div>
</template>

<script>
    import LayoutApp from '../../Layouts/App.vue'
    import Pagination from '../../Components/Shared/Pagination'

    export default {
        layout: LayoutApp,
        props: {
            categories: Array
        },
        methods: {
            destroy() {
                if (confirm('Are you sure you want to delete this organization?')) {
                    this.$inertia.delete(`/dashboard/master/category/${this.organization.id}`)
                }
            },
            changeRecomendation() {

            }
        },
        components: {
            'app-pagination' : Pagination
        }
    }
</script>
