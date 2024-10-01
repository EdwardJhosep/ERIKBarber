<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    // Mostrar la lista de servicios
    public function index()
    {
        $services = Service::all();
        return view('home', compact('services'));
    }
    // Mostrar la lista de servicios
public function servicios()
{
    $services = Service::all();
    return view('servicios', compact('services'));
}


    // Guardar un nuevo servicio
    public function store(Request $request)
    {
        $request->validate([
            'serviceName' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp,svg,webp|max:2048',
        ]);

        $service = new Service();
        $service->name = $request->serviceName;
        $service->price = $request->price;
        $service->description = $request->description;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('services', 'public');
            $service->photo = $path;
        }

        $service->save();

        return redirect('/home')->with('success', 'Servicio agregado correctamente.');
    }

    // Mostrar el formulario de edición
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service);
    }

    // Actualizar el servicio
    public function update(Request $request, $id)
    {
        $request->validate([
            'serviceName' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp,svg,webp|max:2048',
        ]);

        $service = Service::findOrFail($id);
        $service->name = $request->serviceName;
        $service->price = $request->price;
        $service->description = $request->description;

        if ($request->hasFile('photo')) {
            // Eliminar la foto anterior si existe
            if ($service->photo) {
                Storage::disk('public')->delete($service->photo);
            }
            $path = $request->file('photo')->store('services', 'public');
            $service->photo = $path;
        }

        $service->save();

        return redirect('/home')->with('success', 'Servicio actualizado correctamente.');
    }

    // Eliminar el servicio
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        // Eliminar la foto si existe
        if ($service->photo) {
            Storage::disk('public')->delete($service->photo);
        }
        $service->delete();
        return redirect('/home')->with('success', 'Servicio eliminado correctamente.');
    }
}
