<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Galerry\Image;
use App\Http\Services\FileService;
use App\Http\Requests\ImageRequest;
use App\Http\Services\ImageService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Services\MiddlewareService;

class ImageController extends Controller
{
    /**
     * Membuat instance dari ImageService
     *
     * @var ImageService
     */
    public function __construct(
        private FileService $fileService,
        private ImageService $imageService,
        private MiddlewareService $MiddlewareService
    ){
            $this->MiddlewareService->aksesRole();
    }

    /**
     * Menampilkan list image
     */
    public function index(Request $request)
    {
        if (Session::get('role') === 'owner') {
            return redirect()->route('panel.transaction.index');
        }
        // mengirimkan data ke view backend.image.index
        return view('backend.image.index', [
            'images' => $this->imageService->select(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Session::get('role') === 'owner') {
            return redirect()->route('panel.transaction.index');
        }
        return view('backend.image.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImageRequest $request)
    {
        if (Session::get('role') === 'owner') {
            return redirect()->route('panel.transaction.index');
        }
        $data = $request->validated();
        try {
            $data['file'] = $this->fileService->upload($data['file'], 'images');
            $this->imageService->create($data);
            return redirect()->route('panel.image.index')->with('success', 'Image created successfully');
        } catch (\Throwable $error) {
            $this->fileService->delete($data['file'] );
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data, pastikan data yang diinputkan benar dan tidak ada duplikasi nama. Error: ' . $error->getMessage());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Session::get('role') === 'owner') {
            return redirect()->route('panel.transaction.index');
        }
        $image = $this->imageService->getByid($id);
        return view('backend.image.show',[
            'image' => $image
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Session::get('role') === 'owner') {
            return redirect()->route('panel.transaction.index');
        }
        $image = $this->imageService->getByid($id);
        return view('backend.image.edit',[
            'image' => $image
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ImageRequest $request, string $id)
    {
        if (Session::get('role') === 'owner') {
            return redirect()->route('panel.transaction.index');
        }
        $data = $request->validated();
        $getimage = $this->imageService->getByid($id);
        try {
            if ($request->hasFile('file')) {
                $this->fileService->delete($getimage->file);
                $data['file'] = $this->fileService->upload($request->file('file'), 'images');
            }
            $this->imageService->update($data, $id);
            return redirect()->route('panel.image.index')->with('success', 'Image updated successfully');
        } catch (\Throwable $error) {
            $this->fileService->delete($data['file']);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data, pastikan data yang diinputkan benar dan tidak ada duplikasi nama. Error: ' . $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Session::get('role') === 'owner') {
            return redirect()->route('panel.transaction.index');
        }
        try {
            $image = $this->imageService->getByid($id);
            $this->fileService->delete($image->file);
            $image->delete();
            return response()->json(['message' => 'Image deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while deleting the data. Error: ' . $th->getMessage()]);
        }
    }
}
