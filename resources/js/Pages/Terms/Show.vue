<template>
    <v-card elevation="1" tile width="100%" height="100%">
        <v-card-title>{{ term.section }}</v-card-title>

        <v-card-subtitle>{{ term.paragraph }}</v-card-subtitle>

        <v-card-text>
            {{ term.content }}
        </v-card-text>

        <v-card-actions>
            <v-btn @click="$inertia.visit('/terms')">
                Index
            </v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
import Authenticated from "@/Layouts/Authenticated";

export default {
    layout: Authenticated,

    props: {
        term: Object
    }
}
</script>
