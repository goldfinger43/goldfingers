<template>
    <div class="box">
        <form @submit.prevent="submit" @keydown="form.errors.clear($event.target.name)" @keydown.esc="close">
            <div class="columns">
                <div class="column is-6">
                    <bu-input name="name" placeholder="Name" :error="form.errors.get('name')" v-model="form.name" v-focus></bu-input>
                </div>
                <div class="column is-6">
                    <div class="field">
                        <label class="label">Division</label>
                        <div class="control">
                            <div class="select has-fullwidth">
                                <select class="has-fullwidth" v-model="form.division_id">
                                    <option v-for="division in turnier.divisionen" :value="division.id" :key="division.id">{{ division.name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns" v-show="form.division_id">
                <div class="column is-6">
                    <bu-input type="number" name="anzahl_open" placeholder="maximale Anzahl Open" :error="form.errors.get('anzahl_open')" v-model="form.anzahl_open" v-focus></bu-input>
                </div>
                <div class="column is-6">
                    <bu-input type="number" name="anzahl_frauen" placeholder="maximale Anzahl Damen" :error="form.errors.get('anzahl_frauen')" v-model="form.anzahl_frauen" v-focus></bu-input>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="control">
                        <button type="submit" class="button is-primary" :disabled="form.errors.any()">Speichern</button>
                        <a class="button is-danger is-pulled-right" @click.preventDefault="close">Schließen</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

export default {
    name: 'team-create',

    props: [ 'turnier' ],

    data () {
        return {
            form: new Form({
                name: '',
                anzahl_open: 0,
                anzahl_frauen: 0,
                division_id: null,
                turnier_id: this.turnier.id,
            })
        }
    },

    methods: {
        submit() {
            Event.fire('loading');
            this.form.post('team')
                .then( (response) => {
                    Event.fire('team.created', response);
                    Event.fire('loaded');
                    this.close();
                })
                .catch( (errors) => { Event.fire('loaded'); })
        },
        close() {
            Event.fire('team.create.close');
        }
    }
}
</script>
