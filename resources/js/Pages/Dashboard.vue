<template>
    <v-card>
        <v-card-title>Hello, {{ $page.props.auth.user.username }}</v-card-title>
    </v-card>
</template>

<script>
 import Authenticated from "~/Layouts/Authenticated";

 export default {
     layout: Authenticated
 }
</script>
