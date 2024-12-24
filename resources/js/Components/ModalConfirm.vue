<template>
    <div v-if="show" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
      <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-sm">
        <h2 class="text-xl font-semibold mb-4">Konfirmasi Penghapusan</h2>
        <p class="mb-6">Apakah Anda yakin ingin menghapus item ini?</p>
        <div class="flex justify-end">
          <button
            class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 mr-2"
            @click="onCancel"
          >
            Batal
          </button>
          <button
            class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600"
            @click="onConfirm"
          >
            Hapus
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      show: {
        type: Boolean,
        required: true
      }
    },
    emits: ['confirm', 'cancel'],
    methods: {
      onConfirm() {
        this.$emit('confirm');
      },
      onCancel() {
        this.$emit('cancel');
      }
    }
  };
  </script>
  
  