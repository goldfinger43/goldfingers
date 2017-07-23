<template>
    <div class="field">
        <div class="control ">
            <div class="control has-icons-right ">
                <input class="input" :class="{ 'is-danger': hasError }" :type="type" :name="name" :placeholder="placeholder" :value="value" @input="updateValue($event.target.value)" :pattern="pattern" :title="title">
                <span class="icon is-small is-right" v-if="hasError">
                    <i class="fa fa-warning"></i>
                </span>
            </div>
            <p class="help is-danger" v-if="hasError" v-text="error"></p>
        </div>
    </div>
</template>

<script>

export default {
    name: 'bulma-input',

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
        value: String,
        error: {
            type: String,
            default: ''
        }
    },

    computed: {
        hasError() {
            if (this.error != undefined && this.error != "") {
                return true;
            }
            return false;
        }
    },

    methods: {
        updateValue(value) {
            this.$emit('input', value);
        }
    }
}
</script>