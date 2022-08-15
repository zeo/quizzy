<script lang="ts" setup>
import AppLayout from "@/components/layouts/app/AppLayout.vue";
import Container from "@/components/Container.vue";
import Button from "@/components/Button.vue";
import { Form, Input, Submit, Toggle } from "@/components/form";
</script>

<template>
    <AppLayout>
        <Container class="py-12">
            <Form id="createQuiz" method="post" url="/dashboard/quizzes">
                <!-- Page Header -->
                <div class="md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:tracking-tight sm:truncate">
                            Create Quiz
                        </h2>
                    </div>
                    <div class="mt-4 flex md:mt-0 md:ml-4 space-x-3">
                        <Button color="secondary">
                            <inertia-link href="/dashboard/quizzes">
                                Cancel
                            </inertia-link>
                        </Button>

                        <Submit>
                            Create Quiz
                        </Submit>
                    </div>
                </div>

                <div class="space-y-5 mt-8">
                    <Input form-key="name" type="text" label="Name"/>

                    <Toggle form-key="is_private">
                        Private Quiz
                    </Toggle>

                    <div class="flex space-x-3">
                        <Submit>
                            Create Quiz
                        </Submit>

                        <Button color="secondary">
                            <inertia-link href="/dashboard/quizzes">
                                Cancel
                            </inertia-link>
                        </Button>
                    </div>
                </div>
            </Form>
        </Container>
    </AppLayout>
</template>
