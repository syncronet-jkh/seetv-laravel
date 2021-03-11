<template>
    <v-app>
        <v-app-bar app clipped-left color="primary" dark>
            <v-toolbar-title>
                <Logo color="white" max-height="128" max-width="128"/>
            </v-toolbar-title>

            <v-spacer/>

            <v-btn text @click="$inertia.visit('/login')">
                Login
            </v-btn>

            <v-btn text @click="$inertia.visit('/register')">
                Register
            </v-btn>
        </v-app-bar>

        <v-main className="pt-md-16 px-md-0 pl-0">
            <v-container fluid>
                <slot/>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import Logo from "~/Components/Logo";

export default {
    components: {Logo},
};
</script>
