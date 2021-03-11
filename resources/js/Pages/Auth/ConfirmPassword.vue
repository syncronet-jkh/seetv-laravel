<template>
    <v-card elevation="1" tile width="100%" height="100%">
        <v-card-title>
            This is a secure area of the application. Please confirm your password before continuing.
        </v-card-title>

        <v-card-text>
            <v-form ref="form" v-model="valid" @submit.prevent="submit">
                <v-text-field
                    autocomplete="current-password"
                    class="text--primary"
                    v-model="form.password"
                    :rules="passwordRules"
                    label="Password"
                    :error-messages="form.errors.password"
                    type="password"
                    required
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
                    Confirm
                </v-btn>
            </v-form>
        </v-card-text>
    </v-card>
</template>

<script>
    import Guest from "@/Layouts/Guest";
    import {passwordRequired} from "@/rules";

    export default {
        layout: Guest,

        data() {
            return {
                valid: false,

                form: this.$inertia.form({
                    password: '',
                })
            }
        },

        computed: {
            passwordRules() {
                return [passwordRequired];
            },
        },

        methods: {
            async submit() {
                await this.form.post('/confirm-password')
                this.form.reset()
            }
        }
    }
</script>
