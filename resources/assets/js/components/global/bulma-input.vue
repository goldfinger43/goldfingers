<template>
    <div class="field">
        <label :for="name" class="label" v-text="placeholder" v-if="label"></label>
        <div class="control " v-if="date">
            <div class="control has-icons-right ">
                <cleave :placeholder="placeholder" :options="cleaveOptions" :title="title" :id="name" :name="name" @input="updateValue($event)" class="input" :class="{ 'is-danger': hasError }"></cleave>
                <span class="icon is-small is-right" v-if="hasError">
                    <i class="fa fa-warning"></i>
                </span>
            </div>
            <p class="help is-danger" v-if="hasError" v-text="error"></p>
        </div>
        <div class="control " v-else>
            <div class="control has-icons-right ">
                <input class="input" :class="{ 'is-danger': hasError }" :type="type" :id="name" :name="name" :placeholder="placeholder" :value="value" @input="updateValue($event.target.value)" :pattern="pattern" :title="title">
                <span class="icon is-small is-right" v-if="hasError">
                    <i class="fa fa-warning"></i>
                </span>
            </div>
            <p class="help is-danger" v-if="hasError" v-text="error"></p>
        </div>
    </div>
</template>

<script>
import Cleave from 'vue-cleave';

export default {
    name: 'bulma-input',

    components: {
        'cleave': Cleave
    },

    props: {
        required: Boolean,
        disabled: Boolean,
        name: String,
        type: {
            type: String,
            default: 'text'
        },
        pattern: String,
        title: String,
        placeholder: String,
        label: {
            type: Boolean,
            default: true
        },
        value: null,
        error: {
            type: String,
            default: ''
        },
        cleaveOptions: {
            type: Object,
            default() {
                return { date: true, datePattern: ['d', 'm', 'Y'], delimiter: '.' };
            } 
        }
    },

    computed: {
        hasError() {
            if (this.error != undefined && this.error != "") {
                return true;
            }
            return false;
        },
        date() {
            return this.type=='date';
        }
    },

    methods: {
        updateValue(value) {
            this.$emit('input', value);
        }
    }
}
</script>