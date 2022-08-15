<script lang="ts" setup>
import { ref } from "vue";

const props = defineProps<{
    startOpen?: true;
}>();

const isOpen = ref(props.startOpen ?? false);

const toggle = () => isOpen.value = !isOpen.value;
</script>

<template>
    <div class="relative">
        <div>
            <slot name="toggle" :toggle="toggle"/>
        </div>

        <transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <div
                v-if="isOpen"
                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                role="menu"
                aria-orientation="vertical"
                aria-labelledby="user-menu-button"
                tabindex="-1"
            >
                <slot></slot>
            </div>
        </transition>
    </div>
</template>
