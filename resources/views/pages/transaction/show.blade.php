@extends('layouts.admin.main')

@section('content')
    <div class="pagetitle">
        <h1>Transaction Detail</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Admin</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.transaction.index') }}">Transaction</a></li>
                <li class="breadcrumb-item active">Transaction Detail</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="col-md-6 text-start">
                                <h6 class="card-title text-black pb-0">No. Receipt : {{ $transaction->no_receipt }}</h6>
                                <h6 class="card-title text-black py-0">Customer Name : {{ $transaction->user->name }}</h6>
                                <h6 class="card-title text-black py-0">Customer Email : {{ $transaction->user->email }}</h6>
                                <h6 class="card-title text-black py-0">Customer No. WhatsApp :
                                    {{ $transaction->no_telp }}</h6>
                            </div>
                            <div class="col-md-6 text-start">
                                <h6 class="card-title text-black pb-0">Reservation Date :
                                    {{ $transaction->reservation_date }}</h6>
                                <h6 class="card-title text-black py-0">Reservation Time :
                                    {{ $transaction->reservation_time }}
                                </h6>
                                <h6 class="card-title text-black py-0">Reservation People :
                                    {{ $transaction->reservation_people }}</h6>
                                <h6 class="card-title text-black py-0">Grand Total : Rp
                                    {{ number_format($transaction->grand_total, 2, ',', '.') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                            <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered text-center" id="myTableTransaction">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Image</th>
                                                <th class="text-center">Product</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('admin.transaction.index') }}" class="btn btn-secondary mt-4">Back</a>
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
                ajax: {
                    url: '{{ route('admin.transaction.show', ['id' => ':id']) }}'.replace(':id', window
                        .location
                        .href.split('/').pop()),
                    method: 'GET',
                    dataSrc: 'data'
                },
                columns: [{
                        data: 'id_transaction',
                        name: 'id_transaction'
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
                        data: 'product',
                        name: 'product'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
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
                        data: 'total',
                        name: 'total',
                        render: function(data) {
                            return data !== null ? parseInt(data).toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }) : '-';
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
    </script>
@endsection
