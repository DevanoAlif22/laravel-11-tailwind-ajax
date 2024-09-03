<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  @vite('resources/css/app.css')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body>


@include('layout.sidebar')

 <div class="p-4 sm:ml-64">

    <form id="formPost">
        <div class="mb-5">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
            <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Fantasy" required />
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 hidden" role="alert" id="dangerTitle">
            </div>
        </div>
        <div class="mb-5">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
            <textarea id="description" required name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Leave a comment..."></textarea>
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 hidden" role="alert" id="dangerDescription">
            </div>
        </div>
        <div class="mb-5">
            <label class="block mb-2 text-sm font-medium text-gray-900" for="user_avatar">Upload file</label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" aria-describedby="user_avatar_help" id="image" name="image" type="file">
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 hidden" role="alert" id="dangerImage">
            </div>
        </div>
        <div class="mb-5">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Select your country</label>
            <select id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option disabled selected>Option Category</option>
                @foreach ($category as $categories)
                <option value="{{$categories->id}}" >{{$categories->nama}}</option>
                @endforeach
            </select>
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 hidden" role="alert" id="dangerCategory">
            </div>
        </div>
        <div class="mb-5">
            <label for="year" class="block mb-2 text-sm font-medium text-gray-900">Year</label>
            <input type="number" id="year" name="year" min="1900" max="2100" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="2024" required>
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 hidden" role="alert" id="dangerYear"></div>
        </div>
        <button type="button" id="btnSubmit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 mb-10 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center block">Submit</button>
    </form>

</div>

