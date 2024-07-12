@extends('inventory.layouts.app', ['page' => __('inventory.clients'), 'pageSlug' => 'clients', 'section' => 'clients', 'search' => 'clients'])

@section('content')
@include('inventory.alerts.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{__('inventory.clients')}}</h4>
                        </div>
                        <div class="col-2 text-right">
                            <a href="{{ route('clients.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
                        </div>
						<div class="col-2 text-right">
							<button type="button" class="btn btn-sm btn-simple btn-selector" OnClick="client_phones_upate()"><i class="fas fa-blender-phone"></i> Update phones to...</button>
						</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
						<table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead class=" text-primary">
                                <th>Name</th>
                                <th>Notified</th>
                                <th>Telephones</th>
                                <th>Comment</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>{{ $client->name }}</td>
                                        <td>
                                            @if (!$client->notified_at)
                                            <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                            @else
                                            <span class="text-success"><i class="far fa-check-square"></i></span>
                                            @endif
                                        </td>
                                        <td>
											@foreach($client->phones as $phone)
												{{ $phone->phone }}<br>
											@endforeach
                                        </td>
										 <td>{{ $client->comment }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('clients.show', $client) }}" class="btn btn-simple btn-sm btn-standard" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                                <i class="fas fa-search"></i>
                                            </a>
                                            <a href="{{ route('clients.edit', $client) }}" class="btn btn-simple btn-sm btn-standard" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('clients.destroy', $client) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-simple btn-sm btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Estás seguro que quieres eliminar a este Client? Los registros de sus compras y Transactions no serán eliminados.') ? this.parentElement.submit() : ''">
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