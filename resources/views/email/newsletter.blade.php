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
                                 <td id="x_header_wrapper" style="padding: 25px 20px; border-bottom: 1px solid #959595; display:block">
                                    <div style="text-align: center;"><a href="{{url('/')}}" target="_blank"><img style="width:200px; height:67px;" src="{{ asset($company->logo_path) }}"/></a></div>
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
													<!--<div style="text-align: center;"><img src="{{ url('icons/email-contact.png') }}"/></div>-->
													<br>
                          <div style="font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; font-weight: bold; font-size: 18px; color: #424242;text-align: center; line-height: 25px;">
                            {{ $data['campaign_name'] }}
                          </div>
                          <br>
                          @if($data['campaign_image'] != null)
                          <div style="font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; font-weight: bold; font-size: 18px; color: #424242;text-align: center; line-height: 25px;">
                            <img src="{{ url($data['campaign_image']) }}" style="max-width: 100%; width: 80px;"/>
                          </div>
                          @endif
                          <br>
													<div style=" padding: 0; margin-bottom: 30px; font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; font-size: 14px; color: #2b2b2b;text-align: justify; line-height: 25px;">
                            {!! $data['template'] !!}
                          </div>
                          @if($data['hide_product'] == 0)
                          <div style=" padding: 0; margin-bottom: 30px; font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; font-size: 14px; color: #2b2b2b;text-align: justify; line-height: 25px;">
                            <table border="0" cellpadding="10" cellspacing="0" width="100%" style="border: 0; padding: 25px 0; font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; font-size: 14px; color: #424242; line-height: 25px; font-weight: bold;">
                              <tbody>
                                @php $x = 1; @endphp
                                @foreach($data['products'] as $product)
                                @if($x==1 or $x==4) <tr> @endif
                                  <td valign="top" width="130" style="padding: 0 5px 20px;">
                                    <a href="{{ url('detail/'.$product->slug) }}" target="_blank" style="display: block; font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; font-size: 12px; color: #424242; line-height: 21px; text-decoration: none;">
                                      <div><img src="{{ url(explode('::',$product->image_path)[0]) }}" style="max-width: 100%; width: 80px;"/></div>
                                      <div style="margin: 10px 0 0;color: #1196d2;">{{ $product->product_name }}</div>
                                      <div>IDR {{ number_format($product->product_price - ($product->product_price * $product->sale/100)) }}</div>
                                    </a>
                                  </td>
                                @if($x==3 or $x==6) </tr> @endif
                                @php $x++; @endphp
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                          @endif
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
