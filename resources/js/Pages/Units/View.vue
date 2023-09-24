<template>
    <Head :title="unit.name" />


</template>

<script setup>
import Panel from "primevue/panel";
import UnitCard from "@/Components/UnitCard.vue";

const props = defineProps({
    unit: {
        type: [Object, Array],
        required: false,
        default() {
            return null;
        }
    }
});

</script>
