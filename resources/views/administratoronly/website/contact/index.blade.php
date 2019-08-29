@extends('administratoronly/layout')
@section('content')

	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Website</a><span class="m10"> > </span><span class="active">Contact</span>
				</div>
				<div class="adminTable">
					@include('errorfile')
					<table id="table_id">
						<thead>
							<tr>
								<td>No</td>
								<td>Full Name</td>
								<td>Email Address</td>
								<td>Topic</td>
								<td>Message</td>
								<td width="70" class="text-center">Action</td>
							</tr>
						</thead>
						<tbody>
							@foreach($inboxes as $inbox)
							 <tr>
								<td>{{$loop->index+1}}</td>
								<td>{{ $inbox->name }}</td>
								<td>{{ $inbox->email }}</td>
								<td>{{ $inbox->topic }}</td>
								<td>{{ $inbox->message }}</td>
								<td class="text-center">
									<a class="fancybox delInbox" href="#deleteGallery" data-id="{{$inbox->id}}">
										<div class="img-delete"></div>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot></tfoot>
					</table>
				</div>
				<div class="clearfix">
					<div class="pull-left">
						<div class="title" style="margin-top:50px;">Contact Detail</div>
					</div>
				</div>
				<form method="post" action="{{ url('administratoronly/website/contact/edit') }}">
					{{csrf_field()}}
					<div class="form-group">
						<label>Opening Hours <span class="red">*</span></label>
						<input type="text" class="form-control width500" name="opening_hours" value="{{$company->opening_hour}}"/>
					</div>
					<div class="form-group">
						<label>Email Address <span class="red">*</span></label>
						<input type="text" class="form-control width500" name="email" value="{{$company->email}}"/>
					</div>
					<div class="form-group">
						<label>Whatsapp <span class="red">*</span></label>
						<input type="text" class="form-control width500" name="whatsapp" value="{{$company->whatsapp}}"/>
					</div>
					<div class="form-group">
						<label>Instagram <span class="red">*</span></label>
						<textarea id="mceEdit" class="form-control" style="width:500px;" name="support" />{{$company->support}}</textarea>
					</div>
					<div class="form-group">
						<label>Company Address <span class="red">*</span></label>
						<textarea id="mceFixed" class="form-control" style="width:500px;" name="address" />{{$company->address}}</textarea>
					</div>
					<div>
						<button type="submit" class="btn btn-pop">Save</button>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>

<!-- DELETE -->
<div id="deleteGallery" class="width-delete">
	<div class="pad-pop">
		<div class="title-pop">DELETE</div>
		<div class="img-pop">
			<div class="pop-delete"></div>
		</div>
		 <div class="text-center">
			<form action="{{url('/administratoronly/website/contact/delete')}}" method="post">
				{{csrf_field()}}
				<input type="hidden" required name="id" id="deleteID"/>
				<div class="inline">
					<input type="submit" class="btn btn-sure" value="Yes"/>
				</div>
				<div class="inline">
					<button class="btn btn-cancel no-popup" type="button">No</button>
				</div>
			</form>
		</div>
	</div>
</div>
@stop
@section('script')
<script>
$(function() {
	$('#contact').addClass ('active');
});
//comment line 1950
$("a.fancybox").fancybox('#deleteGallery');

$('.delInbox').click(function(){
	var id = $(this).attr('data-id');
	$('#deleteID').val(id)
})
</script>
@stop
