<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ModalConfirm from '@/Components/ModalConfirm.vue'; 
import Alert from '@/Components/Alert.vue'; 
</script>

<template>
    <AppLayout title="Donasi">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Data Donasi
            </h2>
        </template>
        <div class="flex flex-col bg-white border shadow-sm rounded-xl max-w-sm mx-auto mt-6">
            <div class="bg-blue-500 border-b rounded-t-xl py-2 px-3 md:py-3 md:px-4">
                <p class="text-sm text-white text-center">
                    Total Donasi
                </p>
            </div>
            <div class="p-3 md:p-4 text-center">
                <h3 class="text-lg font-bold text-gray-800">
                    {{ formattedDonasi }}
                </h3>
            </div>
        </div>

        
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                    <div class="bg-gray-100 rounded-lg p-5 m-5">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-white font-bold uppercase bg-blue-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-3" style="text-align: center;">ID</th>
                                        <th scope="col" class="px-6 py-3" style="text-align: center;">Jumlah Donasi</th>
                                        <th scope="col" class="px-6 py-3" style="text-align: center;">Metode Pembayaran</th>
                                        <th scope="col" class="px-6 py-3" style="text-align: center;">Status</th>
                                        <th scope="col" class="px-6 py-3" style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="data in donasi" :key="data.id" class="bg-white border-b hover:bg-gray-50">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap" style="text-align: center;">
                                            {{ data.id }}
                                        </th>
                                        <td class="px-6 py-4 text-gray-900" style="text-align: center;">
                                            {{ formatPaymentMethod(data.jumlah_donasi) }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-900" style="text-align: center;">
                                            {{ data.metode_pembayaran }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-900" style="text-align: center;">
                                            {{ data.status }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-900" style="text-align: center;">
                                            <button class="font-medium mx-1 text-red-600 hover:underline" @click="hapus(data.id)">Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <ModalConfirm :show="showModal" @confirm="deleteItem" @cancel="closeModal" />

        <Alert v-if="showMessage" :type="messageType" :message="message" />

    </AppLayout>
</template>

<script>
export default {
    components: {
        ModalConfirm,
        Alert
    },
    data() {
        return {
            showModal: false,
            itemIdToDelete: null,
            showMessage: false,
            message: '',
            messageType: '',
        };
    },
    props: {
        donasi: Array,
        jumlahDonasi: Number
    },
    computed: {
    formattedDonasi() {
      return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
      }).format(this.jumlahDonasi);
    }
  },
    methods: {
        hapus(id) {
            this.itemIdToDelete = id;
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        },
        async deleteItem() {
            try {
                await this.$inertia.post(route('donasi.destroy'), { id: this.itemIdToDelete });
                this.message = 'Data berhasil dihapus';
                this.messageType = 'delete';
                this.showMessage = true;
                setTimeout(() => this.showMessage = false, 3000);
            } catch (error) {
                console.error(error);
            } finally {
                this.closeModal();
            }
        },
        formatPaymentMethod(value) {
            // Format angka dengan pemisah titik
            return new Intl.NumberFormat('id-ID').format(value);
        }
    }
}
</script>
