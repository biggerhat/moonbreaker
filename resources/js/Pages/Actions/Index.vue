<template>
    <Head title="Actions" />

    <div class="mx-2 mx-auto">
        <Card class="mx-auto">
            <template #title>Actions</template>
            <template #content>
                <DataTable :value="actions" stripedRows tableStyle="min-width: 50rem">
                    <template #header>
                        <Link :href="route('admin.actions.create')">
                            <Button raised label="Add New Action" icon="pi pi-plus" icon-pos="left" />
                        </Link>
                    </template>
                    <Column field="id" header="ID"></Column>
                    <Column field="name" header="Name"></Column>
                    <Column header="Action">
                        <template #body="props">
                            <Link
                                :href="route('admin.actions.edit', props.data.id)">
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
import {onMounted, ref} from "vue";
import {router} from "@inertiajs/vue3";
import { useConfirm } from "primevue/useconfirm";
import ConfirmDialog from "primevue/confirmdialog";
const confirm = useConfirm();

const props = defineProps({
    actions: {
        type: [Object, Array],
        required: false,
        default() {
            return null;
        }
    },
});

const showDeleteConfirm = (data) => {
    confirm.require({
        header: "Delete Action",
        message: 'Are you sure?',
        icon: 'pi pi-question-circle',
        acceptIcon: 'pi pi-check',
        rejectIcon: 'pi pi-times',
        accept: () => {
            router.post(route("admin.actions.delete", data.id));
        },
        reject: () => {

        }
    });
}

onMounted(() => {
});
</script>
