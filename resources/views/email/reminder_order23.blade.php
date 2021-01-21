<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
   <tbody>
      <tr>
         <td align="center" valign="top">
            <div id="x_template_header_image"></div>
            <table border="0" cellpadding="0" cellspacing="0" width="500" id="x_template_container" style="background-color: white; border:1px solid #acacac;">
               <tbody>
                  <tr>
                     <td align="center" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" width="500" id="x_template_header">
                           <tbody>
                              <tr>
                                 <td id="x_header_wrapper" style="padding: 20px; border-bottom: 1px solid #959595; display:block">
                                    <div style="text-align: center;"><a href="{{url('/')}}" target="_blank"><img style="width:70px; height:100px;" src="{{ asset($company->logo_path) }}"/></a></div>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                   </tr>
				   <tr>
                     <td align="center" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" width="500" id="x_template_body">
                           <tbody>
                              <tr>
                                 <td valign="top" id="x_body_content" style="background-color:#fdfdfd">
                                    <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                       <tbody>
                                          <tr>
                                             <td valign="top" style="padding: 25px 50px 0">
                                                <div id="x_body_content_inner" style="color:#424242; font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; font-size:14px; line-height:150%; text-align:left">

													<br>
													<div style="font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; font-weight: bold; font-size: 18px; color: #424242;text-align: center; line-height: 25px;">
														Anda mempunyai 1 jam untuk melakukan pembayaran, jika lewat dari tanggal expired, maka status order ini akan berubah menjadi expired.
														Rincian order dibawah ini :
													  </div>
													  <br>
													<div style=" padding: 0; margin-bottom: 30px; font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; font-size: 14px; color: #2b2b2b;text-align: justify; line-height: 25px;">
														  <table border="0" cellpadding="10" cellspacing="0" width="100%" style="border-top: 1px solid #959595; padding: 20px 0 0 !important; font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; font-size: 14px; color: #424242; line-height: 25px; font-weight: bold;">
															<tbody>
															  <tr>
																<td valign="top" width="190" style="padding: 5px 0;">NOMOR ORDER</td>
																<td valign="top" style="padding: 5px 0;">#{{$order->order_no}}</td>
															  </tr>
															  <tr>
																<td valign="top" width="190" style="padding: 5px 0;">STATUS PEMBAYARAN</td>
																<td valign="top" style="padding: 5px 0;">
																	<div style="color:orange;">Pending</div>
																</td>
															  </tr>
															  <tr>
																<td valign="top" width="190" style="padding: 5px 0;">STATUS PENGIRIMAN</td>
																<td valign="top" style="padding: 5px 0;">
																	<div style="color:orange;">Pending</div>
																</td>
															  </tr>
															</tbody>
														  </table>
													  </div>
													  <div style="border-top: 1px solid #959595; padding: 20px 0; font-weight:normal;" >
														Mohon melakukan konfirmasi pembayaran <a href="{{ url('confirm-payment/'.$order->order_no) }}" style="text-decoration:underline;">disini</a>.
													  </div>
													  <div>
														<table border="0" cellpadding="10" cellspacing="0" width="100%" style="border-top: 1px solid #959595; padding: 20px 0 0; font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; font-size: 14px; color: #424242; line-height: 25px; font-weight: bold;">
														   <tbody>
															  <tr>
																	<td valign="top" style="padding: 5px 0;">RINCIAN ORDER</td>
															  </tr>
														   </tbody>
														</table>
													</div>
													<div>
														<table border="0" cellpadding="10" cellspacing="0" width="100%" style="border: 0; padding-bottom: 0; font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; font-size: 14px; color: #424242; line-height: 25px; font-weight: bold;">
															<tbody>
																<tr>
																	<td valign="top" width="190" style="padding: 5px 0;">NAMA LENGKAP</td>
																	<td valign="top" style="padding: 5px 0; font-weight: normal; font-size: 12px;">{{ ucwords($order->billing_first_name)}} {{ ucwords($order->billing_last_name) }}</td>
																</tr>
																<tr>
																	<td valign="top" width="190" style="padding: 5px 0;">METODE PEMBAYARAN</td>
																	<td valign="top" style="padding: 5px 0; font-weight: normal; font-size: 12px;">Bank Transfer</td>
																</tr>
																<tr>
																	<td valign="top" width="190" style="padding: 5px 0;">METODE SHIPPING</td>
																	<td valign="top" style="padding: 5px 0; font-weight: normal; font-size: 12px;">
																		<div class="checkout-desc">{{ $order->billing_email }}</div>
																		<div class="checkout-desc">{{ $order->billing_phone }}</div>
																		<div class="checkout-desc">{{ ucwords($order->billing_address) }}</div>
																		<div class="checkout-desc">{{ ucwords($order->billing_province->province_name) }}</div>
																		<div class="checkout-desc">{{ ucwords($order->billing_jne_city_label) }}</div>
																		<div class="checkout-desc">Indonesia</div>
																		<div class="checkout-desc">{{ $order->billing_post_code }}</div>
																	</td>
																</tr>
																<tr>
																	<td valign="top" width="190" style="padding: 5px 0;">NAMA LENGKAP</td>
																	<td valign="top" style="padding: 5px 0; font-weight: normal; font-size: 12px;">{{ ucwords($order->shipping_first_name)}} {{ ucwords($order->shipping_last_name) }}</td>
																</tr>
																<tr>
																	<td valign="top" width="190" style="padding: 5px 0;">ALAMAT PENGIRIMAN</td>
																	<td valign="top" style="padding: 5px 0; font-weight: normal; font-size: 12px;">
																		<div class="checkout-desc">{{ $order->shipping_email }}</div>
																		<div class="checkout-desc">{{ $order->shipping_phone }}</div>
																		<div class="checkout-desc">{{ ucwords($order->shipping_address) }}</div>
																		<div class="checkout-desc">{{ ucwords($order->shipping_province->province_name) }}</div>
																		<div class="checkout-desc">{{ ucwords($order->shipping_jne_city_label) }}</div>
																		<div class="checkout-desc">Indonesia</div>
																		<div class="checkout-desc">{{ $order->shipping_post_code }}</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>

                          <div>
														<table border="0" cellpadding="10" cellspacing="0" width="100%" style="border-top: 1px solid #959595; padding: 20px 0; font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; font-size: 14px; color: #424242; line-height: 25px; font-weight: bold;">
															<tbody>
																<tr colspan="3">
																	<td valign="top" width="100%" style="padding: 5px 0;">KERANJANG ANDA</td>
																</tr>
                                @php $price = 0; @endphp
                                @php $subtotal=0; @endphp
																@foreach($details as $detail)
																@php $price = $detail->price - $detail->discount_amount; @endphp
																	<tr>
																		<td style="padding: 0;">
																			<table border="0" cellpadding="10" cellspacing="0" width="100%" style="border-bottom: 1px solid #c6c6c6; padding: 15px 0;">
																				<tbody>
																					<tr>
																						<td valign="top" width="100" style="padding: 5px 0;"><img src="{{ url(explode("::",$detail->image_path)[0]) }}" style="width:80px;"/></td>
																						<td valign="top" style="padding: 5px 0 0;">
																							<div>{{ $detail->product_name }}</div>
																							<div style="font-size: 13px; color: #757575; font-style: italic; margin: 10px 0 5px;">IDR {{number_format($price)}}</div>
																							<table>
																								<tbody>
																									<tr>
																										<td valign="middle" width="50" style="padding: 5px 0;font-size: 13px; color: #757575;">Warna</td>
																										<td valign="middle" style="padding: 5px 0;font-size: 13px; color: #757575;">{{ $detail->color }}</td>
																									</tr>
																								</tbody>
																							</table>
																							<table>
																								<tbody>
																									<tr>
																										<td valign="bottom" width="50" style="padding: 5px 0;font-size: 13px; color: #757575;">Qty</td>
																										<td valign="bottom" style="padding: 5px 0;font-size: 13px; color: #757575;">{{ $detail->quantity }}</td>
																									</tr>
																								</tbody>
																							</table>
                                              <table>
																								<tbody>
																									<tr>
																										<td valign="bottom" width="50" style="padding: 5px 0;font-size: 13px; color: #757575;">Berat</td>
																										<td valign="bottom" style="padding: 5px 0;font-size: 13px; color: #757575;">{{ $detail->weight * $detail->quantity }}</td>
																									</tr>
																								</tbody>
																							</table>
																						</td>
																						<td valign="bottom" width="150" style="padding: 5px 0;"><div style="text-align: right; font-size: 14px; font-weight: bold;">IDR {{ number_format($detail->quantity * $price) }}</div></td>
																					</tr>
																				</tbody>
																			</table>
																		</td>
																	</tr>
																@php $subtotal += $detail->quantity * $price; @endphp
																@endforeach
															</tbody>
														</table>
													</div>
                          @php $tax = ($order->tax_vat * $subtotal /100); @endphp
                          @if($order->free_shipping > $order->jne_shipping_value)
                            @php $grandtotal = $subtotal + $tax; @endphp
                          @else
          	                 @php $grandtotal = $subtotal + $tax + $order->jne_shipping_value - $order->free_shipping; @endphp
                          @endif
                          <div>
														<table border="0" cellpadding="10" cellspacing="0" width="100%" style="border: 0; padding-bottom: 0; font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; font-size: 14px; color: #424242; line-height: 25px; font-weight: bold;">
															<tbody>
																<tr>
																	<td valign="top" style="padding: 5px 0;">SUBTOTAL</td>
																	<td valign="top" style="padding: 5px 0; font-weight: normal; font-size: 12px; text-align: right;">IDR {{ number_format($subtotal) }}</td>
																</tr>
                                @if($order->tax_vat)
                                <tr>
                                  <td valign="top" style="padding: 5px 0;">TAX</td>
                                  <td valign="top" style="padding: 5px 0; font-weight: normal; font-size: 12px; text-align: right;">IDR {{ number_format($tax) }}</td>
                                </tr>
                                @endif
																<tr>
																	<td valign="top" style="padding: 5px 0;">BIAYA PENGIRIMAN</td>
                                  @if($order->free_shipping > $order->jne_shipping_value)
																	  <td valign="top" style="padding: 5px 0; font-weight: normal; font-size: 12px; text-align: right;">IDR {{ number_format(0) }}</td>
                                  @else
                                    <td valign="top" style="padding: 5px 0; font-weight: normal; font-size: 12px; text-align: right;">IDR {{ number_format($order->jne_shipping_value - $order->free_shipping) }}</td>
                                  @endif
																</tr>
															</tbody>
														</table>
													</div>
													<div style="margin: 10px 0 30px;">
														<table border="0" cellpadding="0" cellspacing="0" width="100%" id="x_template_header" style="border: 0; padding: 10px 15px; background: #424242; color:white; border-bottom:0; line-height:100%; vertical-align:middle; font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; font-size: 14px;">
															<tbody>
																<tr>
																	<td valign="center">TOTAL</td>
																	<td valign="center" style="font-size: 12px; text-align: right;">IDR {{number_format($grandtotal)}}</td>
																</tr>
															</tbody>
														</table>
													</div>

                                                </div>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
				@include('email/footer')
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
