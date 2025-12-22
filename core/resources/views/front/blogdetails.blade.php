@extends('front.layout')

@section('meta-keywords', "$blog->meta_keywords")
@section('meta-description', "$blog->meta_description")
@section('content')

	<!--Main Breadcrumb Area Start -->
	<div class="main-breadcrumb-area" style="background-image : url('{{ asset('assets/front/img/' . $commonsetting->breadcrumb_image) }}');">
        <div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="pagetitle">
						{{ $blog->title }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="{{ route('front.blogs') }}">
								{{ __('Blog') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ $blog->title }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

   	<!-- Blog Page Grid Area Start -->
	<section class="blog-page blog-details">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="blog-details">
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
                                    {{ $blog->title }}
                            </h4>
                            <div class="content-text">
                             {!! $blog->content !!} 
                            </div>
						</div>
						@if($commonsetting->is_blog_share_links)
						<div class="share-blog">
							<div class="tag-social-link text-center justify-content-center">
								<!-- AddToAny BEGIN -->
								<div class="a2a_kit a2a_kit_size_32 a2a_default_style d-inline-block">
								<a class="a2a_button_facebook"></a>
								<a class="a2a_button_twitter"></a>
								<a class="a2a_button_email"></a>
								<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
								</div>
								<script async src="https://static.addtoany.com/menu/page.js"></script>
								<!-- AddToAny END -->
							</div>
						</div>
						@endif
					</div>
					<div class="discus-comment-box">
						@if($commonsetting->is_disqus	== 1)
						<div id="disqus_thread" class="mt-5"></div>
						<script>
							(function() { // DON'T EDIT BELOW THIS LINE
							var d = document, s = d.createElement('script');
							s.src = '//{{ $commonsetting->disqus }}.disqus.com/embed.js';
							s.setAttribute('data-timestamp', +new Date());
							(d.head || d.body).appendChild(s);
							})();
						</script>
					@endif 
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
							<li class="@if(request()->input('category') == $bcategory->id) active @endif">
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
