<script lang="ts" setup>
import { computed, provide } from "vue";
import { Inertia, Method } from "@inertiajs/inertia";
import { FormComponent, REGISTER_FORM_COMPONENT, RegisterFormComponent } from "@/hooks/registerFormComponent";
import setValue from "lodash/set";

const props = defineProps<{
    id: string;
    method: string;
    url: string;
}>();

let components: FormComponent[] = [];

provide<RegisterFormComponent>(REGISTER_FORM_COMPONENT, (component: FormComponent) => {
    components.push(component);

    return () => components = components.filter(x => x != component);
});

const getData = () => {
    const data: Record<string, any> = {};
    for (const component of components) {
        if (!component.key || !component.valueResolver) continue;

        data[component.key] = component.valueResolver();
    }

    return data;
}

const methodMap: Record<string, Method> = {
    'get': Method.GET,
    'post': Method.POST,
    'patch': Method.PATCH,
    'put': Method.PUT,
    'delete': Method.DELETE,
};
const method = computed(() => methodMap[props.method]);

const submit = () => {
    const data: Record<string, any> = {};
    for (const component of components) {
        if (!component.key || !component.valueResolver) continue;

        setValue(data, component.key, component.valueResolver());
    }

    components.forEach(x => x.onSubmit?.());

    Inertia.visit(props.url, {
        method: method.value,
        errorBag: props.id,
        data,

        onFinish: () => {
            components.forEach(x => x.onFinish?.());
        },

        onSuccess: (p) => {
            components.forEach(x => x.onSuccess?.());
        },
    });
};

provide('submitForm', submit);
provide('formId', props.id);
</script>

<template>
    <form @submit.prevent="submit" novalidate>
        <slot/>
    </form>
</template>
