@extends('shop.template')

@section('content')

<div class="site__body">
	<div class="block-header block-header--has-breadcrumb block-header--has-title">
		<div class="container">
			<div class="block-header__body">
				<!--breadcrumbs-->
				@include('shop.layouts.breadcrumbs')
				<!--breadcrumbs-end-->
				<h1 class="block-header__title">Каталог запчастей</h1>
			</div>
		</div>
		<div class="block block-split block-split--has-sidebar">
			<div class="container">
				<div class="block-split__row row no-gutters">
					<!--sidebar block-->
					@include('shop.block.sidebar')
					<!--sidebar block-->
					<!--product block-->
					<div class="block-split__item block-split__item-content col-auto">
						<div class="alert alert-primary alert-lg mb-3 alert-dismissible fade show">
							Unfortunately, item {{$ResultArray["SECTION_NAME"]}} for <b>{{$ResultArray["UBRAND"]}} {{$ResultArray["MODEL"]}} {{$ResultArray["YEAR"]}}</b> is not available at the moment. We're working hard to ensure it's available again!<br>
							Please <a href="{{$ResultArray["CSEC_LINK"]}}">return back</a>. Or start another search.
						</div>
						<div class="container container--max--lg">
							<div class="card">
								<div class="card-body card-body--padding--2">
									<div class="row">
										<div class="col-12 col-lg-6 pb-4 pb-lg-0">
											<div class="mr-1">
												<img alt="{{$ResultArray["UBRAND"]}} {{$ResultArray["SECTION_NAME"]}} at amazing prices" max-width="300" src="{{$ResultArray["RSECTION_PICTURE"]}}" height="300">
												<div class="contact-us__address">
													<p>Want to be the first to know this item is in stock? Please enter your email address so we could let you know the moment we get it.</p>
													<p>You can also indicate your car's VIN, or the number of article for us to check if this is indeed the part you need. </p>
													<p>Please note our <a href="{{ route('privacypolicy') }}">Privacy Policy</a>.</p>
												</div>
											</div>
										</div>
										<div class="col-12 col-lg-6">
											<div class="ml-1">
												<form>
													<div class="form-row">
														<div class="form-group col-md-6">
															<label for="form-name">Your Name</label>
															<input type="text" id="form-name" class="form-control" placeholder="Your Name">
														</div>
														<div class="form-group col-md-6">
															<label for="form-email">Email</label>
															<input type="email" id="form-email" class="form-control" placeholder="Email Address">
														</div>
													</div>
													<div class="form-group">
														<label for="form-vin">VIN</label>
														<input type="text" id="form-vin" class="form-control" placeholder="VIN">
													</div>
													<div class="form-article">
														<label for="form-article">Article No</label>
														<input type="text" id="form-article" class="form-control" placeholder="Article No">
													</div>
													<div class="form-group">
														<label for="form-comment">Comment</label>
														<textarea id="form-comment" class="form-control" rows="2"></textarea>
													</div>
													<button type="submit" class="btn btn-primary">Send Message</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="block-space block-space--layout--divider-nl"></div>
						<div class="block">
							<!--categories start-->
							<div class="categories-list categories-list--layout--columns-4-sidebar">
								<ul class="categories-list__body">
									@foreach ($ResultArray["SECTIONS"] as $Section)
									<li class="categories-list__item">
										<a href="{{$Section["URL"]}}"><img src="{{$Section["PICTURE"]}}" alt="{{ $Section["name"] }}">
										<div class="categories-list__item-name">{{ $Section["name"] }}</div></a>
									</li>
									<li class="categories-list__divider"></li>
									@endforeach
								</ul>
							</div>
							<!--categories end-->
						</div>
                    </div>
                    <!--product block end-->
				</div>
            </div>
			<div class="block-space block-space--layout--divider-nl"></div>
            @include('shop.blog.news')
            <div class="block-space block-space--layout--divider-nl"></div>
	</div>
</div>
@stop
