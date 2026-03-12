<script setup>
defineEmits(["toggle"]);
</script>

<template>
    <header
        class="h-[70px] bg-white/80 backdrop-blur-md border-b border-gray-200 flex items-center justify-between px-6 sticky top-0 z-20 shrink-0"
    >
        <div class="flex items-center gap-4">
            <button
                @click="$emit('toggle')"
                class="p-2 rounded-lg hover:bg-gray-100 text-gray-600 transition-colors"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    class="w-6 h-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12"
                    />
                </svg>
            </button>

            <h1 class="text-sm font-semibold text-slate-700 md:hidden">
                G&G Admin
            </h1>
        </div>

        <div class="flex items-center gap-4">
            <button
                class="p-2 text-gray-500 hover:bg-gray-100 rounded-full relative"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"
                    />
                </svg>
                <span
                    class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white"
                ></span>
            </button>

            <div class="flex items-center gap-3 pl-4 border-l border-gray-200">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-bold text-slate-800">Ben</p>
                    <p
                        class="text-[10px] text-gray-500 uppercase tracking-tighter"
                    >
                        Administrator
                    </p>
                </div>
                <div
                    class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-sm"
                >
                    B
                </div>
            </div>
        </div>
    </header>
</template>
