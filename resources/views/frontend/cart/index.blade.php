@extends('frontend.layout')

@section('title', 'Shopping cart')
@section('content')
<div class="row">
    <div class="col">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th> QTY</th>
                    <th>Price</th>
                    <th>Money</th>
                    <th width="5%" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($carts as $key => $item)
                <tr>
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>
                        <img src="{{ $item['options']['image'] }}" />
                    </td>
                    <td>
                        <input type="number" class="qty_{{ $item['rowId'] }}" value="{{ $item['qty'] }}"/>
                    </td>
                    <td>
                        {{ number_format($item['price']) }}
                    </td>
                    <td>
                        {{ number_format($item['subtotal']) }}
                    </td>
                    <td>
                        <button id={{ $item['rowId'] }} type="button" class="btn btn-primary btn-sm update-cart">update</button>
                    </td>
                    <td>
                        <a href="{{ route('frontend.remove.cart',['rowid' => $item['rowId']]) }}" class="btn btn-danger btn-sm">remove</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">Tong tien</td>
                    <td colspan="3"> {{ Cart::subtotal() }} </td>
                </tr>
                <tr>
                    <td colspan="8">
                        <a href="{{ route('frontend.delete.cart') }}" class="btn btn-primary">Delete Cart</a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
@push('javascripts')
<script type="text/javascript">
    $(function() {
        $('.update-cart').on('click', function(){
            let sefl = $(this);
            let rowId = $.trim(sefl.attr('id'));
            let qty = $('.qty_'+rowId).val().trim();
            $.ajax({
                url: "{{ route('frontend.update.cart') }}",
                type: "GET",
                data: { qty: qty, rowid: rowId },
                beforeSend: function(){
                    sefl.text('Loading ...');
                },
                success: function(res) {
                    sefl.text('update');
                    if(res.cod === 200){
                        window.location.reload(true);
                    } else {
                        alert('Something went wrong');
                    }
                }
            })
        });
    });
</script>
@endpush