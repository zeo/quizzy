<script lang="ts" setup>
type ButtonColor = 'primary' | 'secondary';
type ButtonSize = 'xs' | 'sm' | 'md' | 'lg' | 'xl';

const colors: Record<ButtonColor, string> = {
    primary: 'bg-primary-500 hover:bg-primary-600 text-white transition border border-transparent focus:outline-none',
    secondary: 'border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 focus:outline-none',
};

const sizes: Record<ButtonSize, string> = {
    xs: 'px-2.5 py-1.5 text-xs rounded',
    sm: 'px-3 py-2 text-sm leading-4 rounded-md',
    md: 'px-4 py-2 text-sm rounded-md',
    lg: 'px-4 py-2 text-base rounded-md',
    xl: 'px-6 py-3 text-base rounded-md'
};

interface ButtonProps {
    size?: ButtonSize;
    color?: ButtonColor;
    as?: any;
}

const { size, color, as } = withDefaults(defineProps<ButtonProps>(), {
    size: 'md',
    color: 'primary',
    as: 'button',
});
</script>

<template>
    <component
        :is="as"
        class="flex justify-center font-medium shadow-sm"
        :class="[ colors[color], sizes[size] ]"
    >
        <slot/>
    </component>
</template>
