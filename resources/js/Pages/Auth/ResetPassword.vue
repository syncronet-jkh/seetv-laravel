<template>
    <v-card elevation="1" width="100%" height="100%">
        <v-form ref="form" v-model="valid" @submit.prevent="submit">
            <v-text-field
                autocomplete="email"
                class="text--primary"
                v-model="form.email"
                :rules="emailRules"
                label="E-Mail"
                :error-messages="form.errors.email"
                required
                prepend-inner-icon="mdi-email"
            ></v-text-field>

            <v-text-field
                autocomplete="new-password"
                class="text--primary"
                v-model="form.password"
                :rules="passwordRules"
                label="Password"
                :error-messages="form.errors.password"
                type="password"
                required

                @keydown.enter="submit"
                prepend-inner-icon="mdi-lock"
                :counter="form.password.length"
            ></v-text-field>

            <v-text-field
                autocomplete="new-password"
                class="text--primary"
                v-model="form.password_confirmation"
                :rules="passwordConfirmationRules"
                label="Password Confirmation"
                :error-messages="form.errors.password_confirmation"
                type="password"
                required

                @keydown.enter="submit"
                prepend-inner-icon="mdi-lock"
                :counter="form.password.length"
            ></v-text-field>

            <v-btn
                :disabled="!valid"
                :loading="form.processing"
                color="primary"
                class="mr-4"
                type="submit"
                block
            >
                Reset Password
            </v-btn>
        </v-form>
    </v-card>
</template>

<script>
import Guest from "@/Layouts/Guest";
import {emailRequired, emailValid, passwordConfirmed, passwordRequired} from "@/rules";

export default {
    layout: Guest,

    props: {
        email: String,
        token: String,
    },

    data() {
        return {
            valid: false,

            form: this.$inertia.form({
                token: this.token,
                email: this.email,
                password: '',
                password_confirmation: '',
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

        passwordRules() {
            return [passwordRequired];
        },

        passwordConfirmationRules() {
            return [
                passwordRequired,
                (v) => passwordConfirmed(v, this.form.password),
            ];
        },
    },

    methods: {
        async submit() {
            await this.form.post('/reset-password')
            this.form.reset('password', 'password_confirmation')
        }
    }
}
</script>
