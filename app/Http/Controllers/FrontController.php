<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index() {
        return view('category');
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:15'
        ]);

        Category::create([
            'nama' => $request->name
        ]);

        return response()->json([
            'success' => 'Category Saved Successfully'
        ], 200);
    }

    public function update(Request $request) {
        $request->validate([
            'name' => 'required|max:15'
        ]);

        $data = Category::find($request->id);
        $data->nama = $request->name;
        $data->save();

        return response()->json([
            'success' => 'Category Updated Successfully'
        ], 200);
    }
    
    public function show() {
        $data = Category::all();
        return response()->json([
            'data' => $data
        ], 200);
    }

    public function destroy($id) {
        $data = Category::find($id);
        if ($data) {
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

    public function dashboard() {
        return view('dashboard');
    }
}
