<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Galerry\Image;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    // public function __construct(private ImageService $ImageService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::latest()->paginate(10);
        return view('backend.image.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.image.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:images,name',  // Pastikan name unik
            'description' => 'required|min:3',
            'file' => 'required|image|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ]);
    
        try {
            // Simpan file ke folder 'images' di storage public
            $fileName = uniqid() . '.' . $request->file('file')->extension();
            $filePath = $request->file('file')->storeAs('public',$fileName);
    
            // Menyimpan data ke database
            $data = [
                'uuid' => Str::uuid(),  // Buat UUID baru
                'name' => $request->name,
                'slug' => Str::slug($request->name),  // Membuat slug dari name
                'description' => $request->description,
                'file' => $filePath  // Simpan path file
            ];
    
            Image::create($data);
    
            return redirect()->route('panel.image.index')->with('success', 'Image created successfully');
        } catch (\Throwable $error) {
            return redirect()->back()->with('error', $error->getMessage());
        }
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
        //
    }
}
