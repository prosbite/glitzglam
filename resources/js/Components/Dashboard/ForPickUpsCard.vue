<script lang="ts" setup>
import { ref, computed, watch } from "vue";
import { Link, router } from "@inertiajs/vue3";
import { format, isToday, isThisYear, parseISO } from "date-fns";
import ShinyButtons from "../Utils/ShinyButtons.vue";
import ShinyModal from "../Utils/ShinyModal.vue";

// 1. State Management
const selectedDate = ref(format(new Date(), "yyyy-MM-dd"));
const dateInput = ref<HTMLInputElement | null>(null);
const showDropdown = ref(false);
const activeFilter = ref("All");
const filterOptions = ["All", "Reservations", "Pick-ups", "Returns"];
const showModal = ref(false);
// 2. Dynamic Title Logic
const displayTitle = computed(() => {
    const date = parseISO(selectedDate.value);
    if (isToday(date)) return "Today's - For Pick-ups";
    if (isThisYear(date)) return `${format(date, "MMM d")} - For Pick-ups`;
    return `${format(date, "MMM d, yyyy")} - For Pick-ups`;
});

// 3. Mock Data (Will be replaced by props from Laravel)
const todaysRentals = ref([
    {
        id: 1,
        item_code: "GW-013",
        category_slug: "Gowns",
        category_color: "bg-indigo-100 text-indigo-700",
        customer: {
            first_name: "Simon",
            last_name: "Cowall",
            email: "simoncowall209@gmail.com",
        },
        action_date: "Mar 10, 2026",
        amount_snapshot: "₱1,234.00",
        status: "Pickup",
    },
    {
        id: 2,
        item_code: "ST-005",
        category_slug: "Suits",
        category_color: "bg-emerald-100 text-emerald-800",
        customer: {
            first_name: "Meisha",
            last_name: "Kerr",
            email: "meishakerr766@gmail.com",
        },
        action_date: "Mar 10, 2026",
        amount_snapshot: "₱2,450.00",
        status: "Return",
    },
]);

// 4. Methods
const openDatePicker = () => dateInput.value?.showPicker();

const setFilter = (option: string) => {
    activeFilter.value = option;
    showDropdown.value = false;
};

// 5. Watcher for Backend Integration
// When the date changes, this will reload the page with the new date query param
watch(selectedDate, (newDate) => {
    console.log("Fetching data for:", newDate);
    // router.get('/dashboard', { date: newDate }, { preserveState: true });
});
</script>

