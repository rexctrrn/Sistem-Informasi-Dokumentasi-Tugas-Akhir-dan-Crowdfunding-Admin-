<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Editor from '@tinymce/tinymce-vue'
import { usePage } from '@inertiajs/vue3';
import Alert from '@/Components/Alert.vue';
</script>

<template>
    <AppLayout title="Edit Tugas Akhir">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Tugas Akhir
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                    <form class="mx-auto" @submit.prevent="submitForm">
                        <div class="bg-gray-100 rounded-lg p-5 my-5">
                            <div class="mb-2">
                                <label for="" class="block mb-1 text-sm font-medium text-gray-900">NIM</label>
                                <input type="number" v-model="form.nim"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="-----------" required>
                            </div>
                            <div class="mb-2">
                                <label for="" class="block mb-1 text-sm font-medium text-gray-900">Nama Penulis</label>
                                <input type="text" v-model="form.nama"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="" required>
                            </div>
                            <div class="mb-2">
                                <label for="" class="block mb-1 text-sm font-medium text-gray-900">Pembimbing 1</label>
                                <select :required="true" name="" v-model="form.pembimbing1" id=""
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option v-for="data in dosen" :key="data.id" :value="data.id"
                                    >{{ data.nip_dosen }} -
                                        {{
                                        data.nama_dosen }}</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="" class="block mb-1 text-sm font-medium text-gray-900">Pembimbing 2</label>
                                <select :required="true" name="" v-model="form.pembimbing2" id=""
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option v-for="data in dosen" :key="data.id" :value="data.id">{{ data.nip_dosen }} -
                                        {{
                                        data.nama_dosen }}</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="" class="block mb-1 text-sm font-medium text-gray-900">Prodi</label>
                                <input type="text" v-model="form.prodi"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="" required>
                            </div>
                            <div class="mb-2">
                                <label for="" class="block mb-1 text-sm font-medium text-gray-900">Judul</label>
                                <input type="text" v-model="form.judul"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 my-2 block w-full p-2.5"
                                placeholder="Judul Tugas Akhir" required>
                            </div>
                            <Editor api-key="nynf1uuertj14xnj9szc4zan23duh37dzcd9xn03q6p4unp0" v-model="form.abstract" :init="{
                                toolbar_mode: 'sliding',
                                plugins: '',
                                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | addcomment showcomments | typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                                tinycomments_mode: 'embedded',
                                tinycomments_author: 'author name',
                            }" initial-value="Welcome to TinyMCE!" />
                            <input type="file" @input="form.file = $event.target.files[0]" placeholder="File Tugas Akhir"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 my-2 block w-full p-2.5">
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                            <div class="mb-2">
                                <label for="" class="block mb-1 text-sm font-medium text-gray-900">Tahun</label>
                                <select :required="true" name="" v-model="form.tahun" id=""
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option v-for="year in years" :value="year">{{ year }}</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="" class="block mb-1 text-sm font-medium text-gray-900">Kata Kunci</label>
                                <input type="text" v-model="form.tags"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Kata kunci, contoh: Teknologi, Website, Jaringan" required>
                            </div>
                            <button type="submit" :disabled="form.processing"
                                class="text-white bg-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200  font-medium rounded-lg text-sm w-full md:w-1/2 px-5 py-2.5 text-center me-2 my-2 mt-5">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <Alert v-if="showMessage" :type="messageType" :message="message" />

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
                id: page.props.publikasi.id,
                nim: page.props.publikasi.nim,
                nama: page.props.publikasi.penulis,
                prodi: page.props.publikasi.prodi,
                pembimbing1: page.props.publikasi.pembimbing_1,
                pembimbing2: page.props.publikasi.pembimbing_2,
                tahun: page.props.publikasi.tahun,
                abstract: page.props.publikasi.abstract,
                judul: page.props.publikasi.judul,
                tags: page.props.publikasi.kata_kunci,
                file: null,
            },
            showMessage: false,
            message: '',
            messageType: '',

        };
    },
    props: {
        dosen: Array,
    },
    computed: {
        years() {
            const year = new Date().getFullYear()
            return Array.from({ length: year - 2021 }, (value, index) => 2022 + index)
        }
    },
    methods: {
        async submitForm() {
            const formData = this.form;
            
            try {
                // Menggunakan metode post dari Inertia untuk mengirim data
                await this.$inertia.post(route('publikasi.update'), formData);
                this.message = 'Data berhasil diedit';
                this.messageType = 'update';
                this.showMessage = true;
                setTimeout(() => this.showMessage = false, 3000);
            } catch (error) {
                console.error(error);
                this.message = 'Maaf, gagal diedit. Silahkan periksa kembali';
                this.messageType = 'error';
                this.showMessage = true;
                setTimeout(() => this.showMessage = false, 3000);
            }
        },
    }
}
</script>