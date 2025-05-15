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

             // Create images directory if not exists
             if (!is_dir('storage/images')) {
                mkdir('./storage/images', 0777);
            }

            //  Get image file
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name_image = time() . "_polylines." . strtolower($image->getClientOriginalExtension());
                $image->move('storage/images', $name_image);
            } else {
                $name_image = null;
            }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'geom' => $request->geom_polyline,
            'image' => $name_image,
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
        $data = [
            'title' => 'Edit Polyline',
            'id' => $id,
        ];
        return view('edit-polyline', $data);
    }

    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request, string $id)
{
    // validate request
    $request->validate([
        'name' => 'required|unique:polylines,name,' . $id,
        'description' => 'required',
        'geom_polyline' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
        'name.required' => 'Name is required',
        'name.unique' => 'Name already exists',
        'description.required' => 'Description is required',
        'geom_polyline.required' => 'Geometry is required',
    ]);

    // Create images directory if not exists
    if (!is_dir('storage/images')) {
        mkdir('./storage/images', 0777);
    }

    // Get old image file name
    $old_image = $this->polylines->find($id)->image;

    // Get image file
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $name_image = time() . "_polylines." . strtolower($image->getClientOriginalExtension());
        $image->move('storage/images', $name_image);

        // Delete old image file if exists
        if ($old_image != null && file_exists('storage/images/' . $old_image)) {
            unlink('storage/images/' . $old_image);
        }
    } else {
        $name_image = $old_image;
    }

    // Prepare data for update
    $data = [
        'geom' => $request->geom_polyline, // ✅ perbaikan ada di sini
        'name' => $request->name,
        'description' => $request->description,
        'image' => $name_image,
    ];

    // Update and check success
    if (!$this->polylines->find($id)->update($data)) {
        return redirect()->route('polylines.index')->with('error', 'Polyline failed to be updated');
    }

    return redirect()->route('polylines.index')->with('success', 'Polyline has been updated');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $imagefile = $this->polylines->find($id)->image;

        if (!$this->polylines->destroy($id)) {
            return redirect()->route('polylines.index')->with('error', 'Polyline failed to be deleted');
        }

        // Delete image file
        if ($imagefile != null) {
            if (file_exists('storage/images/' . $imagefile)) {
                unlink('storage/images/' . $imagefile);
            }
        }

        // Redirect ke halaman peta
        return redirect()->route('polylines.index')->with('success', 'Polyline has been deleted');
    }
}
