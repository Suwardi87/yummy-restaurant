<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Services\FileService;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Http\Services\CategoryService;
use App\Http\Services\MenuService;

class MenuController extends Controller
{
    public function __construct(
        private MenuService $menuService,
        private CategoryService $categoryService,
        private FileService $fileService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.menu.index', [
            'menus' => $this->menuService->select(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.menu.create', [
            'categories' => $this->categoryService->option($coloumn = null, $value = null),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request)
    {
        $data = $request->validated();
        try {
            $data['photo'] = $this->fileService->upload($data['photo'], 'images');

            $this->menuService->create($data);

            return redirect()->route('panel.menu.index')->with('success', 'Menu has been created');
        } catch (\Exception $err) {
            $this->fileService->delete($data['image']);

            return redirect()->back()->with('error', $err->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        return view('backend.menu.show', [
            'menu' => $this->menuService->selectFirstBy('uuid', $uuid)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('backend.menu.edit', [
            'menu' => $this->menuService->getByid($id),
            'categories' => $this->categoryService->option($coloumn = null, $value = null),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, string $id)
    {
        $data = $request->validated();
        $getMenu = $this->menuService->getByid($id);
        try {
            if ($request->hasFile('photo')) {
                $this->fileService->delete( $getMenu->photo);
                $data['photo'] = $this->fileService->upload($request->file('photo'), 'images');
            }
            $this->menuService->update($data, $id);
            return redirect()->route('panel.menu.index')->with('success', 'Image updated successfully');
        } catch (\Exception $error) {
            $this->fileService->delete($data['photo']);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data, pastikan data yang diinputkan benar dan tidak ada duplikasi nama. Error: ' . $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        try {
            $menu = $this->menuService->getByid($uuid);
            $this->fileService->delete( $menu->photo);
            $menu->delete();
            return response()->json(['message' => 'Image deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while deleting the data. Error: ' . $th->getMessage()]);
        }
    }
}
