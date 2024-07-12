@extends('inventory.layouts.app', ['page' => 'Shop Settings', 'pageSlug' => 'shop_settings', 'section' => 'settings', 'search' => 'shop_settings'])

@section('content')
    @include('inventory.alerts.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Shop Settings</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('shop_settings.create') }}" class="btn btn-sm btn-simple">New Shop Setting</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">Setting</th>
                                <th scope="col">Value</th>
                                <th scope="col">Comment</th>
                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($shop_settings as $shop_setting)
                                    <tr>
                                        <td>{{ $shop_setting->name }}</td>
                                        <td>{{ $shop_setting->value }}</td>
                                        <td>{{ $shop_setting->comment }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('shop_settings.edit', $shop_setting) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('shop_settings.destroy', $shop_setting) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to remove this setting? The payment records will not be deleted.') ? this.parentElement.submit() : ''">
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
                    <nav class="d-flex justify-content-end" aria-label="..."></nav>
                </div>
            </div>
        </div>
    </div>
@endsection
