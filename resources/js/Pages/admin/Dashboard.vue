<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const  cards = [
        { title: 'Folder 1', description: 'Details about folder 1' },
        { title: 'Folder 2', description: 'Details about folder 2' },
        { title: 'Folder 3', description: 'Details about folder 3' },
      ]
// export default {
//   data() {
//     return {
//       cards: [
//         { title: 'Folder 1', description: 'Details about folder 1' },
//         { title: 'Folder 2', description: 'Details about folder 2' },
//         { title: 'Folder 3', description: 'Details about folder 3' },
//       ],
//       storageProgress: 65, // Example percentage
//       storageDetails: [
//         { label: 'Documents', color: '#4CAF50' },
//         { label: 'Images', color: '#2196F3' },
//         { label: 'Videos', color: '#FF9800' },
//       ],
//       recentFiles: [
//         { name: 'File 1', date: '2025-02-20', size: '1.2 MB' },
//         { name: 'File 2', date: '2025-02-19', size: '2.4 MB' },
//         { name: 'File 3', date: '2025-02-18', size: '3.5 MB' },
//       ],
//     };
//   },
// };
</script>

<template>
  <Head title="Dashboard" />
  <AdminLayout>
    <div class="dashboard-container">
    <!-- Header Section -->
    <div class="header-section mb-4">
      <h1 class="fw-bold">Manage your folders</h1>
      <p class="text-muted">Create folders to store files and easily access them in locations.</p>
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
            <h5 class="card-title">Storage</h5>
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
            <h5 class="card-title">Recent Files</h5>
            <table class="table">
              <thead>
                <tr>
                  <th>File Name</th>
                  <th>Date</th>
                  <th>Size</th>
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


<style>
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
