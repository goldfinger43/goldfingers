<template>
    <nav class="navbar nav has-shadow">
        <div class="navbar-brand">
            <router-link class="nav-item" to="/">Goldfingers</router-link>

            <div class="navbar-burger burger" data-target="internNav">
              <span></span>
              <span></span>
              <span></span>
            </div>
        </div>

        <div id="internNav" class="navbar-menu">
            <div class="navbar-end">
                <router-link class="nav-item is-tab" :to="{ name: 'dashboard' }" exact>Dashboard</router-link>

                <router-link class="nav-item is-tab" :to="{ name: 'turniere-index' }">Turniere</router-link>

                <router-link class="nav-item is-tab" :to="{ name: 'login' }">Trainings</router-link>

                <router-link class="nav-item is-tab" :to="{ name: 'users-index' }">Mitglieder</router-link>

                <router-link class="nav-item is-tab" :to="{ name: 'startseite' }" exact>Logout</router-link>
            </div>
        </div>
    </nav>
</template>

<script>

export default {
    name: 'intern-navigation',
}
</script>