<script lang="ts" setup>
import registerFormComponent from "@/hooks/registerFormComponent";
import { computed, inject, ref } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

const props = defineProps<{
    formKey: string;
    initialValue?: string | number;
    label: string;
}>();

const value = ref(props.initialValue ?? '');

registerFormComponent({
    key: props.formKey,
    valueResolver: () => value.value,
});

const formId = inject<string>('formId')!;

const error = computed(() => {
    // TODO: proper typing of page props
    const errors = usePage<{errors: any}>().props.value.errors;
    console.log(errors);
    if (!errors) return null;

    const formErrors = errors[formId];
    if (!formErrors) return;

    console.log(formErrors);

    return formErrors[props.formKey];
});

const inputClass = computed(() => {
    return !!error.value
        ? 'focus:ring-red-500 focus:border-red-500 border-red-500'
        : 'focus:ring-primary-500 focus:border-primary-500 border-gray-300 hover:border-primary-500';
});
</script>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
    inheritAttrs: false,
});
</script>

<template>
    <div>
        <label :for="props.formKey" class="block text-sm font-medium text-gray-700">{{ props.label }}</label>

        <div class="mt-1">
            <input
                :name="props.formKey"
                :id="props.formKey"
                class="shadow-sm  block w-full sm:text-sm transition rounded-md"
                :class="inputClass"
                v-model="value"
                v-bind="$attrs"
            />
        </div>

        <p v-if="!!error" class="mt-2 text-sm text-red-600">
            {{ error }}
        </p>
    </div>
</template>
