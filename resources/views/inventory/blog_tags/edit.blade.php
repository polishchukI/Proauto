@extends('inventory.layouts.app', ['page' => __('inventory.blog_tags_edit'), 'pageSlug' => 'blog_tags', 'section' => 'blog', 'search' => 'blog_tags'])
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Edit Order Status</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('blog_tags.index') }}" class="btn btn-sm btn-simple"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('blog_tags.update', $tag) }}" autocomplete="off">
                    @csrf
                    @method('put')

                    <h6 class="heading-small text-muted mb-4">Tag Information</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-4">                                    
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Tag Name</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative" placeholder="Tag Name" value="{{ old('name', $tag->name) }}" required>
                                    @include('inventory.alerts.feedback', ['field' => 'name'])
                                </div>
                            </div>
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