<template>
    <div>
        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">Turniere</h1>
                </div>
            </div>
        </section>
        <div class="container is-fluid">
            <div class="columns">
                <div class="column is-offset-2">
                    <nav class="breadcrumb">
                        <ul>
                            <li><a>Turniere</a></li>
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
                                <router-link :to="{ name: 'turniere-create' }" >Turnier hinzufügen</router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'divisionen-index' }" >Divisionen verwalten</router-link>
                            </li>
                        </ul>
                        <p class="menu-label">Filter</p>
                        <ul class="menu-list">
                            <li>
                                <a @click="filter.damen = !filter.damen" :class="{ 'is-active' : filter.damen }">Open</a>
                                <a @click="filter.herren = !filter.herren" :class="{ 'is-active' : filter.herren }">Damen</a>
                                <a :class="{ 'is-active' : filter.masters }">Mixed</a>
                                <a :class="{ 'is-active' : filter.jugend }">Outdoor</a>
                                <a :class="{ 'is-active' : filter.jugend }">Indoor</a>
                                <a :class="{ 'is-active' : filter.jugend }">DfV-Turniere</a>
                            </li>
                        </ul>
                    </aside>
                </div>
                <div class="column is-8">
                    <table class="table is-fullwidth">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Datum</th>
                                <th>Ort</th>
                                <th>Divisionen</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody v-if="turniere">
                            <tr v-for="turnier in filteredTurniere">
                                <td><router-link :to="{ name: 'turniere-show', params: { slug: turnier.slug }}">{{ turnier.name }}</router-link></td>
                                <td>{{ turnier.von_datum }} - {{ turnier.bis_datum }}</td>
                                <td v-html="turnier.adresse"></td>
                                <td><span class="tag is-light has-hm-02" v-for="division in turnier.divisionen">{{ division.name }}</span></td>
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
                                <td>Keine Turniere vorhanden</td>
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
    name: 'turniere-index',

    data () {
        return {
            turniere: [],
            filter: {
                damen: false,
                herren: false,
                masters: false,
                jugend: false,
            }
        }
    },

    computed: {
        filteredTurniere() {
            return this.turniere.filter( (user) => {
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
        setTurniere(turniere) {
            this.turniere = turniere;
        },
    },

    beforeRouteEnter (to, from, next) {
        Event.fire('loading');

        axios.get('turnier')
            .then( (response) => {
                Event.fire('loaded');
                next(vm => vm.setTurniere(response.data))
            } )
    },
}
</script>