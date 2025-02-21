<script setup>
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TotalLostItemCard from '@/Components/admin/dashboard/TotalLostItemCard.vue';
import TotalFoundItemCard from '@/Components/admin/dashboard/TotalFoundItemCard.vue';
import ResolveCasesChart from '@/Components/admin/dashboard/ResolveCasesChart.vue';
import PendingRequestCard from '@/Components/admin/dashboard/PendingRequestCard.vue';
import UserRegistration from '@/Components/admin/dashboard/UserRegistration.vue';

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
      <div class="container-top container-fluid row" style="min-height: 300px;  max-height: 200px;" >
            <div class="col-12 col-md-6 col-lg-6 pt-4">
              <h1 class="fw-bold">Lost & Found Admin Dashboard</h1>
              <p class="text-muted">Manage reports, users, and system settings effectively.</p>
          </div>

          <div class="col-12 col-md-6 col-lg-6 d-flex flex-row gap-2">
           <TotalLostItemCard :lostItems="countLostItems?.length"/>
           <TotalFoundItemCard :foundItems="countFoundItems?.length"/>
          </div>
      </div>

      <div class="contaner-fluid">
            <ResolveCasesChart />
          </div>

      <!-- Cards Section -->
      <div class="d-flex flex-row justify-content-between align-items-center">
        <div class="">
          <PendingRequestCard />
        </div>
        
        <div class="">
          <UserRegistration />
        </div>

        <div class="as">
          <div class="card shadow-sm" style="min-width: 250px;">
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
      </div>


        <!-- Recent Files Section -->
        <div class="container-fluid mt-5">
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
  </AdminLayout>
</template>

<style scoped>
.container-top{
  height: 70%;
}
.dashboard-container {
  padding: 20px;
  height: 100%;
  overflow-x: hidden;
  overflow-y: scroll;
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
