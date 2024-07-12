@extends('inventory.layouts.app', ['page' => __('inventory.client_autos'), 'pageSlug' => 'client_autos', 'section' => 'inventory', 'search' => 'client_autos'])

@section('content')
@include('inventory.alerts.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('inventory.client_autos') }}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('client_autos.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
					<div class="table-responsive">
						<table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead class=" text-primary">
                                <th scope="col">{{ __('inventory.auto_name') }}<br>VIN</td>
								<th scope="col">{{ __('inventory.client') }}</th>
								<th scope="col">{{ __('inventory.engine') }}</th>
								<th scope="col">{{ __('inventory.fuel') }}</th>
								<th scope="col"><i class="fas fa-search"></i></th>
								<th scope="col"><i class="fas fa-edit"></i></th>
								<th scope="col"><i class="fas fa-times"></i></th>
                            </thead>
                            <tbody>
                                @foreach ($client_autos as $client_auto)
                                    <tr>
                                        <td>{{ $client_auto->name }}
										<br>{{ $client_auto->vin }}</td>
                                        @if($client_auto->client)
                                        <td>
                                            <a href="{{ route('clients.show', ['client' => $client_auto->client]) }}" data-toggle="tooltip" data-placement="bottom" title="Client Details">
                                                {{ $client_auto->client->name }}
                                            </a>
                                        </td>
                                        @else
                                        <td> - </td>
                                        @endif
										<td>{{ $client_auto->engine }}</td>
                                        <td>{{ $client_auto->fuel }}</td>
                                        <td>
                                            <a href="{{ route('client_autos.show', $client_auto) }}" class="btn btn-sm btn-simple btn-standard" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('client_autos.edit', $client_auto) }}" class="btn btn-sm btn-simple btn-standard" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('client_autos.destroy', $client_auto) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-sm btn-simple btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to delete this client_auto? Records of payments made to him will not be deleted.') ? this.parentElement.submit() : ''">
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
            </div>
        </div>
    </div>
@endsection
@push('js')
<script src="{{ asset('assets') }}/js/datatables.js"></script>
@endpush