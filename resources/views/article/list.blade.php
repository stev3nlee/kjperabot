@extends('layout4')

@section('content')

	<div class="home-new-product member">
		<div class="container">
			<div class="title"> Latest Article </div>
			@if(count($articles) > 0)
			@foreach($articles as $article)
				@php $words=implode(' ', array_slice(explode(' ', strip_tags($article->article_content)), 0, 70)); @endphp
				@if($loop->index == 0)
					<div class="main-art">
						<div class="">
							<img src="{{ asset($article->image_path) }}" class="img-responsive" />
						</div>
						<div class="row mt20">
							<div class="col-md-3 col-sm-3 col-xs-12">
								<div class="article-date">{{ date("d F Y, H:i",strtotime($article->created_at)) }}</div>
							</div>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<div class="article-name">{{ $article->article_title }}</div>
								<div class="article-desc">{!! $words !!}</div>
								<div class="mt20">
									<span class="checkout"> <a href="{{ url('/article-detail/'.$article->article_slug) }}" class="btn btn-checkout"> LANJUT </a>
								</div>
							</div>
						</div>
					</div>
				@else
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="art-box-box">
									<div class="article-box">
										<img src="{{ asset($article->image_path) }}" class="img-responsive" />
										<div class="article-inside-box">
											<span class="article-date">{{ date("d F Y",strtotime($article->created_at)) }}</span>
										</div>
									</div>
									<div class="article-name">{{ $article->article_title }}</div>
									<div class="article-desc">{!! $words !!}</div>
									<div class="mt20">
										<span class="checkout"> <a href="{{ url('/article-detail/'.$article->article_slug) }}" class="btn btn-checkout"> LANJUT </a>
									</div>
								</div>
							</div>
				@endif
			@endforeach

			<div class="row"></div>
			<div class="pagination-holder clearfix">
				<div id="light-pagination" class="pagination"></div>
			</div>
			@else
				On Progress
			@endif
		</div>
	</div>

@stop

@section('script')
<script>
$(function(){
	$('.pagination').pagination({
			items: '{{$articles->total()}}',
			itemsOnPage: '5',
			currentPage:'{{$articles->currentPage()}}',
			hrefTextPrefix:'?page=',
			hrefTextSuffix:'',
	});
});

</script>
@stop
