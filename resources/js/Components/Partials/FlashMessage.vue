<template>
    <div v-if="$page.props.flash.success && show">
        <div class="alert alert-success alert-dismissable fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Well done!</h4>
            <p>{{ $page.props.flash.success }}</p>
        </div>
    </div>
    <div v-if="($page.props.flash.error || Object.keys($page.props.errors).length > 0) && show">
        <div class="alert alert-danger alert-dismissable fade show">
            <button type="button" class="btn-close float-start" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Error</h4>
            <p v-if="$page.props.flash.error">{{ $page.props.flash.error }}</p>
            <div v-else class="text-white text-sm font-medium">
                <hr />
                <p v-if="Object.keys($page.props.errors).length === 1">There is one form error.</p>
                <p v-else>There are {{ Object.keys($page.props.errors).length }} form errors.</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            show: true,
        }
    },
    watch: {
        '$page.props.flash': {
            handler() {
                this.show = true
            },
            deep: true,
        },
    },
}
</script>
