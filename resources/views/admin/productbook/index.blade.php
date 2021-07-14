@extends('admin.layout.layout')

@section('content')
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Serial No</th>
                <th scope="col">Product Name</th>
                <th scope="col">User Name</th>
                <th scope="col">Qty</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Payment Status</th>
                <th scope="col">Booking Status</th>

                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($booking_products as $key => $booking_product)
                <tr>
                    <th>{{ $key + 1 }}</th>
                    <td>{{ $booking_product->product->name }}</td>
                    <td>{{ $booking_product->user->name }}</td>
                    <td>{{ $booking_product->qty }}</td>
                    <td>{{ $booking_product->qty * $booking_product->product->price }}</td>
                    <td>{{ $booking_product->payment_status }}</td>
                    <td>
                        <Select class="book_status" data-id="{{ $booking_product->id }}">
                            <option value="0" @if ($booking_product->booking_status == '0') selected @endif>In Progress</option>
                            <option value="1" @if ($booking_product->booking_status == '1') selected @endif>Booking Cancel</option>
                            <option value="2" @if ($booking_product->booking_status == '2') selected @endif>Booked</option>
                        </Select>
                    </td>
                    <td><a href="{{ url('/booking/delete/' . $booking_product->id) }}"
                            style="font-size:17px;padding:5px"><i class="fa fa-trash"></i></a></td>
                </tr>

            @endforeach



        </tbody>
    </table>
@endsection
@push('footer-script')
    <script>
        $(document).ready(function() {
            $('.book_status').on('change', function() {
                //var booking_status=$(this).val();
                console.log("click");
                alert("booking_status");
                var id = $(this).data('id');
                // $.ajax({
                //     url:'{{ route('booking.product.status') }}',
                //     data:{
                //         'booking_status	':booking_status,
                //         'id':id,
                //     }

                // });
            });


         

        });
    </script>
@endpush
