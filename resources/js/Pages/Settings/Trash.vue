<script setup>
import { usePage, router, Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
// Fetch trashed items from props
const trashedItems = ref(usePage().props.trashed_items || []);

// Restore item function
const restoreItem = (id) => {
    if (confirm("Are you sure you want to restore this item?")) {
        router.post(`/trash/restore/${id}`, {}, {
            onSuccess: () => {
                trashedItems.value = trashedItems.value.filter(item => item.id !== id);
            }
        });
    }
};
</script>

<template>
  <Head title="Trash" />
   <AdminLayout>
    <div class="container mt-4">
        <h2 class="mb-3">Trash Bin</h2>

        <div v-if="trashedItems.length === 0" class="alert alert-info">
            No trashed items available.
        </div>

        <div v-else class="row">
            <div v-for="item in trashedItems" :key="item.id" class="col-md-4">
                <div class="card shadow-sm mb-3">
                    <img v-if="item.image_url" :src="item.image_url" class="card-img-top" alt="Item Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ item.title }}</h5>
                        <p class="card-text text-muted">{{ item.description }}</p>
                        <p class="text-success fw-bold">Category: {{ item.category }}</p>
                        <button @click="restoreItem(item.id)" class="btn btn-primary">
                            Restore
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </AdminLayout>
</template>

<style scoped>
.card {
    border-radius: 8px;
    transition: 0.3s ease-in-out;
}

.card:hover {
    transform: scale(1.02);
}
</style>
