<!-- card_body -->
<div class="card-body" style="max-height:100%;overflow:auto;">
    <div class="table-full-width table-responsive" id="selectedProductsTable">
        <table class="table">
            <thead class=" text-primary">
                <th scope="col" style="width: 15%;">{{ __('inventory.article') }}</th>
                <th scope="col" style="width: 15%;">{{ __('inventory.brand') }}</th>
                <th scope="col" style="width: 40%;">{{ __('inventory.product') }}</th>
                <th scope="col" class="text-center" style="width: 5%;">{{ __('inventory.stock') }}</th>
                <th scope="col" class="text-center" style="width: 5%;">{{ __('inventory.quantity') }}</th>
                <th scope="col" class="text-center" style="width: 10%;">{{ __('inventory.price') }}</th>
                <th scope="col" class="text-center" style="width: 10%;">{{ __('inventory.total') }}</th>
            </thead>
            <tbody>
            @foreach ($receipt->products as $item)
                <tr id="receipt_selected_product-{{ $item->product_id }}" class="pointer" ondblclick="receipt_edit_product('{{$receipt->id}}','{{ $item->product_id }}');">
                    <td scope="col" class="article">{{ $item->product->article }}</td>
                    <td scope="col" class="brand">{{ $item->product->brand }}</td>
                    <td scope="col" class="name">{{ $item->product->name }}@if($item->to_provider_order_id)<br>
                        <span class="text-muted">{{ __('inventory.to_provider_order') }} №{{ $item->to_provider_order_id }}</span>@endif
                    </td>
                    <td scope="col" class="text-center stock">{{ number_format($item->product->stocks()->sum('quantity') ?? 0, 2)}}</td>
                    <td scope="col" class="text-center quantity">{{ number_format($item->quantity ?? 0, 2) }}</td>
                    <td scope="col" class="text-center price">{{ number_format($item->price ?? 0, 2) }}</td>
                    <td scope="col" class="text-center total_amount">{{ number_format($item->total_amount ?? 0, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- card_body -->