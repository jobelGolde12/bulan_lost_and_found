<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div>
       <div class="container-fluid d-flex flex-row justify-content-end px-5 pt-3">
        <a class="btn btn-light bi bi-person-lines-fill fs-5" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"></a>
       </div>
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Profile settings</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="container d-flex flex-column gap-2 justify-content-start">
        <Link :href="route('profile.edit')" class="px-2 py-1 text-start rounded">Edit profile </Link>
        <Link :href="route('logout')" method="POST" class="px-2 py-1 text-start rounded">Logout </Link>
    </div>
  </div>
</div>
    </div>
</template>
<style lang="css" scoped>
    
</style>