<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="Beranda">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Beranda
            </h2>
        </template>

        <!-- component -->
        <div class="flex justify-center">
  <div class="w-full max-w-4xl">
    <h5 class="text-center text-3xl font-sans font-bold leading-8 text-gray-900 mb-8 mt-5">Total Data</h5>
    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:gap-10">

      <!-- Kartu 1 -->
      <div class="relative overflow-hidden rounded-lg bg-gray-600 px-4 pb-12 pt-5 shadow-lg sm:px-6 sm:pt-6 text-center">
        <div class="flex items-center justify-center mb-5">
          <div class="bg-blue-300 p-3 rounded-md mr-4">
            <svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m19 2.01h-13c-1.206 0-3 .799-3 3v3 6 3 2c0 2.201 1.794 3 3 3h15v-2h-14.988c-.462-.012-1.012-.195-1.012-1 0-.101.009-.191.024-.273.112-.575.583-.717.987-.727h13.989c.018 0 .031-.009.049-.01h.951v-.99-2.01-10.99c0-1.103-.897-2-2-2zm0 14h-14v-2-6-3c0-.806.55-.988 1-1h7v7l2-1 2 1v-7h2v10.99z"/></svg>
          </div>
          <div>
            <p class="truncate text-sm font-medium text-gray-300">Total Tugas Akhir</p>
            <p class="text-2xl font-semibold text-gray-100">{{ $page.props.jumlahTugasAkhir }}</p>
          </div>
        </div>
        <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
          <div class="text-sm">
            <a :href="route('publikasi')" class="font-medium text-black hover:text-blue-500">Lihat<span class="sr-only"> Total Tugas Akhir stats</span></a>
          </div>
        </div>
      </div>

      <!-- Kartu 2 -->
      <div class="relative overflow-hidden rounded-lg bg-gray-600 px-4 pb-12 pt-5 shadow-lg sm:px-6 sm:pt-6 text-center">
        <div class="flex items-center justify-center mb-5">
          <div class="bg-blue-300 p-3 rounded-md mr-4">
            <svg width="24" stroke-width="1.5" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M19 20H5C3.89543 20 3 19.1046 3 18V9C3 7.89543 3.89543 7 5 7H19C20.1046 7 21 7.89543 21 9V18C21 19.1046 20.1046 20 19 20Z" stroke="currentColor" />
              <path d="M16.5 14C16.2239 14 16 13.7761 16 13.5C16 13.2239 16.2239 13 16.5 13C16.7761 13 17 13.2239 17 13.5C17 13.7761 16.7761 14 16.5 14Z" fill="currentColor" stroke="currentColor"  stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M18 7V5.60322C18 4.28916 16.7544 3.33217 15.4847 3.67075L4.48467 6.60409C3.60917 6.83756 3 7.63046 3 8.53656V9" stroke="currentColor" />
              </svg>
          </div>
          <div>
            <p class="truncate text-sm font-medium text-gray-300">Total Donasi</p>
            <p class="text-2xl font-semibold text-gray-100">{{ formattedDonasi }}</p>
          </div>
        </div>
        <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
          <div class="text-sm">
            <a :href="route('donasi')" class="font-medium text-black hover:text-blue-500">Lihat<span class="sr-only"> Total Donasi stats</span></a>
          </div>
        </div>
      </div>

      <!-- Kartu 3 -->
      <div class="relative overflow-hidden rounded-lg bg-gray-600 px-4 pb-12 pt-5 shadow-lg sm:px-6 sm:pt-6 text-center">
        <div class="flex items-center justify-center mb-5">
          <div class="bg-blue-300 p-3 rounded-md mr-4">
            <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><g fill="#292d32"><path d="m16.8311 15.6402c.67-.44 1.55.04 1.55.84v1.29c0 1.27-.99 2.63-2.18 3.03l-3.19 1.06c-.56.19-1.47.19-2.02 0l-3.19001-1.06c-1.2-.4-2.18-1.76-2.18-3.03v-1.3c0-.79.88-1.27 1.54-.84l2.06 1.34c.79001.53 1.79001.79 2.79001.79s2-.26 2.79-.79z"/><path d="m19.9795 6.45859-5.99-3.93c-1.08-.71-2.86-.71-3.94 0l-6.01997 3.93c-1.93 1.25-1.93 4.08001 0 5.34001l1.6 1.04 4.41997 2.88c1.08.71 2.86.71 3.94 0l4.39-2.88 1.37-.9v3.06c0 .41.34.75.75.75s.75-.34.75-.75v-4.92c.4-1.29001-.01-2.79001-1.27-3.62001z"/></g></svg>
          </div>
          <div>
            <p class="truncate text-sm font-medium text-gray-300">Total Pembimbing</p>
            <p class="text-2xl font-semibold text-gray-100">{{ $page.props.jumlahDosen }}</p>
          </div>
        </div>
        <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
          <div class="text-sm">
            <a :href="route('dosen')" class="font-medium text-black hover:text-blue-500">Lihat<span class="sr-only"> Total Pembimbing stats</span></a>
          </div>
        </div>
      </div>

      <!-- Kartu 4 -->
      <div class="relative overflow-hidden rounded-lg bg-gray-600 px-4 pb-12 pt-5 shadow-lg sm:px-6 sm:pt-6 text-center">
        <div class="flex items-center justify-center mb-5">
          <div class="bg-blue-300 p-3 rounded-md mr-4">
            <svg width="24" height="24" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1 20V19C1 15.134 4.13401 12 8 12V12C11.866 12 15 15.134 15 19V20" stroke="currentColor" stroke-linecap="round"/>
              <path d="M13 14V14C13 11.2386 15.2386 9 18 9V9C20.7614 9 23 11.2386 23 14V14.5" stroke="currentColor" stroke-linecap="round"/>
              <path d="M8 12C10.2091 12 12 10.2091 12 8C12 5.79086 10.2091 4 8 4C5.79086 4 4 5.79086 4 8C4 10.2091 5.79086 12 8 12Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M18 9C19.6569 9 21 7.65685 21 6C21 4.34315 19.6569 3 18 3C16.3431 3 15 4.34315 15 6C15 7.65685 16.3431 9 18 9Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
          </div>
          <div>
            <p class="truncate text-sm font-medium text-gray-300">Total Admin</p>
            <p class="text-2xl font-semibold text-gray-100">{{ $page.props.jumlahAdmin }}</p>
          </div>
        </div>
        <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
          <div class="text-sm">
            <a :href="route('admin')" class="font-medium text-black hover:text-blue-500">Lihat<span class="sr-only"> Total Admin stats</span></a>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>



    </AppLayout>
</template>

<script>
export default {
  props: {
    jumlahTugasAkhir: Number,
    jumlahDosen: Number,
    jumlahAdmin: Number,
    jumlahDonasi: Number,
  },
  computed: {
    formattedDonasi() {
      return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
      }).format(this.jumlahDonasi);
    }
  }
}
</script>