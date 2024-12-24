<template>
  <div v-if="message" class="fixed top-4 left-1/2 transform -translate-x-1/2 w-full max-w-lg">
    <div :class="alertClass" class="p-4 text-sm rounded-lg text-center" role="alert">
      <span class="font-medium">{{ message }}</span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    type: {
      type: String,
      required: true
    },
    message: {
      type: String,
      required: true
    }
  },
  computed: {
    alertClass() {
      switch (this.type) {
        case 'success':
          return 'bg-green-100 text-green-800 border border-green-400';
        case 'update':
          return 'bg-blue-100 text-blue-800 border border-blue-400';
        case 'delete':
          return 'bg-red-100 text-red-800 border border-red-400';
        default:
          return 'bg-gray-100 text-gray-800 border border-gray-400';
      }
    }
  }
}
</script>
