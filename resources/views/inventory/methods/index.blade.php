@extends('inventory.layouts.app', ['page' => 'Methods', 'pageSlug' => 'methods', 'section' => 'transactions', 'search' => 'methods'])

@section('content')
@include('inventory.alerts.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('inventory.accounts_methods') }}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('methods.create') }}" class="btn btn-sm btn-simple">New Method</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">                    
                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">{{ __('inventory.method') }}</th>
                                <th scope="col">{{ __('inventory.description') }}</th>
                                <th scope="col">{{ __('inventory.trnsactions_quantity') }}</th>
                                <th scope="col">{{ __('inventory.trnsactions_sum') }}</th>
                                <th scope="col">{{ __('inventory.show') }}</th>
                                <th scope="col">{{ __('inventory.edit') }}</th>
                                <th scope="col">{{ __('inventory.delete') }}</th>
                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($methods as $method)
                                    <tr>
                                        <td>{{ $method->name }}</td>
                                        <td>{{ $method->description }}</td>
                                        <td>{{ $method->transactions->count() }}</td>
                                        <td>{{ $method->transactions->sum('amount') }}</td>
                                        <td>
                                            <a href="{{ route('methods.show', $method) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('methods.edit', $method) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('methods.destroy', $method) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to remove this method? The payment records will not be deleted.') ? this.parentElement.submit() : ''">
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
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $methods->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
