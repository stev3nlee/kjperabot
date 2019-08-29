@extends('layout4')

@section('content')

	<div class="home-new-product member">
		<div class="container">
			<div class="title"> Profile Saya </div>

			@include ('member/menu')
          @include('errorfile')
					<table id="table-order" class="wishlist table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width="70">Gambar</th>
								<th>Nama Produk</th>
								<th width="200">Stok</th>
								<th width="350"></th>
							</tr>
						</thead>
						<tbody>
              @if(count($wishlists) >0)
              @foreach($wishlists as $wishlist)
							<tr>
								<td><img src="{{ asset(explode("::",$wishlist->image_path)[0]) }}" class="img-responsive"></td>
								<td>
									<div class="wish-header">{{$wishlist->product_name}}</div>
									<div class="wish-desc">Rp {{ number_format($wishlist->sale == 0 ? $wishlist->product_price : $wishlist->product_price - ($wishlist->product_price * $wishlist->sale / 100)) }}</div>
								</td>
								<td>
									<div class="wish-header">Stok</div>
                  @if($wishlist->total_stock > 0)
									<div class="wish-desc">Ada Stok</div>
                  @else
                  <div class="wish-desc red">Stok Habis</div>
                  @endif
								</td>
								<td>
                  <a href="{{ url('/product-detail/'.$wishlist->slug) }}" class="btn btn-wish"> LIHAT PRODUK </a>
                  <a onclick="delete_wishlist({{$wishlist->wishlist_id}})" class="btn btn-wish red"> HAPUS </a>
								</td>
							</tr>
              @endforeach
              @endif
						</tbody>
					</table>
          <form style="display:none" id="frm-wishlist" method="post" action="{{url('wishlist/delete')}}">
            {{csrf_field()}}
            <input type="hidden" name="id" value="" id="wishlist_id">
          </form>
		</div>
	</div>

@stop

@section('script')
<script>
$(function() {
	$('#wishlist').addClass ('active');
});
function delete_wishlist(id)
{
  $('#wishlist_id').val(id);
  $('#frm-wishlist').submit();
}
</script>
@stop
