@extends('inventory.layouts.app', ['page' => 'Currencies', 'pageSlug' => 'currencies', 'section' => 'inventory', 'search' => 'currencies'])

@section('content')
@include('inventory.alerts.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            <h4 class="card-title">currencies</h4>
                        </div>
                        <div class="col-1 text-right">
                            <a href="{{ route('currencies.create') }}" class="btn btn-simple  btn-sm"><i class="fas fa-plus"></i></a>
                        </div>
                        <div class="col-1 text-right">
							<button class="btn btn-primary btn-sm" title="update currencies" OnClick="currencies_update()">
								<i class="fas fa-sync"></i>
							</button>
						</div>
					</div>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">Name</th>
                                <th scope="col">Code</th>
                                <th scope="col">Symbol</th>
                                <th scope="col">Exchange rate</th>
                                <th scope="col">Active</th>
                                <th scope="col">Updated</th>
                                <th scope="col">Show</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </thead>
                            <tbody>
                                @foreach ($currencies as $currency)
                                    <tr>
                                        <td>{{ $currency->name }}</td>
                                        <td>{{ $currency->code }}</td>
                                        <td>{{ $currency->symbol }}</td>
                                        <td>{{ $currency->exchange_rate }}</td>
                                        <td>
                                            @if ($currency->active == 0)
                                            <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                            @else
                                            <span class="text-success"><i class="far fa-check-square"></i></span>
                                            @endif
                                        </td>
                                        <td>{{ $currency->updated_at }}</td>
                                        <td class="td-actions">
                                            <a href="{{ route('currencies.show', $currency) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                                <i class="fas fa-search"></i>
                                            </a>
										</td>
										<td class="td-actions">
                                            <a href="{{ route('currencies.edit', $currency) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
											</td>
										<td class="td-actions">
                                            <form action="{{ route('currencies.destroy', $currency) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to delete this currency? All products belonging to it will be deleted and the records that contain it will not be accurate.') ? this.parentElement.submit() : ''">
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
                        {{ $currencies->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection