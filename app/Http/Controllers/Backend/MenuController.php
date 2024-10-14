<?php

namespace App\Http\Controllers\Backend;

use App\Http\Services\FileService;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Http\Services\CategoryService;
use App\Http\Services\MenuService;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function __construct(
        private MenuService $menuService,
        private CategoryService $categoryService,
        private FileService $fileService
    ) {}

    public function index()
    {
        if (Session::get('role') === 'owner') {
            return redirect()->route('panel.transaction.index');
        }
        return view('backend.menu.index', [
            'menus' => $this->menuService->select(3)
        ]);
    }

    public function create()
    {
        if (Session::get('role') === 'owner') {
            return redirect()->route('panel.transaction.index');
        }
        return view('backend.menu.create', [
            'categories' => $this->categoryService->option($coloumn = null, $value = null),
        ]);
    }

    public function store(MenuRequest $request)
    {
        if (Session::get('role') === 'owner') {
            return redirect()->route('panel.transaction.index');
        }
        $data = $request->validated();
        try {
            $data['photo'] = $this->fileService->upload($data['photo'], path: 'menus');

            $this->menuService->create($data);

            return redirect()->route('panel.menu.index')->with('success', 'Menu has been created');
        } catch (\Exception $err) {
            $this->fileService->delete($data['photo']);

            return redirect()->back()->with('error', $err->getMessage());
        }
    }

    public function show(string $uuid)
    {
        return view('backend.menu.show', [
            'menu' => $this->menuService->selectFirstBy('uuid', $uuid)
        ]);
    }

    public function edit(string $id)
    {
        if (Session::get('role') === 'owner') {
            return redirect()->route('panel.transaction.index');
        }
        return view('backend.menu.edit', [
            'menu' => $this->menuService->getByid($id),
            'categories' => $this->categoryService->option($coloumn = null, $value = null),
        ]);
    }

    public function update(MenuRequest $request, string $id)
    {
        if (Session::get('role') === 'owner') {
            return redirect()->route('panel.transaction.index');
        }
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

    public function destroy(string $uuid)
    {
        if (Session::get('role') === 'owner') {
            return redirect()->route('panel.transaction.index');
        }
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