<div class="mt-6 p-4 sm:ml-64">
    <h2 class="text-lg font-medium text-gray-900">List Film</h2>

    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 hidden" role="alert" id="successMessage">
    </div>

    <!-- Modal toggle -->
    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 hidden text-center" type="button">
        Toggle modal
    </button>

  <!-- Main modal -->
  <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Edit Film
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" id="formEdit">
                <!-- Alerts -->
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 hidden" role="alert" id="successNameAlert"></div>

                <!-- Title -->
                <div class="mb-5">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                    <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 hidden" role="alert" id="dangerTitleAlert"></div>
                </div>

                <!-- Description -->
                <div class="mb-5">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                    <textarea name="description" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-600 focus:border-primary-600" placeholder="Leave a comment..." required></textarea>
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 hidden" role="alert" id="dangerDescriptionAlert"></div>
                </div>

                <!-- Upload File -->
                <div class="mb-5">
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Upload file (opsional)</label>
                    <input type="file" name="image" id="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 hidden" role="alert" id="dangerImageAlert"></div>
                </div>
                
                <div class="mb-5">
                    <p>Image Existing</p>
                    <img src="" id="preview-image" style="width:100px" alt="">
                </div>

                <!-- Category -->
                <!-- Dropdown untuk Edit Kategori -->
                <div class="mb-5">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Select your country</label>
                    <select name="category" id="edit-category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @foreach ($category as $categories)
                        <option value="{{$categories->id}}">{{$categories->nama}}</option>
                        @endforeach
                    </select>
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 hidden" role="alert" id="dangerCategoryAlert"></div>             
                </div>



                <!-- Year -->
                <div class="mb-5">
                    <label for="year" class="block mb-2 text-sm font-medium text-gray-900">Year</label>
                    <input type="number" name="year" id="year" min="1900" max="2100" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="2024" required>
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 hidden" role="alert" id="dangerYearAlert"></div>
                </div>

                <!-- Submit Button -->
                <button type="button" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Update Film
                </button>
            </form>
        </div>
    </div>
  </div>


    <table class="mb-[20px] min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b text-left">NO</th>
                <th class="px-4 py-2 border-b text-left">Title</th>
                <th class="px-4 py-2 border-b text-left">Category</th>
                <th class="px-4 py-2 border-b text-left">Description</th>
                <th class="px-4 py-2 border-b text-left">Year</th>
                <th class="px-4 py-2 border-b text-left">Image</th>
            </tr>
        </thead>
        <tbody id="categoryTableBody">
            <!-- Daftar kategori akan ditambahkan di sini -->
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Fungsi untuk memuat kategori saat halaman dimuat
        function loadFilms(callback) {
            $.ajax({
                url: '{{ route("films.show") }}',
                method: 'GET',
                success: function(response) {
                    var films = response.data;
                    var rows = '';
                    var counter = 1; // Inisialisasi penghitung nomor urut

                    films.forEach(function(film) {
                        rows += '<tr>' +
                            '<td class="px-4 py-2 border-b text-left">' + counter++ + '</td>' +
                            '<td class="px-4 py-2 border-b text-left">' + film.categories.nama + '</td>' + // Menampilkan kategori_id
                            '<td class="px-4 py-2 border-b text-left">' + film.judul + '</td>' + // Menampilkan judul
                            '<td class="px-4 py-2 border-b text-left">' + film.deskripsi + '</td>' + // Menampilkan deskripsi
                            '<td class="px-4 py-2 border-b text-left">' + film.tahun + '</td>' + // Menampilkan tahun
                            '<td class="px-4 py-2 border-b text-left"><img src="' + film.gambar + '" alt="' + film.judul + '" width="50"></td>' +
                            '<td class="px-4 py-2 border-b text-left">' +
                                '<button class="text-blue-600 hover:text-blue-800 edit-btn" ' +
                                'data-id="' + film.id + '" ' +
                                'data-title="' + film.judul + '" ' +
                                'data-description="' + film.deskripsi + '" ' +
                                'data-category="' + film.categories.id + '" ' +
                                'data-year="' + film.tahun + '" ' +
                                'data-image="' + film.gambar + '">Edit</button> ' +
                                '<button class="text-red-600 hover:text-red-800 delete-btn" data-id="' + film.id + '">Delete</button>' +
                            '</td>' +
                        '</tr>';
                    });


                    $('#categoryTableBody').html(rows);
                },
                error: function(error) {
                    console.log('Error loading categories:', error);
                }
            });
        }

        // Panggil fungsi untuk memuat kategori saat halaman dimuat
        loadFilms();

        // Handle submit form
        var form = $('#formPost')[0];
        $('#btnSubmit').click(function() {
            var formData = new FormData(form);
            $.ajax({
                url: '{{ route("films.store") }}',
                method: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    $('#dangerTitle').hide();
                    $('#dangerDescription').hide();
                    $('#dangerImage').hide();
                    $('#dangerYear').hide();
                    $('#dangerCategory').hide();
                    loadFilms();
                    $('#successMessage').html(response.success).show();
                    setTimeout(function() {
                        $('#successMessage').hide();
                        $('#title').val('');
                        $('#description').val('');
                        $('#image').val('');
                        $('#category').val('');
                        $('#year').val('');
                    }, 4000);
                },
                error: function(error) {
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.name) {
                            $('#dangerName').html(error.responseJSON.errors.name).show();
                        }
                        if (error.responseJSON.errors.title) {
                            $('#dangerTitle').html(error.responseJSON.errors.title).show();
                        }
                        if (error.responseJSON.errors.description) {
                            $('#dangerDescription').html(error.responseJSON.errors.description).show();
                        }
                        if (error.responseJSON.errors.image) {
                            $('#dangerImage').html(error.responseJSON.errors.image).show();
                        }
                        if (error.responseJSON.errors.category) {
                            $('#dangerCategory').html(error.responseJSON.errors.category).show();
                        }
                        if (error.responseJSON.errors.year) {
                            $('#dangerYear').html(error.responseJSON.errors.year).show();
                        }
                    }
                }
            });
        });

        // Handle delete button click
        $(document).on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this film?')) {
                $.ajax({
                    url: '{{ route("film.destroy", ":id") }}'.replace(':id', id),
                    method: 'DELETE',
                    success: function(response) {
                        if (response.success) {
                            loadFilms();
                            $('#dangerName').hide();
                            $('#successMessage').html(response.success).show();
                            setTimeout(function() {
                                $('#successMessage').hide();
                            }, 4000);
                        }
                    },
                    error: function(error) {
                        if (error.status === 404) {
                            $('#dangerName').html(error.responseJSON.error).show();
                            setTimeout(function() {
                                $('#dangerName').hide();
                            }, 4000);
                        }
                    }
                });
            }
        });

        $(document).on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var title = $(this).data('title');
            var description = $(this).data('description');
            var category = $(this).data('category');
            var year = $(this).data('year');
            var image = $(this).data('image');

            // Set data in modal input
            $('#formEdit input[name="title"]').val(title);
            $('#formEdit textarea[name="description"]').val(description);
            
            // Mengatur kategori yang sesuai sebagai selected
            $('#formEdit #edit-category option').each(function() {
                if ($(this).val() == category) {
                    $(this).prop('selected', true);
                } else {
                    $(this).prop('selected', false); // Hilangkan selected pada option lainnya
                }
            });
            $('#formEdit input[name="year"]').val(year);
            $('#preview-image').attr('src', image);
            $('#formEdit').data('id', id); 

            // Open modal
            $('[data-modal-target="crud-modal"]').click();
        });

        // Handle update form submission
        $('#formEdit button[type="button"]').click(function() {
            var id = $('#formEdit').data('id');
            var title = $('#formEdit input[name="title"]').val();
            var description = $('#formEdit textarea[name="description"]').val();
            var category = $('#formEdit select[name="category"]').val();
            var year = $('#formEdit input[name="year"]').val();
            
            // Mengambil elemen file input untuk gambar
            var image = $('#formEdit input[name="image"]')[0].files[0];

            // Membuat form data untuk mengirim file melalui AJAX jika ada gambar baru
            var formData = new FormData();
            formData.append('id', id);
            formData.append('title', title);
            formData.append('description', description);
            formData.append('category', category);
            formData.append('year', year);

            // Periksa apakah ada gambar yang dipilih
            if (image) {
                formData.append('image', image);
            }

            // Menggunakan AJAX dengan FormData untuk mendukung pengiriman file
            $.ajax({
                url: '{{ route("film.update") }}',
                method: 'POST', // Gunakan 'POST' untuk pengiriman FormData (HTTP PUT tidak didukung untuk FormData secara langsung)
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // console.log(response);
                    loadFilms();
                    if(response.gambar) {
                        $('#preview-image').attr('src', response.gambar);
                    }
                    $('#formEdit input[name="image"]').val('');
                    $('#successNameAlert').html(response.success).show();
                    setTimeout(function() {
                        $('#successNameAlert').hide();
                    }, 4000);
                },
                error: function(error) {
                    if(error) {
                        loadFilms();
                        $('#dangerNameAlert').html(error.responseJSON.errors.name).show();
                        setTimeout(function() {
                            $('#dangerNameAlert').hide();
                        }, 4000);
                    }
                }
            });
        });

    });
</script>
</body>
</html>
