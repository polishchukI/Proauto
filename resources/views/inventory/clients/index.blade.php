@extends('inventory.layouts.app', ['page' => __('inventory.clients'), 'pageSlug' => 'clients', 'section' => 'clients', 'search' => 'clients'])

@section('content')
@include('inventory.alerts.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                              {{ $clients->links() }}
                        </div>
                        <div class="col-2">
                            <form method="get" action="/clients" autocomplete="off">
                                <input type="text" name="search" placeholder="{{ __('inventory.search') }}" value="{{ request('search') }}" class="form-control-sm" />
                                <button class="btn btn-simple btn-sm btn-selector" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="col-1 text-right">
                            <a href="{{ route('clients.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
                        </div>
						<div class="col-1 text-right">
							<button type="button" class="btn btn-sm btn-simple btn-selector" OnClick="client_phones_upate()"><i class="fas fa-blender-phone"></i></button>
						</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table" width="100%">
                            <thead>
                                <th width="5%">{{ __('inventory.notified') }}</th>
                                <th width="25%">{{ __('inventory.client') }}</th>
                                <th width="15%">{{ __('inventory.phones') }}</th>
                                <th width="40%">{{ __('inventory.comment') }}</th>
								<th width="5%"><i class="fas fa-search"></i></th>
								<th width="5%"><i class="fas fa-edit"></i></th>
								<th width="5%"><i class="fas fa-times"></i></th>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td width="5%">
                                            @if (!$client->notified_at)
                                            <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                            @else
                                            <span class="text-success"><i class="far fa-check-square"></i></span>
                                            @endif
                                        </td>
                                        <td width="25%">{{ $client->name }}</td>
                                        <td width="15%">
											@foreach($client->phones as $phone)
                                            @if(strlen($phone->phone) == 12)
                                            {{ substr($phone->phone, 0, 2).' ('.substr($phone->phone, 2, 3).') '.substr($phone->phone, 5, 3).' '.substr($phone->phone, 8, 2).' '.substr($phone->phone, 10, 2) }}<br>
                                            @elseif(strlen($phone->phone) == 13)
                                            {{ substr($phone->phone, 0, 3).' ('.substr($phone->phone, 3, 3).') '.substr($phone->phone, 6, 3).' '.substr($phone->phone, 9, 2).' '.substr($phone->phone, 11, 2) }}<br>
                                            @endif
											@endforeach
                                        </td>
										 <td width="40%">{{ $client->comment }}</td>
                                         <td width="5%">
                                            <a href="{{ route('clients.show', $client) }}" class="btn btn-simple btn-sm btn-selector" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                        <td width="5%">
                                            <a href="{{ route('clients.edit', $client) }}" class="btn btn-simple btn-sm btn-selector" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td width="5%">
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