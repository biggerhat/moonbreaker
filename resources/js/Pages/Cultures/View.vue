<template>
    <Head :title="culture.name" />

    <Panel :header="culture.name" class="mb-6">
        <p class="m-0">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
    </Panel>

    <Panel header="Captains" class="mb-6">
        <div class="flex items-center">
            <UnitCard v-for="captain in culture.captains" :unit="captain" class="hover:border hover:border-blue-300 border border-[#1E1E1E]" link=link />
        </div>
    </Panel>

    <Panel header="Crew">
        <div class="flex items-center flex-wrap">
            <UnitCard v-for="crew in culture.crew" :unit="crew" custom-classes="hover:border hover:border-blue-300 border border-[#1E1E1E]" link=link />
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
    },
    captains: {
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
