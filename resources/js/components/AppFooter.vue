<template>
    <footer class="main-footer">
        <strong>{{settings?.app_name}}</strong>
        <div class="float-right d-none d-sm-inline">
            Anything you want {{ authUserStore.user.name }}
        </div>

    </footer>
</template>

<script setup>
    import { useAuthUserStore } from "../stores/AuthUserStore";

    const authUserStore = useAuthUserStore();


    defineProps({
       settings: Object,
    });

</script>
