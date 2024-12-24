<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ModalConfirm from '@/Components/ModalConfirm.vue'; 
import Alert from '@/Components/Alert.vue'; 
</script>

<template>
    <AppLayout title="Pembimbing">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Data pembimbing
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                    <div class="bg-gray-100 rounded-lg p-5 m-5">
                        <h1 class="text-lg font-bold mb-5">Tambah Data Pembimbing</h1>
                        <form class="max-w-lg mx-auto" @submit.prevent="submitForm">
                            <div class="mb-2">
                                <label for="" class="block mb-1 text-sm font-medium text-gray-900">NIP</label>
                                <input type="number" v-model="form.nip_dosen"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="-----------" required>
                                    <div v-if="errors.nip_dosen" class="text-red-500 text-sm mt-1">
                                    {{ errors.nip_dosen[0] }}
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="" class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
                                <input type="text" v-model="form.nama_dosen"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="" required>
                            </div>
                            <div class="mb-2">
                                <label for="" class="block mb-1 text-sm font-medium text-gray-900">Prodi</label>
                                <input type="text" v-model="form.prodi"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="" required>
                            </div>
                            <div class="mb-2">
                                <label for="" class="block mb-1 text-sm font-medium text-gray-900">Fakultas</label>
                                <input type="text" v-model="form.fakultas"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="" required>
                            </div>
                            <button type="submit" :disabled="form.processing"
                                class="text-white bg-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200  font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                Tambah Data
                            </button>
                            
                        </form>
                    </div>
                    <div class="bg-gray-100 rounded-lg p-5 m-5">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-white font-bold uppercase bg-blue-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-3" style="text-align: center;">
                                            NIP
                                        </th>
                                        <th scope="col" class="px-6 py-3" style="text-align: center;">
                                            Nama
                                        </th>
                                        <th scope="col" class="px-6 py-3" style="text-align: center;">
                                            Prodi
                                        </th>
                                        <th scope="col" class="px-6 py-3" style="text-align: center;">
                                            Fakultas
                                        </th>
                                        <th scope="col" class="px-6 py-3" style="text-align: center;">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="data in dosen" :key="data.id" class="bg-white border-b hover:bg-gray-50">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap" style="text-align: center;">
                                            {{ data.nip_dosen }}
                                        </th>
                                        <td class="px-6 py-4 text-gray-900" style="text-align: center;">
                                            {{ data.nama_dosen }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-900" style="text-align: center;">
                                            {{ data.prodi }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-900" style="text-align: center;">
                                            {{ data.fakultas }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <a :href="route('dosen.edit', { id: data.id })"
                                                class="font-medium mx-1 text-blue-600 hover:underline">Edit</a>
                                            <button class="font-medium mx-1 text-red-600 hover:underline"
                                                @click="hapus(data.id)">Hapus</button>
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
            form: {
                nip_dosen: '',
                nama_dosen: '',
                prodi: '',
                fakultas: '',
            },
            showModal: false,
            itemIdToDelete: null,
            showMessage: false,
            message: '',
            messageType: '',
            errors: {}, 
        };
    },
    props: {
        dosen: Array
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
                await this.$inertia.post(route('dosen.destroy'), { id: this.itemIdToDelete });
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
        async submitForm() {
            const formData = this.form;

            try {
                // Kirim data ke backend menggunakan Inertia
                await this.$inertia.post(route('dosen.store'), formData, {
                    onError: (errors) => {
                        // Jika ada kesalahan, tampilkan pesan error
                        this.message = 'Gagal menyimpan data. NIP yang dimasukkan sudah ada';
                        this.messageType = 'error';
                        this.showMessage = true;
                    },
                    onSuccess: () => {
                        // Tampilkan pesan sukses jika data berhasil disimpan
                        this.message = 'Data berhasil disimpan';
                        this.messageType = 'success';
                        this.showMessage = true;

                        // Reset form setelah data berhasil disimpan
                        this.form = {
                            nip_dosen: '',
                            nama_dosen: '',
                            prodi: '',
                            fakultas: '',
                        };
                    }
                });
            } catch (error) {
                // Tangani kesalahan server lainnya
                this.message = 'Terjadi kesalahan pada server.';
                this.messageType = 'error';
                this.showMessage = true;
            } finally {
                // Sembunyikan pesan setelah beberapa waktu
                setTimeout(() => this.showMessage = false, 3000);
            }
        }


    }
}
</script>
