<template>
    <div v-if="turnier">
        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">{{ turnier.name }}</h1>
                    <h2 class="subtitle">{{ turnier.von_datum }} - {{ turnier.bis_datum }}</h2>
                </div>
            </div>
        </section>
        <div class="container is-fluid">
            <div class="columns">
                <div class="column is-offset-2">
                    <nav class="breadcrumb">
                        <ul>
                            <li><a>Turniere</a></li>
                            <li ><router-link :to="{ name: 'turniere-index' }" >Übersicht</router-link></li>
                            <li class="is-active"><a>{{ turnier.name }}</a></li>
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
                                <router-link :to="{ name: 'turniere-edit', params: { slug: turnier.slug } }" exact>Stammdaten bearbeiten</router-link>
                            </li>
                            <li>
                                <a @click.prevent="add_team = true" >Team hinzufügen</a>
                            </li>
                            <li>
                                <a @click.prevent="" >Finanzübersicht</a>
                            </li>
                            <li>
                                <a @click.prevent="deleteTurnier" class="has-text-danger">Turnier löschen</a>
                            </li>
                        </ul>
                    </aside>
                </div>
                <div class="column is-8">
                    <team-create v-if="add_team" :turnier="turnier"></team-create>
                    <div class="columns">
                        <div class="column is-12">
                            <p class="title is-4 has-text-centered">Beschreibung</p>
                            <hr>
                            <div class="columns">
                                <div class="column is-half-desktop">
                                        <div class="columns">
                                            <div class="column is-5 has-flex-end-center">
                                                <span class="icon is-medium">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                            <div class="column has-flex-start-center">
                                                <p >{{ turnier.von_datum }} - {{ turnier.bis_datum }}</p>
                                            </div>
                                        </div>
                                        <div class="columns">
                                            <div class="column is-5 has-flex-end-center">
                                                <span class="icon is-medium">
                                                    <i class="fa fa-map-marker"></i>
                                                </span>
                                            </div>
                                            <div class="column has-flex-start-center">
                                                <p v-html="turnier.adresse"></p>
                                            </div>
                                        </div>
                                </div>

                                <div class="column is-half-desktop">
                                    <p v-html="turnier.beschreibung"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column is-6">
                            <p class="title is-4 has-text-centered">Teams</p>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import teamCreate from '../teams/create.vue';

export default {
    name: 'turniere-show',

    props: ['slug'],

    components: {
        'team-create': teamCreate,
    },

    data() {
        return {
            turnier: null,
            add_team: false,
        }
    },

    methods: {
        setTurnier(turnier) {
            this.turnier = turnier;
        },
        deleteTurnier() {
            this.$swal({
                title: 'Sicher?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Jetzt löschen!',
                cancelButtonText: 'Doch nicht!',
                confirmButtonClass: 'button is-success',
                cancelButtonClass: 'button is-danger has-ml-2',
                buttonsStyling: false
            }).then(() => {
                axios.delete('turnier/' + this.turnier.slug)
                    .then( (response) => {
                        this.$router.push({ name: 'turniere-index' });
                    });
            })
        }
    },

    beforeRouteEnter (to, from, next) {
        Event.fire('loading');

        axios.get('turnier/' + to.params.slug)
            .then( (response) => {
                Event.fire('loaded');
                next(vm => vm.setTurnier(response.data))
            } )
    },
}
</script>
