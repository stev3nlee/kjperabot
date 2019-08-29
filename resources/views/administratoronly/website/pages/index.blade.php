@extends('administratoronly/layout')
@section('content')
	<div class="clearfix">
		@include('administratoronly/menu')
		<div class="box-right">
			<div class="content">
				<div class="breadcrumb">
					<a>Website</a><span class="m10"> > </span><span class="active">Pages</span>
				</div>
				<div class="title">Pages</div>
				<div class="table-role">
					@include('errorfile')
					<table>
						<thead>
							<tr>
								<td>Page</td>
								<td width="150"><div class="text-center">Action</div></td>
							</tr>
						</thead>
						<tbody>
							@foreach($pages as $page)
							<tr>
								<td>{{ $page->page_title }}</td>
								<td class="text-center">
									<a href="{{ url('/administratoronly/website/pages/view/'.$page->id ) }}" class="link"><div class="img-view"></div></a>
									<a href="{{ url('/administratoronly/website/pages/edit/'.$page->id ) }}" class="link"><div class="img-edit"></div></a>
								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot></tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop
@section('script')
<script>
$(function() {
	$('#pages').addClass ('active');
});
</script>
@stop
