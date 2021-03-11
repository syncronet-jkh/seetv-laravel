<template>
    <v-card elevation="1" tile width="100%" height="100%">
        <v-alert outlined color="error" icon="mdi-alert" v-model="form.hasErrors && form.errors.gateway">
            {{ form.errors.gateway }}
        </v-alert>

        <v-card-text>
            <v-form ref="form" v-model="valid" @submit.prevent="register">
                <v-text-field
                    autocomplete="username"
                    class="text--primary"
                    v-model="form.username"
                    :rules="usernameRules"
                    label="Username"
                    :error-messages="form.errors.username"
                    required

                    @keydown.enter="register"
                    prepend-inner-icon="mdi-card-account-details"
                ></v-text-field>

                <v-text-field
                    autocomplete="email"
                    class="text--primary"
                    v-model="form.email"
                    :rules="emailRules"
                    label="E-Mail"
                    :error-messages="form.errors.email"
                    required

                    @keydown.enter="register"
                    prepend-inner-icon="mdi-email"
                ></v-text-field>

                <v-text-field
                    autocomplete="current-password"
                    class="text--primary"
                    v-model="form.password"
                    :rules="passwordRules"
                    label="Password"
                    :error-messages="form.errors.password"
                    type="password"
                    required

                    @keydown.enter="register"
                    prepend-inner-icon="mdi-lock"
                    :counter="form.password.length"
                ></v-text-field>

                <v-text-field
                    autocomplete="current-password"
                    class="text--primary"
                    v-model="form.password_confirmation"
                    :rules="passwordConfirmationRules"
                    label="Password confirmation"
                    :error-messages="form.errors.password_confirmation"
                    type="password"
                    required

                    @keydown.enter="register"
                    prepend-inner-icon="mdi-lock"
                    :counter="form.password.length"
                ></v-text-field>

                <v-checkbox
                    label="Age consent"
                    v-model="form.age_consent"
                    :rules="ageConsentRules"
                    required
                />
                <v-checkbox
                    v-model="form.terms_consent"
                    :rules="termsConsentRules"
                    required
                >
                    <template v-slot:label>
                        <v-tooltip bottom>
                            <template v-slot:activator="{ on }">
                                <a
                                    target="_blank"
                                    href="https://syncronet.dk/privatlivspolitik"
                                    @click.stop
                                    v-on="on"
                                >
                                    Terms of Service
                                </a>
                            </template>
                            Opens in a new window
                        </v-tooltip>
                    </template>
                </v-checkbox>

                <v-btn
                    :disabled="!valid"
                    :loading="form.processing"
                    color="primary"
                    class="mr-4"
                    type="submit"
                    block
                >
                    Register
                </v-btn>
            </v-form>
        </v-card-text>

        <v-card-actions class="justify-end">
            <v-btn block color="primary" @click="$inertia.visit('/login')">Login</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
import Guest from "~/Layouts/Guest";
import {
    emailRequired,
    emailValid,
    mustBeOver18,
    passwordConfirmed,
    passwordRequired,
    termsAccepted,
    usernameRequired
} from "@/rules";

export default {
    layout: Guest,

    data() {
        return {
            valid: false,

            form: this.$inertia.form({
                username: '',
                email: '',
                password: '',
                password_confirmation: '',
                age_consent: false,
                terms_consent: false
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

        usernameRules() {
            return [usernameRequired];
        },

        passwordRules() {
            return [passwordRequired];
        },

        passwordConfirmationRules() {
            return [
                passwordRequired,
                passwordConfirmed,
            ];
        },

        ageConsentRules() {
            return [mustBeOver18]
        },

        termsConsentRules() {
            return [termsAccepted]
        }
    },

    methods: {
        async register() {
            if (this.$refs.form.validate()) {
                await this.form.post('/register')
                this.form.reset();
                this.$inertia.visit('/register/details')
            }
        },
    },
};
</script>
