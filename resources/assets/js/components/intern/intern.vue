<template>
    <div>
        <navigation></navigation>

        <div>
            <loader></loader>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import Navigation from './partials/navigation.vue';

    export default {
        name: 'intern',

        components: {
            'navigation': Navigation
        },
    }
</script>