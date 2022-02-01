<template>
    <th :scope="scope">{{ (array.current_page - 1) * array.per_page + array.data.indexOf(object) + 1 }}</th>
</template>

<script>
export default {
    props: {
        scope: {
            type: String,
            default: "row"
        },
        array: Object,
        object: Object
    }
}
</script>
