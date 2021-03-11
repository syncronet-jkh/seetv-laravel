<template>
    <v-card elevation="1" tile width="100%" height="100%">
        <v-card-title>
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </v-card-title>

        <v-alert v-if="verificationLinkSent" type="info" outlined>A new verification link has been sent to the email address you provided during registration.</v-alert>

        <v-card-actions>
            <v-btn
                :disabled="verificationLinkSent"
                :loading="form.processing"
                color="primary"
                class="mr-4"
                block
                @click="submit"
            >
                Resend Verification Email
            </v-btn>

            <v-btn @click="$inertia.visit('/logout')">Log out</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
    import Guest from "@/Layouts/Guest";

    export default {
        layout: Guest,

        props: {
            status: String
        },

        data() {
            return {
                form: this.$inertia.form()
            }
        },

        methods: {
            submit() {
                this.form.post('/email/verification-notification')
            },
        },

        computed: {
            verificationLinkSent() {
                return this.status === 'verification-link-sent';
            }
        }
    }
</script>
