<script lang="ts" setup>
import Button from "@/components/Button.vue";

const props = defineProps<{
    quizzes: Quiz[];
}>();
</script>

<template>
    <div v-if="props.quizzes.length === 0" class="text-center py-36">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
        </svg>

        <h3 class="mt-2 text-sm font-medium text-gray-900">No quizzes found</h3>
        <p class="mt-1 text-sm text-gray-500">Create your first quiz now.</p>
        <div class="mt-6">
            <Button class="mx-auto">
                <inertia-link href="/dashboard/quizzes/create">
                    Create Quiz
                </inertia-link>
            </Button>
        </div>
    </div>

    <div v-else class="space-y-5">
        <inertia-link
            v-for="(quiz, i) in props.quizzes"
            :key="quiz.id"
            :href="`/dashboard/quizzes/${quiz.id}`"
            class="border border-gray-300 rounded-md p-4 flex justify-between shadow-sm bg-gray-50"
        >
            <div>
                <p class="text-black font-medium text-base">
                    {{ quiz.name }}

                    <!-- TODO: badge component and find out what's causing space on the left -->
                    <span v-if="quiz.is_private" class="ml-2 px-2 py-1 text-sm rounded-full bg-amber-300 bg-opacity-40">
                        PRIVATE
                    </span>
                </p>

                <p class="text-gray-600 font-medium text-sm mt-2">
                    {{ quiz.questions_count }} questions - created on 19/20/2
                </p>
            </div>
        </inertia-link>
    </div>
</template>
