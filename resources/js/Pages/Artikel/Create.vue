<template>
    <MainLayout>
        <div class="max-w-3xl mx-auto px-4 py-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Artikel Baru</h1>

                <form @submit.prevent="simpan">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Judul</label>
                        <input 
                            v-model="form.judul" 
                            type="text" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Masukkan judul artikel"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Isi Artikel</label>
                        <textarea 
                            v-model="form.isi" 
                            rows="8" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Tulis isi artikel di sini"
                            required
                        ></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
                        <select 
                            v-model="form.kategori_id" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="">Pilih Kategori</option>
                            <option 
                                v-for="kategori in kategoris" 
                                :key="kategori.id" 
                                :value="kategori.id"
                            >
                                {{ kategori.nama }}
                            </option>
                        </select>
                    </div>

                    <div class="flex gap-3">
                        <button 
                            type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg"
                            :disabled="loading"
                        >
                            {{ loading ? 'Menyimpan...' : 'Simpan' }}
                        </button>
                        <Link 
                            href="/artikels" 
                            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg"
                        >
                            Batal
                        </Link>
                    </div>

                    <div v-if="errors" class="mt-4 p-3 bg-red-100 text-red-700 rounded">
                        <p v-for="(error, key) in errors" :key="key">{{ error }}</p>
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

const props = defineProps({
    kategoris: {
        type: Array,
        default: () => []
    }
})

const form = ref({
    judul: '',
    isi: '',
    kategori_id: ''
})

const loading = ref(false)
const errors = ref(null)

const simpan = () => {
    loading.value = true
    errors.value = null
    
    router.post('/artikels', form.value, {
        onSuccess: () => {
            loading.value = false
            form.value = { judul: '', isi: '', kategori_id: '' }
            alert('Artikel berhasil ditambahkan')
        },
        onError: (err) => {
            errors.value = err
            loading.value = false
        }
    })
}
</script>