@extends('layout4')

@section('content')

	<div class="home-new-product member">
		<div class="container">
			<div class="title"> Latest Article </div>
			<div class="main-art">
				<div class="">
					<img src="{{ asset($article->image_path) }}" class="img-responsive" />
				</div>
				<div class="row mt20">
					<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="article-date">{{ date("d F Y H:i",strtotime($article->created_at)) }}</div>
					</div>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<div class="article-name">{{ $article->article_name }}</div>
						<div class="article-desc bodytext">
							{!! $article->article_content !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop
