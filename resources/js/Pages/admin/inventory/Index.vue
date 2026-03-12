<template>
    <div></div>
</template>

<script lang="ts" setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();
defineOptions({
    layout: MainLayout,
});
</script>

<style></style>
