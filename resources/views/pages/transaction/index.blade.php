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
                        data: 'status_transaction',
                        name: 'status_transaction',
                        render: function(data) {
                            if (data == 'Pending') {
                                return '<span class="badge text-bg-warning text-white">' + data +
                                    '</span>';
                            } else if (data == 'Process') {
                                return '<span class="badge text-bg-secondary text-white">' + data +
                                    '</span>';
                            } else if (data == 'Completed') {
                                return '<span class="badge text-bg-success text-white">' + data +
                                    '</span>';
                            } else {
                                return '<span class="badge text-bg-danger text-white">' + data +
                                    '</span>';
                            }
                        }
                    },
                    {
                        data: 'status_payment',
                        name: 'status_payment',
                        render: function(data) {
                            if (data == 'Pending') {
                                return '<span class="badge text-bg-warning text-white">' + data +
                                    '</span>';
                            } else if (data == 'Paid') {
                                return '<span class="badge text-bg-success text-white">' + data +
                                    '</span>';
                            } else {
                                return '<span class="badge text-bg-danger text-white">' + data +
                                    '</span>';
                            }
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            if (data.status_payment == 'Pending') {
                                return '<div class="row justify-content-center">' +
                                    '<div class="col-auto">' +
                                    '<button type="button" class="btn btn-primary m-1" onclick="confirm(' +
                                    data.id_transaction + ')" ' +
                                    'data-id="' + data.id_transaction + '">' +
                                    'Confirm' +
                                    '</button>' +
                                    '<a href="{{ route('admin.transaction.show', '') }}/' + data
                                    .id_transaction +
                                    '" class="btn btn-secondary m-1" ' +
                                    'data-id="' + data.id_category + '">' +
                                    'Detail' +
                                    '</a>' +
                                    '</div>' +
                                    '</div>';
                            } else {
                                return '<div class="row justify-content-center">' +
                                    '<div class="col-auto">' +
                                    '<a href="{{ route('admin.transaction.show', '') }}/' + data
                                    .id_transaction +
                                    '" class="btn btn-secondary m-1" ' +
                                    'data-id="' + data.id_category + '">' +
                                    'Detail' +
                                    '</a>' +
                                    '</div>' +
                                    '</div>';
                            }
                        }
                    }
                ],
                rowCallback: function(row, data, index) {
                    var dt = this.api();
                    $(row).attr('data-id', data.id);
                    $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                }
            });
        });

        function confirm(id) {
            Swal.fire({
                title: 'Warning',
                text: "Confirm to the next transaction process?",
                icon: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                showDenyButton: true,
                confirmButtonColor: '#3085d6',
                denyButtonColor: '#d33',
                confirmButtonText: 'Accept',
                denyButtonText: 'Cancel',
                cancelButtonText: 'Back'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('admin/transaction/confirm') }}/" + id,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                'Transaction accepted!',
                                'Data received successfully.',
                                'success'
                            );
                            $('#myTableTransaction').DataTable().ajax.reload();
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
                        url: "{{ url('admin/transaction/cancel') }}/" + id,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                'Transaction cancelled!',
                                'Data cancelled successfully.',
                                'success'
                            );
                            $('#myTableTransaction').DataTable().ajax.reload();
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
