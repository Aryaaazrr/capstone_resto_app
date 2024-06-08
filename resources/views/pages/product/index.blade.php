@extends('layouts.admin.main')

@section('content')
    <div class="pagetitle">
        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Admin</a></li>
                <li class="breadcrumb-item active">Product</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">List Product</h5>
                            <div class="h-10 d-flex align-items-center">
                                <a href="{{ route('admin.category.show') }}" class="btn btn-danger mx-2"><i
                                        class="bi bi-trash"></i> Trash Product</a>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#basicModal">
                                    <i class="bi bi-plus-lg"></i>
                                    Add Product
                                </button>
                                <div class="modal fade" id="basicModal" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.product.store') }}" class=" needs-validation"
                                                method="POST" enctype="multipart/form-data" novalidate>
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Product</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body row">
                                                    <div class="col-md-6 mb-2">
                                                        <label for="category" class="form-label">Product Name</label>
                                                        <input type="text" class="form-control" name="name"
                                                            id="category" placeholder="Enter the category name" required>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Please provide a valid product name.
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="subcategory" class="form-label">Subcategory</label>
                                                        <select class="form-select" id="subcategory" name="subcategory"
                                                            required>
                                                            <option selected disabled value="">Choose Subcategory
                                                            </option>
                                                            @foreach ($subcategory as $item)
                                                                <option value="{{ $item->id_subcategory }}">
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Please select a valid subcategory.
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="image" class="form-label">Image</label>
                                                        <input class="form-control" type="file" id="image"
                                                            name="image" required>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Please select a valid image.
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="price" class="form-label">Price</label>
                                                        <input type="text" class="form-control" name="price"
                                                            id="price" placeholder="Enter the price product" required>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Please provide a valid price product.
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-2">
                                                        <label for="description"
                                                            class="col-sm-2 col-form-label">Description</label>
                                                        <textarea class="form-control" style="height: 100px" id="description" name="description" required></textarea>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Please provide a valid description product.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button class="btn btn-success" type="submit">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                            <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered text-center" id="myTableCategory">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Image</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Description</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Subcategory</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- modal edit --}}
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin.product.update') }}" class=" needs-validation" method="POST"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <input type="hidden" name="id_product" id="id_product">
                        <div class="col-md-6 mb-2">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Enter the product name" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid product name.
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="subcategory" class="form-label">Subcategory</label>
                            <select class="form-select" id="subcategory" name="subcategory" required>
                                <option selected disabled value="">Choose Subcategory
                                </option>
                                @foreach ($subcategory as $item)
                                    <option value="{{ $item->id_subcategory }}">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please select a valid subcategory.
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="image" class="form-label">Image</label>
                            <input class="form-control" type="file" id="image" name="image">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please select a valid image.
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" name="price" id="price"
                                placeholder="Enter the price product" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid price product.
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <textarea class="form-control" style="height: 100px" id="description" name="description" required></textarea>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid description product.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}'
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oopss...',
                text: '{{ $errors->first() }}'
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#myTableCategory').DataTable({
                serverSide: true,
                responsive: true,
                processing: true,
                ajax: '{{ route('admin.product.index') }}',
                columns: [{
                        data: 'id_product',
                        name: 'id_product'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        render: function(data) {
                            return '<img src="{{ asset('uploads/menu') }}/' + data +
                                '" alt="" style="width: 50px; height: 50px;">';
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'price',
                        name: 'price',
                        render: function(data) {
                            return data !== null ? parseInt(data).toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }) : '-';
                        }
                    },
                    {
                        data: 'subcategory',
                        name: 'subcategory'
                    },
                    {
                        data: null,
                        render: function(data) {
                            return '<div class="row justify-content-center">' +
                                '<div class="col-auto">' +
                                '<button type="button" class="btn btn-warning m-1" data-bs-toggle="modal" ' +
                                'data-bs-target="#editModal" data-id="' + data.id_product +
                                '" data-name="' + data.name + '" data-description="' + data
                                .description + '" data-price="' + data.price + '">' +
                                'Edit' +
                                '</button>' +
                                '<button type="button" class="btn btn-danger m-1" onclick="confirmDelete(' +
                                data.id_category + ')" ' +
                                'data-id="' + data.id_category + '">' +
                                'Delete' +
                                '</button>' +
                                '</div>' +
                                '</div>';
                        }
                    }
                ]
            });

            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id_product = button.data('id');
                var name = button.data('name');
                var description = button.data('description');
                var price = button.data('price');
                var modal = $(this);

                modal.find('.modal-body #id_product').val(id_product);
                modal.find('.modal-body #name').val(name);
                modal.find('.modal-body #description').val(description);
                modal.find('.modal-body #price').val(price);
            });
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Oopss..',
                text: "Do you want to delete permanently or soft delete?",
                icon: 'warning',
                showCancelButton: true,
                showDenyButton: true,
                confirmButtonColor: '#3085d6',
                denyButtonColor: '#d33',
                confirmButtonText: 'Permanent Delete',
                denyButtonText: 'Move to trash',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('admin/category/force-delete') }}/" + id,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                'Permanently Deleted!',
                                'Data has been successfully deleted permanently.',
                                'success'
                            );
                            $('#myTableCategory').DataTable().ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Oppss!',
                                'An error occurred while deleting data. Please try again',
                                'error'
                            );
                        }
                    });
                } else if (result.isDenied) {
                    $.ajax({
                        url: "{{ url('admin/category') }}/" + id,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Data is moved to trash.',
                                'success'
                            );
                            $('#myTableCategory').DataTable().ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Oppss!',
                                'An error occurred while deleting data. Please try again',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endsection
