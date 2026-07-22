<template>
    <MainLayout>
        <div class="max-w-2xl mx-auto px-4 py-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h1 class="text-2xl font-bold mb-6">Tambah Kategori</h1>
                <form @submit.prevent="simpan">
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Nama Kategori</label>
                        <input 
                            v-model="form.nama" 
                            type="text" 
                            class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required
                            placeholder="Masukkan nama kategori"
                        >
                    </div>
                    <div class="flex gap-3">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                            Simpan
                        </button>
                        <Link href="/kategori" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                            Batal
                        </Link>
                    </div>
                </form>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'

const form = ref({ nama: '' })

const simpan = () => {
    router.post('/kategori', form.value, {
        onSuccess: () => {
            form.value = { nama: '' }
            alert('Kategori berhasil ditambahkan')
        }
    })
}
</script>