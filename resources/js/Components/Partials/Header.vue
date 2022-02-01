<template>
    <div id="header" class="app-header">
        <div class="desktop-toggler">
            <button type="button" class="menu-toggler" data-toggle-class="app-sidebar-collapsed"
                data-dismiss-class="app-sidebar-toggled" data-toggle-target=".app">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>


        <div class="mobile-toggler">
            <button type="button" class="menu-toggler" data-toggle-class="app-sidebar-mobile-toggled"
                data-toggle-target=".app">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>


        <div class="brand">
            <a href="#" class="brand-logo">
                <span class="brand-img">
                    <span class="brand-img-text text-theme">A</span>
                </span>
                <span class="brand-text">ADMIN</span>
            </a>
        </div>


        <div class="menu">
            <div class="menu-item dropdown dropdown-mobile-full">
                <a href="#" data-bs-toggle="dropdown" data-bs-display="static" class="menu-link">
                    <div class="menu-img online">
                        <img src="/assets/img/user/profile.jpg" height="60px" />
                    </div>
                    <div class="menu-text d-sm-block d-none"><span class="__cf_email__">{{ user.user.name }}</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end me-lg-3 fs-11px mt-1">
                    <Link class="dropdown-item d-flex align-items-center" href="/logout" method="POST" replace>LOGOUT <i
                        class="bi bi-toggle-off ms-auto text-theme fs-16px my-n1"></i></Link>
                </div>
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
        }
    }
</script>
