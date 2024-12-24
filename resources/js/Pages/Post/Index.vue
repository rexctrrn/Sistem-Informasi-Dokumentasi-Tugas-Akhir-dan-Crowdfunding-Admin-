<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ModalConfirm from '@/Components/ModalConfirm.vue';
import Alert from '@/Components/Alert.vue';
const columns = [
    { data: 'judul' },
    { data: 'nim' },
    { data: 'penulis' },
    { data: 'prodi' },
    { data: 'tahun' },
    { data: null, render: '#action', title: 'Action' },
];
</script>

<template>
    <AppLayout title="Tugas Akhir">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tugas Akhir
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="bg-gray-100 rounded-lg p-5 m-5">
                        <div class="my-5 w-full flex">
                            <a :href="route('publikasi.create')" class="py-2 px-5 w-full md:w-1/3 bg-blue-500 text-white text-center">Tambah Data</a>
                            <a :href="route('publikasi.cetakLaporan')" target="_blank" class="py-2 px-5 ml-2 w-full md:w-1/3 bg-green-500 text-white text-center">Cetak Laporan</a>
                        </div>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <DataTable class="" :data="publikasi" :columns="columns">
                                <thead
                                    class="text-xs text-white font-bold uppercase bg-blue-500 ">
                                    <tr>
                                        <th scope="col" class="px-6 py-3" style="text-align: center;">
                                            Judul
                                        </th>
                                        <th scope="col" class="px-6 py-3" style="text-align: center;">
                                            NIM
                                        </th>
                                        <th scope="col" class="px-6 py-3" style="text-align: center;">
                                            Penulis
                                        </th>
                                        <th scope="col" class="px-6 py-3" style="text-align: center;">
                                            Prodi
                                        </th>
                                        <th scope="col" class="px-6 py-3" style="text-align: center;">
                                            Tahun
                                        </th>
                                        <th scope="col" class="px-6 py-3" style="text-align: center;">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <template #action="props">
                                    <a :href="route('publikasi.edit', { id: props.rowData.id })" class="font-medium mx-1 text-blue-600 hover:underline">Edit</a>
                                    <button class="font-medium mx-1 text-red-600 hover:underline" @click="confirmDelete(props.rowData.id)">Hapus</button>
                                    <a :href="route('publikasi.view', { id: props.rowData.id })" target="_blank" class="font-medium mx-1 text-green-600 hover:underline">Lihat</a>
                                </template>
                            </DataTable>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <ModalConfirm :show="showModal" @confirm="deleteItem" @cancel="closeModal" />
        
        <Alert v-if="showMessage" :type="messageType" :message="message"/>

    </AppLayout>
</template>

<script>


export default {
    components: {
        ModalConfirm,
        Alert
    },
    props: {
        publikasi: Array,
    },
    data() {
        return {
            showModal: false,
            itemIdToDelete: null,
            showMessage: false,
            message: '',
            messageType:'',
        };
    },
    methods: {
        confirmDelete(id) {
            this.itemIdToDelete = id;
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        },
        async deleteItem() {
            try {
                await this.$inertia.post(route('publikasi.destroy'), { id: this.itemIdToDelete });
                this.message = 'Data berhasil dihapus';
                this.messageType = 'delete';
                this.showMessage = true;
                setTimeout(() => this.showMessage = false, 3000);
            } catch (error) {
                console.error(error);
            } finally {
                this.closeModal();
            }
        }
    }
}
</script>

