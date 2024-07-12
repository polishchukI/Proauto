@extends('shop.template')

@section('content')
<div class="site__body">
	<div class="block-space block-space--layout--after-header"></div>
	<div class="block">
		<div class="container container-xl">
			<div class="row">
				@include('shop.block.profileNav')
				<div class="col-12 col-lg-9 mt-4 mt-lg-0">
					<div class="card">
						<div class="card-header"><h5>{{ __('account.profile') }}</h5></div>
						<div class="card-divider"></div>
						<div class="card-body card-body--padding--2">
							<div class="col-12 col-lg-12 col-xl-12">
								<form method="POST" action="{{route('account.profile.update')}}" enctype="multipart/form-data">
								@csrf
									<div class="form-row">
										<div class="form-group col-md-12">
											<label for="profile-lastname">{{ __('account.lastname') }}</label>
											@if(isset($client["lastname"]))
											<input type="text" class="form-control" id="lastname" name="lastname" value="{{ $client["lastname"] }}" placeholder="{{ __('account.lastname') }}">
											@else
											<input type="text" class="form-control" id="lastname" name="lastname" placeholder="{{ __('account.lastname') }}">
											@endif
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="profile-firstname">{{ __('account.firstname') }}</label>
											@if(isset($client["firstname"]))
											<input type="text" class="form-control" id="firstname" name="firstname" value="{{$client["firstname"]}}" placeholder="{{ __('account.firstname') }}">
											@else
											<input type="text" class="form-control" id="firstname" name="firstname" value="" placeholder="{{ __('account.firstname') }}">
											@endif
										</div>
										<div class="form-group col-md-6">
											<label for="profile-secondname">{{ __('account.secondname') }}</label>
											<input type="secondname" class="form-control" id="secondname" name="secondname" @if(isset($client["secondname"])) value="{{$client["secondname"]}}" @endif placeholder="{{ __('account.secondname') }}">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="profile-email">{{ __('account.emailaddress') }}</label>
											@if(isset($client["email"]))
											<input type="email" class="form-control" id="email" name="email" value="{{$client["email"]}}" placeholder="{{ __('account.emailaddress') }}">
											@else
											<input type="email" class="form-control" id="email" name="email" value="" placeholder="{{ __('account.emailaddress') }}">
											@endif
										</div>
										<div class="form-group col-md-6">
											<label for="profile-phone">{{ __('account.phonenumber') }}</label>
											@if(isset($client["phone"]))
											<input type="text" class="form-control" id="phone" name="phone" value="{{$client["phone"]}}"  placeholder="{{ __('account.phonenumber') }}">
											@else
											<input type="text" class="form-control" id="phone" name="phone" value=""  placeholder="{{ __('account.phonenumber') }}">
											@endif
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											@if(isset($client["avatar"]) && $client["avatar"]!=='')
											<img id="preview" src="{{$client["avatar"]}}" class="profile-card__avatar" width="200" height="200"/>
											@else
											<img id="preview" src="{{$client["avatar"]}}" class="" width="200" height="200"/>
											@endif
										</div>
										<div class="form-group col-md-6">
											<label for="avatar">{{ __('account.avatarupload') }}</label>
											<input type="file" name="avatar" id="avatar" onchange="loadPreview(this);" class="form-control">
										</div>
									</div>
									<div class="form-row">
										<div class="form-check col-md-6">
											<span class="input-check form-check-input">
												<span class="input-check__body">
													<input class="input-check__input" type="checkbox" name="telegram_notifications" id="telegram_notifications" @if(isset($client["telegram_notifications"]) && $client["telegram_notifications"] == 1) checked @endif>
													<span class="input-check__box"></span>
													<span class="input-check__icon">
														<svg xmlns="http://www.w3.org/2000/svg" width="9px" height="7px">
															<path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"></path>
														</svg>
													</span>
												</span>
											</span>
											<label class="form-check-label" for="telegram_notifications">{{ __('account.telegramnotifications') }}</label>
										</div>
										<div class="form-check col-md-6">
											<span class="input-check form-check-input">
												<span class="input-check__body">
													<input class="input-check__input" type="checkbox" name="newsletter" id="newsletter" @if(isset($client["newsletter"]) && $client["newsletter"] == 1) checked @endif>
													<span class="input-check__box"></span>
													<span class="input-check__icon">
														<svg xmlns="http://www.w3.org/2000/svg" width="9px" height="7px">
															<path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"></path>
														</svg>
													</span>
												</span>
											</span>
											<label class="form-check-label" for="newsletter">{{ __('account.newsletter') }}</label>
										</div>
									</div>
									<div class="form-group mb-0"><button class="btn btn-primary mt-3" type="submit">{{ __('account.save') }}</button></div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function loadPreview(input, id)
	{
		id = id || '#preview';
		if (input.files && input.files[0])
		{
			var reader = new FileReader();
			reader.onload = function (e)
			{
				$(id)
				.attr('src', e.target.result)
				.width(200)
				.height(200);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>
@stop