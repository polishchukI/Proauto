@extends('inventory.layouts.app', ['page' => __('inventory.dashboard'), 'pageSlug' => 'types', 'section' => 'catalog', 'search' => ''])

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
						@foreach($cataloggroups as $item)
                        <li class="block-brands__item">
                            <a href="{{$item["url"]}}" class="block-brands__item-link" name="{{$item["group"]}}">
                                <!--img src="{{$item["image_url"]}}" alt="Выберите группу {{$item["group_name"]}}"-->
                                <span class="block-brands__item-name">{{$item["group_name"]}}</span>
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
