<template>
    <Head :title="culture.name + ' Culture'" />

    <Panel :header="culture.name" class="mb-6">
        <p class="m-0">
            {{ culture.description }}
        </p>
    </Panel>

    <Panel header="Captains" class="mb-6">
        <div class="flex items-center flex-wrap flex-grow gap-2">
            <UnitCard v-for="captain in culture.captains" :unit="captain" class="hover:border hover:border-blue-300 border border-[#1E1E1E] self-stretch" link=link />
        </div>
    </Panel>

    <Panel :header="'Crew (' + culture.crew.length + ' Units)'" class="mb-6">
        <div class="flex items-center flex-wrap flex-grow gap-2">
            <UnitCard v-for="crew in culture.crew" :unit="crew" custom-classes="hover:border hover:border-blue-300 border border-[#1E1E1E] self-stretch" link=link />
        </div>
    </Panel>

</template>

<script setup>
import Panel from "primevue/panel";
import UnitCard from "@/Components/UnitCard.vue";

const props = defineProps({
    culture: {
        type: [Object, Array],
        required: false,
        default() {
            return null;
        }
    }
});

</script>

<style>
.p-panel-content {
    background: #1E1E1E !important;
}
</style>
