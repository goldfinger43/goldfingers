<template>
    <div>
        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">Turnier hinzufügen</h1>
                </div>
            </div>
        </section>
        <div class="container is-fluid">
            <div class="columns">
                <div class="column is-offset-2">
                    <nav class="breadcrumb">
                        <ul>
                            <li><a>Turniere</a></li>
                            <li><router-link :to="{ name: 'turniere-index' }">Übersicht</router-link></li>
                            <li class="is-active"><a>Hinzufügen</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="columns">
                <div class="column is-offset-2-desktop is-8-desktop">
                    <form @submit.prevent="submit" @keydown="form.errors.clear($event.target.name)">
                        <div class="columns">
                            <div class="column">
                                <bu-input name="name" placeholder="Name" :error="form.errors.get('name')" v-model="form.name"></bu-input>
                            </div>
                            <div class="column">
                                <bu-input name="von_datum" placeholder="Startdatum tt.mm.jjjj" type="date" :error="form.errors.get('von_datum')" v-model="form.von_datum" ></bu-input>
                            </div>
                            <div class="column">
                                <bu-input name="bis_datum" placeholder="Enddatum tt.mm.jjjj" type="date" :error="form.errors.get('bis_datum')" v-model="form.bis_datum"></bu-input>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column is-8">
                                <bu-input name="strasse_nr" placeholder="Straße + Hausnummer" :error="form.errors.get('strasse_nr')" v-model="form.strasse_nr"></bu-input>
                            </div>
                            <div class="column">
                                <bu-input name="plz" placeholder="PLZ" :error="form.errors.get('plz')" v-model="form.plz" ></bu-input>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <bu-input name="ort" placeholder="Ort" :error="form.errors.get('ort')" v-model="form.ort"></bu-input>
                            </div>
                            <div class="column">
                                <bu-input name="land" placeholder="Land" :error="form.errors.get('land')" v-model="form.land"></bu-input>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <label class="checkbox">
                                    <input type="checkbox" v-model="form.untergrund" id="Rasen" value="Rasen">
                                    Rasen
                                </label>
                                <label class="checkbox has-ml-2">
                                    <input type="checkbox" v-model="form.untergrund" id="Halle" value="Halle">
                                    Halle
                                </label>
                                <label class="checkbox has-ml-2">
                                    <input type="checkbox" v-model="form.untergrund" id="Sand" value="Sand">
                                    Sand
                                </label>
                            </div>
                            <div class="column">
                                <label class="checkbox">
                                    <input type="checkbox" v-model="form.indoor_outdoor" id="indoor" value="Indoor">
                                    Indoor
                                </label>
                                <label class="checkbox has-ml-2" >
                                    <input type="checkbox" v-model="form.indoor_outdoor" id="outdoor" value="Outdoor">
                                    Outdoor
                                </label>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column " v-for="division in divisionen">
                                <label class="checkbox" >
                                    <input type="checkbox" v-model="form.divisionen" id="divisionen" :value="division.id">
                                    {{ division.name }}
                                </label>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <div class="control">
                                    <textarea class="textarea" placeholder="Beschreibung" v-model="form.beschreibung" name="beschreibung"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <div class="control">
                                    <button type="submit" class="button is-primary" :disabled="form.errors.any()">Speichern</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'turniere-create',

    data () {
        return {
            form: new Form({
                name: '',
                von_datum: '',
                bis_datum: '',
                phone: '',
                strasse_nr: '',
                plz: '',
                ort: '',
                land: 'Deutschland',
                untergrund: [],
                indoor_outdoor: [],
                divisionen: [],
                beschreibung: ''
            }),
            divisionen: {},
        }
    },

    methods: {
        submit() {
            Event.fire('loading');
            this.form.post('turnier')
                .then( (response) => {
                    this.$router.push({ name: 'turniere-index' });
                })
                .catch( (errors) => { Event.fire('loaded'); })
        },
        setDivisionen(divisionen) {
            this.divisionen = divisionen;
        }
    },

    beforeRouteEnter (to, from, next) {
        Event.fire('loading');

        axios.get('division')
            .then( (response) => {
                console.log(response);
                Event.fire('loaded');
                next(vm => vm.setDivisionen(response.data))
            } )
    }
}
</script>