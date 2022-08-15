<script lang="ts" setup>
const props = defineProps<{
    external?: true;
}>();
</script>

<template>
    <component
        :is="props.external ? 'a' : 'inertia-link'"
        class="text-primary-500 underline hover:text-primary-600 transition"
    >
        <slot/>
    </component>
</template>
