@extends('components.main')

@section('title', 'Dashboard')

@section('content')
    <div class="p-4">
        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
            <!-- Stat Cards -->
            <div class="bg-white rounded-lg shadow p-4">
                <h1 class="text-2xl font-bold mb-4">Tambahkan Film</h1>
                <form action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-5">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Judul</label>
                        <input type="text" name="title" id="title"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="One Piece" required />
                    </div>
                    <div class="mb-5 flex">
                        <div class="mr-2">
                            <label for="year" class="block mb-2 text-sm font-medium text-gray-900">Release
                                Year</label>
                            <input type="number" id="year" name="year"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                        <div class="mr-2">
                            <label for="age_rating" class="block mb-2 text-sm font-medium text-gray-900">Age
                                Rating</label>
                            <input type="number" id="age_rating" name="age_rating"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                        <div class="">
                            <label for="duration" class="block mb-2 text-sm font-medium text-gray-900">Duration</label>
                            <input type="text" id="duration" name="duration"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="genre" class="block mb-2 text-sm font-medium text-gray-900">Genre</label>
                        <input type="text" name="genre" id="genre"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required />
                    </div>
                    <div class="mb-5">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                        <textarea name="description" id="description"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            rows="4" required></textarea>
                    </div>
                    <div class="mb-5">
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Upload
                            Poster Film</label>
                        <input type="file" name="image" id="image"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required />
                    </div>
                    <div class="mb-5">
                        <label for="image_bg" class="block mb-2 text-sm font-medium text-gray-900">Upload
                            Background</label>
                        <input type="file" name="image_bg" id="image_bg"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required />
                    </div>
                    <div class="mb-5">
                        <label for="video" class="block mb-2 text-sm font-medium text-gray-900">Link
                            Video</label>
                        <input type="text" name="video" id="video"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required />
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah
                        Film</button>
                </form>

            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="text-2xl font-bold mb-4">Daftar Film</h2>
								<form action="{{ route('admin.dashboard.film') }}" method="GET" class="flex">
									<input type="text" name="search" placeholder="Search films..." value="{{ request('search') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
									<button type="submit" class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Search</button>
							</form>
							<div class="overflow-x-auto mt-4">
								<table class="min-w-full bg-white">
									<thead>
											<tr>
													<th class="py-2 px-4 border-b border-gray-200 text-center">No</th>
													<th class="py-2 px-4 border-b border-gray-200 text-center">Gambar</th>
													<th class="py-2 px-4 border-b border-gray-200 text-center">Nama Film</th>
													<th class="py-2 px-4 border-b border-gray-200 text-center">Aksi</th>
											</tr>
									</thead>
									<tbody>
											@foreach ($films as $index => $film)
													<tr>
															<td class="py-2 px-4 border-b border-gray-200 text-center">{{ $index + 1 }}</td>
															<td class="py-2 px-4 border-b border-gray-200 text-center">
																	<img src="{{ asset('images/' . $film->image) }}" alt="{{ $film->title }}"
																			class="w-16 h-16 object-cover mx-auto">
															</td>
															<td class="py-2 px-4 border-b border-gray-200 text-center">{{ $film->title }}</td>
															<td class="py-2 px-4 border-b border-gray-200 text-center">
																	<div class="flex justify-center">
																			{{-- Button Edit --}}
																			<button data-modal-target="edit-modal-{{ $film->id }}"
																					data-modal-toggle="edit-modal-{{ $film->id }}"
																					class="flex justify-center align-center text-white bg-blue-500 p-2 rounded-md hover:text-gray-300 mr-1">
																					<span class="material-symbols-rounded text-md">
																							edit
																					</span>
																			</button>

																			{{-- Button Delete --}}
																			<button data-modal-target="popup-modal-{{ $film->id }}"
																					data-modal-toggle="popup-modal-{{ $film->id }}"
																					class="flex justify-center align-center text-white bg-red-500 p-2 rounded-md hover:text-gray-300">
																					<span class="material-symbols-rounded">
																							delete
																					</span>
																			</button>
																	</div>
																	<!-- Edit Modal -->
																	<div id="edit-modal-{{ $film->id }}" tabindex="-1"
																			class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-start w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
																			<div class="relative p-4 w-full max-w-md max-h-full">
																					<div class="relative bg-white rounded-lg shadow">
																							<button type="button"
																									class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
																									data-modal-hide="edit-modal-{{ $film->id }}">
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
																									<h1 class="text-2xl font-bold mb-4">Edit Film</h1>
																									<form action="{{ route('films.update', $film->id) }}" method="POST"
																											enctype="multipart/form-data">
																											@csrf
																											@method('PUT')
																											<div class="mb-5">
																													<label for="title-{{ $film->id }}"
																															class="block mb-2 text-sm font-medium text-gray-900">Judul</label>
																													<input type="text" name="title"
																															id="title-{{ $film->id }}"
																															value="{{ $film->title }}"
																															class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
																															required />
																											</div>
																											<div class="mb-5 flex">
																													<div class="mr-2">
																															<label for="year-{{ $film->id }}"
																																	class="block mb-2 text-sm font-medium text-gray-900">Release
																																	Year</label>
																															<input type="number" name="year"
																																	id="year-{{ $film->id }}"
																																	value="{{ $film->release_year }}"
																																	class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
																																	required />
																													</div>
																													<div class="mr-2">
																															<label for="age_rating-{{ $film->id }}"
																																	class="block mb-2 text-sm font-medium text-gray-900">Age
																																	Rating</label>
																															<input type="number" name="age_rating"
																																	id="age_rating-{{ $film->id }}"
																																	value="{{ $film->age_rate }}"
																																	class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
																																	required />
																													</div>
																													<div class="">
																															<label for="duration-{{ $film->id }}"
																																	class="block mb-2 text-sm font-medium text-gray-900">Duration</label>
																															<input type="text" name="duration"
																																	id="duration-{{ $film->id }}"
																																	value="{{ $film->duration }}"
																																	class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
																																	required />
																													</div>
																											</div>
																											<div class="mb-5">
																													<label for="genre-{{ $film->id }}"
																															class="block mb-2 text-sm font-medium text-gray-900">Genre</label>
																													<input type="text" name="genre"
																															id="genre-{{ $film->id }}"
																															value="{{ $film->genre }}"
																															class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
																															required />
																											</div>
																											<div class="mb-5">
																													<label for="description-{{ $film->id }}"
																															class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
																													<textarea name="description" id="description-{{ $film->id }}"
																															class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
																															rows="4" required>{{ $film->description }}</textarea>
																											</div>
																											<div class="mb-5">
																													<label for="image-{{ $film->id }}"
																															class="block mb-2 text-sm font-medium text-gray-900">Upload
																															Gambar</label>
																													<div class="flex items-center">
																															<img src="{{ asset('images/' . $film->image) }}"
																																	alt="{{ $film->title }}"
																																	class="w-16 h-16 object-cover mr-4">
																															<input type="file" name="image"
																																	id="image-{{ $film->id }}"
																																	class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
																																	accept="image/*" />
																													</div>
																											</div>
																											<div class="mb-5">
																													<label for="image_bg-{{ $film->id }}"
																															class="block mb-2 text-sm font-medium text-gray-900">Upload
																															Background</label>
																													<div class="flex items-center">
																															<img src="{{ asset('images/' . $film->image_bg) }}"
																																	alt="{{ $film->title }}"
																																	class="w-16 h-16 object-cover mr-4">
																															<input type="file" name="image_bg"
																																	id="image_bg-{{ $film->id }}"
																																	class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
																																	accept="image/*" />
																													</div>
																											</div>
																											<div class="mb-5">
																													<label for="video-{{ $film->id }}"
																															class="block mb-2 text-sm font-medium text-gray-900">Link
																															Video</label>
																													<input type="text" name="video"
																															id="video-{{ $film->id }}"
																															value="{{ $film->video }}"
																															class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
																															required />
																											</div>
																											<button type="submit"
																													class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update
																													Film</button>
																									</form>
																							</div>
																					</div>
																			</div>
																	</div>
																	<!-- Delete Modal -->
																	<div id="popup-modal-{{ $film->id }}" tabindex="-1"
																			class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
																			<div class="relative p-4 w-full max-w-md max-h-full">
																					<div class="relative bg-white rounded-lg shadow">
																							<button type="button"
																									class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
																									data-modal-hide="popup-modal-{{ $film->id }}">
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
																											Apakah Anda yakin ingin menghapus film {{ $film->title }}?
																									</h3>
																									<form action="{{ route('films.destroy', $film->id) }}" method="POST"
																											class="inline-block">
																											@csrf
																											@method('DELETE')
																											<button type="submit"
																													class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
																													Ya
																											</button>
																									</form>
																									<button data-modal-hide="popup-modal-{{ $film->id }}"
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
										{{ $films->links() }}
								</div>
            </div>
        </div>
    </div>
@endsection
