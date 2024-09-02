<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FilmController extends Controller
{
    public function index() {
        $category = Category::all();
        return view('film', compact('category'));
    }
    public function show() {
        $data = Film::with('categories')->get();
        return response()->json([
            'data' => $data
        ], 200);
    }
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', 
            'category' => 'required|integer',
            'year' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {            
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);

            // Path yang bisa kamu simpan ke database
            $imagePath = 'images/' . $imageName;

        } else {
            $imagePath = null;
        }
    
        // Menyimpan film ke database
        $film = Film::create([
            'kategori_id' => $request->category,
            'judul' => $request->title,
            'deskripsi' => $request->description,
            'gambar' => $imagePath,
            'tahun' => $request->year,
        ]);
    
        return response()->json([
            'success' => 'Film Saved Successfully!',
        ], 200);
    }

    public function update(Request $request) {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', 
            'category' => 'required|integer',
            'year' => 'required|integer',
        ]);

        $data = Film::where('id',$request->id)->first();
        if($data) {

            if($request->hasFile('image')) {
                $imagePath = public_path($data->gambar); 
                if (file_exists($imagePath)) {
                    unlink($imagePath);            
                    $image = $request->file('image');
                    $imageName = time() . '-' . $image->getClientOriginalName();
                    $image->move(public_path('images'), $imageName);

                    // Path yang bisa kamu simpan ke database
                    $imagePath = 'images/' . $imageName;
                    $data->gambar = $imagePath;
                }
            } 
            $data->judul = $request->title;
            $data->deskripsi = $request->description;
            $data->kategori_id = $request->category;
            $data->tahun = $request->year;
            $data->save();
    
            if($request->hasFile('image')) {
                return response()->json([
                    'success' => 'Film Updated Successfully',
                    'gambar' => $imagePath
                ], 200);
            } else {
                return response()->json([
                    'success' => 'Film Updated Successfully'
                ], 200);
            }
        } else {
            return response()->json([
                'error' => 'Film not found.'
            ], 404); // HTTP 404 Not Found
        }
    }

    public function destroy($id) {
        $data = Film::where('id',$id)->first();
        if ($data) {
            $imagePath = public_path($data->gambar); 
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            // Logic to delete data if found
            $data->delete();
    
            return response()->json([
                'success' => 'Data successfully deleted.'
            ], 200); // HTTP 200 OK
        } else {
            return response()->json([
                'error' => 'Data not found.'
            ], 404); // HTTP 404 Not Found
        }
    }
}
