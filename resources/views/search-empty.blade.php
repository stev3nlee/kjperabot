@extends('layout')

@section('content')


	<div class="home-new-product content">
		<div class="container">
      <form action="{{url('search')}}" method="get">
			<div class="">
				<div class="title"> Hasil Pencarian : "<span class="italic">{{ $search }}</span>" </div>
				<div class="sub-title-success"> Daftar hasil pencarian tidak ditemukan. Mohon mengisi nama produk lain.  </div>
				<div> <input type="text" placeholder="Cari Nama Produk..." name="q" class="form-control input-search"> </div>
			</div>
			<div class="checkout">
				<span class="to-home"> <input type="submit" class="btn btn-checkout" value="CARI"/> </span>
			</div>
    </form>
		</div>
	</div>


@stop
