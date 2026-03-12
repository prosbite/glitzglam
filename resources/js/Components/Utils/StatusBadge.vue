<script lang="ts" setup>
import { computed } from "vue";

// expanded types for the full rental lifecycle
export type BadgeStatus =
    | "available" // Ready for rent
    | "rented" // Currently out
    | "maintenance" // Cleaning/Repairs
    | "overdue" // Past return date
    | "draft" // Not yet official
    | "cancelled" // Rental aborted
    | "damaged" // Item needs major repair/replacement
    | "reserved"; // Booked for a future date

export type BadgeSize = "sm" | "md" | "lg";

const props = defineProps<{
    status?: BadgeStatus;
    label: string;
    size?: BadgeSize;
    showDot?: boolean; // Optional: Adds a small decorative circle
}>();

const statusClasses = computed(() => {
    const themes: Record<BadgeStatus, string> = {
        // Green - Positive
        available: "bg-emerald-50 text-emerald-600 border-emerald-200",

        // Blue - Active
        rented: "bg-blue-50 text-blue-600 border-blue-200",

        // Indigo - Scheduled
        reserved: "bg-indigo-50 text-indigo-600 border-indigo-200",

        // Orange - Process/Warning
        maintenance: "bg-orange-50 text-orange-600 border-orange-200",

        // Red/Rose - Critical
        overdue: "bg-rose-50 text-rose-600 border-rose-200",
        damaged: "bg-red-100 text-red-700 border-red-300 shadow-sm", // Stronger red for damage

        // Gray/Slate - Neutral
        draft: "bg-slate-50 text-slate-500 border-slate-200",
        cancelled: "bg-gray-100 text-gray-400 border-gray-200 italic", // Gray and italic for cancelled
    };
    return themes[props.status || "draft"];
});

const sizeClasses = computed(() => {
    const sizes: Record<BadgeSize, string> = {
        sm: "px-2 py-0.5 text-[10px] rounded-md",
        md: "px-3 py-1 text-[12px] rounded-lg",
        lg: "px-4 py-1.5 text-[14px] rounded-xl",
    };
    return sizes[props.size || "md"];
});
</script>

<template>
    <span
        :class="[
            statusClasses,
            sizeClasses,
            'font-bold border inline-flex items-center justify-center gap-1.5 whitespace-nowrap transition-all',
        ]"
    >
        <span
            v-if="showDot"
            class="w-1.5 h-1.5 rounded-full bg-current opacity-70"
        ></span>

        {{ label }}
    </span>
</template>
