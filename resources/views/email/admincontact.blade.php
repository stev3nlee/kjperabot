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
                                    <div style="text-align: center;"><a href="{{url('/')}}" target="_blank"><img style="width:70px;" src="{{ asset($company->logo_path) }}"/></a></div>
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
													<div style="font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; font-weight: bold; font-size: 18px; color: #424242;text-align: center; line-height: 25px;">Someone has left you message</div><br>
													<div style="margin: 30px 0 20px;">
														<table border="0" cellpadding="10" cellspacing="0" width="100%" id="x_template_footer">
														   <tbody>
															  <tr>
																 <td valign="top" style="padding:0; -webkit-border-radius:6px">
																	<table border="0" cellpadding="10" cellspacing="0" width="100%" style="border-top: 1px solid #959595; padding: 20px 0 0 !important; font : 300 14px/18px 'Lucida Grande', Lucida Sans, Lucida Sans Unicode, sans-serif, Arial, Helvetica, Verdana, sans-serif; font-size: 14px; color: #424242; line-height: 25px; font-weight: bold;">
																		<tbody>
																			<tr>
																				<td valign="top" width="190" style="padding: 5px 0;">Nama Lengkap</td>
																				<td valign="top" style="padding: 5px 0;">: {{ ucwords($data['full_name']) }} </td>
																			</tr>
																			<tr>
																				<td valign="top" width="190" style="padding: 5px 0;">Email</td>
																				<td valign="top" style="padding: 5px 0;">: {{ $data['email'] }}</td>
																			</tr>
                                                                            <tr>
																				<td valign="top" width="190" style="padding: 5px 0;">Topik</td>
																				<td valign="top" style="padding: 5px 0;">: {{ ucwords($data['topic_name']) }}</td>
																			</tr>
																			<tr>
																				<td valign="top" width="190" style="padding: 5px 0;">Message</td>
																				<td valign="top" style="padding: 5px 0;">: {{ ucwords($data['message']) }}</td>
																			</tr>
																		</tbody>
																	</table>
																 </td>
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
