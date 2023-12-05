<template>
    <footer class="main-footer">
        <strong>{{settings?.app_name}}</strong>
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>

    </footer>
</template>

<script setup>

    defineProps({
       settings: Object,
    });

</script>
