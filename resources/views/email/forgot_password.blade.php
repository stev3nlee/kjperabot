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
													<div style="font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; font-weight: bold; font-size: 20px; color: #424242;text-align: center; line-height: 25px;">Forgot Password</div><br>
													<div style="text-align: center;"><img src="{{ asset('assets/images/email/accountactivation.png') }}" style="width: 70px;"/></div>
													<br>
													<div style="font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; font-size: 14px; color: #424242;text-align: center; line-height: 25px; margin-bottom: 20px;">
														<div>Lupa kata sandi anda?</div>
														<div>KJ Perabot telah terima sebuah request untuk menggantikan password di email ini</div>
													</div>
													<a href="{{ url('forget/'.$private_token) }}" target="_blank" style="display: block; text-decoration: none; ">
														<div style="font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; background: #222; color: white; display: block; width: 150px; border-radius: 5px; font-size: 14px; margin: 0 auto; padding: 12px 5px; text-align: center; cursor:pointer;">Password Baru</div>
													</a><br/><br/>																						
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
