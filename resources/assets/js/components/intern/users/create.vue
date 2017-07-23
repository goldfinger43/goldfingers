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
                                <div class="field">
                                    <div class="control ">
                                        <div class="control has-icons-right ">
                                            <input class="input" type="text" name="vorname" placeholder="Vorname" v-model="form.vorname">
                                            <span class="icon is-small is-right" v-if="form.errors.has('vorname')">
                                                <i class="fa fa-warning"></i>
                                            </span>
                                        </div>
                                        <p class="help is-danger" v-if="form.errors.has('vorname')" v-text="form.errors.get('vorname')"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="field">
                                    <div class="control ">
                                        <div class="control has-icons-right ">
                                            <input class="input" name="nachname" type="text" placeholder="Nachname" v-model="form.nachname">
                                            <span class="icon is-small is-right" v-if="form.errors.has('nachname')">
                                                <i class="fa fa-warning"></i>
                                            </span>
                                        </div>
                                        <p class="help is-danger" v-if="form.errors.has('nachname')" v-text="form.errors.get('nachname')"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <div class="field">
                                    <div class="control ">
                                        <div class="control has-icons-right ">
                                            <input class="input" type="text" name="geburtsdatum" placeholder="Geburtsdatum" v-model="form.geburtsdatum" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" title="Bitte gib folgendes Format ein: tt.mm.yyy">
                                            <span class="icon is-small is-right" v-if="form.errors.has('geburtsdatum')">
                                                <i class="fa fa-warning"></i>
                                            </span>
                                        </div>
                                        <p class="help is-danger" v-if="form.errors.has('geburtsdatum')" v-text="form.errors.get('geburtsdatum')"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="field">
                                    <div class="control ">
                                        <div class="control has-icons-right ">
                                            <input class="input" name="dfv_nr" type="text" placeholder="DfV-Nummer" v-model="form.dfv_nr">
                                            <span class="icon is-small is-right" v-if="form.errors.has('dfv_nr')">
                                                <i class="fa fa-warning"></i>
                                            </span>
                                        </div>
                                        <p class="help is-danger" v-if="form.errors.has('dfv_nr')" v-text="form.errors.get('dfv_nr')"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <div class="field">
                                    <div class="control ">
                                        <div class="control has-icons-right ">
                                            <input class="input" type="email" name="email" placeholder="E-Mailadresse" v-model="form.email">
                                            <span class="icon is-small is-right" v-if="form.errors.has('email')">
                                                <i class="fa fa-warning"></i>
                                            </span>
                                        </div>
                                        <p class="help is-danger" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="field">
                                    <div class="control ">
                                        <div class="control has-icons-right ">
                                            <input class="input" name="phone" type="text" placeholder="Telefonnummer" v-model="form.phone">
                                            <span class="icon is-small is-right" v-if="form.errors.has('phone')">
                                                <i class="fa fa-warning"></i>
                                            </span>
                                        </div>
                                        <p class="help is-danger" v-if="form.errors.has('phone')" v-text="form.errors.get('phone')"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <div class="field">
                                    <div class="control ">
                                        <div class="control has-icons-right ">
                                            <input class="input" type="text" name="strasse_nr" placeholder="Straße + Hausnummer" v-model="form.strasse_nr">
                                            <span class="icon is-small is-right" v-if="form.errors.has('strasse_nr')">
                                                <i class="fa fa-warning"></i>
                                            </span>
                                        </div>
                                        <p class="help is-danger" v-if="form.errors.has('strasse_nr')" v-text="form.errors.get('strasse_nr')"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="field">
                                    <div class="control ">
                                        <div class="control has-icons-right ">
                                            <input class="input" name="plz" type="text" placeholder="Postleitzahl" v-model="form.plz">
                                            <span class="icon is-small is-right" v-if="form.errors.has('plz')">
                                                <i class="fa fa-warning"></i>
                                            </span>
                                        </div>
                                        <p class="help is-danger" v-if="form.errors.has('plz')" v-text="form.errors.get('plz')"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="field">
                                    <div class="control ">
                                        <div class="control has-icons-right ">
                                            <input class="input" name="ort" type="text" placeholder="Ort" v-model="form.ort">
                                            <span class="icon is-small is-right" v-if="form.errors.has('ort')">
                                                <i class="fa fa-warning"></i>
                                            </span>
                                        </div>
                                        <p class="help is-danger" v-if="form.errors.has('ort')" v-text="form.errors.get('ort')"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <div class="control">
                                    <button type="submit" class="button is-primary" :class="{ 'is-loading': pending }" :disabled="form.errors.any()">Create</button>
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
    name: 'users-create',

    data () {
        return {
            pending: false,
            form: new Form({
                vorname: '',
                nachname: '',
                email: '',
                phone: '',
                strasse_nr: '',
                plz: '',
                ort: '',
                geburtsdatum: '',
                dfv_nr: '',
                geschlecht: 'männlich'
            })
        }
    },

    methods: {
        submit() {
            this.pending = true;
            this.form.post('/api/user')
                .then( (response) => this.pending = false)
                .catch( (errors) => this.pending = false )
        }

    },

    mounted () {

    },
}
</script>