<script setup>
import Card from 'primevue/card';

defineProps({
    unit: Object,
});

const imagePath = (path) => {
    return "/storage/" + path;
}

const capitalize = (word) => {
    return word.charAt(0).toUpperCase()
        + word.slice(1);
}
</script>

<template>
    <div class="border-t-4 border-b-4 rounded border-gray-400 border-l p-6 w-full md:w-1/2 lg:w-1/4 border-r mx-auto">
                <img :alt="unit.name" :src="imagePath(unit.base_image)" class="mx-auto" />
                <div class="w-full text-center">
                    {{ unit.name }}
                </div>
                <div class="w-full text-center">
                    {{ capitalize(unit.size) }} {{ unit.attack_type === 'none' ? '' : capitalize(unit.attack_type) }}
                </div>
    </div>
</template>
