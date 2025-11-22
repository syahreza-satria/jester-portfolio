<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dashboard JPRD</title>
        @vite('resources/css/app.css')
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

            body {
                font-family: 'Inter', sans-serif;
                background-color: #f3f4f6;
            }
        </style>
    </head>

    <body class="antialiased text-gray-800 bg-gray-50">

        <nav class="sticky top-0 z-40 bg-white border-b border-gray-200 shadow-sm bg-opacity-90 backdrop-blur-md">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <a href="{{ route('dashboard.index') }}"
                        class="flex items-center gap-2 text-xl font-bold tracking-tight text-gray-900">
                        <div class="flex items-center justify-center w-8 h-8 text-white bg-blue-600 rounded-lg">D</div>
                        Dashboard <span class="font-normal text-gray-400">JPRD</span>
                    </a>
                    <div class="md:hidden">
                        <button type="button"
                            class="p-2 text-gray-500 rounded-md hover:bg-gray-100 hover:text-gray-900 focus:outline-none"
                            id="mobile-menu-button">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <main class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">

            @if (session('success'))
                <div x-data="{ showAlert: true }" x-show="showAlert" x-init="setTimeout(() => showAlert = false, 5000)"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                    class="relative px-4 py-3 mb-6 text-green-700 bg-green-100 border-l-4 border-green-500 rounded shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p class="font-medium">{{ session('success') }}</p>
                        </div>
                        <button @click="showAlert = false" class="text-green-700 hover:text-green-900">×</button>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div x-data="{ showAlert: true }" x-show="showAlert"
                    class="mb-6 overflow-hidden bg-white border-l-4 border-red-500 rounded shadow-sm">
                    <div class="px-4 py-3 bg-red-50">
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-red-700">Terdapat Kesalahan</p>
                            <button @click="showAlert = false" class="text-red-700 hover:text-red-900">×</button>
                        </div>
                    </div>
                    <ul class="px-8 py-3 space-y-1 text-sm text-red-600 list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">Galeri Foto</h1>
                    <p class="mt-1 text-sm text-gray-500">Kelola koleksi foto anda disini.</p>
                </div>

                <button type="button" id="add-photo"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white shadow transition-all duration-200 hover:bg-blue-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-blue-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Baru</span>
                </button>
            </div>

            <div class="grid grid-cols-2 gap-6 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                @if ($photos->isEmpty())
                    <div
                        class="flex flex-col items-center justify-center py-16 text-center bg-white border-2 border-gray-300 border-dashed col-span-full rounded-xl">
                        <svg class="w-12 h-12 mb-4 text-gray-300" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900">Belum ada gambar</h3>
                        <p class="text-gray-500">Mulai dengan menambahkan gambar baru.</p>
                    </div>
                @else
                    @foreach ($photos as $photo)
                        <div
                            class="relative overflow-hidden transition-all duration-300 bg-white shadow-sm group rounded-xl hover:-translate-y-1 hover:shadow-xl">
                            <div class="relative w-full h-64 bg-gray-100 aspect-w-1 aspect-h-1">
                                <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}"
                                    class="object-cover w-full h-full transition duration-700 transform group-hover:scale-105">

                                <div
                                    class="absolute inset-0 transition-opacity duration-300 bg-gray-900 opacity-0 bg-opacity-60 group-hover:opacity-100">
                                    <div class="absolute inset-0 flex items-center justify-center gap-3">
                                        <button type="button" id="editButton-{{ $photo->id }}"
                                            onclick="openEditModal('{{ $photo->id }}')"
                                            class="p-2 text-blue-600 transition-all duration-200 transform bg-white rounded-full hover:scale-110 hover:bg-blue-50 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>

                                        <form action="{{ route('dashboard.destroy', $photo->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Yakin ingin menghapus foto ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-600 transition-all duration-200 transform bg-white rounded-full hover:scale-110 hover:bg-red-50 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                                                title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4">
                                <h3 class="text-sm font-bold text-gray-900 truncate">{{ $photo->title }}</h3>
                                <p class="mt-1 text-xs text-gray-500 truncate line-clamp-1">
                                    {{ $photo->description ?? 'Tidak ada deskripsi' }}</p>
                            </div>
                        </div>

                        <div id="editModal-{{ $photo->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto"
                            aria-labelledby="modal-title" role="dialog" aria-modal="true">
                            <div
                                class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75 backdrop-blur-sm"
                                    aria-hidden="true" onclick="closeEditModal('{{ $photo->id }}')"></div>
                                <span class="hidden sm:inline-block sm:h-screen sm:align-middle"
                                    aria-hidden="true">&#8203;</span>

                                <div
                                    class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white shadow-xl rounded-2xl sm:my-8 sm:w-full sm:max-w-lg sm:align-middle">
                                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                                        <div class="sm:flex sm:items-start">
                                            <div class="w-full mt-3 text-center sm:mt-0 sm:text-left">
                                                <h3 class="text-lg font-semibold leading-6 text-gray-900"
                                                    id="modal-title">Edit Foto</h3>
                                                <div class="mt-4">
                                                    <form id="editForm-{{ $photo->id }}"
                                                        action="{{ route('dashboard.update', $photo->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="space-y-4">
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">Judul</label>
                                                                <input type="text" name="title"
                                                                    value="{{ $photo->title }}"
                                                                    class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                                            </div>
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                                                <textarea name="description" rows="3"
                                                                    class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('description', $photo->description) }}</textarea>
                                                            </div>
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700">Ganti
                                                                    Gambar (Opsional)</label>
                                                                <input type="file" name="image"
                                                                    class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-4 py-3 bg-gray-50 sm:flex sm:flex-row-reverse sm:px-6">
                                        <button type="button" onclick="submitEditForm('{{ $photo->id }}')"
                                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Simpan
                                            Perubahan</button>
                                        <button type="button" onclick="closeEditModal('{{ $photo->id }}')"
                                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:ml-3 sm:mt-0 sm:w-auto sm:text-sm">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </main>

        {{-- Modal Tambah (Create) --}}
        <div class="fixed inset-0 z-50 hidden overflow-y-auto" id="modal" aria-labelledby="modal-title"
            role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

                <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-60 backdrop-blur-sm"
                    aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:h-screen sm:align-middle" aria-hidden="true">&#8203;</span>

                <div
                    class="inline-block w-full overflow-hidden text-left align-bottom transition-all transform bg-white shadow-xl rounded-xl sm:my-8 sm:max-w-md sm:align-middle">

                    <div class="p-6 bg-white">
                        <div class="mb-5">
                            <h3 class="text-lg font-bold text-gray-900">Tambah Gambar</h3>
                            <p class="text-sm text-gray-500">Lengkapi data di bawah ini.</p>
                        </div>

                        @if ($errors->any())
                            <div class="p-3 mb-5 text-sm text-red-600 border border-red-100 rounded-lg bg-red-50">
                                <ul class="pl-4 list-disc">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data"
                            class="space-y-5">
                            @csrf

                            <div>
                                <label for="title"
                                    class="block mb-1 text-sm font-medium text-gray-700">Judul</label>
                                <input type="text" name="title" id="title"
                                    class="w-full px-3 py-2 text-sm transition-all border border-gray-300 rounded-lg outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                                    placeholder="Nama gambar..." value="{{ old('title') }}" required>
                            </div>

                            <div>
                                <label for="description"
                                    class="block mb-1 text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="description" id="description" rows="3"
                                    class="w-full px-3 py-2 text-sm transition-all border border-gray-300 rounded-lg outline-none resize-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                                    placeholder="Keterangan singkat...">{{ old('description') }}</textarea>
                            </div>

                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Upload Gambar</label>
                                <input type="file" name="image" id="image" required
                                    onchange="validateFileSize(this)"
                                    class="block w-full text-sm text-gray-500 cursor-pointer file:mr-4 file:rounded-full file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100">
                                <p class="mt-1 text-xs text-gray-400">Max: 5MB (JPG, PNG)</p>
                            </div>

                            <div class="flex items-center justify-end gap-3 pt-2">
                                <button type="button" id="close-modal"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-medium text-white transition-all bg-blue-600 rounded-lg shadow-sm hover:bg-blue-700 hover:shadow">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const addPhotoButton = document.getElementById('add-photo');
                const addPhotoModal = document.getElementById('modal');
                const closeAddModalButton = document.getElementById('close-modal');

                // Buka modal tambah foto
                if (addPhotoButton && addPhotoModal) {
                    addPhotoButton.addEventListener('click', function() {
                        addPhotoModal.classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                    });
                }

                // Tutup modal tambah foto
                if (closeAddModalButton && addPhotoModal) {
                    closeAddModalButton.addEventListener('click', function() {
                        addPhotoModal.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    });
                }

                // Tutup modal saat klik di luar area modal
                window.addEventListener('click', function(event) {
                    // Modal tambah foto
                    if (addPhotoModal && event.target === addPhotoModal.querySelector(
                            '.fixed.inset-0.bg-opacity-75')) {
                        addPhotoModal.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }

                    // Modal edit foto (Close on click outside logic improved)
                    const editModals = document.querySelectorAll('[id^="editModal-"]');
                    editModals.forEach(modal => {
                        // Cek jika yang diklik adalah backdrop
                        if (event.target.classList.contains('bg-opacity-75')) {
                            const photoId = modal.id.split('-')[1];
                            closeEditModal(photoId);
                        }
                    });
                });

                // Auto show modal jika ada error validasi dari server
                @if ($errors->any())
                    if (addPhotoModal) {
                        addPhotoModal.classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                    }
                @endif
            });

            // Fungsi global untuk buka modal edit
            function openEditModal(photoId) {
                const modal = document.getElementById(`editModal-${photoId}`);
                if (modal) {
                    modal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                }
            }

            // Fungsi global untuk tutup modal edit
            function closeEditModal(photoId) {
                const modal = document.getElementById(`editModal-${photoId}`);
                if (modal) {
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            }

            // Fungsi global untuk submit form edit
            function submitEditForm(photoId) {
                const form = document.getElementById(`editForm-${photoId}`);
                if (form) {
                    form.submit();
                }
            }

            function validateFileSize(input) {
                const file = input.files[0];
                if (file) {
                    const fileSize = file.size / 1024 / 1024; // Konversi ke MB
                    const maxSize = 5; // Batas maks 5MB sesuai validasi Laravel

                    if (fileSize > maxSize) {
                        alert('File terlalu besar! Ukuran maksimal adalah 5MB.');
                        input.value = ''; // Reset input agar file batal diupload
                    }
                }
            }
        </script>

    </body>

</html>
