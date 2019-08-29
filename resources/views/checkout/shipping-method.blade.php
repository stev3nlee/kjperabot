<div class="home-new-product content">
	<div class="container">
			<div class="title"> Metode Pengiriman </div>

			<label>Dari : {{ $jne[0]->origin_name }} - {{ $jne[0]->destination_name }} ( {{$total_weight}} KG )</label><br>
				@foreach($jne as $option)
					@if( $option->service_display == "REG" or $option->service_display == "OKE" or $option->service_display == "YES"
							or $option->service_display == "CTC" or $option->service_display == "CTCOKE" or $option->service_display == "CTCYES")

							@if($option->service_display == "CTC")
								@php $service_display = "REG"; @endphp
							@elseif($option->service_display == "CTCOKE")
								@php $service_display = "OKE"; @endphp
							@elseif($option->service_display == "CTCYES")
								@php $service_display = "YES"; @endphp
							@else
								@php $service_display = $option->service_display; @endphp
							@endif
						<div class="col-md-4">
							<div class="option-check">
								<input type="radio" class="radio-opt" name="shipping" value="{{ $service_display }}" @if($loop->index ==0) checked @endif />

								<label class="radio" >{{ $service_display }} @if($option->etd_from != null) ( {{ $option->etd_from }} - {{ $option->etd_thru }} Day) @endif <label>Rp. {{ number_format($option->price) }}</label><br></label>

							</div>
						</div>
						<input type="hidden" name="shipping_price_{{$service_display}}" value="{{$option->price}}"/>
					@endif
				@endforeach
	</div>
</div>
<script>
$('.option-check').click(function(){
	$('.radio-opt').removeAttr('checked',false);
	$(this).find('.radio-opt').prop('checked',true);
});
</script>
