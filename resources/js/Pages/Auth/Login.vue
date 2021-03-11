<template>
    <v-card elevation="1" tile width="100%" height="100%">
        <div class="d-flex justify-center">
            <Logo color="red" max-height="800" max-width="600" />
        </div>

        <v-card-text>
            <v-form ref="form" @submit.prevent="submit" v-model="valid">
                <v-text-field
                    ref="emailInput"
                    autofocus
                    class="text--primary"
                    v-model="form.email"
                    :rules="emailRules"
                    :error-messages="form.errors.email"
                    label="E-mail"
                    required
                    prepend-inner-icon="mdi-email"
                />

                <v-text-field
                    ref="passwordInput"
                    class="text--primary"
                    v-model="form.password"
                    :rules="passwordRules"
                    :error-messages="form.errors.password"
                    label="Password"
                    type="password"
                    required
                    prepend-inner-icon="mdi-lock"
                ></v-text-field>

                <v-btn
                    :disabled="!valid"
                    :loading="form.processing"
                    color="primary"
                    class="mr-4"
                    block
                    type="submit"
                >
                    Login
                </v-btn>
            </v-form>
        </v-card-text>

        <v-card-actions class="justify-space-around">
            <v-btn text color="primary" @click="$inertia.visit('/register')">Register</v-btn>
            <v-btn text v-if="canResetPassword" color="primary" @click="$inertia.visit('/forgot-password')">Forgot password</v-btn>
        </v-card-actions>
    </v-card>
</template>
<script>
    import Guest from "~/Layouts/Guest";
    import Logo from "~/Components/Logo";
    import {emailRequired, emailValid, passwordRequired} from "@/rules";

    export default {
        components: {Logo},
        layout: Guest,

        props: {
            canResetPassword: Boolean,
            status: String
        },

        data() {
            return {
                valid: false,

                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: 'on'
                }),
            }
        },

        computed: {
            emailRules() {
                return [
                    emailRequired,
                    emailValid
                ];
            },

            passwordRules() {
                return [passwordRequired];
            },
        },

        methods: {
            async submit() {
                if (this.$refs.form.validate()) {
                    await this.form.post('/login')
                    this.form.reset('password')
                }
            },
        }
    }
</script>