<template>
    <div
        class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mt-4 min-h-[300px]"
    >
        <div
            class="px-6 h-[75px] border-b border-gray-100 flex items-center justify-between"
        >
            <div class="relative flex items-center">
                <input
                    type="date"
                    ref="dateInput"
                    v-model="selectedDate"
                    class="absolute opacity-0 pointer-events-none w-0 h-0"
                />

                <button
                    @click="openDatePicker"
                    class="group flex items-center gap-3 hover:bg-gray-50 px-3 py-2 -ml-3 rounded-xl transition-all"
                >
                    <div
                        class="p-2 bg-indigo-50 text-indigo-600 rounded-lg group-hover:bg-indigo-600 group-hover:text-white transition-colors"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9 3.75h.008v.008H12v-.008Z"
                            />
                        </svg>
                    </div>

                    <h3
                        class="text-xl font-bold text-slate-800 tracking-tight flex items-center gap-2"
                    >
                        {{ displayTitle }}
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-4 h-4 text-gray-300 group-hover:text-indigo-400 transition-colors"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m19.5 8.25-7.5 7.5-7.5-7.5"
                            />
                        </svg>
                    </h3>
                </button>
            </div>

            <div class="relative">
                <button
                    @click="showDropdown = !showDropdown"
                    class="bg-white border border-gray-200 px-4 py-2 rounded-xl text-sm font-semibold text-slate-700 flex items-center gap-2 hover:bg-gray-50 transition-all shadow-sm"
                >
                    {{ activeFilter }}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="w-4 h-4 text-gray-400 transition-transform"
                        :class="{ 'rotate-180': showDropdown }"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m19.5 8.25-7.5 7.5-7.5-7.5"
                        />
                    </svg>
                </button>

                <div
                    v-if="showDropdown"
                    class="absolute right-0 mt-2 w-40 bg-white border border-gray-100 rounded-xl shadow-xl z-20 p-1.5 animate-in fade-in zoom-in duration-150"
                >
                    <button
                        v-for="option in filterOptions"
                        :key="option"
                        @click="setFilter(option)"
                        class="w-full text-left px-4 py-2.5 rounded-lg text-sm transition-colors"
                        :class="[
                            activeFilter === option
                                ? 'bg-indigo-50 text-indigo-700 font-bold'
                                : 'text-slate-600 hover:bg-gray-50',
                        ]"
                    >
                        {{ option }}
                    </button>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr
                        class="text-[11px] text-gray-400 uppercase font-bold tracking-[0.05em]"
                    >
                        <th class="px-6 py-4">Customer</th>
                        <!-- <th class="px-6 py-4">Time</th> -->
                        <th class="px-6 py-4">Balance</th>
                        <th class="px-6 py-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr
                        v-for="rental in todaysRentals"
                        :key="rental.id"
                        class="group hover:bg-indigo-50/30 transition-colors"
                    >
                        <td class="px-3 py-2">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-slate-100 border border-gray-200 flex items-center justify-center font-bold text-slate-400 text-xs shrink-0"
                                >
                                    {{ rental.customer.first_name[0]
                                    }}{{ rental.customer.last_name[0] }}
                                </div>
                                <div class="min-w-0">
                                    <p
                                        class="font-bold text-[14px] text-slate-800 truncate"
                                    >
                                        {{ rental.customer.last_name }},
                                        {{ rental.customer.first_name }}
                                    </p>
                                    <p class="text-xs text-gray-400 truncate">
                                        {{ rental.customer.email }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <!-- <td
                            class="px-3 py-2 text-[13px] text-slate-500 font-medium"
                        >
                            {{ rental.action_date }}
                        </td> -->
                        <td
                            class="px-3 py-2 text-[14px] font-extrabold text-slate-900"
                        >
                            {{ rental.amount_snapshot }}
                        </td>
                        <!-- <td class="px-3 py-2">
                            <span
                                class="px-3 py-1 text-[10px] font-bold uppercase rounded-full shadow-sm"
                                :class="rental.category_color"
                            >
                                {{ rental.category_slug }}
                            </span>
                        </td> -->
                        <td class="px-8 py-5 text-left">
                            <!-- <ShinyButtons variant="primary" size="sm">
                                Receive
                            </ShinyButtons> -->
                            <ShinyButtons
                                @click="showModal = true"
                                variant="primary"
                                size="sm"
                                position="bottom"
                            >
                                <template #icon>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2.5"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 19.5V8.25m0 0l-4.5 4.5m4.5-4.5l4.5 4.5"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 15v3.375A2.625 2.625 0 0 0 5.625 21h12.75A2.625 2.625 0 0 0 21 18.375V15"
                                        />
                                    </svg>
                                </template>
                                Release
                            </ShinyButtons>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div
            class="px-8 py-5 border-t border-gray-100 bg-gray-50/30 flex items-center justify-between text-xs text-gray-500 font-medium"
        >
            <p>Showing {{ todaysRentals.length }} entries for this date</p>
            <Link
                href="/rentals"
                class="text-indigo-600 hover:text-indigo-800 font-bold flex items-center gap-1 transition-colors"
            >
                View All Rentals
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    class="w-3 h-3"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"
                    />
                </svg>
            </Link>
        </div>
        <ShinyModal :show="showModal" @close="showModal = false" size="sm">
            <template #header>
                <h3 class="text-lg font-semibold text-gray-900">
                    Release Rental
                </h3>
            </template>
            <template #default>
                <p>Do you want to release this rental?</p>
            </template>
            <template #footer>
                <button
                    @click="showModal = false"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
                >
                    Cancel
                </button>
                <button
                    @click="showModal = false"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors"
                >
                    Release
                </button>
            </template>
        </ShinyModal>
    </div>
</template>

<style scoped>
/* Smooth custom scrollbar for the table if needed */
.overflow-x-auto::-webkit-scrollbar {
    height: 6px;
}
.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #e5e7eb;
    border-radius: 10px;
}
</style>
