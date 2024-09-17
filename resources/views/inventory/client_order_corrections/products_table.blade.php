<!-- card_body -->
<div class="card-body" style="max-height:100%;overflow:auto;">
    <div class="table-full-width table-responsive" id="selectedProductsTable">
        <table class="table">
            <thead class=" text-primary">
                <th scope="col" style="width: 10%;">{{ __('inventory.article') }}</th>
                <th scope="col" style="width: 10%;">{{ __('inventory.brand') }}</th>
                <th scope="col" style="width: 46%;">{{ __('inventory.product') }}</th>
                <th scope="col" class="text-center" style="width: 5%;">{{ __('inventory.stock') }}</th>
                <th scope="col" class="text-center" style="width: 5%;">{{ __('inventory.quantity') }}</th>
                <th scope="col" class="text-center" style="width: 6%;">{{ __('inventory.price') }}</th>
                <th scope="col" class="text-center" style="width: 6%;">{{ __('inventory.total') }}</th>
                <th scope="col" class="text-center" style="width: 6%;">{{ __('inventory.discount') }}</th>
                <th scope="col" class="text-center" style="width: 6%;">{{ __('inventory.total_amount') }}</th>
            </thead>
            <tbody>
                @foreach ($client_order_correction->products as $item)
                <tr id="client_order_correction_selected_product-{{ $item->product_id }}" class="pointer" ondblclick="client_order_correction_edit_product('{{$client_order_correction->id}}','{{ $item->product_id }}');">
                    <td scope="col" class="article">{{ $item->product->article }}</td>
                    <td scope="col" class="brand">{{ $item->product->brand }}</td>
                    <td scope="col" class="name">{{ $item->product->name }}
                        @if($item->client_order_id)<br><span class="text-muted">{{ __('inventory.client_order') }} №{{ $item->client_order_id }}</span>@endif
                    </td>
                    <td scope="col" class="text-center stock">{{ number_format($item->product->stocks()->sum('quantity') ?? 0, 2) }}</td>
                    <td scope="col" class="text-center quantity">{{ number_format($item->quantity ?? 0, 2) }}</td>
                    <td scope="col" class="text-center price">{{ number_format($item->price ?? 0, 2) }}</td>
                    <td scope="col" class="text-center total">{{ number_format($item->total ?? 0, 2) }}</td>
                    <td scope="col" class="text-center discount">{{ number_format($item->discount ?? 0, 2)}}</td>
                    <td scope="col" class="text-center total_amount">{{ number_format($item->total_amount ?? 0, 2)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- card_body -->