<template>
    <v-img v-if="$vuetify.theme.isDark" src="/zome-white.png" alt="Logo" v-bind="$attrs" v-on="$listeners" />
    <v-img v-else src="/zome-red.png" alt="Logo" v-bind="$attrs" v-on="$listeners" />
</template>

<script>
export default {
    // functional: true
};
</script>
