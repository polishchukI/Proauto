@extends('inventory.layouts.app', ['page' => __('inventory.blog_tags'), 'pageSlug' => 'blog_tags', 'section' => 'blog', 'search' => 'blog_tags'])

@section('content')
@include('inventory.alerts.success')
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">{{ $blog_tags->links() }}</div>
                        <div class="col-2">
						<form method="get" action="/blog_tags" autocomplete="off">
							<input type="text" name="search" placeholder="{{ __('inventory.search') }}" value="{{ request('search') }}" class="form-control-sm" />
							<button class="btn btn-simple btn-sm btn-selector" type="submit"><i class="fa fa-search"></i></button>
						</form>
					</div>
					<div class="col-2 text-right">
                        <a href="{{ route('blog_tags.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <table class="table tablesorter " id="">
                        <thead class=" text-primary">
                            <th scope="col">#</th>
                            <th scope="col">{{ __('inventory.name') }}</th>
                            <th scope="col">{{ __('inventory.slug') }}</th>
                            <th scope="col">{{ __('inventory.edit') }}</th>
                            <th scope="col">{{ __('inventory.delete') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($blog_tags as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>
                                        <a href="{{ route('blog_tags.edit', $item) }}" class="btn btn-sm btn-simple btn-selector" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('blog_tags.destroy', $item) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-sm btn-simple btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to remove this item? The records that contain it will continue to exist.') ? this.parentElement.submit() : ''">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-4">
                <nav class="d-flex justify-content-end">
                    {{ $blog_tags->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
