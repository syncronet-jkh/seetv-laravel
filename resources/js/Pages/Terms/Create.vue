<template>
    <v-card elevation="1" tile width="100%" height="100%">
        <v-card-title>Create new Terms</v-card-title>

        <v-form ref="form" @submit.prevent="submit" v-model="valid">
            <v-text-field
                autofocus
                class="text--primary"
                v-model="form.section"
                :rules="sectionRules"
                :error-messages="form.errors.section"
                label="Section"
                required
            />

            <v-text-field
                class="text--primary"
                v-model="form.paragraph"
                :rules="paragraphRules"
                :error-messages="form.errors.paragraph"
                label="Paragraph"
                required
            />

            <v-text-field
                class="text--primary"
                v-model="form.content"
                :rules="contentRules"
                :error-messages="form.errors.content"
                label="Content"
                required
                counter
            ></v-text-field>

            <v-btn
                :disabled="!valid"
                :loading="form.processing"
                color="primary"
                class="mr-4"
                block
                type="submit"
            >
                Create
            </v-btn>
        </v-form>
    </v-card>
</template>

<script>
import Authenticated from "~/Layouts/Authenticated";
import {termContentRequired, termParagraphRequired, termSectionRequired} from "@/rules";

export default {
    metaInfo() {
        return {title: this.title}
    },

    layout: Authenticated,

    props: {
        title: String,
    },

    data() {
        return {
            valid: false,

            form: this.$inertia.form({
                section: '',
                paragraph: '',
                content: ''
            })
        }
    },

    computed: {
        sectionRules: () => [termSectionRequired],
        paragraphRules: () => [termParagraphRequired],
        contentRules: () => [termContentRequired]
    },

    methods: {
        async submit() {
            if (this.$refs.form.validate()) {
                await this.form.post('/terms')
                this.form.reset();
            }
        }
    }
}
</script>
