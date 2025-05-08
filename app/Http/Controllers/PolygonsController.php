<?php

namespace App\Http\Controllers;

use App\Models\PolygonModel;
use App\Models\PolygonsModel;
use Illuminate\Http\Request;

class PolygonsController extends Controller
{
    protected $polygons;
    public function __construct()
    {
        $this->polygons = new PolygonsModel();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Map',
            'polygons' => $this->polygons->all(), // Menampilkan semua polygons
        ];
        return view('map', $data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:polygons,name',
                'description'=> 'required',
                'geom_polygon'=> 'required',
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_polygon.required' => 'Geometry is required',
            ]
        );

             // Create images directory if not exists
             if (!is_dir('storage/images')) {
                mkdir('./storage/images', 0777);
            }

            //  Get image file
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name_image = time() . "_polygons." . strtolower($image->getClientOriginalExtension());
                $image->move('storage/images', $name_image);
            } else {
                $name_image = null;
            }

        $data = [
            'geom' => $request->geom_polygon,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
        ];

        // Buat data dan cek keberhasilan
        if (!$this->polygons->create($data)) {
            return redirect()->route('polygons.index')->with('error', 'Polygon failed to be added');
        }

        // Redirect ke halaman peta
        return redirect()->route('polygons.index')->with('success', 'Polygon has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagafile = $this->polygons->findOrFail($id);
        if ($imagafile->image) {
            $file_path = public_path('storage/images/' . $imagafile->image);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        if (!$this->polygons->destroy($id)) {
            return redirect()->route('polygons.index')->with('error', 'Polygon failed to be deleted');
        }
        // Redirect ke halaman peta
        return redirect()->route('polygons.index')->with('success', 'Polygon has been deleted');
        // Redirect ke halaman peta
            return redirect()->route('map')->with('success', 'Polygon has been deleted');
    }
}
