<script lang="ts" setup>
import { Form, Input, Submit } from "@/components/form";
import AuthLayout from "@/components/layouts/auth/AuthLayout.vue";
import SSO from "@/components/layouts/auth/SSO.vue";
import Link from "@/components/Link.vue";

const { errors, ...props } = defineProps<{
    errors: any;
}>();

</script>

<template>
    <AuthLayout>
        <div>
            <img class="h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Log in to your account</h2>
            <p class="mt-2 text-sm text-gray-600">
                Don't have an account yet?

                <Link href="/auth/register">Register now.</Link>
            </p>
        </div>

        <div class="mt-8">
            <SSO/>

            <div class="mt-6">
                <Form id="login" method="post" url="/auth/login" class="space-y-5">
                    <Input form-key="email" type="email" label="Email" />
                    <Input form-key="password" type="password" label="Password" />

                    <Submit class="w-full">
                        Login
                    </Submit>
                </Form>
            </div>
        </div>
    </AuthLayout>
</template>
