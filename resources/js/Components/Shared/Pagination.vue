<template>
    <ul v-if="links.length > 3" class="pagination mb-0">
        <template v-for="(link, key) in links">
            <div v-if="link.url === null" :key="key" class="page-item" v-html="link.label" />
            <Link v-else :key="`link-${key}`" class="page-link" :class="{ 'active': link.active }" :href="link.url" v-html="link.label" />
        </template>
    </ul>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Link,
    },
    props: {
        links: Array,
    }
}
</script>
