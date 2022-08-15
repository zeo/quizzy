<script lang="ts" setup>
const props = defineProps<{
    icon?: string;
}>();
</script>

<template>
    <inertia-link
        class="text-gray-700 group flex items-center px-4 py-2 text-sm"
        role="menuitem"
        tabindex="-1"
    >
        <fontawesome-icon
            v-if="props.icon"
            :icon="props.icon"
            class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500"
        />

        <slot/>
    </inertia-link>
</template>
