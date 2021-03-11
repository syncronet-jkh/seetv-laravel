<template>
    <v-card elevation="1" tile width="100%" height="100%">
        <v-card-title>
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </v-card-title>

        <v-alert v-if="status" type="info" outlined>{{ status }}</v-alert>

        <v-card-text>
            <v-form ref="form" v-model="valid" @submit.prevent="submit">
                <v-text-field
                    autocomplete="email"
                    class="text--primary"
                    v-model="form.email"
                    :rules="emailRules"
                    label="E-mail"
                    :error-messages="form.errors.email"
                    required
                    prepend-inner-icon="mdi-email"
                ></v-text-field>

                <v-btn
                    :disabled="!valid"
                    :loading="form.processing"
                    color="primary"
                    class="mr-4"
                    type="submit"
                    block
                >
                    Confirm
                </v-btn>
            </v-form>
        </v-card-text>
    </v-card>
</template>

<script>
    import {emailRequired, emailValid} from "@/rules";
    import Guest from "@/Layouts/Guest";

    export default {
        layout: Guest,

        props: {
            status: String
        },

        data() {
            return {
                valid: false,

                form: this.$inertia.form({
                    email: ''
                })
            }
        },

        computed: {
            emailRules() {
                return [
                    emailRequired,
                    emailValid,
                ];
            },

        },

        methods: {
            submit() {
                this.form.post('/forgot-password')
            }
        }
    }
</script>
