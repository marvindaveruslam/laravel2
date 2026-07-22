<template>
    <MainLayout>
        <div class="max-w-4xl mx-auto px-4 py-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Daftar Kategori</h1>
                    <Link href="/kategori/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                        Tambah Kategori
                    </Link>
                </div>

                <div v-if="kategori && kategori.length > 0">
                    <div 
                        v-for="kategori in kategori" 
                        :key="kategori.id" 
                        class="flex justify-between items-center border-b py-3"
                    >
                        <span class="text-lg">{{ kategori.nama }}</span>
                        <div class="flex gap-2">
                            <Link :href="`/kategori/${kategori.id}/edit`" class="text-yellow-500">Edit</Link>
                            <button @click="hapus(kategori.id)" class="text-red-500">Hapus</button>
                        </div>
                    </div>
                </div>
                <p v-else class="text-gray-500 text-center py-8">Belum ada kategori</p>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'

const props = defineProps({
    kategori: Array
})

const hapus = (id) => {
    if (confirm('Yakin ingin menghapus kategori ini?')) {
        router.delete(`/kategori/${id}`, {
            onSuccess: () => {
                alert('Kategori berhasil dihapus')
            }
        })
    }
}
</script>