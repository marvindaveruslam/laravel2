<template>
    <div class="min-h-screen bg-gray-100 p-6">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">Edit Komentar</h1>
            <form @submit.prevent="update">
                <div class="mb-4">
                    <label class="block font-semibold mb-2">Komentar</label>
                    <textarea 
                        v-model="form.isi" 
                        rows="4" 
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500" 
                        required
                    ></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg">
                        Update
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
    komentar: Object
})

const form = ref({
    isi: props.komentar?.isi || ''
})

const update = () => {
    router.put(`/komentars/${props.komentar.id}`, form.value, {
        onSuccess: () => {
            alert('Komentar berhasil diupdate')
        }
    })
}
</script>