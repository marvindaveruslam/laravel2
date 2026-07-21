<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white shadow mb-6">
            <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between">
                <h1 class="text-xl font-bold text-gray-800">Manajemen Artikel</h1>
                <div class="flex gap-4">
                    <Link href="/artikels" class="text-gray-600 hover:text-blue-600">Artikel</Link>
                    <Link href="/kategoris" class="text-gray-600 hover:text-blue-600">Kategori</Link>
                    <Link href="/komentars" class="text-gray-600 hover:text-blue-600">Komentar</Link>
                </div>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Daftar Artikel</h2>
                <Link 
                    href="/artikels/create" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2"
                >
                    Tambah Artikel
                </Link>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div 
                    v-for="artikel in artikels" 
                    :key="artikel.id" 
                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition"
                >
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">
                            {{ artikel.judul }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ artikel.isi || 'Belum ada isi' }}
                        </p>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>Kategori: {{ artikel.kategori?.nama || 'Tanpa Kategori' }}</span>
                            <span>User: {{ artikel.user?.name || 'Unknown' }}</span>
                        </div>
                        <div class="mt-4 flex gap-2">
                            <Link 
                                :href="`/artikels/${artikel.id}`" 
                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm"
                            >
                                Detail
                            </Link>
                            <Link 
                                :href="`/artikels/${artikel.id}/edit`" 
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm"
                            >
                                Edit
                            </Link>
                            <button 
                                @click="hapus(artikel.id)" 
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm"
                            >
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="!artikels || artikels.length === 0" class="text-center py-12">
                <p class="text-gray-500">Belum ada artikel. Silakan tambahkan artikel pertama.</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
    artikels: {
        type: Array,
        default: () => []
    }
})

const hapus = (id) => {
    if (confirm('Yakin ingin menghapus artikel ini?')) {
        router.delete(`/artikels/${id}`, {

            onSuccess: () => {
                alert('Artikel berhasil dihapus')
            }
        })
    }
}
</script>

<style scoped>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>