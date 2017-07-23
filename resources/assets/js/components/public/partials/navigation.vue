<template>
    <nav class="navbar nav has-shadow">
        <div class="navbar-brand">
            <router-link class="nav-item" to="/">Goldfingers</router-link>

            <div class="navbar-burger burger" data-target="publicNav">
              <span></span>
              <span></span>
              <span></span>
            </div>
        </div>

        <div id="publicNav" class="navbar-menu">
            <div class="navbar-end">
                <router-link class="nav-item is-tab" :to="{ name: 'startseite' }" exact>Goldfingers</router-link>

                <router-link class="nav-item is-tab" :to="{ name: 'login' }">Login</router-link>

                <router-link class="nav-item is-tab" :to="{ name: 'dashboard' }" >Intern</router-link>
            </div>
        </div>
    </nav>
</template>

<script>

export default {
    name: 'public-navigation',

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