@extends('inventory.layouts.app', ['page' => __('inventory.blog_tags'), 'pageSlug' => 'blog_tags', 'section' => 'blog', 'search' => 'blog_tags'])

@section('content')
@include('inventory.alerts.success')
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">Order Statuses</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('blog_tags.create') }}" class="btn btn-sm btn-simple"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                

                <div class="">
                    <table class="table tablesorter " id="">
                        <thead class=" text-primary">
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                        </thead>
                        <tbody>
                            @foreach ($tags as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{ route('blog_tags.edit', $item) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('blog_tags.destroy', $item) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to remove this brand? The records that contain it will continue to exist.') ? this.parentElement.submit() : ''">
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
                    {{ $tags->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
