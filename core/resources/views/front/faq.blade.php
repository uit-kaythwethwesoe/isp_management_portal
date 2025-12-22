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
						{{ __('Faq') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Faq') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

    <!-- Faq Area Start -->
	<section id="faq" class="faq">
		<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8">
                <div class="panel-group accordion" id="accordion-1">
                    @foreach($faqs as $key => $faq)
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 data-toggle="collapse" aria-expanded="@if ($loop->first) true @endif" data-target="#id{{ $faq->id }}" aria-controls="id{{ $faq->id }}"
                            class="panel-title">
                                {{ $faq->title }}
                            </h4>
                        </div>
                        <div id="id{{ $faq->id }}" class="panel-collapse collapse @if ($loop->first) show @endif" aria-labelledby="id{{ $faq->id }}" data-parent="#accordion-1">
                            <div class="panel-body">
                            	{!! $faq->content !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
			</div>
		</div>
		</div>
	</section>
	<!-- Faq Area End -->

@endsection
