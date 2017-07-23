<template>
    <div>
        <navigation></navigation>

        <div>
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

        data () {
            return {

            }
        },

        methods: {

        },

        mounted () {

        },
    }
</script>