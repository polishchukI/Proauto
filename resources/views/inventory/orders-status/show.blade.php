@extends('inventory.layouts.app', ['page' => 'Status Information', 'pageSlug' => 'brands', 'section' => 'inventory', 'search' => 'order_statuses'])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Status Information</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Color</th>
                            <th>Defective Stock</th>
                            <th>Base price</th>
                            <th>Average Price</th>
                            <th>Total sales</th>
                            <th>Income Produced</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $orderstatus->id }}</td>
                                <td>{{ $orderstatus->name }}</td>
                                <td>{{ $orderstatus->description }}</td>
                                <td style="background-color:{{ $orderstatus->status_color }}"> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
