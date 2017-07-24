<template>
    <div class="loader-wrapper" v-show="show">
        <pulse-loader :loading="loading" :color="color"></pulse-loader>
    </div>
</template>

<script>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
export default {
    name: 'loader',

    data () {
        return {
            loading: true,
            color: '#00d1b2',
            show: false
        }
    },

    components: { PulseLoader },

    mounted () {
        Event.listen('loading', () => {this.show = true});
        Event.listen('loaded', () => {this.show = false});
    },
}
</script>