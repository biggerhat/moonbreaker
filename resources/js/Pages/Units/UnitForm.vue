<template>
    <Head :title="props.unit ? 'Edit An Unit' : 'Add An Unit'" />

    <div class="mx-2 mx-auto">
        <Card class="mx-auto">
            <template #title> {{ props.unit ? 'Edit An Unit' : 'Add An Unit' }}</template>
            <template #content>
                <div class="grid grid-cols-1 md:grid-cols-3 md:gap-2">
                    <div class="flex flex-col gap-2 mb-6">
                        <label for="name">Name</label>
                        <InputText id="name" type="text" class="p-inputtext" v-model="formInfo.name" />
                        <div v-if="$page.props.errors.name" class="text-xs text-red-500">{{ $page.props.errors.name }}</div>
                    </div>
                    <div class="flex flex-col gap-2 mb-6">
                        <label for="cultures">Cultures</label>
                        <MultiSelect id="cultures" v-model="formInfo.cultures" display="chip" filter :options="cultures" optionLabel="name" placeholder="Select Cultures" />
                        <div v-if="$page.props.errors.cultures" class="text-xs text-red-500">{{ $page.props.errors.cultures }}</div>
                    </div>
                    <div class="flex flex-col gap-2 mb-6">
                        <label for="type">Unit Type</label>
                        <Dropdown id="type" class="p-dropdown" v-model="formInfo.type" :options="types" optionLabel="name" optionValue="value" />
                        <div v-if="$page.props.errors.type" class="text-xs text-red-500">{{ $page.props.errors.type }}</div>
                    </div>
                    <div class="flex flex-col gap-2 mb-6">
                        <label for="size">Unit Size</label>
                        <Dropdown id="size" class="p-dropdown" v-model="formInfo.size" :options="sizes" optionLabel="name" optionValue="value" />
                        <div v-if="$page.props.errors.size" class="text-xs text-red-500">{{ $page.props.errors.size }}</div>
                    </div>
                    <div class="flex flex-col gap-2 mb-6">
                        <label for="cost">Cost</label>
                        <Dropdown id="cost" class="p-dropdown" v-model="formInfo.cost" :options="numberList" optionLabel="name" optionValue="value" />
                        <div v-if="$page.props.errors.cost" class="text-xs text-red-500">{{ $page.props.errors.cost }}</div>
                    </div>
                    <div class="flex flex-col gap-2 mb-6">
                        <label for="cinder">Cinder Generation</label>
                        <Dropdown id="cinder" class="p-dropdown" v-model="formInfo.cinder" :options="numberList" optionLabel="name" optionValue="value" />
                        <div v-if="$page.props.errors.cinder" class="text-xs text-red-500">{{ $page.props.errors.cinder }}</div>
                    </div>
                    <div class="flex flex-col gap-2 mb-6">
                        <label for="attack_type">Attack Type</label>
                        <Dropdown id="attack_type" class="p-dropdown" v-model="formInfo.attack_type" :options="attack_types" optionLabel="name" optionValue="value" />
                        <div v-if="$page.props.errors.attack_type" class="text-xs text-red-500">{{ $page.props.errors.attack_type }}</div>
                    </div>
                    <div class="flex flex-col gap-2 mb-6">
                        <label for="damage">Damage</label>
                        <Dropdown id="damage" class="p-dropdown" v-model="formInfo.damage" :options="numberList" optionLabel="name" optionValue="value" />
                        <div v-if="$page.props.errors.damage" class="text-xs text-red-500">{{ $page.props.errors.damage }}</div>
                    </div>
                    <div class="flex flex-col gap-2 mb-6">
                        <label for="health">Health</label>
                        <Dropdown id="health" class="p-dropdown" v-model="formInfo.health" :options="numberList" optionLabel="name" optionValue="value" />
                        <div v-if="$page.props.errors.health" class="text-xs text-red-500">{{ $page.props.errors.health }}</div>
                    </div>
                    <div class="flex flex-col gap-2 mb-6">
                        <label for="speed">Speed</label>
                        <Dropdown id="speed" class="p-dropdown" v-model="formInfo.speed" :options="numberList" optionLabel="name" optionValue="value" />
                        <div v-if="$page.props.errors.speed" class="text-xs text-red-500">{{ $page.props.errors.speed }}</div>
                    </div>
                    <div class="flex flex-col gap-2 mb-6">
                        <label for="abilities">Abilities</label>
                        <MultiSelect id="abilities" v-model="formInfo.abilities" display="chip" filter :options="abilities" optionLabel="name" placeholder="Select Abilities" />
                        <div v-if="$page.props.errors.abilities" class="text-xs text-red-500">{{ $page.props.errors.abilities }}</div>
                    </div>
                    <div class="flex flex-col gap-2 mb-6">
                        <label for="actions">Actions</label>
                        <MultiSelect id="actions" v-model="formInfo.actions" display="chip" filter :options="actions" optionLabel="name" placeholder="Select Actions" />
                        <div v-if="$page.props.errors.actions" class="text-xs text-red-500">{{ $page.props.errors.actions }}</div>
                    </div>
                    <div class="flex flex-col gap-2 mb-6">
                        <label for="is_hireable">Is Hireable</label>
                        <InputSwitch id="is_hireable" class="p-inputswitch" v-model="formInfo.is_hireable" />
                        <div v-if="$page.props.errors.is_hireable" class="text-xs text-red-500">{{ $page.props.errors.is_hireable }}</div>
                    </div>
                    <div class="flex flex-col gap-2 mb-6">
                        <label for="voice_actor_id">Voice Actor</label>
                        <Dropdown id="voice_actor_id" class="p-dropdown" v-model="formInfo.voice_actor_id" :options="voice_actors" optionLabel="name" optionValue="value" />
                        <div v-if="$page.props.errors.voice_actor_id" class="text-xs text-red-500">{{ $page.props.errors.voice_actor_id }}</div>
                    </div>
                    <div class="flex flex-col gap-2 mb-6">
                        <label for="image_upload">Base Image</label>
                        <input
                            class="p-fileupload"
                            type="file"
                            accept=".heic,.jpeg,.jpg,.png,.webp"
                            required
                            @input="formInfo.basic_image = $event.target.files[0]"
                        >
                    </div>
                </div>
            </template>
            <template #footer>
                <Button
                    @click="submit()"
                    label="Submit" />
            </template>
        </Card>
    </div>

