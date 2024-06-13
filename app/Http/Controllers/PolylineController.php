<?php

namespace App\Http\Controllers;

use App\Models\Polylines;
use Illuminate\Http\Request;

class PolylineController extends Controller
{
    public function __construct ()
    {
        $this->polyline = new Polylines();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $polylines = $this->polyline->polylines();

        foreach ($polylines as $pl){
            $feature[] = [
                'type' =>'Feature',
                'geometry'=> json_decode($pl->geom),
                'properties'=>[
                    'id'=> $pl->id, // unique value untuk penghapusan data
                    'name'=>$pl->name,
                    'description'=>$pl->description,
                    'image'=>$pl ->image,
                    'created_at'=>$pl->created_at,
                    'updated_at'=>$pl->updated_at
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
            $filename = time() . '_polyline.' . $image->getClientOriginalExtension();
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


        // Create Polyline
        if(!$this->polyline->create($data)) {
            return redirect()->back()->with('eror', 'Failed to create polyline');
        }
          //   Redirect to Map
        return redirect()->back()->with('success', 'Polyline created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $polylines = $this->polyline->polyline($id); //supaya yang tertampil hanya 1 polyline sesuai idnya saja

        foreach ($polylines as $pl){
            $feature[] = [
                'type' =>'Feature',
                'geometry'=> json_decode($pl->geom),
                'properties'=>[
                    'id'=> $pl->id, // unique value untuk penghapusan data
                    'name'=>$pl->name,
                    'description'=>$pl->description,
                    'image'=>$pl ->image,
                    'created_at'=>$pl->created_at,
                    'updated_at'=>$pl->updated_at
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $polyline = $this->polyline->find($id);

        $data = [
            'title' => 'Edit Polyline',
            'polyline' => $polyline,
            'id' => $id,
        ];

        return view('edit-polyline', $data);
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
        $filename = time() . '_polyline.' . $image->getClientOriginalExtension();
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

    // update polyline
    if(!$this->polyline->find($id)->update($data)) {
        return redirect()->back()->with('error', 'Failed to update polyline');
    }

    // redirect to map
    return redirect()->back()->with('success', 'Polyline updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       // get image --> hanya mencari nama gambar maka menambahkan melalui query id --> image
       $image =$this->polyline->find($id)->image;



       //delete polyline
       if (!$this->polyline->destroy($id)) {
           return redirect()->back()->with('eror', 'Failed to detele polyline');
       }


       // delete image
       if($image != null) {
           unlink('storage/images/' . $image);
       }

       //redirect to map
       return redirect()->back()->with('success', 'Polyline delete sucessfully');
    }

    public function table ()
    {
        $polylines = $this->polyline->polylines();

        $data = [
            'title' => 'Table Polyline',
            'polylines' => $polylines
        ];

        return view('table-polyline', $data);
    }
}
