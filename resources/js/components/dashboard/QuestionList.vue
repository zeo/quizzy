<script lang="ts" setup>
import Question from "@/components/dashboard/Question.vue";

const props = defineProps<{
    quizId: string;
    questions: Question[];
}>();
</script>

<template>
    <div class="space-y-5">
        <Question
            v-for="(question, i) in props.questions"
            :key="question.id"
            :quiz-id="props.quizId"
            :question="question"
            :question-number="i + 1"
        />

        <inertia-link
            as="button"
            method="post"
            :href="`/dashboard/quizzes/${props.quizId}/questions`"
            class="border border-gray-400 border-dashed w-full p-5 text-left rounded-md flex text-gray-700"
        >
            <fontawesome-icon icon="far fa-plus" class="text-gray-400 w-5 h-5 my-auto mr-3"/>

            Create new question
        </inertia-link>
    </div>
</template>
