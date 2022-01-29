<template>
   <div class="app">
       <app-header/>
       <app-sidebar/>

        <div id="content" class="app-content">
            <app-breadcrumb/>
            <slot/>
        </div>

       <app-theme-panel/>
   </div>
</template>

<script>
import Header from "../Components/Partials/Header.vue";
import Breadcrumb from "../Components/Partials/Breadcrumb.vue";
import Sidebar from "../Components/Partials/Sidebar.vue";
import ThemePanel from "../Components/Partials/ThemePanel.vue";
export default {
    components: {
        'app-breadcrumb': Breadcrumb,
        'app-header': Header,
        'app-sidebar': Sidebar,
        'app-theme-panel': ThemePanel
    }
}
</script>
