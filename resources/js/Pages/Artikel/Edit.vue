<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white shadow mb-6">
            <div class="max-w-7xl mx-auto px-4 py-3">
                <Link href="/artikels" class="text-gray-600 hover:text-blue-600">Kembali</Link>
            </div>
        </nav>

        <div class="max-w-3xl mx-auto px-4">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Artikel</h2>

                <form @submit.prevent="update">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Judul</label>
                        <input 
                            v-model="form.judul" 
                            type="text" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Isi Artikel</label>
                        <textarea 
                            v-model="form.isi" 
                            rows="8" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                            required
                        ></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
                        <select 
                            v-model="form.kategori_id" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500"
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
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg"
                            :disabled="loading"
                        >
                            {{ loading ? 'Menyimpan...' : 'Update' }}
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
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
    artikel: {
        type: Object,
        required: true
    },
    kategoris: {
        type: Array,
        default: () => []
    }
})

const form = ref({
    judul: props.artikel.judul || '',
    isi: props.artikel.isi || '',
    kategori_id: props.artikel.kategori_id || ''
})

const loading = ref(false)
const errors = ref(null)

const update = () => {
    loading.value = true
    errors.value = null
    
    router.put(`/artikels/${props.artikel.id}`, form.value, {
        onSuccess: () => {
            loading.value = false
            alert('Artikel berhasil diupdate')
        },
        onError: (err) => {
            errors.value = err
            loading.value = false
        }
    })
}
</script>