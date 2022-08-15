<script lang="ts" setup>
import registerFormComponent from "@/hooks/registerFormComponent";
import { ref } from "vue";
import Button from "@/components/Button.vue";

const submitting = ref(false);

registerFormComponent({
    onSubmit: () => {
        submitting.value = true;
    },
    onFinish: () => {
        submitting.value = false;
    },
});
</script>

<template>
    <Button type="submit" :disabled="submitting">
        <slot></slot>
    </Button>
</template>
