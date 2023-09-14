<template>
    <Head :title="props.ability ? 'Edit An Ability' : 'Add An Ability'" />

    <div class="mx-2 mx-auto">
        <Card class="mx-auto">
            <template #title> {{ props.ability ? 'Edit An Ability' : 'Add An Ability' }}</template>
            <template #content>
                <div class="grid grid-cols-1">
                    <div class="flex flex-col gap-2 mb-6">
                        <label for="name">Name</label>
                        <InputText id="name" type="text" class="p-inputtext" v-model="formInfo.name" />
                        <div v-if="$page.props.errors.name" class="text-xs text-red-500">{{ $page.props.errors.name }}</div>
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
import {onMounted, ref} from "vue";
import {router} from "@inertiajs/vue3";

const props = defineProps({
    ability: {
        type: [Object, Array],
        required: false,
        default() {
            return null;
        }
    },
});

const formInfo = ref({
    name: null,
    description: null,
});


const submit = () => {
    router.post(props.ability ? route("admin.abilities.update", props.ability.id) : route("admin.abilities.store"),
        formInfo.value
    );
};

onMounted(() => {
    formInfo.value.name = props.ability?.name ?? null;
    formInfo.value.description = props.ability?.description ?? null;
});
</script>
