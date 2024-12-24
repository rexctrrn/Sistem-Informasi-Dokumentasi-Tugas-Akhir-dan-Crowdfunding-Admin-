<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ModalConfirm from '@/Components/ModalConfirm.vue';
import Alert from '@/Components/Alert.vue';
</script>

<template>
    <AppLayout title="Admin">
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Data Admin
        </h2>
      </template>
  
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
            <div class="bg-gray-100 rounded-lg p-5 m-5">
              <h1 class="text-lg font-bold mb-5">Tambah Admin</h1>
              <form class="max-w-lg mx-auto" @submit.prevent="submitForm">
                <div class="mb-2">
                  <label for="name" class="block mb-1 text-sm font-medium text-gray-900">Nama Lengkap</label>
                  <input type="text" v-model="form.name" id="name"
                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="" required>
                </div>
                <div class="mb-2">
                  <label for="email" class="block mb-1 text-sm font-medium text-gray-900">Email</label>
                  <input type="email" v-model="form.email" id="email"
                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="" required>
                </div>
                <div class="mb-2">
                  <label for="password" class="block mb-1 text-sm font-medium text-gray-900">Password</label>
                  <input type="password" v-model="form.password" id="password"
                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="" required>
                </div>
                <button type="submit" :disabled="form.processing"
                  class="text-white bg-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Tambah Data</button>
              </form>
            </div>
            <div class="bg-gray-100 rounded-lg p-5 m-5">
              <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                  <thead class="text-xs text-white font-bold uppercase bg-blue-500">
                    <tr>
                      <th scope="col" class="px-6 py-3" style="text-align: center;">ID</th>
                      <th scope="col" class="px-6 py-3" style="text-align: center;">Nama</th>
                      <th scope="col" class="px-6 py-3" style="text-align: center;">Email</th>
                      <th scope="col" class="px-6 py-3" style="text-align: center;">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="data in admin" :key="data.id" class="bg-white border-b hover:bg-gray-50">
                      <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap" style="text-align: center;">
                        {{ data.id }}
                      </th>
                      <td class="px-6 py-4 text-gray-900" style="text-align: center;">
                        {{ data.name }}
                      </td>
                      <td class="px-6 py-4 text-gray-900" style="text-align: center;">
                        {{ data.email }}
                      </td>
                      <td class="px-6 py-4" style="text-align: center;">
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
          name: '',
          email: '',
          password: '',
        },
        showModal: false,
        itemIdToDelete: null,
        showMessage: false,
        message: '',
        messageType: '',
      };
    },
    props: {
      admin: Array
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
          await this.$inertia.post(route('admin.destroy'), { id: this.itemIdToDelete });
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
          await this.$inertia.post(route('admin.store'), formData);
          this.form = {
            name: '',
            email: '',
            password: '',
          };
          this.message = 'Data berhasil disimpan';
          this.messageType = 'success';
          this.showMessage = true;
          setTimeout(() => this.showMessage = false, 3000);
        } catch (error) {
          console.error(error);
          this.message = 'Maaf, gagal disimpan. Silahkan periksa kembali';
          this.messageType = 'error';
          this.showMessage = true;
          setTimeout(() => this.showMessage = false, 3000);
        }
      }
    }
  }
  </script>
  