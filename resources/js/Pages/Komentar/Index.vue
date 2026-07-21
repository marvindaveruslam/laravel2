<template>
    <div class="min-h-screen bg-gray-100 p-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Daftar Komentar</h1>
                    <Link href="/komentars/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                        Tambah Komentar
                    </Link>
                </div>
                
                <div v-if="komentars && komentars.length > 0" class="space-y-4">
                    <div v-for="komentar in komentars" :key="komentar.id" class="border-b pb-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <strong>{{ komentar.user?.name || 'Anonymous' }}</strong>
                                <span class="text-sm text-gray-500 ml-2">
                                    pada "{{ komentar.artikel?.judul || 'Artikel' }}"
                                </span>
                            </div>
                            <div class="flex gap-2">
                                <Link :href="`/komentars/${komentar.id}/edit`" class="text-yellow-500">Edit</Link>
                                <button @click="hapus(komentar.id)" class="text-red-500">Hapus</button>
                            </div>
                        </div>
                        <p class="mt-2 text-gray-700">{{ komentar.isi }}</p>
                    </div>
                </div>
                <p v-else class="text-gray-500 text-center py-8">Belum ada komentar</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
    komentars: Array
})

const hapus = (id) => {
    if (confirm('Yakin ingin menghapus komentar ini?')) {
        router.delete(`/komentars/${id}`, {
            onSuccess: () => {
                alert('Komentar berhasil dihapus')
            }
        })
    }
}
</script>