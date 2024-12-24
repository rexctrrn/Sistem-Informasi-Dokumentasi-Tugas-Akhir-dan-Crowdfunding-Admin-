<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { usePage } from '@inertiajs/vue3';
import Alert from '@/Components/Alert.vue';
</script>
<template>
    <AppLayout title="Edit Pembimbing">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Pembimbing
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                    <div class="bg-gray-100 rounded-lg p-5 m-5">
                        <h1 class="text-lg font-bold mb-5">Edit Data Pembimbing</h1>
                        <form class="max-w-lg mx-auto" @submit.prevent="submitForm">
                            <div class="mb-2">
                                <label for="" class="block mb-1 text-sm font-medium text-gray-900">NIP</label>
                                <input type="number" v-model="form.nip_dosen" id="dosen"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="-----------" required>
                            </div>
                            <div class="mb-2">
                                <label for="" class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
                                <input type="text" v-model="form.nama_dosen" id="dosen"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="" required>
                            </div>
                            <div class="mb-2">
                                <label for="" class="block mb-1 text-sm font-medium text-gray-900">Prodi</label>
                                <input type="text" v-model="form.prodi" id="dosen"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="" required>
                            </div>
                            <div class="mb-2">
                                <label for="" class="block mb-1 text-sm font-medium text-gray-900">Fakultas</label>
                                <input type="text" v-model="form.fakultas" id="dosen"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="" required>
                            </div>
                            <button type="submit" :disabled="form.processing"
                                class="text-white bg-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200  font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Update Data</button>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <Alert v-if="showMessage" :type="messageType" :message="message" />
        <div v-if="showMessage" :class="messageType === 'success' ? 'alert-success' : 'alert-error'">
    {{ message }}
  </div>
    </AppLayout>
</template>


<script>

const page = usePage();

export default {
    components: {
        Alert
    },

    data() {
        return {
            form: {
                id: page.props.data.id,
                nip_dosen: page.props.data.nip_dosen,
                nama_dosen: page.props.data.nama_dosen,
                prodi: page.props.data.prodi,
                fakultas: page.props.data.fakultas,
            },
            showMessage: false,
            message: '',
            messageType: '',
        };
    },
    methods: {
        async submitForm() {
            const formData = this.form;

            try {
                await this.$inertia.post(route('dosen.update'), formData, {
                    onError: (errors) => {
                        // Pesan error sama seperti di index.vue
                        this.message = 'Gagal memperbarui data. NIP yang dimasukkan sudah ada';
                        this.messageType = 'error';
                        this.showMessage = true;
                    },
                    onSuccess: () => {
                        this.message = 'Data berhasil diperbarui';
                        this.messageType = 'success';
                        this.showMessage = true;

                        console.log('Message:', this.message);
console.log('MessageType:', this.messageType);
console.log('ShowMessage:', this.showMessage);

    // Reset form setelah pesan sukses muncul
    setTimeout(() => {
        this.form = {
            nip_dosen: '',
            nama_dosen: '',
            prodi: '',
            fakultas: '',
        };
    }, 500); // Tunda reset form sedikit untuk memberi waktu pada alert
}

                });
            } catch (error) {
                // Penanganan kesalahan server lainnya
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