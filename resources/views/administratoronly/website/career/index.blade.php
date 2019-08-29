@extends('administratoronly/layout')
@section('content')

	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Website</a><span class="m10"> > </span><span class="active">Career</span>
				</div>

				@include('errorfile')
			<form method="post" action="{{ url('administratoronly/website/career/save') }}">
				{{ csrf_field() }}
				<div class="row clearfix">
					<div class="wdth50">
						<div class="form-group">
							<label>Paragraph <span class="red">*</span></label>
							<textarea class="form-control" name="page_description">{!! $page->page_description !!}</textarea>
						</div>
					</div>
				</div>
				<input type="submit" class="btn btn-pop" value="Save">
			</form>
		</div>
		<div class="border-line"></div>
		<div class="clearfix">
			<div class="pull-right">
				<a href="{{ url('/administratoronly/website/career/add') }}"><button type="button" class="btn btn-auto">Add</button></a>
			</div>
		</div>
		<div class="adminTable">
			<table id="table_id">
				<thead>
					<tr>
						<td width="50">No</td>
						<td>Job Name</td>
						<td width="250">Date</td>
						<td width="150" class="text-center">Publish</td>
						<td width="150">
							<div class="text-center">Action</div>
						</td>
					</tr>
				</thead>
				<tbody>
					@foreach($careers as $career)
						<tr>
							<td>{{ $loop->index+1 }}</td>
							<td>{{ $career->job_name }}</td>
							<td>{{ date("d F Y",strtotime($career->created_at)) }}</td>
							<td>
								@if($career->is_publish == 1)
								<div class="img-auto">
									<div class="icon-correct"></div>
								</div>
								@else
									<div class="img-auto">
										<div class="icon-incorrect"></div>
									</div>
								@endif
							</td>
							<td class="text-center">
								<a href="{{ url('/administratoronly/website/career/view/'.$career->id) }}">
									<div class="img-view"></div>
								</a>
								<a href="{{ url('/administratoronly/website/career/edit/'.$career->id) }}">
									<div class="img-edit"></div>
								</a>
								<a class="fancybox deleteClick" href="#deleteGallery" data-id="{{$career->id}}">
									<div class="img-delete"></div>
								</a>
							</td>
						</tr>
					@endforeach
					</tbody>
					<tfoot></tfoot>
				</table>


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
			<form action="{{url('administratoronly/website/career/delete')}}" method="post">
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
	$('#career').addClass ('active');
});
//comment line 1950
$("a.fancybox").fancybox('#deleteGallery');

$('.deleteClick').click(function(){
	var id = $(this).attr('data-id');
	$('#deleteID').val(id)
})
</script>
@stop
