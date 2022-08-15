<script lang="ts" setup>
import { Form, Input, Submit } from "@/components/form";
import Link from "@/components/Link.vue";
import AuthLayout from "@/components/layouts/auth/AuthLayout.vue";
import SSO from "@/components/layouts/auth/SSO.vue";
</script>

<template>
    <AuthLayout>
        <div>
            <img class="h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Register a new account</h2>
            <p class="mt-2 text-sm text-gray-600">
                Already have an account?
                <Link href="/auth/login">Log in.</Link>
            </p>
        </div>

        <div class="mt-8">
            <SSO/>

            <div class="mt-6">
                <Form id="register" method="post" url="/auth/register" class="space-y-5">
                    <Input form-key="name" type="text" label="Name" />
                    <Input form-key="email" type="email" label="Email" />
                    <Input form-key="password" type="password" label="Password" autocomplete="new-password" />
                    <Input form-key="password_confirmation" type="password" label="Password Confirmation" autocomplete="new-password" />

                    <Submit class="w-full">
                        Register
                    </Submit>
                </Form>
            </div>
        </div>
    </AuthLayout>
</template>
