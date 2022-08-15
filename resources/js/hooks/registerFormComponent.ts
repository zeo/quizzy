import { inject, onBeforeMount, onBeforeUnmount } from "vue";

export type FormComponent = {
    key?: string;
    valueResolver?: () => any;

    onSubmit?: () => void;
    onFinish?: () => void;
    onSuccess?: () => void;
};

export type RegisterFormComponent = (component: FormComponent) => UnregisterFormComponent;
export type UnregisterFormComponent = () => void;

export const REGISTER_FORM_COMPONENT = Symbol("registerFormComponent");

export default function registerFormComponent(component: FormComponent) {
    let unregister: UnregisterFormComponent;

    onBeforeMount(() => {
        const registerFunc = inject<RegisterFormComponent>(REGISTER_FORM_COMPONENT);
        if (!registerFunc) {
            throw new Error("'registerFormComponent' was used outside of a Form element.");
        }

        unregister = registerFunc(component);
    });

    onBeforeUnmount(() => {
        unregister?.();
    });
}
