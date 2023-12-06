<template>
    <nav class="main-header navbar navbar-expand " :class="settingStore.theme === 'dark' ? 'navbar-dark' : 'navbar-light' ">

    <ul class="navbar-nav">
        <li class="nav-item" id="toggleMenuIcon">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
<!--        <li class="nav-item d-none d-sm-inline-block">-->
<!--            <router-link to="/admin/dashboard" class="nav-link">Home</router-link>-->
<!--        </li>-->

    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
            <a @click.prevent="settingStore.changeTheme" href="#" class="nav-link">
                <i class="far" :class="settingStore.theme === 'dark' ? 'fa-moon' : 'fa-sun'"> </i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
    </nav>
</template>

<script setup>
    import { useSettingStore } from "../stores/SettingStore";

    const settingStore = useSettingStore();


</script>
