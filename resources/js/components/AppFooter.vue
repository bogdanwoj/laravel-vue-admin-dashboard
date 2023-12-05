<template>
    <footer class="main-footer">

        <div class="float-right d-none d-sm-inline">
            <strong>{{settingStore.setting.app_name}}</strong>
        </div>

    </footer>
</template>

<script setup>
    import { useAuthUserStore } from "../stores/AuthUserStore";

    const authUserStore = useAuthUserStore();
    import { useSettingStore } from "../stores/SettingStore";

    const settingStore = useSettingStore();


</script>
