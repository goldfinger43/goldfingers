<template>
    <div v-if="user">
        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">{{ user.fullname }}</h1>
                </div>
            </div>
        </section>
        <div class="container is-fluid">
            <div class="columns">
                <div class="column is-offset-2">
                    <nav class="breadcrumb">
                        <ul>
                            <li><a>Mitglieder</a></li>
                            <li ><router-link :to="{ name: 'users-index' }" >Übersicht</router-link></li>
                            <li class="is-active"><a>{{ user.fullname }}</a></li>
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
                                <router-link :to="{ name: 'users-edit', params: { slug: user.slug } }" exact>Stammdaten bearbeiten</router-link>
                            </li>
                        </ul>
                    </aside>
                </div>
                <div class="column is-8">
                    <div class="columns">
                        <div class="column is-6">
                            <p class="title is-4 has-text-centered">geplante Turniere</p>
                            <hr>
                        </div>
                        <div class="column is-6">
                            <p class="title is-4 has-text-centered">Kontaktdaten</p>
                            <hr>
                            <div class="columns">
                                <div class="column is-5 has-flex-end-center">
                                    <span class="icon is-medium">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                </div>
                                <div class="column has-flex-start-center">
                                    <p >
                                        {{ user.strasse_nr }}<br>
                                        {{ user.plz }} {{ user.ort }}
                                    </p> 
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column is-5 has-flex-end-center">
                                    <span class="icon is-medium">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                </div>
                                <div class="column has-flex-start-center">
                                    <p >
                                        {{ user.email }}
                                    </p>   
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column is-5 has-flex-end-center">
                                    <span class="icon is-medium">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                </div>
                                <div class="column has-flex-start-center">
                                    <p >
                                        {{ user.phone }}
                                    </p>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'users-show',

    props: ['slug'],

    data() {
        return {
            user: null,
        }
    },

    methods: {
        setUser(user) {
            this.user = user;
        }
    },

    beforeRouteEnter (to, from, next) {
        Event.fire('loading');

        axios.get('/api/user/' + to.params.slug)
            .then( (response) => {
                // let user = response.data;
                Event.fire('loaded');
                next(vm => vm.setUser(response.data))
            } )
    },
}
</script>