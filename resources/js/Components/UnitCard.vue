<script setup>
import Card from 'primevue/card';
import Cinder from '/public/Cinder.webp';
import Divider from "primevue/divider";
import {router} from "@inertiajs/vue3";

const props = defineProps({
    unit: {
        type: Object,
        default: [],
    },
    customClasses: {
        type: String,
        default: "",
    },
    link: {
        type: Boolean,
        default: false,
    }
});

const imagePath = (path) => {
    return "/storage/" + path;
};

const capitalize = (word) => {
    return word.charAt(0).toUpperCase()
        + word.slice(1);
};

const unitPage = () => {
    router.get(route("units.view", props.unit.slug));
}
</script>

<style>
hr {
    background: linear-gradient(to right, #1E1E1E, #777777, #1E1E1E);
    height: 3px;
    border: 0;
}

.separator {
    display: flex;
    align-items: center;
    text-align: center;
}

.separator::before,
.separator::after {
    content: '';
    flex: 1;
    border-bottom: 3px solid #777777;
}

.separator:not(:empty)::before {
    margin-right: .0em;
}

.separator:not(:empty)::after {
    margin-left: .0em;
}
</style>

<template>
    <div
        class="p-card p-card-content w-full md:w-1/2 lg:w-1/4 mx-auto my-4 flex flex-col"
        :class="[customClasses, link ? 'hover:cursor-pointer' : '']"
        @click="link ? unitPage() : ''"
    >
        <div class="flex items-center" v-if="unit.cost > 0">
            <div class="rounded-full bg-black p-2 mb-2 text-2xl mx-auto mt-4 min-w-1/4 text-center">
                <span class="mx-4">
                    {{ unit.cost }}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="height: 1.5em; width: 1.5em; fill: purple" class="inline"><g class="" transform="translate(0,0)" style=""><path d="M279 25v30h-46V25h46zm178 35.396c3.485 1.262 7.267 2.717 11.195 4.55 5.553 2.589 10.945 5.739 14.409 8.742C486.067 76.69 487 78.936 487 80c0 1.063-.933 3.31-4.396 6.313-3.464 3.002-8.856 6.152-14.409 8.742-3.928 1.832-7.71 3.287-11.195 4.549V60.396zm-402 0v39.208c-3.485-1.262-7.267-2.717-11.195-4.55-5.553-2.589-10.945-5.739-14.409-8.742C25.933 83.31 25 81.064 25 80c0-1.063.933-3.31 4.396-6.313 3.464-3.002 8.856-6.152 14.409-8.742 3.928-1.832 7.71-3.287 11.195-4.549zM439 73v14h-46V73h46zm-64 0v291.578L256 498.453 137 364.578V73h238zm-256 0v14H73V73h46zm210 23h-18v252.844l-55 68.75-55-68.75V96h-18v259.156l73 91.25 73-91.25V96z" fill-opacity="1"></path></g></svg>
                </span>
            </div>
        </div>
        <div class="m-4 bg-primary">
            <img :alt="unit.name" :src="imagePath(unit.base_image)" class="mx-auto" />
        </div>

        <div class="w-full text-center text-2xl font-bold my-4">
            {{ unit.name }}
        </div>
        <hr />
        <div class="w-full text-center bg-gray-600 py-2">
            {{ capitalize(unit.size) }} {{ unit.attack_type === 'none' ? '' : capitalize(unit.attack_type) }}
        </div>
        <hr />
        <div>
            <div class="w-full text-center p-4" v-for="ability in unit.abilities">
                <span class="text-xl font-bold">{{ ability.name }}</span>
                <p>{{ ability.description }}</p>
            </div>
            <div class="flex flex-row justify-between p-4">
                <div class="rounded-full bg-black p-2 text-xl w-1/4 text-center">
                    +{{ unit.cinder }} <img :src="Cinder" class="inline" />
                </div>
                <div class="rounded-full bg-black p-2 text-xl w-1/4 text-center" v-if="unit.speed > 0">
                    +{{ unit.speed }}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="height: 1.5em; width: 1.5em; fill: green" class="inline"><g class="" transform="translate(0,0)" style=""><path d="M494.25 21.125l-164.53 1.25c-15.463 27.984-33.913 52.67-54.163 75.8 6.012 1.497 12.073 2.995 18.027 4.497l13.69 3.453-8.528 11.254c-50.415 66.503-44.632 142.087-27.36 213.694l-18.17 4.383c-16.838-69.817-23.528-148.192 22.64-217.94-88.07-21.897-183.62-43.434-253.374-89.38-1.77 4.89-1.01 10.187 2.262 17.23 2.427 5.222 6.516 11.043 12.14 17.117 53.162 37.938 130.458 65.946 189.778 75.168l-2.87 18.467c-61.85-9.616-139.642-37.397-196.036-77.227.61 5.953 2.61 12.393 6.387 19.36 6.918 12.758 19.275 26.49 35.7 38.907.84.635 1.697 1.265 2.557 1.893 42.555 22.677 93.696 38.914 140.737 42.164l-1.287 18.644c-61.147-4.222-126.33-28.22-175.672-60.745 1.03 4.922 3.253 10.397 6.885 16.38 7.367 12.14 20.078 25.484 36.23 37.675 39.264 17.838 81.604 32.938 128.62 36.473l-1.4 18.636C150.41 244.06 101.38 224.536 57.41 203.57c3.7 19.623 17.285 34.4 38.926 46.805 26.818 15.373 65.26 25.424 105.822 31.328l7.457 1.086.52 7.517c1.074 15.51 4.568 22.832 9.742 31.672l-16.13 9.438c-4.93-8.426-9.286-18.45-11.292-32.436-32.304-5.087-63.402-12.616-89.365-24.265-6.44 7.75-12.784 15.74-18.994 24.033 16.515 23.758 30.6 43.036 52.78 65.78l27.095-9.467 9.343-3.25 2.718 9.53c15.066 53.052 59.564 93.564 113.595 113.813 48.005 17.99 103.003 19.633 150.063.594-68.673-37.578-114.617-123.708-135.782-199.875l-1.125-4.156 2.376-3.564C348.53 203.283 425.85 148.88 494.25 123.97V21.124z" fill="currentFill" fill-opacity="1"></path></g></svg>
                </div>
            </div>
        </div>
        <hr class="my-4" />
        <div class="w-full grid grid-cols-8 my-6 px-4" v-for="action in unit.actions">
            <div class="col-span-2 flex items-center justify-center action-cost">
                <span class="text-xl">{{ action.cost }}x </span><img :src="Cinder" />
            </div>
            <div class="col-span-6">
                <span class="text-xl font-bold">{{ action.name }}</span>
                <p>{{ action.description }}</p>
            </div>
        </div>
        <div style="margin-top: auto;">
            <div class="flex items-center">
                <div class="rounded-full bg-black p-2 mb-2 text-2xl mx-auto min-w-1/3 text-center">
                <span v-if="unit.attack_type !== 'none'" class="mx-4">
                    {{ unit.damage }}
                    <i class="text-blue-700 fa fa-crosshairs" v-if="unit.attack_type === 'ranged'" />
                    <svg xmlns="http://www.w3.org/2000/svg" v-if="unit.attack_type ==='melee'" viewBox="0 0 512 512" style="height: 1.5em; width: 1.5em; fill: yellow" class="inline"><g class="" transform="translate(0,0)" style=""><path d="M62.5 17.28c-9.747.288-20.824 5.23-29.844 14.25-15.192 15.193-18.838 36.194-8.125 46.907 7.99 7.988 21.716 8.027 34.47 1.22 16.167 30.05 42.154 57.687 71.438 76.374-18.77 24.156-29.97 54.48-29.97 87.376h18.688c0-28.9 9.828-55.474 26.344-76.53l2.156 39.405C274.5 320.554 402.09 428.196 496.062 494.94c-65.54-95.294-176.99-224.638-288.687-348.407l-38.97-2.124c20.764-15.68 46.638-24.967 74.72-24.97V100.75c-32.2.002-61.945 10.725-85.844 28.78-18.696-29.383-46.39-55.48-76.53-71.686 6.795-12.748 6.796-26.423-1.188-34.407-4.352-4.352-10.393-6.352-17.062-6.156z" fill-opacity="1"></path></g></svg>
                </span>
                    <span class="mx-4">{{ unit.health }} <i class="fa fa-heart text-red-700" /></span>
                </div>
            </div>
        </div>


    </div>
</template>
