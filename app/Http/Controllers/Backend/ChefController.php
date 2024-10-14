<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\ChefRequest;
use App\Http\Services\ChefService;
use App\Http\Services\FileService;
use App\Http\Controllers\Controller;

class ChefController extends Controller
{
    public function __construct(
        private ChefService $chefService,
        private FileService $fileService,
    ) {}

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
        if (Auth::user()->role == 'owner') {
            return redirect()->route('panel.chef.index')->with('error', 'You dont have permission to create chef');
        }

        return view('Backend.chef.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChefRequest $request)
    {
        $data = $request->validated();
        try {
            $data['photo'] = $this->fileService->upload($data['photo'], path: 'chef');
            $data['uuid'] = (string) Str::uuid();
            $this->chefService->create($data);
            return redirect()->route('panel.chef.index')->with('success', 'Chef has been created');
        } catch (\Exception $err) {
            $this->fileService->delete($data['photo']);

            return redirect()->back()->with('error', $err->getMessage());
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
        if (Auth::user()->role == 'owner') {
            return redirect()->route('panel.chef.index')->with('error', 'You dont have permission to edit chef');
        }

        $chef = $this->chefService->getByid($id);

        return view('Backend.chef.edit', compact('chef'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChefRequest $request, string $id)
    {
        if (Auth::user()->role == 'owner') {
            return redirect()->route('panel.chef.index')->with('error', 'You dont have permission to update chef');
        }

        $data = $request->validated();
        try {
            $chef = $this->chefService->getByid($id);
            if ($request->hasFile('photo')) {
                $this->fileService->delete($chef->photo);
                $data['photo'] = $this->fileService->upload($request->file('photo'), path: 'chef');
            } else {
                $data['photo'] = $chef->photo;
            }
            $this->chefService->update($data, $id);

            return redirect()->route('panel.chef.index')->with('success', 'Chef has been updated');
        } catch (\Exception $err) {
            if ($request->file('photo')) {
                $this->fileService->delete($data['photo']);
            }

            return redirect()->back()->with('error', $err->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        if (Auth::user()->role == 'owner') {
            return redirect()->route('panel.chef.index')->with('error', 'You dont have permission to delete chef');
        }

        try {
            $chef = $this->chefService->getByid($uuid);
            $this->fileService->delete($chef->photo);
            $chef->delete();
            return response()->json(['message' => 'Image deleted successfully']);
        } catch (\Exception $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }
}

