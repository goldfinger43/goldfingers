<template>
    <div class="box" >
        <form @submit.prevent="submit" @keydown="form.errors.clear($event.target.name)" @keydown.esc="close">
            <div class="columns">
                <div class="column">
                    <bu-input name="name" placeholder="Name" :error="form.errors.get('name')" v-model="form.name" v-focus></bu-input>
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
    name: 'division-index-create',

    data () {
        return {
            form: new Form({
                name: '',
            })
        }
    },

    props: ['division'],

    methods: {
        submit() {
            Event.fire('loading');
            this.form.patch('division/' + this.division.slug)
                .then( (response) => {
                    Event.fire('division.updated', response);
                    this.close();
                })
                .catch( (errors) => { Event.fire('loaded'); })
        },
        close() {
            Event.fire('division.edit.close');
        }
    },

    mounted() {
        this.form.name = this.division.name;
    }

}
</script>