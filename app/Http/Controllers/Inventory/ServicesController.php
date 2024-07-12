<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;

use App\Models\Service\Service;

use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Service::paginate(25);

        return view('inventory.services.index', compact('services'));
    }

    public function create()
    {
        return view('inventory.services.create');
    }

    public function store(Request $request, Service $service)
    {
        $service->create($request->all());

        return redirect()->route('services.index')->withStatus('Successfully registered customer.');
    }

    public function show(Service $service)
    {
        return view('inventory.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('inventory.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $service->update($request->all());

        return redirect()->route('services.index')->withStatus('Service successfully modified.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')->withStatus('Service successfully removed.');
    }

   	//////////////////////////////////////////////////////////////////// ** service Live Search ** ////////////////////////////////////////////////////////////////////
	public static function serviceLiveSearch(Request $request)
	{
        $search = strip_tags($request->serviceLive);        
        if ($search)
		{
            $data = Service::where('article', 'LIKE', "%${search}%")
							->orWhere('name', 'LIKE', "%${search}%")
							->limit(10)->get(['id', 'name']);
        }
		else
		{
            $data = Service::where('id', 'LIKE', "%%")->limit(15)->get(['id', 'name']);
        }
        return response()->json($data);
	}
}
