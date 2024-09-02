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
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name Category</label>
            <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Fantasy" required />
        </div>
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 hidden" role="alert" id="dangerName">
        </div>
        <button type="button" id="btnSubmit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 mb-10 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center block dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>

</div>

<!-- Tabel untuk menampilkan daftar kategori -->
<div class="mt-6 p-4 sm:ml-64">
    <h2 class="text-lg font-medium text-gray-900 dark:text-white">List Kategori</h2>

    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 hidden" role="alert" id="successMessage">
    </div>

    <!-- Modal toggle -->
    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 hidden text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        Toggle modal
    </button>

  <!-- Main modal -->
  <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                      Edit Category
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <form class="p-4 md:p-5" id="formEdit">
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 hidden" role="alert" id="dangerNameAlert">
                </div>
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 hidden" role="alert" id="successNameAlert">
                </div>
                  <div class="grid gap-4 mb-4 grid-cols-2">
                      <div class="col-span-2">
                          <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                          <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                      </div>
                  </div>
                  <button type="button" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                      Update Category
                  </button>
              </form>
          </div>
      </div>
  </div>

    <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b text-left">NO</th>
                <th class="px-4 py-2 border-b text-left">Name</th>
                <th class="px-4 py-2 border-b text-left">Action</th>
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
        function loadCategories(callback) {
            $.ajax({
                url: '{{ route("categories.show") }}',
                method: 'GET',
                success: function(response) {
                    var categories = response.data;
                    var rows = '';
                    var counter = 1; // Inisialisasi penghitung nomor urut

                    categories.forEach(function(category) {
                        rows += '<tr>' +
                        '<td class="px-4 py-2 border-b text-left">' + counter++ + '</td>' +
                        '<td class="px-4 py-2 border-b text-left">' + category.nama + '</td>' +
                        '<td class="px-4 py-2 border-b text-left">' +
                            '<button class="text-blue-600 hover:text-blue-800 edit-btn" data-id="' + category.id + '" data-name="' + category.nama + '">Edit</button> | ' +
                            '<button class="text-red-600 hover:text-red-800 delete-btn" data-id="' + category.id + '">Delete</button>' +
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
        loadCategories();

        // Handle submit form
        var form = $('#formPost')[0];
        $('#btnSubmit').click(function() {
            var formData = new FormData(form);
            $.ajax({
                url: '{{ route("categories.store") }}',
                method: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    $('#dangerName').hide();
                    loadCategories();
                    $('#successMessage').html(response.success).show();
                    setTimeout(function() {
                        $('#successMessage').hide();
                        $('#name').val('');
                    }, 4000);
                },
                error: function(error) {
                    if (error) {
                        $('#dangerName').html(error.responseJSON.errors.name).show();
                    }
                }
            });
        });

        // Handle delete button click
        $(document).on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this category?')) {
                $.ajax({
                    url: '{{ route("categories.destroy", ":id") }}'.replace(':id', id),
                    method: 'DELETE',
                    success: function(response) {
                        if (response.success) {
                            loadCategories();
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
        var name = $(this).data('name');

        // Set data in modal input
        $('#formEdit input[name="name"]').val(name);
        $('#formEdit').data('id', id); // Store ID in form for update

        // Open modal
        $('[data-modal-target="crud-modal"]').click();
    });

     // Handle update form submission
     $('#formEdit button[type="button"]').click(function() {
        var id = $('#formEdit').data('id');
        var name = $('#formEdit input[name="name"]').val();

        $.ajax({
            url: '{{ route("categories.update", ":id") }}'.replace(':id', id),
            method: 'PUT',
            data: { name: name },
            success: function(response) {
                loadCategories();
                $('#successNameAlert').html(response.success).show();
                setTimeout(function() {
                    $('#successNameAlert').hide();
                }, 4000);
            },
            error: function(error) {
                if(error) {
                    loadCategories();
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
