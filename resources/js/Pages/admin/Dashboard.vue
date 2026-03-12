<template>
    <Head title="Dashboard" />

    <div class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-800">Dashboard Overview</h2>

        <div class="flex flex-col gap-2">
            <div class="w-full">
                <RentalsCard />
            </div>
            <div class="flex gap-6 w-full">
                <ForReturnsCard class="flex-1" />
                <ForPickUpsCard class="flex-1" />
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { usePage, Head } from "@inertiajs/vue3";
import RentalsCard from "@/Components/Dashboard/RentalsCard.vue";
import ForPickUpsCard from "@/Components/Dashboard/ForPickUpsCard.vue";
import ForReturnsCard from "@/Components/Dashboard/ForReturnsCard.vue";

const page = usePage();

defineOptions({
    layout: MainLayout,
});
</script>

<style></style>
