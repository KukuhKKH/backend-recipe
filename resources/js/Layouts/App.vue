<template>
   <div class="app">
       <app-header v-bind:user="auth"/>
       <app-sidebar/>

        <div id="content" class="app-content">
            <app-flash-message/>
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
import FlashMessage from "../Components/Partials/FlashMessage.vue";
export default {
    components: {
        'app-breadcrumb': Breadcrumb,
        'app-header': Header,
        'app-sidebar': Sidebar,
        'app-theme-panel': ThemePanel,
        'app-flash-message': FlashMessage
    },
    props: {
        auth: Object,
    }
}
</script>
