@extends('inventory.layouts.app', ['page' => __('inventory.blog_posts_show'), 'pageSlug' => 'blog_posts', 'section' => 'blog', 'search' => 'blog_posts'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Blog Post information</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Transactions</th>
                            <th>Daily Balance</th>
                            <th>Weekly Balance</th>
                            <th>Quarterly Balance</th>
                            <th>Monthly Balance</th>
                            <th>Annual balance</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $blog_post->id }}</td>
                                <td>{{ $blog_post->name }}</td>
                                <td>{{ $blog_post->description }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection