<script lang="ts" setup>
import { ref } from "vue";
import registerFormComponent from "@/hooks/registerFormComponent";

const props = defineProps<{
    formKey: string;
    initialValue?: true;
}>();

const value = ref(props.initialValue ?? false);

const toggle = () => value.value = !value.value;

registerFormComponent({
    key: props.formKey,
    valueResolver: () => value.value,
});
</script>

<template>
    <div class="flex items-center">
        <button
            @click="toggle"
            type="button"
            class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none"
            :class="value ? 'bg-primary-500' : 'bg-gray-200'"
            role="switch"
            aria-checked="false"
        >
            <!-- Enabled: "translate-x-5", Not Enabled: "translate-x-0" -->
            <span
                aria-hidden="true"
                class="pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"
                :class="value ? 'translate-x-5' : 'translate-x-0'"
            />
        </button>
        <span class="ml-3 text-sm font-medium text-gray-900">
            <slot/>
        </span>
    </div>
</template>
