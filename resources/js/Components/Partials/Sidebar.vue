<template>
   <div id="sidebar" class="app-sidebar">
      <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
         <div class="menu">
            <div class="menu-header">Navigation</div>
            <div class="menu-item" :class="isUrl('dashboard') ? 'active' : ''">
                <Link :href="route('dashboard.index')" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-cpu"></i></span>
                    <span class="menu-text">Dashboard</span>
                </Link>
            </div>
            <div class="menu-header">Master</div>
            <div class="menu-item" :class="isUrl('dashboard/master/category') ? 'active' : ''">
                <Link :href="route('category.index')" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-list"></i></span>
                    <span class="menu-text">Category</span>
                </Link>
            </div>
            <div class="menu-item" :class="isUrl('dashboard/master/tag') ? 'active' : ''">
                <Link :href="route('tag.index')" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-tags"></i></span>
                    <span class="menu-text">Tag</span>
                </Link>
            </div>
            <div class="menu-item" :class="isUrl('dashboard/master/user') ? 'active' : ''">
                <Link :href="route('user.index')" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-users"></i></span>
                    <span class="menu-text">Pengguna</span>
                </Link>
            </div>
         </div>

         <div class="p-3 px-4 mt-auto">
            <a href="javascript:void(0)" class="btn d-block btn-outline-theme">
                <i class="fa fa-code-branch me-2 ms-n2 opacity-5"></i> Documentation
            </a>
         </div>
      </div>
   </div>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3'
    export default {
        components: {
            Link
        },
        props: {
            user: Object,
        },
        methods: {
            isUrl(urls) {
                let currentUrl = this.$page.url.substr(1)
                return currentUrl === urls
            },
        }
    }
</script>
