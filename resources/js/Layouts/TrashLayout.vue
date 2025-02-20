<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>
<template>
    <Head title="trash"/>
    <div class="main-container">
        <h2 class="my-3">Trash</h2>
        
        <div class="container-fluid d-flex flex-row align-items-center gap-2">
            <Link :href="route('profile.edit')" class="list px-2 py-1 rounded text-decoration-none text-dark">Item</Link>
            <Link :href="route('profile.edit')" class="list px-2 py-1 rounded text-decoration-none text-dark">Announcement</Link>
        </div>
       <main>
        <slot />
       </main>
    </div>
</template>
<style lang="css" scoped>
.main-container{
    width: 100%;
    height: 100%;
}
.list{
        background: rgba(0,0,0,.1);
        cursor: pointer;
    }
    .list:hover{
        background: rgba(0,0,0,.2);
    }
</style>