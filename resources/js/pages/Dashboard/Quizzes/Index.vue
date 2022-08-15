<script lang="ts" setup>
import AppLayout from "@/components/layouts/app/AppLayout.vue";
import Container from "@/components/Container.vue";
import Button from "@/components/Button.vue";
import QuizList from "@/components/dashboard/QuizList.vue";

const props = defineProps<{
    quizzes: Quiz[];
}>();
</script>

<template>
    <AppLayout>
        <Container class="py-12">
            <!-- Page Header -->
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:tracking-tight sm:truncate">
                        Your Quizzes
                    </h2>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <Button>
                        <inertia-link href="/dashboard/quizzes/create">
                            Create Quiz
                        </inertia-link>
                    </Button>
                </div>
            </div>

            <QuizList class="mt-12" :quizzes="props.quizzes"/>
        </Container>
    </AppLayout>
</template>
