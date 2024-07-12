@extends('inventory.layouts.app', ['page' => 'Catalog', 'pageSlug' => 'manufacturers', 'section' => 'catalog', 'search' => 'manufacturers'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Categories</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('categories.create') }}" class="btn btn-sm btn-simple">New Category</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('inventory.alerts.success')
					<ul class="block-brands__list">
						@foreach($manufacturers as $make)
						<li class="block-brands__item">
							<a href="{{$make["url"]}}" class="block-brands__item-link">
								<span class="block-brands__item-name">{{$make["manufacturer_name"]}}</span>
							</a>
						</li>
						<li class="block-brands__divider" role="presentation"></li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
    </div>
@endsection
