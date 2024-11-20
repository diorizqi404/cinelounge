@extends('components.main')

@section('title', 'Dashboard')

@section('content')
    <div class="p-4">
        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
            <!-- Stat Cards -->
            <div class="bg-white rounded-lg shadow p-4">
                <h1 class="text-2xl font-bold mb-4">Tambahkan Admin</h1>
                <form action="{{ route('admin.store') }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                        <input type="text" name="username" id="username"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="John Doe" required />
                    </div>
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input type="email" name="email" id="email"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="admin@smkn2sby.sch.id" required />
                    </div>
                    <div class="mb-5">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input type="password" name="password" id="password"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="********" required />
                    </div>
                    <div class="mb-5">
                        <label for="cpassword" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
                        <input type="password" name="cpassword" id="cpassword"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="********" required />
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Tambah Admin Baru
                    </button>
                </form>

            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="text-lg font-semibold mb-4">Daftar Admin</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200 text-center">No</th>
                                <th class="py-2 px-4 border-b border-gray-200 text-center">Username</th>
                                <th class="py-2 px-4 border-b border-gray-200 text-center">Email</th>
                                <th class="py-2 px-4 border-b border-gray-200 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $index => $admin)
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $index + 1 }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $admin->username }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $admin->email }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">
                                        <div class="flex justify-center">
                                            {{-- Button Delete --}}
                                            <button data-modal-target="popup-modal-{{ $admin->id }}"
                                                data-modal-toggle="popup-modal-{{ $admin->id }}"
                                                class="flex justify-center align-center text-white bg-red-500 p-2 rounded-md hover:text-gray-300">
                                                <span class="material-symbols-rounded">
                                                    delete
                                                </span>
                                            </button>
                                        </div>
                                        <!-- Delete Modal -->
                                        <div id="popup-modal-{{ $admin->id }}" tabindex="-1"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow">
                                                    <button type="button"
                                                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="popup-modal-{{ $admin->id }}">
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
                                                            Apakah Anda yakin ingin menghapus admin {{ $admin->username }}?
                                                        </h3>
                                                        <form action="{{ route('admin.destroy', $admin->id) }}"
                                                            method="POST" class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                                Ya
                                                            </button>
                                                        </form>
                                                        <button data-modal-hide="popup-modal-{{ $admin->id }}"
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
                <div class="mt-4">
                    {{ $admins->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
