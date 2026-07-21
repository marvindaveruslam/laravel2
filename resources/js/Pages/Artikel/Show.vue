<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white shadow mb-6">
            <div class="max-w-7xl mx-auto px-4 py-3">
                <Link href="/artikels" class="text-gray-600 hover:text-blue-600">Kembali</Link>
            </div>
        </nav>

        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white rounded-lg shadow-md p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ artikel.judul }}</h1>
                
                <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-6 pb-4 border-b">
                    <span>Tanggal: {{ formatDate(artikel.created_at) }}</span>
                    <span>Kategori: {{ artikel.kategori?.nama || 'Tanpa Kategori' }}</span>
                    <span>User: {{ artikel.user?.name || 'Unknown' }}</span>
                </div>

                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    {{ artikel.isi }}
                </div>

                <div class="mt-8 pt-6 border-t">
                    <h3 class="text-xl font-semibold mb-4">Komentar ({{ artikel.komentars?.length || 0 }})</h3>
                    
                    <div v-if="artikel.komentars && artikel.komentars.length > 0" class="space-y-4">
                        <div 
                            v-for="komentar in artikel.komentars" 
                            :key="komentar.id" 
                            class="bg-gray-50 p-4 rounded-lg"
                        >
                            <div class="flex justify-between items-center">
                                <strong class="text-blue-600">{{ komentar.user?.name || 'Anonymous' }}</strong>
                                <span class="text-sm text-gray-500">{{ formatDate(komentar.created_at) }}</span>
                            </div>
                            <p class="mt-2 text-gray-700">{{ komentar.isi }}</p>
                        </div>
                    </div>
                    <p v-else class="text-gray-500 italic">Belum ada komentar</p>
                </div>

                <div class="mt-6 flex gap-3">
                    <Link 
                        :href="`/artikels/${artikel.id}/edit`" 
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg"
                    >
                        Edit
                    </Link>
                    <button 
                        @click="hapus(artikel.id)" 
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg"
                    >
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
    artikel: {
        type: Object,
        required: true
    }
})

const formatDate = (date) => {
    if (!date) return '-'
    return new Date(date).toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    })
}

const hapus = (id) => {
    if (confirm('Yakin ingin menghapus artikel ini?')) {
        router.delete(`/artikels/${id}`, {
            onSuccess: () => {
                window.location.href = '/artikels'
            }
        })
    }
}
</script>