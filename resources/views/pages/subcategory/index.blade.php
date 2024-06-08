@extends('layouts.admin.main')

@section('content')
    <div class="pagetitle">
        <h1>Subcategory</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Admin</a></li>
                <li class="breadcrumb-item active">Subcategory</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">List Subcategory</h5>
                            <div class="h-10 d-flex align-items-center">
                                <a href="{{ route('admin.subcategory.show') }}" class="btn btn-danger mx-2"><i
                                        class="bi bi-trash"></i> Trash Subcategory</a>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#basicModal">
                                    <i class="bi bi-plus-lg"></i>
                                    Add Subcategory
                                </button>
                                <div class="modal fade" id="basicModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.subcategory.store') }}" class=" needs-validation"
                                                method="POST" novalidate>
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Subcategory</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-md-12">
                                                        <label for="validationCustom04" class="form-label">Category</label>
                                                        <select class="form-select" id="validationCustom04" name="category"
                                                            required>
                                                            <option selected disabled value="">Choose Category
                                                            </option>
                                                            @foreach ($category as $item)
                                                                <option value="{{ $item->id_category }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please select a valid category.
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mt-2">
                                                        <label for="category" class="form-label">Subcategory Name</label>
                                                        <input type="text" class="form-control" name="name"
                                                            id="category" placeholder="Enter the category name" required>
                                                        <div class="valid-feedback">
                                                            Looks good!
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
                                    <table class="table table-hover table-bordered text-center" id="myTableSubcategory">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Category</th>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.subcategory.update') }}" class=" needs-validation" method="POST" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Subcategory</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_subcategory" id="id_subcategory">
                        <div class="col-md-12">
                            <label for="validationCustom04" class="form-label">Category</label>
                            <select class="form-select" id="validationCustom04" name="category" required>
                                <option selected disabled value="">Choose Category
                                </option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id_category }}">{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid category.
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="subcategory" class="form-label">Subcategory</label>
                            <input type="text" class="form-control" name="name" id="subcategory"
                                placeholder="Enter the subcategory name" required>
                            <div class="valid-feedback">
                                Looks good!
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
            $('#myTableSubcategory').DataTable({
                serverSide: true,
                responsive: true,
                processing: true,
                ajax: '{{ route('admin.subcategory.index') }}',
                columns: [{
                        data: 'id_subcategory',
                        name: 'id_subcategory'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: null,
                        render: function(data) {
                            return '<div class="row justify-content-center">' +
                                '<div class="col-auto">' +
                                '<button type="button" class="btn btn-warning m-1" data-bs-toggle="modal" ' +
                                'data-bs-target="#editModal" data-id="' + data.id_subcategory +
                                '" data-subcategory="' + data.name + '">' +
                                'Edit' +
                                '</button>' +
                                '<button type="button" class="btn btn-danger m-1" onclick="confirmDelete(' +
                                data.id_subcategory + ')" ' +
                                'data-id="' + data.id_subcategory + '">' +
                                'Delete' +
                                '</button>' +
                                '</div>' +
                                '</div>';
                        }
                    }
                ],
                rowCallback: function(row, data, index) {
                    var dt = this.api();
                    $(row).attr('data-id', data.id);
                    $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                }
            });

            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id_subcategory = button.data('id');
                var subcategory = button.data('subcategory');
                var modal = $(this);

                modal.find('.modal-body #id_subcategory').val(id_subcategory);
                modal.find('.modal-body #subcategory').val(subcategory);
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
                        url: "{{ url('admin/subcategory/force-delete') }}/" + id,
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
                            $('#myTableSubcategory').DataTable().ajax.reload();
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
                        url: "{{ url('admin/subcategory') }}/" + id,
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
                            $('#myTableSubcategory').DataTable().ajax.reload();
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
