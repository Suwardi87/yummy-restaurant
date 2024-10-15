<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use App\Http\Requests\ChefRequest;
use App\Http\Services\ChefService;
use App\Http\Services\MiddlewareService;
use App\Http\Services\FileService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ChefController extends Controller
{
    public function __construct(
        private ChefService $chefService,
        private FileService $fileService,
        private MiddlewareService $MiddlewareService
        ){
            $this->MiddlewareService->aksesRole();
        }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Backend.chef.index', [
            'chefs' => $this->chefService->select()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.chef.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChefRequest $request)
    {
        $data = $request->validated();
        try {
            $data['photo'] = $this->fileService->upload($data['photo'], 'chef');
            $data['uuid'] = (string) Str::uuid();
            $this->chefService->create($data);

            return redirect()->route('panel.chef.index')->with('success', 'Chef has been created successfully.');
        } catch (\Exception $err) {
            if (isset($data['photo'])) {
                $this->fileService->delete($data['photo']);
            }

            Log::error('Error creating chef: ' . $err->getMessage());

            return redirect()->back()->with('error', 'An error occurred while creating the chef.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $chef = $this->chefService->getByid($id);

        return view('Backend.chef.show', compact('chef'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $chef = $this->chefService->getByid($id);

        return view('Backend.chef.edit', compact('chef'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChefRequest $request, string $id)
    {
        $data = $request->validated();
        try {
            $chef = $this->chefService->getByid($id);
            // Jika ada foto baru yang diupload, hapus foto lama
            if ($request->hasFile('photo')) {
                $this->fileService->delete($chef->photo);
                $data['photo'] = $this->fileService->upload($request->file('photo'), 'chef');
            } else {
                $data['photo'] = $chef->photo;
            }

            $this->chefService->update($data, $id);

            return redirect()->route('panel.chef.index')->with('success', 'Chef has been updated successfully.');
        } catch (\Exception $err) {
            if (isset($data['photo'])) {
                $this->fileService->delete($data['photo']);
            }

            Log::error('Error updating chef: ' . $err->getMessage());

            return redirect()->back()->with('error', 'An error occurred while updating the chef.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        try {
            $chef = $this->chefService->getByid($uuid);

            // Hapus file foto terlebih dahulu
            $this->fileService->delete($chef->photo);

            // Hapus chef dari database
            $chef->delete();

            return response()->json(['message' => 'Chef deleted successfully.']);
        } catch (\Exception $err) {
            Log::error('Error deleting chef: ' . $err->getMessage());

            return redirect()->back()->with('error', 'An error occurred while deleting the chef.');
        }
    }

    /**
     * Download the specified resource.
     */
    public function download(string $id)
    {
        try {
            $chef = $this->chefService->getByid($id);

            return response()->download($chef->photo, $chef->name . '.jpg');
        } catch (\Exception $err) {
            Log::error('Error downloading chef: ' . $err->getMessage());

            return redirect()->back()->with('error', 'An error occurred while downloading the chef.');
        }
    }
}
