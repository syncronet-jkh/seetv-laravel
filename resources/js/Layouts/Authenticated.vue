<template>
    <v-app>
        <v-navigation-drawer
            v-model="sidebarVisible"
            app
            temporary
            style="z-index: 150"
        >
            <v-list dense>
                <div class="py-2 px-4">
                    <Logo max-height="128" max-width="128" />
                </div>

                <v-list-item link @click="$inertia.visit('/terms')">
                    <v-list-item-action>
                        <v-icon>mdi-gavel</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>
                            Terms
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-divider></v-divider>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app clipped-left color="primary" dark>
            <v-app-bar-nav-icon
                class="mr-4"
                aria-label="Open menu"
                @click="sidebarVisible = !sidebarVisible"
            />
            <Logo color="white" max-height="128" max-width="128" />

            <v-spacer />

            <v-spacer />

            <!-- Profile -->
            <v-menu
                offset-y
                style="z-index: 150"
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-btn fab light small v-bind="attrs" v-on="on">
                        {{ user.initials }}
                    </v-btn>
                </template>
                <v-card max-width="375">
                    <v-card-actions class="justify-center pb-0">
                        <v-btn fab elevation="0" x-large>
                            {{ user.initials }}
                        </v-btn>
                    </v-card-actions>
                    <v-card-title
                        class="justify-center py-0"
                        style="font-size: 16px; font-weight: 600"
                    >{{ user.username }}</v-card-title
                    >
                    <v-card-actions class="justify-center py-4">
                        <v-btn outlined @click="$inertia.visit('/dashboard')">
                            <v-icon left> mdi-account </v-icon>
                            Manage profile
                        </v-btn>
                    </v-card-actions>
                    <v-divider></v-divider>
                    <v-card-actions class="justify-center py-4">
                        <v-btn outlined @click="$inertia.post('/logout')">
                            Log out
                        </v-btn>
                    </v-card-actions>
                    <v-divider></v-divider>
                    <v-card-actions class="justify-center pa-0" style="height: 36px">
                        <v-btn text class="grey--text">
                            Terms & Conditions
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-menu>
        </v-app-bar>

        <v-main class="pt-md-16 px-md-0 pl-0">
            <v-container fluid>
                <v-snackbar
                    top
                    right
                    v-model="snackbarVisible"
                >
                    {{ flashMessage }}
                    <v-btn text @click="snackbarVisible = false">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </v-snackbar>

                <slot />
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import Logo from "~/Components/Logo";
export default {
    components: {Logo},

    props: {
        flashMessage: String
    },

    data: () => ({
        sidebarVisible: false,
        snackbarVisible: false,
    }),

    computed: {
        user() {
            return this.$page.props.auth.user
        }
    },

    watch: {
        flashMessage: {
            handler: function (val, oldVal) {
                if (val && val !== oldVal) {
                    this.snackbarVisible = true;
                }
            },

            immediate: true
        }
    }
};
</script>
