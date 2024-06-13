<?php

namespace App\Http\Controllers;
use App\Models\Points;
use Illuminate\Http\Request;

class PointController extends Controller
{
    public function __construct ()
    {
        $this->point = new Points();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $points = $this->point->points();

        foreach ($points as $p){
            $feature[] = [
                'type' =>'Feature',
                'geometry'=> json_decode($p->geom), //Json_decode --> konversi string json menjadi php
                'properties'=>[
                    'id'=> $p->id, // unique value untuk penghapusan data
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
     * Store a newly created resource in storage. (Memasukkan data ke dalam database)
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
            $filename = time() . '_point.' . $image->getClientOriginalExtension();
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

        // Create Point
        if(!$this->point->create($data)) {
            return redirect()->back()->with('eror', 'Failed to create point');
        }
          //   Redirect to Map
        return redirect()->back()->with('success', 'Point created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $points = $this->point->point($id);

        foreach ($points as $p){
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
        $point = $this->point->find($id);

        $data = [
            'title' => 'Edit Point',
            'point' => $point,
            'id' => $id,
        ];

        return view('edit-point', $data);


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
                $filename = time() . '_point.' . $image->getClientOriginalExtension();
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

            // update point
            if(!$this->point->find($id)->update($data)) {
                return redirect()->back()->with('error', 'Failed to update point');
            }

            // redirect to map
            return redirect()->back()->with('success', 'Point updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // get image (mencari nama gambar dengan id tertentu)
        $image = $this->point->find($id)->image;

        // dd($image);

        // delete point
        if (!$this->point->destroy($id)) {
            return redirect()->back()->with('error', 'Failed to delete point');
        }

        // delete image
        if ($image != null) {
            unlink('storage/images/' . $image);
        }

        // redirect to map
        return redirect()->back()->with('success', 'Point deleted succesfully');

    }


    public function table ()
    {
        $points = $this->point->points();

        $data = [
            'title' => 'Table Point',
            'points' => $points
        ];

        return view('table-point', $data);
    }
}
