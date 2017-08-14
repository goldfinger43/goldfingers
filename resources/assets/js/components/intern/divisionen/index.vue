<template>
    <div>
        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">Divisionen</h1>
                </div>
            </div>
        </section>
        <div class="container is-fluid">
            <div class="columns">
                <div class="column is-offset-2">
                    <nav class="breadcrumb">
                        <ul>
                            <li><router-link :to="{ name: 'turniere-index' }">Turniere</router-link></li>
                            <li><a>Divisionen</a></li>
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
                                <a :class="{ 'is-active' : create }" @click="create = !create">Division hinzufügen</a>
                            </li>
                        </ul>
                    </aside>
                </div>
                <div class="column is-8">
                    <create v-if="create"></create>
                    <edit v-if="edit" :division="divisionToEdit"></edit>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Bearbeiten</th>
                                <th>Löschen</th>
                            </tr>
                        </thead>
                        <tbody v-if="divisionen.length > 0">
                            <tr v-for="division in divisionen">
                                <td>{{ division.name }}</td>
                                <td>
                                    <a @click.preventDefault="editDivision(division)" class="has-text-primary">
                                        <span class="icon">
                                            <i class="fa fa-edit"></i>
                                        </span>
                                        Bearbeiten
                                    </a>
                                </td>
                                <td>
                                    <a @click.preventDefault="deleteDivision(division.slug)" class="has-text-danger">
                                        <span class="icon">
                                            <i class="fa fa-trash"></i>
                                        </span>
                                        Löschen
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="4">Keine Divisionen vorhanden</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import create from './create.vue';
import edit from './edit.vue';

export default {
    name: 'divisionen-index',

    components: {
        'create': create,
        'edit': edit,
    },

    data () {
        return {
            divisionen: [],
            create: false,
            edit: false,
            divisionToEdit: {},
        }
    },

    methods: {
        setDivisionen(divisionen) {
            this.divisionen = divisionen;
        },
        deleteDivision(slug) {
            Event.fire('loading');
            axios.delete('division/' + slug)
                .then( () => this.fetchDivisionen() )
                .catch( (e) => {
                    //notify me
                    Event.fire('loaded');
                } )
        },
        editDivision(division) {
            this.divisionToEdit = division;
            this.edit = true;
        },
        fetchDivisionen() {
            axios.get('division')
                .then( (response) => {
                    this.setDivisionen(response.data);
                    Event.fire('loaded');
                } )
        }
    },

    mounted() {
        Event.listen('division.create.close', () => this.create = false);
        Event.listen('division.edit.close', () => this.edit = false);
        Event.listen('division.created', (division) => this.divisionen.push(division));
        Event.listen('division.updated', (division) => this.fetchDivisionen());
    },

    beforeRouteEnter (to, from, next) {
        Event.fire('loading');

        axios.get('division')
            .then( (response) => {
                console.log(response);
                Event.fire('loaded');
                next(vm => vm.setDivisionen(response.data))
            } )
    },
}
</script>