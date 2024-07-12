@extends('inventory.layouts.app', ['page' => __('inventory.blog_posts_create'), 'pageSlug' => 'blog_post-create', 'section' => 'blog', 'search' => 'blog_posts'])

@section('content')
@include('inventory.alerts.errors')
<div class="row">
    <div class="col-xl-12 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">New Blog Post</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('blog_posts.index') }}" class="btn btn-sm btn-simple"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('blog_posts.store') }}" autocomplete="off">
                    @csrf
                    <h6 class="heading-small text-muted mb-4">Blog Post information</h6>
                    <div class="pl-lg-4">
                        <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-title">Title</label>
                            <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="Title" required autofocus>
                            @include('inventory.alerts.feedback', ['field' => 'title'])
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-description">Description</label>
                            <input type="text" name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Description">
                            @include('inventory.alerts.feedback', ['field' => 'description'])
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label class="form-control-label" for="input-name">{{ __('inventory.category') }}</label>
                                <select name="category" id="input-category" class="form-select form-control-alternative{{ $errors->has('category') ? ' is-invalid' : '' }}" required>
                                    @foreach ($categories as $id=>$name)
                                    <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                                @include('inventory.alerts.feedback', ['field' => 'category'])
                            </div>
                            <div class="col-4">
                                <label class="form-control-label" for="input-active">Активен</label>
                                <select name="active" id="input-active" class="form-control form-control-alternative{{ $errors->has('active') ? ' is-invalid' : '' }}" required>
                                    @foreach (['0'=>'Не активен', '1' => 'Активен'] as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class='col-4'>
                                <label for="FormControlFile">Feature Image</label>
                                <input type="file" class="form-control-file" id="FormControlFile" name="image">
                                <small id="blog_feature_image" class="form-text text-muted">Post main image</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group{{ $errors->has('slug') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-slug">Slug</label>
                                    <input type="text" name="slug" id="input-slug" class="form-control form-control-alternative{{ $errors->has('slug') ? ' is-invalid' : '' }}" placeholder="Slug">
                                    @include('inventory.alerts.feedback', ['field' => 'slug'])
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group{{ $errors->has('tags') ? 'has-error' : ''}}">
                                <label class="form-control-label" for="input-tag">Tags</label>
                                <select name="tag[]" id="input-tag" class="form-select form-control-alternative{{ $errors->has('tag') ? ' is-invalid' : '' }}" required multiple>
                                    @foreach ($tags as $id=>$name)
                                    <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('body') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-body">Body</label>
                            <textarea name="body" id="input-body" class="form-control form-control-alternative{{ $errors->has('body') ? ' is-invalid' : '' }}" placeholder="Body" value="{{ old('body') }}"></textarea>
                            @include('inventory.alerts.feedback', ['field' => 'body'])
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-sm btn-simple btn-success">{{ __('inventory.save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('/assets/js/ckeditor/ckeditor.js') }}"></script>
<script defer>
CKEDITOR.replace('body',{
            height: "200px"
        }); 
</script>
@endpush