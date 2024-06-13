<?php

namespace App\Http\Controllers;
use App\Models\Polygons;
use Illuminate\Http\Request;

class PolygonController extends Controller
{
    public function __construct ()
    {
        $this->polygon = new Polygons();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $polygons = $this->polygon->polygons();

        foreach ($polygons as $pg){
            $feature[] = [
                'type' =>'Feature',
                'geometry'=> json_decode($pg->geom),
                'properties'=>[
                    'id'=> $pg->id, // unique value untuk penghapusan data
                    'name'=>$pg->name,
                    'description'=>$pg->description,
                    'image'=>$pg ->image,
                    'created_at'=>$pg->created_at,
                    'updated_at'=>$pg->updated_at
                ]
            ];
        }

        return response()->json([
            'type'=>'FeatureCollection',
            'features'=>$feature
            ]
        );
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
        // Validate request
        $request->validate([
            'name'=>'required',
            'geom'=>'required',
            'image'=>'mimes::jpeg,jpg,png,gif|max:1000' //Memvalidasi file yang diupload, tidak sembarang file dapat diupload meningkatkan security
        ],
        [
            'name.required'=> 'Name is required',
            'geom.required'=> 'Location is required',
            'image.mimes'=> 'Image must be a file of type: jpg, jpeg, png, tiff, gif',
            'image.max'=> 'Image must to exceed 10MB'
        ]);

        // create folder images --> pengecekan folder image, jika tidak ada maka dibuat menggunakan mkdir
        if(!is_dir('storage/images')) {
            mkdir('storage/images', 0777);
        }

        // upload image --> ketika input dengan nama image itu ada filenya, maka akan dibuat variabel image dengan menangkap file image dilengkapi dengan pembuatan filename sesuai yang atur
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_polygon.' . $image->getClientOriginalExtension();
            $image->move('storage/images', $filename);
        }else{
            $filename = null;

        }

        $data =[
            'name' => $request->name,
            'description' => $request->description,
            'geom' => $request->geom,
            'image' => $filename
        ];

        // Create Polygon
        if(!$this->polygon->create($data)) {
            return redirect()->back()->with('eror', 'Failed to create polygon');
        }
          //   Redirect to Map
        return redirect()->back()->with('success', 'Polygon created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $polygons = $this->polygon->polygon($id);

        foreach ($polygons as $p){
            $feature[] = [
                'type' =>'Feature',
                'geometry'=> json_decode($p->geom), //Json_decode --> konversi string json menjadi php
                'properties'=>[
                    'id'=> $p->id,
                    'name'=>$p->name,
                    'description'=>$p->description,
                    'image'=>$p->image,
                    'created_at'=>$p->created_at,
                    'updated_at'=>$p->updated_at
                ]
            ];
        }
        return response()->json([
            'type'=>'FeatureCollection',
            'features'=>$feature
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $polygon = $this->polygon->find($id);

        $data = [
            'title' => 'Edit Polygon',
            'polygon' => $polygon,
            'id' => $id,
        ];

        return view('edit-polygon', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate request
      $request->validate([
        'name' => 'required',
        'geom' => 'required',
        'image' => 'mimes:jpeg,jpg,png,gif|max:10000' //10 MB
    ],
    [
        'name.required' => 'Name is required',
        'geom.required' => 'Location is required',
        'image.mimes' => 'Image must be a file of type: jpeg, jpg, png, giff',
        'image.max' => 'Image must not exceed 10 MB'
    ]);


    // membuat folder image
    if(!is_dir('storage/images')) {
        mkdir('storage/images', 0777);
    }

    // upload image
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = time() . '_polygon.' . $image->getClientOriginalExtension();
        $image->move('storage/images', $filename);

        // delete image
        $image_old = $request->image_old;
        if ($image_old != null) {
            unlink('storage/images/' . $image_old);
        }

    } else {
        $filename = $request->image_old;
    }

    $data = [
        'name' => $request->name,
        'description' => $request->description,
        'geom' => $request->geom,
        'image' => $filename
    ];

    // update polygon
    if(!$this->polygon->find($id)->update($data)) {
        return redirect()->back()->with('error', 'Failed to update polygon');
    }

    // redirect to map
    return redirect()->back()->with('success', 'Polygon updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       // get image --> hanya mencari nama gambar maka menambahkan melalui query id --> image
       $image =$this->polygon->find($id)->image;



       //delete polygon
       if (!$this->polygon->destroy($id)) {
           return redirect()->back()->with('eror', 'Failed to detele polygon');
       }


       // delete image
       if($image != null) {
           unlink('storage/images/' . $image);
       }

       //redirect to map
       return redirect()->back()->with('success', 'Polygon delete sucessfully');
    }

    public function table ()
    {
        $polygons = $this->polygon->polygons();

        $data = [
            'title' => 'Table Polygon',
            'polygons' => $polygons
        ];

        return view('table-polygon', $data);
    }
}
