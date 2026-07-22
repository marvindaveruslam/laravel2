<template>
    <div class="min-h-screen bg-gray-100">
        <!-- Navbar -->
        <nav class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <Link href="/" class="text-xl font-bold text-gray-800">
                            MyApp
                        </Link>
                    </div>

                    <!-- Menu -->
                    <div class="flex items-center space-x-4">
                        <Link 
                            href="/artikel" 
                            class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium"
                            :class="{ 'text-blue-600 border-b-2 border-blue-600': $page.component.startsWith('Artikel/') }"
                        >
                            Artikel
                        </Link>
                        <Link 
                            href="/kategori" 
                            class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium"
                            :class="{ 'text-blue-600 border-b-2 border-blue-600': $page.component.startsWith('Kategori/') }"
                        >
                            Kategori
                        </Link>
                        <Link 
                            href="/komentar" 
                            class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium"
                            :class="{ 'text-blue-600 border-b-2 border-blue-600': $page.component.startsWith('Komentar/') }"
                        >
                            Komentar
                        </Link>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <main>
            <slot />
        </main>

        <!-- Footer -->
        <footer class="bg-white shadow-inner mt-12">
            <div class="max-w-7xl mx-auto px-4 py-4 text-center text-gray-500 text-sm">
                &copy; 2026 MyApp. All rights reserved.
            </div>
        </footer>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>