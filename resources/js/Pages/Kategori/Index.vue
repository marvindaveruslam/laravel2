<template>
    <div class="min-h-screen bg-gray-100 p-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Daftar Kategori</h1>
                    <Link href="/kategoris/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                        Tambah Kategori
                    </Link>
                </div>

                <div v-if="kategoris && kategoris.length > 0">
                    <div 
                        v-for="kategori in kategoris" 
                        :key="kategori.id" 
                        class="flex justify-between items-center border-b py-3"
                    >
                        <span class="text-lg">{{ kategori.nama }}</span>
                        <div class="flex gap-2">
                            <Link :href="`/kategoris/${kategori.id}/edit`" class="text-yellow-500">Edit</Link>
                            <button @click="hapus(kategori.id)" class="text-red-500">Hapus</button>
                        </div>
                    </div>
                </div>
                <p v-else class="text-gray-500 text-center py-8">Belum ada kategori</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
    kategoris: Array
})

const hapus = (id) => {
    if (confirm('Yakin ingin menghapus kategori ini?')) {
        router.delete(`/kategoris/${id}`, {
            onSuccess: () => {
                alert('Kategori berhasil dihapus')
            }
        })
    }
}
</script>