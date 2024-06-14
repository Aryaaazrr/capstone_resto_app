@extends('layouts.home.app')

@section('title', 'Pesanan')

@section('head-scripts')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
@endsection

@section('content')
    <main id="main">
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Pesanan</h2>
                    <ol>
                        @if (Auth::user())
                            <li><a href="{{ route('customer.index') }}">Home</a></li>
                        @else
                            <li><a href="{{ route('home') }}">Home</a></li>
                        @endif
                        <li>Pesanan</li>
                    </ol>
                </div>

            </div>
        </section>

        <section class="inner-page">
            <!-- ======= Menu Section ======= -->
            <section id="menu" class="menu section-bg">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>Daftar Pesananmu</h2>
                        <p>Terima Kasih Pesanannya</p>
                    </div>

                    <div class="row " data-aos="fade-up" data-aos-delay="200">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center text-white" id="myTableOrder">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">No Receipt</th>
                                        <th class="text-center">Grand Total</th>
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
            </section>
        </section>

    </main>

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
            $('#myTableOrder').DataTable({
                serverSide: true,
                responsive: true,
                processing: true,
                ajax: '{{ route('customer.order') }}',
                columns: [{
                        data: 'id_transaction',
                        name: 'id_transaction'
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
                            if (data.status_payment == 'Settlement') {
                                return '<div class="row justify-content-center">' +
                                    '<div class="col-auto">' +
                                    '<span class="badge bg-success text-light">Thanks For Order' +
                                    '</span>' +
                                    '</div>' +
                                    '</div>';
                            } else if (data.status_payment == 'Expire') {
                                return '<div class="row justify-content-center">' +
                                    '<div class="col-auto">' +
                                    '<span class="badge bg-danger text-light">Order Failed' +
                                    '</span>' +
                                    '</div>' +
                                    '</div>';
                            } else if (data.status_transaction == 'Process') {
                                return '<div class="row justify-content-center">' +
                                    '<div class="col-auto">' +
                                    '<button class="btn btn-warning m-1" id="pay-button" data-id="' +
                                    data.id_transaction + '">' +
                                    'Pay Now' +
                                    '</button>' +
                                    '</div>' +
                                    '</div>';
                            } else {
                                return '<div class="row justify-content-center">' +
                                    '<div class="col-auto">' +
                                    '<span class="badge bg-warning text-dark">Waiting for confirmation' +
                                    '</span>' +
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

        $('#myTableOrder tbody').on('click', '#pay-button', function(event) {
            var transactionId = $(this).data('id');

            fetch('{{ route('customer.reservation.getToken') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        id_transaction: transactionId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.snap_token) {
                        snap.pay(data.snap_token);
                    } else {
                        alert('Error getting Snap token');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to fetch Snap token');
                });
        });
    </script>
@endsection
