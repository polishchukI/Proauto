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
            @foreach ($repair_order->products as $item)
            <tr id="repair_order_selected_product-{{ $item->product_id }}" class="pointer" ondblclick="repair_order_edit_product('{{$repair_order->id}}','{{ $item->product_id }}');">
                <td scope="col" class="article">{{ $item->product->article }}</td>
                <td scope="col" class="brand">{{ $item->product->brand }}</td>
                <td scope="col" class="name">{{ $item->product->name }}
                    @if($item->client_order_id)<br><span class="text-muted">{{ __('inventory.client_order') }} №{{ $item->client_order_id }}</span>@endif
                </td>
                <td scope="col" class="text-center stock">{{ $item->product->stocks()->sum('quantity') ?? 0}}</td>
                <td scope="col" class="text-center quantity">{{ $item->quantity ?? 0}}</td>
                <td scope="col" class="text-center price">{{ $item->price ?? 0}}</td>
                <td scope="col" class="text-center total">{{ $item->total ?? 0}}</td>
                <td scope="col" class="text-center discount">{{ $item->discount ?? 0}}</td>
                <td scope="col" class="text-center total_amount">{{ $item->total_amount ?? 0}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>