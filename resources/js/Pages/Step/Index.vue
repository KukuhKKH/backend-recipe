<template>
    <h1 class="page-header">
        Resep Masakan - Langkah Langkah
    </h1>
    <hr class="mb-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <Link :href="route('step.update', post.id)" class="btn btn-theme"><i class="far fa-plus"></i> Tambah / Update Langkah Langkah</Link>
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
                    <tr v-for="(step, index) in post.step" :key="step.id">
                        <td scope="row">{{ index + 1 }}</td>
                        <th scope="row">{{ step.name }}</th>
                        <td scope="row">
                            <Link :href="route('step.detail', step.id)" class="btn btn-sm btn-outline-theme"><i class="fas fa-plus"></i> Tambah Detail</Link>
                            <button @click="destroy(step.id)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3'
    import LayoutApp from '../../Layouts/App.vue'
    import swal from 'sweetalert2'

    export default {
        layout: LayoutApp,
        props: {
            post: Object
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
                        this.$inertia.delete(route('step.destroy', id))
                    }
                })
            },
            reset() {
                this.form = mapValues(this.form, () => null)
            },
        },
        components: {
            'Link' : Link
        }
    }
</script>
