@extends('components.main')

@section('title', 'Dashboard')

@section('content')
    <div class="p-4">
        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mb-4">
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="text-lg font-semibold mb-4">Daftar Form</h2>
                <form action="{{ route('admin.dashboard.form') }}" method="GET" class="flex">
                    <input type="text" name="search" placeholder="Search by name or email..."
                        value="{{ request('search') }}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <button type="submit"
                        class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Search</button>
                </form>
                <div class="overflow-x-auto mt-4">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200 text-center">No</th>
                                <th class="py-2 px-4 border-b border-gray-200 text-center">Nama</th>
                                <th class="py-2 px-4 border-b border-gray-200 text-center">Email</th>
                                <th class="py-2 px-4 border-b border-gray-200 text-center">Pesan</th>
                                <th class="py-2 px-4 border-b border-gray-200 text-center">Tanggal</th>
                                <th class="py-2 px-4 border-b border-gray-200 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($forms as $index => $form)
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $index + 1 }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $form->name }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $form->email }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $form->message }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $form->created_at->format('Y-m-d') }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">
                                        <div class="flex justify-center">
                                            {{-- Button Reply --}}
                                            <button data-modal-target="edit-modal-{{ $form->id }}"
                                                data-modal-toggle="edit-modal-{{ $form->id }}"
                                                class="flex justify-center align-center text-white bg-blue-500 p-2 rounded-md hover:text-gray-300 mr-1">
                                                <span class="material-symbols-rounded text-md">
                                                    reply
                                                </span>
                                            </button>

                                            {{-- Button Delete --}}
                                            <button data-modal-target="popup-modal-{{ $form->id }}"
                                                data-modal-toggle="popup-modal-{{ $form->id }}"
                                                class="flex justify-center align-center text-white bg-red-500 p-2 rounded-md hover:text-gray-300">
                                                <span class="material-symbols-rounded">
                                                    delete
                                                </span>
                                            </button>
                                        </div>
                                        <!-- Edit Modal -->
                                        <div id="edit-modal-{{ $form->id }}" tabindex="-1"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-start w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow">
                                                    <button type="button"
                                                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                                                        data-modal-hide="edit-modal-{{ $form->id }}">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-4 md:p-5">
                                                        <h1 class="text-2xl font-bold mb-4">Balas Pesan</h1>
                                                        <form action="{{ route('forms.reply', $form->id) }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="mb-5">
                                                                <label for="description-{{ $form->id }}"
                                                                    class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                                                                <textarea name="reply_message" id="description-{{ $form->id }}"
                                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                    rows="4" required></textarea>
                                                            </div>
                                                            <button type="submit"
                                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                                Kirim Balasan
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Delete Modal -->
                                        <div id="popup-modal-{{ $form->id }}" tabindex="-1"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow">
                                                    <button type="button"
                                                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="popup-modal-{{ $form->id }}">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-4 md:p-5 text-center">
                                                        <span class="material-symbols-rounded mb-4 text-red-500 text-8xl">
                                                            error
                                                        </span>
                                                        <h3 class="mb-5 text-lg font-normal text-gray-500">
                                                            Apakah Anda yakin ingin menghapus pesan dari
                                                            {{ $form->name }}?
                                                        </h3>
                                                        <form action="{{ route('forms.destroy', $form->id) }}"
                                                            method="POST" class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                                Ya
                                                            </button>
                                                        </form>
                                                        <button data-modal-hide="popup-modal-{{ $form->id }}"
                                                            type="button"
                                                            class="py-2.5 px-5 ml-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Batal</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- <!-- Content Area -->
        <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-lg font-semibold mb-4">Recent Activity</h2>
            <!-- Add your content here -->
            <p class="text-gray-500">Your main content goes here...</p>
        </div> --}}
    </div>
@endsection
