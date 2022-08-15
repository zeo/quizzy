<script lang="ts" setup>
import { ref } from "vue";
import { Form, Input, Submit } from "@/components/form";
import Button from "@/components/Button.vue";
import Toggle from "@/components/form/Toggle.vue";

const props = defineProps<{
    quizId: string;
    question: Question;
    questionNumber: number;
}>();

type AnswerInEditor = {
    value: string;
    is_correct: boolean;
}

const isEditing = ref(false);
// TODO: should probs fix these types
const answers = ref(props.question.answers as unknown as AnswerInEditor[]);

const addAnswer = () => {
    answers.value.push({
        value: '',
        is_correct: false,
    });
};
</script>

<template>
    <button
        v-if="!isEditing"
        @click="isEditing = true"
        class="border border-gray-300 rounded-md p-4 flex justify-between shadow-sm bg-gray-50 w-full flex justify-between"
    >
        <div class="inline-flex">
            <div class="flex mr-2">
                <p class="px-3 py-1 rounded-full bg-primary-100 mr-1 my-auto">{{ questionNumber }}</p>
            </div>

            <div>
                <p class="text-black font-medium text-base text-left">
                    {{ question.name }}
                </p>

                <p class="text-gray-600 font-medium text-sm mt-1 text-left">
                    {{ question.answers.length }} answers &middot; {{ question.answers.filter(x => x.is_correct).length }} correct
                </p>
            </div>
        </div>
    </button>

    <div v-else class="border border-gray-300 rounded-md p-4">
        <Form
            :id="`editQuestion[${question.id}]`"
            method="patch"
            :url="`/dashboard/quizzes/${props.quizId}/questions/${props.question.id}`"
            class="space-y-5"
        >
            <p class="text-xs text-gray-500 uppercase">Editing Question</p>

            <Input form-key="name" type="text" label="Name" :initial-value="question.name" />
            <Input form-key="time_seconds" type="number" label="Time (in seconds)" :initial-value="question.time_seconds"/>

            <div>
                <div v-for="(answer, i) in answers" :key="i" class="flex w-full">
                    <div class="grow">
                        <Input :form-key="`answers[${i}].value`" label="Value" type="text"/>
                    </div>

                    <div class="shrink-0 flex">
                        <Toggle :form-key="`answers[${i}].is_correct`" class="my-auto">Is Correct</Toggle>
                    </div>
                </div>

                <Button type="button" @click="addAnswer">
                    New answer
                </Button>
            </div>

            <div class="inline-flex space-x-3">
                <Submit>
                    Update Question
                </Submit>

                <Button @click="isEditing = false" color="secondary">
                    Cancel
                </Button>
            </div>
        </Form>
    </div>
</template>
