<template>
    <div class="min-h-screen bg-gray-100 p-6">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">Tambah Komentar</h1>
            <form @submit.prevent="simpan">
                <div class="mb-4">
                    <label class="block font-semibold mb-2">Pilih Artikel</label>
                    <select 
                        v-model="form.artikel_id" 
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        required
                    >
                        <option value="">Pilih Artikel</option>
                        <option v-for="artikel in artikels" :key="artikel.id" :value="artikel.id">
                            {{ artikel.judul }}
                        </option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-2">Komentar</label>
                    <textarea 
                        v-model="form.isi" 
                        rows="4" 
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        required
                        placeholder="Tulis komentar di sini"
                    ></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                        Simpan
                    </button>
                    <Link href="/komentars" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                        Batal
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
    artikels: Array
})

const form = ref({
    isi: '',
    artikel_id: ''
})

const simpan = () => {
    router.post('/komentars', form.value, {
        onSuccess: () => {
            form.value = { isi: '', artikel_id: '' }
            alert('Komentar berhasil ditambahkan')
        }
    })
}
</script>