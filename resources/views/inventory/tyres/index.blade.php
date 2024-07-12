@extends('inventory.layouts.app', ['page' => 'tyres', 'pageSlug' => 'tyres', 'section' => 'special', 'search' => 'tyres'])

@section('content')
@include('inventory.alerts.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('inventory.tyres') }}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('special.tyres.create') }}" class="btn btn-sm btn-simple">New tyre</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">                    
                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">{{ __('inventory.tyre') }}</th>
                                <th scope="col">{{ __('inventory.description') }}</th>
                                <th scope="col">{{ __('inventory.trnsactions_quantity') }}</th>
                                <th scope="col">{{ __('inventory.trnsactions_sum') }}</th>
                                <th scope="col">{{ __('inventory.show') }}</th>
                                <th scope="col">{{ __('inventory.edit') }}</th>
                                <th scope="col">{{ __('inventory.delete') }}</th>
                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($tyres as $tyre)
                                    <tr>
                                        <td>{{ $tyre->name }}</td>
                                        <td>{{ $tyre->description }}</td>
                                        <td>{{-- $tyre->transactions->count() --}}</td>
                                        <td>{{-- $tyre->transactions->sum('amount') --}}</td>
                                        <td>
                                            <a href="{{ route('special.tyres.show', $tyre) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('special.tyres.edit', $tyre) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('special.tyres.destroy', $tyre) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to remove this tyre? The payment records will not be deleted.') ? this.parentElement.submit() : ''">
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
                        {{ $tyres->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
