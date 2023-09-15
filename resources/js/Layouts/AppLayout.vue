<template>
    <div>
        <Head :title="title"/>

        <div class="">
            <div class="card relative z-2">
                <Menubar :model="$page.props.navBarItems" style="border-radius: 0">
                    <template #start class="p-menuitem-content">
                        <Link :href="route('index')">
                            <img :src="logo" alt="Cinderborn logo" class="rounded mr-2 hidden sm:block"  />
                        </Link>
                    </template>
                    <template #item="{ label, item, props, root }" class="p-menuitem-content">
                        <Link v-if="item.route" :href="item.route" v-slot="routerProps" class="p-menuitem-link">
                            <i class="p-menuitem-icon" :class="item.icon" />
                            <span class="p-menuitem-text">{{ item.label }}</span>
                        </Link>
                        <a v-else :href="item.url" :target="item.target" v-bind="props.action" class="p-menuitem-link">
                            <span v-bind="props.icon" class="p-menuitem-icon" />
                            <span v-bind="props.label" class="p-menuitem-text">{{ label }}</span>
                            <span :class="[root ? 'pi pi-fw pi-angle-down' : 'pi pi-fw pi-angle-right']" v-bind="props.submenuicon" />
                        </a>
                    </template>
                    <template #end>
                        <span class="p-input-icon-left">
                            <i class="pi pi-search" />
                            <InputText placeholder="Search" class="mr-2" />
                        </span>
                        <span v-if="$page.props.auth.user">
                            <Button v-tooltip.left="'Logout'" icon="pi pi-sign-out" @click="logout" alt="Logout" />
                        </span>
                        <span v-else>
                            <Button v-tooltip.left="'Login/Register'" icon="pi pi-user" @click="login" alt="Login" />
                        </span>
                    </template>
                </Menubar>
            </div>
        </div>

        <!-- Page Content -->
        <main class="min-h-screen container mx-auto pt-6 px-2 md:px-0">
            <Message v-if="$page.props.jetstream?.flash?.message"
                     :severity="$page.props.jetstream?.flash?.messageType"
            >
                {{ $page.props.jetstream?.flash?.message }}
            </Message>

            <slot/>
        </main>
    </div>
</template>

<script setup>
import {ref, computed, onMounted, reactive} from 'vue';
import logo from "/public/cinderborn.png";
import {router} from '@inertiajs/vue3';
import Message from 'primevue/message';
import Menubar from 'primevue/menubar';
import Button from "primevue/button";
import { dom } from '@fortawesome/fontawesome-svg-core';
import InputText from "primevue/inputtext";

defineProps({
    title: String,
});

dom.watch();

const logout = () => {
    router.post(route('logout'));
};

const login = () => {
    router.get(route('login'));
};
</script>
