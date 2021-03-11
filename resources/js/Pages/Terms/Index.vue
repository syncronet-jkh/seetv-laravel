<template>
    <v-card>
        <v-card-title>{{ title }}</v-card-title>

        <v-snackbar
            top
            left
            v-model="hasStatusMessage"
            :timeout="3000"
            color="success"
        >
            {{  statusMessage }}
        </v-snackbar>

        <v-data-table
            item-key="section"
            :headers="headers"
            :items="terms.data"
            :items-per-page="5"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar
                    flat
                >
                    <v-btn
                        color="primary"
                        dark
                        class="mb-2"
                        @click="$inertia.visit('/terms/create')"
                    >
                        New Item
                    </v-btn>

                    <v-dialog v-model="confirmingDelete" max-width="500px">
                        <v-card v-if="termBeingDeleted">
                            <v-card-title class="headline">Are you sure you want to delete this term?</v-card-title>
                            <v-card-subtitle>Paragraph [{{ termBeingDeleted.paragraph }}] in section [{{ termBeingDeleted.section }}]</v-card-subtitle>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="stopDeleting">Cancel</v-btn>
                                <v-btn color="blue darken-1" text @click="deleteTerm">Yes</v-btn>
                                <v-spacer></v-spacer>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>

            <template v-slot:item.section="{ item }">
                <v-edit-dialog
                    :return-value.sync="item.section"
                    @save="update(item)"
                >
                    {{ item.section }}
                    <template v-slot:input>
                        <v-text-field
                            v-model="item.section"
                            label="Edit"
                            single-line
                            counter
                        ></v-text-field>
                    </template>
                </v-edit-dialog>
            </template>

            <template v-slot:item.paragraph="{ item }">
                <v-edit-dialog
                    :return-value.sync="item.paragraph"
                    @save="update(item)"
                >
                    {{ item.paragraph }}
                    <template v-slot:input>
                        <v-text-field
                            v-model="item.paragraph"
                            label="Edit"
                            single-line
                            counter
                        ></v-text-field>
                    </template>
                </v-edit-dialog>
            </template>

            <template v-slot:item.content="{ item }">
                <v-edit-dialog
                    :return-value.sync="item.content"
                    @save="update(item)"
                >
                    {{ item.content }}
                    <template v-slot:input>
                        <v-textarea
                            v-model="item.content"
                            label="Edit"
                            single-line
                            counter
                        ></v-textarea>
                    </template>
                </v-edit-dialog>
            </template>

            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    @click="confirmDeleting(item)"
                >
                    mdi-delete
                </v-icon>
            </template>
        </v-data-table>
    </v-card>
</template>

<script>
import Authenticated from "~/Layouts/Authenticated";

export default {
    metaInfo() {
        return {title: this.title}
    },

    layout: Authenticated,

    props: {
        title: String,
        terms: Object,
        headers: Array
    },

    data: () => ({
        hasStatusMessage: false,
        statusMessage: '',

        confirmingDelete: false,
        termBeingDeleted: undefined,
    }),

    methods: {
        async update(term) {
            this.$inertia.patch(`/terms/${term.id}`, term)

            this.statusMessage = 'Term was updated.'
            this.hasStatusMessage = true;
        },

        confirmDeleting(term) {
            this.confirmingDelete = true;
            this.termBeingDeleted = term;
        },

        stopDeleting() {
          this.confirmingDelete = false;
          this.termBeingDeleted = undefined;
        },

        deleteTerm() {
            this.$inertia.delete(`/terms/${this.termBeingDeleted.id}`)

            this.statusMessage = 'Term was deleted.'
            this.hasStatusMessage = true;

            this.stopDeleting();
        }
    }
}
</script>
