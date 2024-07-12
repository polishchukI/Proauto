<div class="table-full-width table-responsive" id="selectedServicesTable">
    <table class="table">
        <thead class=" text-primary">
            <th scope="col" style="width: 10%;">{{ __('inventory.article') }}</th>
            <th scope="col" style="width: 30%;">{{ __('inventory.service') }}</th>
            <th scope="col" class="text-center" style="width: 30%;">{{ __('inventory.employee') }}</th>
            <th scope="col" class="text-center" style="width: 10%;">{{ __('inventory.price') }}</th>
            <th scope="col" class="text-center" style="width: 10%;">{{ __('inventory.discount') }}</th>
            <th scope="col" class="text-center" style="width: 10%;">{{ __('inventory.total_amount') }}</th>
        </thead>
        <tbody>
            @foreach ($repair_order->services as $item)
            <tr id="repair_order_selected_service-{{ $item->service_id }}" class="pointer" onclick="repair_order_edit_service('{{$repair_order->id}}','{{ $item->service_id }}');">
                <td scope="col" class="article">{{ $item->service->article }}</td>
                <td scope="col" class="name">{{ $item->service->name }}</td>
                <td scope="col" class="text-center employee">{{ $item->employee->fullname }}</td>
                <td scope="col" class="text-center price">{{ $item->price ?? 0}}</td>
                <td scope="col" class="text-center discount">{{ $item->discount ?? 0}}</td>
                <td scope="col" class="text-center total_amount">{{ $item->total_amount ?? 0}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>