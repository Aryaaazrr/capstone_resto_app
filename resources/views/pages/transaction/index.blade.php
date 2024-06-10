@extends('layouts.admin.main')

@section('content')
    <div class="pagetitle">
        <h1>Transaction</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Admin</a></li>
                <li class="breadcrumb-item active">Transaction</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">List Transaction</h5>
                            <div class="h-10 d-flex align-items-center">
                            </div>
                        </div>
                        <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                            <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered text-center" id="myTableTransaction">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">No Receipt</th>
                                                <th class="text-center">Grand Total</th>
                                                <th class="text-center">No Telp</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Time</th>
                                                <th class="text-center">People</th>
                                                <th class="text-center">Status Transaction</th>
                                                <th class="text-center">Status Payment</th>
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
    {{-- <div class="modal fade" id="editModal" tabindex="-1">
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
    </div> --}}

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
            $('#myTableTransaction').DataTable({
                serverSide: true,
                responsive: true,
                processing: true,
                ajax: '{{ route('admin.transaction.index') }}',
                columns: [{
                        data: 'id_transaction',
                        name: 'id_transaction'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'no_receipt',
                        name: 'no_receipt'
                    },
                    {
                        data: 'grand_total',
                        name: 'grand_total',
                        render: function(data) {
                            return data !== null ? parseInt(data).toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }) : '-';
                        }
                    },
                    {
                        data: 'no_telp',
                        name: 'no_telp'
                    },
                    {
                        data: 'reservation_date',
                        name: 'reservation_date'
                    },
                    {
                        data: 'reservation_time',
                        name: 'reservation_time'
                    },
                    {
                        data: 'reservation_people',
                        name: 'reservation_people'
                    },
                    {
                        data: 'status_transaction',
                        name: 'status_transaction'
                    },
                    {
                        data: 'status_payment',
                        name: 'status_payment'
                    },
                    {
                        data: null,
                        render: function(data) {
                            return '<div class="row justify-content-center">' +
                                '<div class="col-auto">' +
                                '<a href="" class="btn btn-secondary m-1" data-id="' +
                                data.id_transaction + '">' +
                                'Detail' +
                                '</a>' +
                                '</div>' +
                                '</div>';
                        }
                    }
                ]
            });
        });
    </script>
@endsection
