<script setup>
import { ref } from 'vue';
import { use } from 'echarts/core';
import { CanvasRenderer } from 'echarts/renderers';
import { LineChart } from 'echarts/charts';
import { GridComponent, TooltipComponent, LegendComponent } from 'echarts/components';
import VChart from 'vue-echarts';

// Register necessary ECharts modules
use([CanvasRenderer, LineChart, GridComponent, TooltipComponent, LegendComponent]);

// Chart options
const chartOptions = ref({
  tooltip: {
    trigger: 'axis'
  },
  legend: {
    data: ['Lost Items', 'Found Items', 'Resolved Cases']
  },
  xAxis: {
    type: 'category',
    data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
  },
  yAxis: {
    type: 'value'
  },
  series: [
    {
      name: 'Lost Items',
      type: 'line',
      smooth: true, // Makes the line smooth
      data: [5, 8, 6, 7, 5, 9, 4],
      lineStyle: {
        color: '#ff4d4f' // Red for lost items
      }
    },
    {
      name: 'Found Items',
      type: 'line',
      smooth: true,
      data: [3, 5, 7, 6, 8, 7, 6],
      lineStyle: {
        color: '#1890ff' // Blue for found items
      }
    },
    {
      name: 'Resolved Cases',
      type: 'line',
      smooth: true,
      data: [2, 3, 4, 5, 4, 6, 5],
      lineStyle: {
        color: '#52c41a' // Green for resolved cases
      }
    }
  ]
});
</script>

<template>
  <div>
    <h5 class="text-dark fw-lighter mb-0">Resolved Cases</h5>
    <p class="text-muted">Number of matched lost and found items.</p>
    <v-chart class="chart" :option="chartOptions" />
  </div>
</template>

<style scoped>
.chart {
  width: 100%;
  height: 400px;
}
</style>
