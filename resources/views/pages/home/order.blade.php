@extends('layouts.home.app')

@section('title', 'Pesanan')

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
            </section><!-- End Menu Section -->
            {{-- 
            <div class="container">
                <form action="{{ route('customer.reservation.process') }}" method="POST" id="reservation-form">
                    @csrf
                    <!-- ======= Why Us Section ======= -->
                    <section id="why-us" class="why-us">
                        <div class="container" data-aos="fade-up">

                            <div class="section-title">
                                <h2>Paket Reservasi</h2>
                                <p>Silahkan pilih menu dari kami</p>
                            </div>

                            <div class="row">
                                <div class="col-md-6 d-flex justify-content-center">
                                    <div data-aos="zoom-in" data-aos-delay="100">
                                        <h3 class="text-center mb-4">Paket Ijen</h3>
                                        <div class="col">
                                            @foreach ($products as $item)
                                                @if ($item->packageType == 'Paket Ijen')
                                                    <div class="form-group d-flex justify-content-between my-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="{{ $item->id_product }}" id="flexCheckDefault"
                                                                name="paket_{{ $item->id_product }}">
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                {{ $item->name }}
                                                            </label>
                                                            <input class="form-control-sm bl-4" type="number"
                                                                min="1" name="qty_{{ $item->id_product }}"
                                                                placeholder="0">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 d-flex justify-content-center">
                                    <div data-aos="zoom-in" data-aos-delay="100">
                                        <h3 class="text-center mb-4">Paket Kembul</h3>
                                        <div class="col">
                                            @foreach ($products as $item)
                                                @if ($item->packageType == 'Paket Kembulan')
                                                    <div class="form-group d-flex justify-content-between my-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="{{ $item->id_product }}" id="flexCheckDefault"
                                                                name="paket_{{ $item->id_product }}">
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                {{ $item->name }}
                                                            </label>
                                                            <input class="form-control-sm bl-4" type="number"
                                                                min="1" name="qty_{{ $item->id_product }}"
                                                                placeholder="0">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!-- End Why Us Section -->

                    <!-- ======= Book A Table Section ======= -->
                    <section id="book-a-table" class="book-a-table">
                        <div class="container" data-aos="fade-up">

                            <div class="section-title">
                                <h2>Reservasi</h2>
                                <p>Pesan Meja</p>
                            </div>


                            <div class="row">
                                <div class="col-lg-4 col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Nama" data-rule="minlen:4"
                                        data-msg="Silakan masukkan setidaknya 4 karakter" value="{{ Auth::user()->name }}"
                                        required>
                                    <div class="validate"></div>
                                </div>
                                <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Email" data-rule="email" data-msg="Tolong masukkan email yang benar"
                                        value="{{ Auth::user()->email }}" readonly required>
                                    <div class="validate"></div>
                                </div>
                                <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0">
                                    <input type="text" class="form-control" name="phone" id="phone"
                                        placeholder="No. WhatsApp" data-rule="minlen:9"
                                        data-msg="Silakan masukkan setidaknya 9 karakter" required>
                                    <div class="validate"></div>
                                </div>
                                <div class="col-lg-4 col-md-6 form-group mt-3">
                                    <input type="date" name="date" class="form-control" id="date"
                                        placeholder="Date" data-rule="minlen:4" data-msg="Please enter at least 4 chars"
                                        required>
                                    <div class="validate"></div>
                                </div>
                                <div class="col-lg-4 col-md-6 form-group mt-3">
                                    <input type="time" class="form-control" name="time" id="time"
                                        placeholder="Time" data-rule="minlen:4" data-msg="Please enter at least 4 chars"
                                        required>
                                    <div class="validate"></div>
                                </div>
                                <div class="col-lg-4 col-md-6 form-group mt-3">
                                    <input type="number" class="form-control" name="people" id="people"
                                        placeholder="# of people" min="1" data-rule="minlen:1"
                                        data-msg="Please enter at least 1 chars" required>
                                    <div class="validate"></div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>
                                <div class="validate"></div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn" id="pay-button">Daftar Reservasi</button>
                            </div>

                        </div>
                    </section>
                </form>

            </div> --}}
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
                            if (data.status_transaction == 'Process') {
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

        $('#myTableOrder tbody').on('click', '.pay-button', function(event) {
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
                });
        });
    </script>
@endsection
