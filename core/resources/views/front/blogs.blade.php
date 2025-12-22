@extends('front.layout')

@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")
@section('content')

	<!--Main Breadcrumb Area Start -->
	<div class="main-breadcrumb-area" style="background-image : url('{{ asset('assets/front/img/' . $commonsetting->breadcrumb_image) }}');">
        <div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="pagetitle">
						{{ __('Blog') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Blog') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

   	<!-- Blog Page Grid Area Start -->
	<section class="blog-page single-blog-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="row">
						@if (count($blogs) == 0)
							<div class="col-md-12">
							  <div class="bg-light py-5">
								<h3 class="text-center">{{__('NO BLOG FOUND')}}</h3>
							  </div>
							</div>
						@else
							@foreach ($blogs as $blog)
							<div class="col-md-6">
								<a href="{{route('front.blogdetails', $blog->slug)}}" class="single-blog">
									<div class="img">
										<img src="{{asset('assets/front/img/'.$blog->main_image) }}" alt="">
									</div>
									<div class="content">
										<ul class="top-meta">
											<li>
												<p class="date">
													{{date ( 'd M, Y', strtotime($blog->created_at) )}}
												</p>
											</li>
											<li>
												<p class="post-by">
													{{__('By,')}}  {{__('Admin')}}
												</p>
											</li>
										</ul>
										<h4 class="title"> 
											{{ (strlen(strip_tags(Helper::convertUtf8($blog->title))) > 50) ? substr(strip_tags(Helper::convertUtf8($blog->title)), 0, 50) . '...' : strip_tags(Helper::convertUtf8($blog->title)) }}
										</h4>
									</div>
								</a>
							</div>
							@endforeach
						@endif
					</div>
					<div class="row">
						<div class="col-12 d-flex justify-content-center">
							{{$blogs->appends(['language' => request()->input('language')])->links()}}
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="search-widget">
						<form action="{{route('front.blogs', ['category' => request()->input('category')]) }}" method="GET">
						
							<input type="text" name="term" class="input-field" placeholder="{{ __('Search Blogs') }}" value="{{ request()->input('term')}}">
							<button type="submit" class="base-btn1"><i class="fas fa-search"></i></button>
						</form> 
					</div>
					<div class="categori-widget mt-30">
						<h4 class="title">
							{{ __('Categories') }}
						</h4>
						<ul class="cat-list">
							@foreach ($bcategories as $bcategory)
							<li class="@if(request()->input('category') == $bcategory->slug) active @endif">
								<a href="{{route('front.blogs',  ['term'=>request()->input('term'), 'category'=>$bcategory->slug]) }}">
									<p>
										<i class="fas fa-angle-double-right"></i>	{{ $bcategory->name }}
									</p>
								</a>
							</li>
							@endforeach
						</ul>
					</div>
					<div class="latest-post-widget">
						<h4 class="title">
							{{ __('Latest Post') }}
						</h4>
						<ul class="post-list">
							@foreach ($latestblogs as $latestblog)
							<li>
								<a href="{{route('front.blogdetails', $latestblog->slug)}}" class="post">
									<div class="post-img">
										<img src="{{asset('assets/front/img/'.$latestblog->main_image)}}" alt="">
									</div>
									<div class="post-details">
										<p class="post-title">
											{{ (strlen(strip_tags(Helper::convertUtf8($latestblog->title))) > 50) ? substr(strip_tags(Helper::convertUtf8($latestblog->title)), 0, 50) . '...' : strip_tags(Helper::convertUtf8($latestblog->title)) }}
										</p>
									</div>
								</a>
							</li>
							@endforeach
						</ul>
					</div>
					
				</div>
			</div>
		</div>
	</section>
	<!-- Blog Page Grid Area End -->

@endsection
