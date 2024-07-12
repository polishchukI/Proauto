@extends('shop.template')

@section('content')
<!-- site__body -->
<div class="site__body">
	<div class="block-space block-space--layout--after-header"></div>
	<div class="block">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
					<div class="card ml-md-3 mr-md-3">
						<div class="card-body card-body--padding--2">
							<h1 class="card-title card-title--lg">Track Order</h1>
							<p class="mb-4">Enter the order id and email address that was used to create the order, and then click the track button.</p>
							<form method="POST" action="{{ route('trackorder.send') }}">
							@csrf
								<div class="form-group">
									<label for="orderid">Order id</label>
									<input id="orderid" name="orderid" type="text" class="form-control" placeholder="Order id">
								</div>
								<div class="form-group">
									<label for="email">Email address</label>
									<input id="email" type="email" name="email" class="form-control" placeholder="Email address">
								</div>
								<div class="form-group pt-4 mb-1">
									<button type="submit" class="btn btn-primary btn-lg btn-block">Track</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- site__body / end -->
@stop