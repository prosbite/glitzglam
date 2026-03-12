<script setup>
import { ref } from "vue";
import Sidebar from "@/Components/Layout/Sidebar.vue";
import Header from "@/Components/Layout/Header.vue";

const isCollapsed = ref(false);
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-[#F4F6FB]">
        <Sidebar :isCollapsed="isCollapsed" />

        <div class="flex-1 flex flex-col min-w-0 h-full relative">
            <Header @toggle="isCollapsed = !isCollapsed" />

            <main class="flex-1 overflow-y-auto p-6 lg:p-6 custom-scrollbar">
                <div class="max-w-[1600px] mx-auto">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