</template>

<script setup>
import Card from 'primevue/card';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Button from 'primevue/button';
import Dropdown from 'primevue/dropdown';
import {onMounted, ref} from "vue";
import {router} from "@inertiajs/vue3";
import MultiSelect from "primevue/multiselect";
import InputSwitch from "primevue/inputswitch";
import FileUpload from "primevue/fileupload";

const props = defineProps({
    unit: {
        type: [Object, Array],
        required: false,
        default() {
            return null;
        }
    },
    selected_cultures: {
        type: [Object, Array],
        required: false,
        default() {
            return null;
        }
    },
    selected_actions: {
        type: [Object, Array],
        required: false,
        default() {
            return null;
        }
    },
    selected_abilities: {
        type: [Object, Array],
        required: false,
        default() {
            return null;
        }
    },
    types: {
        type: [Object, Array],
        required: false,
        default() {
            return null;
        }
    },
    sizes: {
        type: [Object, Array],
        required: false,
        default() {
            return null;
        }
    },
    attack_types: {
        type: [Object, Array],
        required: false,
        default() {
            return null;
        }
    },
    actions: {
        type: [Object, Array],
        required: false,
        default() {
            return null;
        }
    },
    abilities: {
        type: [Object, Array],
        required: false,
        default() {
            return null;
        }
    },
    cultures: {
        type: [Object, Array],
        required: false,
        default() {
            return null;
        }
    },
    voice_actors: {
        type: [Object, Array],
        required: false,
        default() {
            return null;
        }
    }
});

const numberList = ref([
    { name: "0", value: 0 },
    { name: "1", value: 1 },
    { name: "2", value: 2 },
    { name: "3", value: 3 },
    { name: "4", value: 4 },
    { name: "5", value: 5 },
    { name: "6", value: 6 },
    { name: "7", value: 7 },
    { name: "8", value: 8 },
    { name: "9", value: 9 },
    { name: "10", value: 10 },
    { name: "11", value: 11 },
    { name: "12", value: 12 },
    { name: "13", value: 13 },
    { name: "14", value: 14 },
    { name: "15", value: 15 },
    { name: "16", value: 16 },
    { name: "17", value: 17 },
    { name: "18", value: 18 },
    { name: "19", value: 19 },
    { name: "20", value: 20 },
]);

const formInfo = ref({
    name: null,
    cultures: null,
    type: null,
    size: null,
    cost: null,
    cinder: null,
    abilities: null,
    actions: null,
    attack_type: null,
    damage: null,
    health: null,
    speed: null,
    is_hireable: true,
    voice_actor_id: null,
    basic_image: null,
});


const submit = () => {
    router.post(props.unit ? route("admin.units.update", props.unit.id) : route("admin.units.store"),
        formInfo.value
    );
};

onMounted(() => {
    if (props.unit) {
        if (props.unit.is_hireable === 1) {
            formInfo.value.is_hireable = true;
        } else {
            formInfo.value.is_hireable = false;
        }
    }

    formInfo.value.name = props.unit?.name ?? null;
    formInfo.value.cultures = props.selected_cultures ?? null;
    formInfo.value.actions = props.selected_actions ?? null;
    formInfo.value.abilities = props.selected_abilities ?? null;
    formInfo.value.type = props.unit?.type ?? null;
    formInfo.value.size = props.unit?.size ?? null;
    formInfo.value.cost = props.unit?.cost ?? null;
    formInfo.value.cinder = props.unit?.cinder ?? 1;
    formInfo.value.attack_type = props.unit?.attack_type ?? null;
    formInfo.value.damage = props.unit?.damage ?? null;
    formInfo.value.health = props.unit?.health ?? null;
    formInfo.value.speed = props.unit?.speed ?? null;
    formInfo.value.voice_actor_id = props.unit?.voice_actor_id ?? null;
});
</script>
