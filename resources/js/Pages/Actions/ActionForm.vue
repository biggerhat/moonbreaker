<template>
    <Head :title="props.action ? 'Edit An Action' : 'Add An Action'" />

    <div class="mx-2 mx-auto">
        <Card class="mx-auto">
            <template #title> {{ props.action ? 'Edit An Action' : 'Add An Action' }}</template>
            <template #content>
                <div class="grid grid-cols-1">
                    <div class="flex flex-col gap-2 mb-6">
                        <label for="name">Name</label>
                        <InputText id="name" type="text" class="p-inputtext" v-model="formInfo.name" />
                        <div v-if="$page.props.errors.name" class="text-xs text-red-500">{{ $page.props.errors.name }}</div>
                    </div>
                    <div class="flex flex-col gap-2 mb-6">
                        <label for="cost">Cinder Cost</label>
                        <Dropdown id="cost" class="p-dropdown" v-model="formInfo.cost" :options="costList" optionLabel="name" optionValue="value" />
                        <div v-if="$page.props.errors.cost" class="text-xs text-red-500">{{ $page.props.errors.cost }}</div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="description">Description</label>
                        <Textarea id="description" v-model="formInfo.description" class="rounded" rows="5" cols="60" />
                        <div v-if="$page.props.errors.description" class="text-xs text-red-500">{{ $page.props.errors.description }}</div>
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

const props = defineProps({
    action: {
        type: [Object, Array],
        required: false,
        default() {
            return null;
        }
    },
});

const costList = ref([
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
]);

const formInfo = ref({
    name: null,
    cost: null,
    description: null,
});


const submit = () => {
    router.post(props.action ? route("admin.actions.update", props.action.id) : route("admin.actions.store"),
        formInfo.value
    );
};

onMounted(() => {
    formInfo.value.name = props.action?.name ?? null;
    formInfo.value.cost = props.action?.cost ?? 0;
    formInfo.value.description = props.action?.description ?? null;
});
</script>
