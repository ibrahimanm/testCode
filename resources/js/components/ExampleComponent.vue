<template>
    <div class="card card-default">
        <div class="card-header">Example Component</div>

        <div class="card-body">
            {{ __('hi') }}
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log(__('Go Home'))
        }
    }
</script>
