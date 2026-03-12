<script lang="ts" setup>
import { computed, watch, onUnmounted } from "vue";

export type ModalSize =
    | "sm"
    | "md"
    | "lg"
    | "xl"
    | "2xl"
    | "3xl"
    | "4xl"
    | "5xl"
    | "full";
export type ModalPosition = "center" | "top" | "bottom";

const props = defineProps<{
    show: boolean;
    size?: ModalSize;
    position?: ModalPosition; // New: center, top, bottom
    zIndex?: number;
    closeable?: boolean;
    clean?: boolean;
}>();

const emit = defineEmits(["close"]);

const close = () => {
    if (props.closeable !== false) emit("close");
};

const sizeClasses = computed(() => {
    const sizes: Record<ModalSize, string> = {
        sm: "max-w-sm",
        md: "max-w-md",
        lg: "max-w-lg",
        xl: "max-w-xl",
        "2xl": "max-w-2xl",
        "3xl": "max-w-3xl",
        "4xl": "max-w-4xl",
        "5xl": "max-w-5xl",
        full: "max-w-[95vw]",
    };
    return sizes[props.size || "2xl"];
});

// Positioning Logic
const positionWrapperClasses = computed(() => {
    const positions: Record<ModalPosition, string> = {
        center: "flex items-center justify-center p-4",
        top: "flex items-start justify-center p-4 sm:pt-10",
        bottom: "flex items-end justify-center", // No padding for flush bottom sheets
    };
    return positions[props.position || "center"];
});

// Dynamic Animation Classes based on Position
const transitionClasses = computed(() => {
    if (props.position === "bottom") {
        return {
            enter: "translate-y-full",
            enterTo: "translate-y-0",
            leaveTo: "translate-y-full",
        };
    }
    if (props.position === "top") {
        return {
            enter: "-translate-y-full opacity-0",
            enterTo: "translate-y-0 opacity-100",
            leaveTo: "-translate-y-full opacity-0",
        };
    }
    // Default Center Scale
    return {
        enter: "opacity-0 scale-95",
        enterTo: "opacity-100 scale-100",
        leaveTo: "opacity-0 scale-95",
    };
});

watch(
    () => props.show,
    (val) => (document.body.style.overflow = val ? "hidden" : ""),
);
onUnmounted(() => (document.body.style.overflow = ""));
</script>

<template>
    <Teleport to="body">
        <Transition
            enter-active-class="ease-out duration-300"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="ease-in duration-200"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div
                v-if="show"
                class="fixed inset-0"
                :style="{ zIndex: zIndex || 50 }"
            >
                <div
                    class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity"
                    @click="close"
                />

                <div
                    class="fixed inset-0 overflow-hidden"
                    :class="positionWrapperClasses"
                >
                    <Transition
                        enter-active-class="transform transition ease-out duration-300"
                        :enter-from-class="transitionClasses.enter"
                        :enter-to-class="transitionClasses.enterTo"
                        leave-active-class="transform transition ease-in duration-200"
                        leave-from-class="transitionClasses.enterTo"
                        :leave-to-class="transitionClasses.leaveTo"
                    >
                        <div
                            v-if="show"
                            class="relative w-full transform transition-all"
                            :class="[
                                sizeClasses,
                                clean ? '' : 'bg-white shadow-2xl',
                                position === 'bottom'
                                    ? 'rounded-t-3xl'
                                    : 'rounded-2xl', // Cuter rounded top for bottom sheets
                                clean
                                    ? ''
                                    : position === 'bottom'
                                      ? ''
                                      : 'mb-6',
                            ]"
                        >
                            <button
                                v-if="closeable !== false"
                                @click="close"
                                class="absolute z-[70] bg-white text-slate-900 rounded-full shadow-lg flex items-center justify-center border border-slate-100 hover:bg-slate-50 transition-all"
                                :class="[
                                    position === 'bottom'
                                        ? 'top-4 right-6 w-10 h-10' // Larger, internal close for bottom sheets
                                        : 'top-0 right-0 -translate-y-1/2 translate-x-1/2 w-8 h-8', // Offset for center/top
                                ]"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="3"
                                    stroke="currentColor"
                                    class="w-4 h-4"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>

                            <div
                                v-if="$slots.header && !clean"
                                class="px-6 py-5 border-b border-gray-100 font-bold text-lg text-slate-800"
                            >
                                <slot name="header" />
                            </div>

                            <div :class="clean ? '' : 'px-6 py-6'">
                                <slot />
                            </div>

                            <div
                                v-if="$slots.footer && !clean"
                                class="px-6 py-4 bg-gray-50/50 border-t border-gray-100 flex justify-end gap-3"
                            >
                                <slot name="footer" />
                            </div>
                        </div>
                    </Transition>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>
