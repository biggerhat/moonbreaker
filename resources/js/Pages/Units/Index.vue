<template>
    <Head title="Units" />

    <div class="mx-2 mx-auto">
        <Card class="mx-auto">
            <template #title>Units</template>
            <template #content>
                <DataTable :value="units" stripedRows tableStyle="min-width: 50rem">
                    <template #header>
                        <Link :href="route('admin.units.create')">
                            <Button raised label="Add New Unit" icon="pi pi-plus" icon-pos="left" />
                        </Link>
                    </template>
                    <Column field="id" header="ID"></Column>
                    <Column field="image" header="image">
                        <template #body="props">
                            <Image :src="imagePath(props.data.base_image)" :alt="props.data.name" />
                        </template>

                    </Column>
                    <Column field="name" header="Name"></Column>
                    <Column header="Action">
                        <template #body="props">
                            <Link
                                :href="route('admin.units.edit', props.data.id)">
                                <Button raised label="Edit" icon="pi pi-pencil" icon-pos="left" class="mx-2" />
                            </Link>

                            <Button raised label="Delete" icon="pi pi-trash" icon-pos="left" class="mx-2" severity="danger" @click="showDeleteConfirm(props.data)" />
                        </template>
                    </Column>
                </DataTable>
            </template>
        </Card>
    </div>

    <ConfirmDialog></ConfirmDialog>
</template>

<script setup>
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import SpeedDial from 'primevue/speeddial';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Button from 'primevue/button';
import Dropdown from 'primevue/dropdown';
import Image from "primevue/image";
import {onMounted, ref} from "vue";
import {router} from "@inertiajs/vue3";
import { useConfirm } from "primevue/useconfirm";
import ConfirmDialog from "primevue/confirmdialog";
const confirm = useConfirm();

const props = defineProps({
    units: {
        type: [Object, Array],
        required: false,
        default() {
            return null;
        }
    },
});

const imagePath = (path) => {
    return "/storage/" + path;
}

const showDeleteConfirm = (data) => {
    confirm.require({
        header: "Delete Unit",
        message: 'Are you sure?',
        icon: 'pi pi-question-circle',
        acceptIcon: 'pi pi-check',
        rejectIcon: 'pi pi-times',
        accept: () => {
            router.post(route("admin.units.delete", data.id));
        },
        reject: () => {

        }
    });
}

onMounted(() => {
});
</script>
