@extends('layout')

@section('content')

	<div class="home-new-product content">
		<div class="container">
			<div class="contact">
				<div class="title"> Kategori </div>
        @foreach($categories as $category)
				<div class="category-box mt50">
					<div class="row">
						<div class="col-md-3 col-sm-3 col-xs-12">
							<div class="category-name">
								<a href="{{ url('/product/'.$category->category_slug) }}">
									{{ $category->category_name }}
								</a>
							</div>
						</div>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<div class="row">
								<div class="col-md-4 col-sm-4 col-xs-12">
									<ul class="category-list">
									@foreach($category->subcategories as $subcategory)
										<li> <a href="{{ url('/product/'.$category->category_slug.'/'.$subcategory->subcategory_slug) }}"> {{$subcategory->subcategory_name}} </a> </li>
									@endforeach
									</ul>
								</div>
							</div>
						</div>
					</div>
					</div>
        @endforeach
				</div>
			</div>
		</div>
	</div>
@stop
