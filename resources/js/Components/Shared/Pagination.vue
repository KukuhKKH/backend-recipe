<template>
    <ul v-if="links.length > 3" class="pagination mb-0">
        <template v-for="(link, key) in links">
            <li v-if="link.url === null" :key="key" class="page-item disabled">
                <link v-html="link.label" class="page-link" />
            </li>
            <li v-else :key="`link-${key}`" class="page-item" :class="{ 'active': link.active }">
                <Link class="page-link" :href="link.url" v-html="link.label" />
            </li>
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
