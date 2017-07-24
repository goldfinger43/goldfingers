<template>
    <div>
        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">Mitglieder</h1>
                </div>
            </div>
        </section>
        <div class="container is-fluid">
            <div class="columns">
                <div class="column is-offset-2">
                    <nav class="breadcrumb">
                        <ul>
                            <li><a>Mitglieder</a></li>
                            <li class="is-active"><a>Übersicht</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="columns">
                <div class="column is-2">
                    <aside class="menu">
                        <p class="menu-label">Aktionen</p>
                        <ul class="menu-list">
                            <li>
                                <router-link :to="{ name: 'users-create' }" >Mitglied hinzufügen</router-link>
                            </li>
                        </ul>
                    </aside>
                </div>
                <div class="column is-8">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Geburtsdatum</th>
                                <th>E-Mail</th>
                                <th>Telefon</th>
                            </tr>
                        </thead>
                        <tbody v-if="users">
                            <tr>
                                <td>users</td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td>Keine Mitglieder vorhanden</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'users-index',

    data () {
        return {
            users: null
        }
    },

    methods: {
        fetchUsers() {
            axios.get('/api/user')
                .then( (response) => {
                    this.users = response.data;
                    Event.fire('loaded');
                } )


        }
    },

    mounted () {
        this.fetchUsers();
    },

    beforeRouteEnter (to, from, next) {
        Event.fire('loading');
        next();
    },
}
</script>