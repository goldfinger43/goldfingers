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
                        <p class="menu-label">Filter</p>
                        <ul class="menu-list">
                            <li>
                                <a @click="filter.damen = !filter.damen" :class="{ 'is-active' : filter.damen }">Damen</a>
                                <a @click="filter.herren = !filter.herren" :class="{ 'is-active' : filter.herren }">Herren</a>
                                <a :class="{ 'is-active' : filter.masters }">Masters</a>
                                <a :class="{ 'is-active' : filter.jugend }">Jugend</a>
                                <a >Ermäßigt</a>
                                <a >Vollzahler</a>
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody v-if="users">
                            <tr v-for="user in filteredUsers">
                                <td><router-link :to="{ name: 'users-show', params: { slug: user.slug }}">{{ user.fullname }}</router-link></td>
                                <td>{{ user.geburtsdatum }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.phone }}</td>
                                <td>
                                    <a class="">
                                        <span class="icon">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                    </a>
                                </td>
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
            users: null,
            filter: {
                damen: false,
                herren: false,
                masters: false,
                jugend: false,
            }
        }
    },

    computed: {
        filteredUsers() {
            return this.users.filter( (user) => {
                if (this.hasFilter ){
                    let filter = false;
                    if (this.filter.damen) {
                        filter = user.geschlecht == 'weiblich';
                    }
                    if (this.filter.herren && !filter) {
                        filter = user.geschlecht == 'männlich';
                    }
                    return filter;
                }
                return true
            })
        },
        hasFilter() {
            for (let prop in this.filter) {
                if (this.filter[prop]) {
                    return true;
                }
            }
            return false;
        }
    },

    methods: {
        fetchUsers() {
            axios.get('/api/user')
                .then( (response) => {
                    this.users = response.data;
                    Event.fire('loaded');
                } )
        },
        setUsers(users) {
            this.users = users;
        },
    },

    beforeRouteEnter (to, from, next) {
        Event.fire('loading');

        axios.get('/api/user')
            .then( (response) => {
                Event.fire('loaded');
                next(vm => vm.setUsers(response.data))
            } )
    },
}
</script>