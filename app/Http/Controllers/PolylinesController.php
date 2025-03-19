<?php

namespace App\Http\Controllers;

use App\Models\PolylinesModel;
use Illuminate\Http\Request;

class PolylinesController extends Controller
{
    protected $polylines;

    public function __construct()
    {
        $this->polylines = new PolylinesModel();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Map',
            'polylines' => $this->polylines->all(), // Menampilkan semua garis
        ];
        return view('map', $data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('polylines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:polylines,name',
            'description' => 'required',
            'geom_polyline' => 'required',
        ], [
            'name.required' => 'Name is required',
            'name.unique' => 'Name already exists',
            'description.required' => 'Description is required',
            'geom_polyline.required' => 'Geometry is required',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'geom' => $request->geom_polyline,
        ];

        if (!$this->polylines->create($data)) {
            return redirect()->route('polylines.index')->with('error', 'Polyline failed to be added');
        }

        return redirect()->route('polylines.index')->with('success', 'Polyline has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $polyline = $this->polylines->findOrFail($id);
        return view('polylines.show', compact('polyline'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $polyline = $this->polylines->findOrFail($id);
        return view('polylines.edit', compact('polyline'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'geom_polyline' => 'required',
        ]);

        $polyline = $this->polylines->findOrFail($id);
        $polyline->update([
            'name' => $request->name,
            'description' => $request->description,
            'geom' => $request->geom_polyline,
        ]);

        return redirect()->route('polylines.index')->with('success', 'Polyline updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $polyline = $this->polylines->findOrFail($id);
        $polyline->delete();

        return redirect()->route('polylines.index')->with('success', 'Polyline deleted successfully');
    }
}
