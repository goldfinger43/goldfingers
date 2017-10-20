<template>
    <div>
        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">{{ turnier.name }} bearbeiten</h1>
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
                            <li><router-link :to="{ name: 'turniere-show' ,params: { slug: turnier.slug } }">{{ turnier.name }}</router-link></li>
                            <li class="is-active"><a>Bearbeiten</a></li>
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
                                <bu-input name="teamfee" placeholder="Teamfee" type="number" :error="form.errors.get('teamfee')" v-model="form.teamfee"></bu-input>
                            </div>
                            <div class="column">
                                <bu-input name="playersfee" placeholder="Playersfee" type="number" :error="form.errors.get('playersfee')" v-model="form.playersfee"></bu-input>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <label class="label">Untergrund</label>
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
                                <label class="label">Unter freiem Himmel?</label>
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
                        <label class="label">Divisionen</label>
                        <div class="columns">
                            <div class="column" v-for="division in divisionen" :key="division.id">
                                <label class="checkbox" >
                                    <input type="checkbox" v-model="form.divisionen" id="divisionen" :value="division.id" >
                                    {{ division.name }}
                                </label>
                            </div>
                        </div>
                        
                        <label class="label">Beschreibung</label>
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
    name: 'turniere-edit',

    data () {
        return {
            turnier: {
                slug: '' 
            },
            form: new Form({}),
            divisionen: [],
        }
    },

    methods: {
        submit() {
            Event.fire('loading');
            this.form.patch('turnier/' + this.turnier.slug)
                .then( (response) => {
                    this.$router.push({ name: 'turniere-show', params: { slug: response.slug } });
                })
                .catch( (errors) => { Event.fire('loaded'); })
        },
        setData(turnier, divisionen) {
            this.turnier = turnier;
            this.divisionen = divisionen;
            this.form = new Form(turnier);
            this.form.divisionen = this.form.divisionen.map((obj) => {return obj.id});
        }
    },

    beforeRouteEnter (to, from, next) {
        Event.fire('loading');

        axios.all([ axios.get('turnier/' + to.params.slug), axios.get('division') ])
            .then(axios.spread((turnier, division) => {
                Event.fire('loaded');
                next(vm => vm.setData(turnier.data, division.data))
            }))
    },
}
</script>