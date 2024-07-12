<div class="card-body" style="max-height:100%;overflow:auto;">
    <div class="table-full-width table-responsive" id="selectedProductsTable">
        <table class="table">
            <thead class="text-primary">
                <th scope="col" style="width: 15%;">{{ __('inventory.article') }}</th>
                <th scope="col" style="width: 15%;">{{ __('inventory.brand') }}</th>
                <th scope="col" style="width: 40%;">{{ __('inventory.product') }}</th>
                <th scope="col" style="width: 5%;">{{ __('inventory.stock') }}</th>
                <th scope="col" style="width: 5%;" class="text-center">{{ __('inventory.quantity') }}</th>
                <th scope="col" style="width: 10%;" class="text-center">{{ __('inventory.price') }}</th>
                <th scope="col" style="width: 10%;" class="text-center">{{ __('inventory.total') }}</th>
            </thead>
            <tbody>
            @foreach ($client_order->products as $item)
                <tr id="client_order_selected_product-{{ $item->product_id }}" class="pointer" ondblclick="client_order_edit_product('{{$client_order->id}}','{{ $item->product_id }}');">
                    <td scope="col" class="article">{{ $item->product->article }}</td>
                    <td scope="col" class="brand">{{ $item->product->brand }}</td>
                    <td scope="col" class="name">{{ $item->product->name }}</td>
                    <td scope="col" class="text-center stock">{{ $item->product->stocks()->sum('quantity') ?? 0}}</td>
                    <td scope="col" class="text-center quantity">{{ $item->quantity }}</td>
                    <td scope="col" class="text-center price">{{ $item->price }}</td>
                    <td scope="col" class="text-center total_amount">{{ $item->total_amount }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>