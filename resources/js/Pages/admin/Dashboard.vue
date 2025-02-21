<script setup>
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TotalLostItemCard from '@/Components/admin/dashboard/TotalLostItemCard.vue';
import TotalFoundItemCard from '@/Components/admin/dashboard/TotalFoundItemCard.vue';
const props = defineProps({
  categories: {
    type: Array,
    default: [],
  },
  items: {
    type: Array,
    default: [],
  },  
});
const countLostItems = props.items.filter(item => item.status === 'Lost')
const countFoundItems = props.items.filter(item => item.status === 'Found')

const cards = [
  { title: 'Total Lost Items', description: 'Count of lost items reported.' },
  { title: 'Total Found Items', description: 'Count of found items reported.' },
  { title: 'Resolved Cases', description: 'Number of matched lost and found items.' },
  { title: 'Pending Requests', description: 'Reports that require admin approval or action.' },
  { title: 'User Registrations', description: 'Number of registered users.' }
];

const storageProgress = 75; // Example percentage for resolved cases
const storageDetails = [
  { label: 'Lost Items', color: '#FF5733' },
  { label: 'Found Items', color: '#33FF57' },
  { label: 'Resolved Cases', color: '#3357FF' }
];

const recentFiles = [
  { name: 'Lost Wallet', date: '2025-02-19', size: 'Electronics' },
  { name: 'Found Phone', date: '2025-02-18', size: 'Accessories' },
  { name: 'Lost Keys', date: '2025-02-17', size: 'Personal Items' }
];
</script>

<template>
  <Head title="Dashboard" />
  <AdminLayout>
    <div class="dashboard-container">
      <div class="container-top container-fluid row" style="min-height: 300px;">
            <div class="col-12 col-md-6 col-lg-6 pt-4">
              <h1 class="fw-bold">Lost & Found Admin Dashboard</h1>
              <p class="text-muted">Manage reports, users, and system settings effectively.</p>
          </div>

          <div class="col-12 col-md-6 col-lg-6 d-flex flex-row gap-2">
           <TotalLostItemCard :lostItems="countLostItems?.length"/>
           <TotalFoundItemCard :foundItems="countFoundItems?.length"/>

      </div>
      </div>
      <!-- Cards Section -->
      <div class="row mb-4">
        <div class="col-md-4" v-for="(card, index) in cards" :key="index">
          <div class="card h-100 text-center shadow-sm">
            <div class="card-body">
              <h5 class="card-title">{{ card.title }}</h5>
              <p class="card-text">{{ card.description }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Storage and Recent Files Section -->
      <div class="row">
        <!-- Storage Chart Section -->
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Overview</h5>
              <div class="d-flex justify-content-center align-items-center my-3">
                <div class="progress-circle" :style="{ '--progress': storageProgress + '%' }">
                  <span>{{ storageProgress }}%</span>
                </div>
              </div>
              <ul class="list-unstyled text-muted">
                <li v-for="(item, index) in storageDetails" :key="index">
                  <span class="dot" :style="{ 'background-color': item.color }"></span> {{ item.label }}
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Recent Files Section -->
        <div class="col-md-8 mb-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Recent Lost & Found Reports</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th>Item Name</th>
                    <th>Date</th>
                    <th>Category</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(file, index) in recentFiles" :key="index">
                    <td>{{ file.name }}</td>
                    <td>{{ file.date }}</td>
                    <td>{{ file.size }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<style scoped>
.container-top{
  height: 70%;
}
.dashboard-container {
  padding: 20px;
}
.progress-circle {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background: conic-gradient(var(--progress, 0%) #4CAF50, #e0e0e0 0%);
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 1.2rem;
  font-weight: bold;
  color: #333;
}
.progress-circle span {
  position: absolute;
}
.dot {
  display: inline-block;
  width: 10px;
  height: 10px;
  border-radius: 50%;
  margin-right: 5px;
}
</style>
