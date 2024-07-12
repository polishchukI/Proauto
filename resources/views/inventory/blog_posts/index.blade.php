@extends('inventory.layouts.app', ['page' => __('inventory.blog_posts'), 'pageSlug' => 'blog_posts', 'section' => 'blog', 'search' => 'blog_posts'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <nav class="d-flex justify-content-end" aria-label="...">
                                {{ $blog_posts->links() }}
                            </nav>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('blog_posts.create') }}"  class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">                    
                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">{{ __('inventory.title') }}</th>
                                <th scope="col">{{ __('inventory.active') }}</th>
                                <th scope="col">{{ __('inventory.category') }}</th>
                                <th scope="col">{{ __('inventory.author') }}</th>
                                <th scope="col">{{ __('inventory.views') }}</th>
                                <th scope="col">{{ __('inventory.edit') }}</th>
                                <th scope="col">{{ __('inventory.delete') }}</th>
                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($blog_posts as $post)
                                    <tr>
                                        <td>{{ $post->title }}</td>
                                        <td>
                                        @if ($post->active==0)
											<span class="text-danger"><i class="far fa-minus-square"></i></span>
										@else
											<span class="text-success"><i class="far fa-check-square"></i></span>
										@endif
                                        </td>
                                        <td>{{ $post->category->title }}</td>
                                        <td>{{ $post->author->name }}</td>
                                        <td>{{ $post->views }}</td>
                                        <td>
                                            <a href="{{ route('blog_posts.edit', $post) }}" class="btn btn-sm btn-simple btn-selector" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('blog_posts.destroy', $post) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-sm btn-simple btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to remove this method? The payment records will not be deleted.') ? this.parentElement.submit() : ''">
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
                <div class="row">
                        <div class="col-8">
                            <nav class="d-flex justify-content-end" aria-label="...">
                                {{ $blog_posts->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
