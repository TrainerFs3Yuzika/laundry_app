<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_service' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|array',
            'description.*' => 'required|string',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $service = new Service();
        $service->name_service = $request->name_service;
        $service->price = $request->price;
        $service->description = $request->description;
        $service->status = $request->status;

        $service->save();

        return response()->json(['success' => 'Service created successfully!']);
    }

    public function edit($id)
    {
        $service = Service::find($id);

        if ($service) {
            return response()->json(['service' => $service]);
        }

        return response()->json(['error' => 'Service not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_service' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|array',
            'description.*' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }

        $service->name_service = $request->name_service;
        $service->price = $request->price;
        $service->description = $request->description;
        $service->status = $request->status;

        $service->save();

        return response()->json(['success' => 'Service updated successfully!']);
    }

    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }

        $service->delete();

        return response()->json(['success' => 'Service deleted successfully!']);
    }
}
