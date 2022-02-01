<template>
   <div>
      <ul class="breadcrumb">
          <li v-for="filter in filters" :key="filter" class="breadcrumb-item">
              <a href="#" v-if="filters.indexOf(filter) == 0">{{ filter.toUpperCase() }}</a>
              <template v-else>
                  {{ filter.toUpperCase() }}
              </template>
          </li>
      </ul>
   </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia'
export default {
    data() {
        return {
            filters: []
        }
    },
    created() {
        this.getPath()
    },
    methods: {
        getPath() {
            let path = this.$page.url.substr(1)
            let split = path.split('/')
            this.filters = split.filter(n => {
                return isNaN(n)
            })
        }
    },
    mounted() {
        Inertia.on('start', (event) => {
            let path = event.detail.visit.url.pathname
            let split = path.split('/')
            this.filters = split.filter(n => {
                return isNaN(n)
            })
        })
    }
    // setup() {
    //     let filters = ref([])
    //     onUnmounted(
    //         Inertia.on('start', (event) => {
    //             let path = event.detail.visit.url.pathname
    //             let split = path.split('/')
    //             filters.value = split.filter(n => {
    //                 return isNaN(n)
    //             })
    //         })
    //     )
    //     return {
    //         filters
    //     }
    // }
}
</script>
