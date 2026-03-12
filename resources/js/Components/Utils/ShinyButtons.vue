<script lang="ts" setup>
import { computed } from "vue";

export type ButtonVariant =
    | "primary"
    | "success"
    | "warning"
    | "danger"
    | "info"
    | "secondary";
export type ButtonSize = "sm" | "md" | "lg";

const props = defineProps<{
    variant?: ButtonVariant;
    size?: ButtonSize;
    disabled?: boolean;
    loading?: boolean;
}>();

const variantClasses = computed(() => {
    const variants: Record<ButtonVariant, string> = {
        // Solid Dark/Brand Backgrounds with White Text
        primary:
            "bg-indigo-600 text-white border-indigo-600 hover:bg-indigo-700 shadow-sm",
        success:
            "bg-emerald-600 text-white border-emerald-600 hover:bg-emerald-700 shadow-sm",
        warning:
            "bg-orange-500 text-white border-orange-500 hover:bg-orange-600 shadow-sm",
        danger: "bg-rose-600 text-white border-rose-600 hover:bg-rose-700 shadow-sm",
        info: "bg-blue-600 text-white border-blue-600 hover:bg-blue-700 shadow-sm",

        // Secondary remains white/gray for "Cancel" actions
        secondary:
            "bg-white text-slate-700 border-gray-200 hover:bg-gray-50 hover:border-gray-300",
    };
    return variants[props.variant || "primary"];
});

const sizeClasses = computed(() => {
    const sizes: Record<ButtonSize, string> = {
        sm: "px-3 py-1.5 text-xs rounded-lg",
        md: "px-5 py-2.5 text-sm rounded-xl", // Slightly more padding for a "button" feel
        lg: "px-7 py-3.5 text-base rounded-2xl",
    };
    return sizes[props.size || "md"];
});

const iconSizeClasses = computed(() => {
    if (props.size === "sm") return "w-3.5 h-3.5";
    if (props.size === "lg") return "w-5 h-5";
    return "w-4 h-4";
});
</script>

<template>
    <button
        :disabled="disabled || loading"
        :class="[
            variantClasses,
            sizeClasses,
            'inline-flex items-center justify-center font-bold border transition-all duration-200 active:scale-[0.96] disabled:opacity-50 disabled:pointer-events-none',
        ]"
    >
        <svg
            v-if="loading"
            :class="['animate-spin text-white mr-2', iconSizeClasses]"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
        >
            <circle
                class="opacity-25"
                cx="12"
                cy="12"
                r="10"
                stroke="currentColor"
                stroke-width="4"
            ></circle>
            <path
                class="opacity-75"
                fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
            ></path>
        </svg>

        <span
            v-if="$slots.icon && !loading"
            :class="['shrink-0', $slots.default ? 'mr-2' : '', iconSizeClasses]"
        >
            <slot name="icon" />
        </span>

        <span :class="{ 'opacity-0': loading }">
            <slot />
        </span>
    </button>
</template>
