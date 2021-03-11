<template>
    <v-card>
        Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
    </v-card>
</template>

<script>
    import Guest from "@/Layouts/Guest";

    export default {
        layout: Guest,

        props: {
            laravelVersion: String,
            phpVersion: String
        }
    }
</script>
