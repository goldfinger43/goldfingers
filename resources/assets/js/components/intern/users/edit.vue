<template>
    <div>
        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">Mitglieder hinzufügen</h1>
                </div>
            </div>
        </section>
        <div class="container is-fluid">
            <div class="columns">
                <div class="column is-offset-2">
                    <nav class="breadcrumb">
                        <ul>
                            <li><a>Mitglieder</a></li>
                            <li><router-link :to="{ name: 'users-index' }">Übersicht</router-link></li>
                            <li><router-link :to="{ name: 'users-show' ,params: { slug: user.slug } }">{{ user.fullname }}</router-link></li>
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
                                <bu-input name="vorname" placeholder="Vorname" :error="form.errors.get('vorname')" v-model="form.vorname"></bu-input>
                            </div>
                            <div class="column">
                                <bu-input name="nachname" placeholder="Nachname" :error="form.errors.get('nachname')" v-model="form.nachname"></bu-input>
                            </div>
                            <div class="column">
                                <div class="select is-fullwidth">
                                    <select v-model="form.geschlecht">
                                        <option>männlich</option>
                                        <option>weiblich</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <bu-input name="geburtsdatum" placeholder="Geburtsdatum" :error="form.errors.get('geburtsdatum')" v-model="form.geburtsdatum" title="Bitte gib folgendes Format ein: tt.mm.yyy" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}"></bu-input>
                            </div>
                            <div class="column">
                                <bu-input name="dfv_nr" placeholder="DfV-Nummer" :error="form.errors.get('dfv_nr')" v-model="form.dfv_nr"></bu-input>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <bu-input name="email" placeholder="E-Mailadresse" :error="form.errors.get('email')" v-model="form.email" type="email"></bu-input>
                            </div>
                            <div class="column">
                                <bu-input name="phone" placeholder="Telefonnummer" :error="form.errors.get('phone')" v-model="form.phone"></bu-input>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <bu-input name="strasse_nr" placeholder="Straße + Hausnummer" :error="form.errors.get('strasse_nr')" v-model="form.strasse_nr"></bu-input>
                            </div>
                            <div class="column">
                                <bu-input name="plz" placeholder="Postleitzahl" :error="form.errors.get('plz')" v-model="form.plz"></bu-input>
                            </div>
                            <div class="column">
                                <bu-input name="ort" placeholder="Ort" :error="form.errors.get('ort')" v-model="form.ort"></bu-input>
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
    name: 'users-edit',

    data () {
        return {
            user: {
                slug: '' 
            },
            form: null,
        }
    },

    methods: {
        submit() {
            Event.fire('loading');
            this.form.patch('user/' + this.user.slug)
                .then( (response) => {
                    this.$router.push({ name: 'users-show', params: { slug: response.slug } });
                })
                .catch( (errors) => { Event.fire('loaded'); })
        },
        setUser(user) {
            this.user = user;
            this.form = new Form(user);
        }
    },

    beforeRouteEnter (to, from, next) {
        Event.fire('loading');

        axios.get('user/' + to.params.slug)
            .then( (response) => {
                Event.fire('loaded');
                next(vm => vm.setUser(response.data))
            } )
    },
}
</script>