<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\MenuRequest;
use App\Http\Services\FileService;
use App\Http\Services\MenuService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\CategoryService;
use App\Http\Services\MiddlewareService;

class MenuController extends Controller
{
    public function __construct(
        private MenuService $menuService,
        private CategoryService $categoryService,
        private FileService $fileService,
        private MiddlewareService $MiddlewareService
        ){
            $this->MiddlewareService->aksesRole();
        }

    public function index()
    {
        // Mendapatkan daftar menu untuk ditampilkan
        return view('backend.menu.index', ['menus' => $this->menuService->select(3)]);
    }

    public function create()
    {
        // Menampilkan formulir untuk membuat menu baru
        return view('backend.menu.create', ['categories' => $this->categoryService->option()]);
    }

    public function store(MenuRequest $request)
    {
        try {
            $data = $request->validated();
            $data['photo'] = $this->fileService->upload($data['photo'], 'menus');
            $this->menuService->create($data);
            return redirect()->route('panel.menu.index')->with('success', 'Menu has been created');
        } catch (\Exception $err) {
            // Pastikan data sudah ada sebelum mencoba menghapus
            if (isset($data['photo'])) {
                $this->fileService->delete($data['photo']);
            }
            return redirect()->back()->with('error', $err->getMessage());
        }
    }

    public function show(string $uuid)
    {
        // Menampilkan detail menu berdasarkan UUID
        return view('backend.menu.show', ['menu' => $this->menuService->selectFirstBy('uuid', $uuid)]);
    }

    public function edit(string $id)
    {
        // Menampilkan formulir untuk mengedit menu
        return view('backend.menu.edit', [
            'menu' => $this->menuService->getByid($id),
            'categories' => $this->categoryService->option(),
        ]);
    }

    public function update(MenuRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $getMenu = $this->menuService->getByid($id);
            if ($request->hasFile('photo')) {
                $this->fileService->delete($getMenu->photo);
                $data['photo'] = $this->fileService->upload($request->file('photo'), 'images');
            }
            $this->menuService->update($data, $id);
            return redirect()->route('panel.menu.index')->with('success', 'Menu has been updated');
        } catch (\Exception $error) {
            // Pastikan data sudah ada sebelum mencoba menghapus
            if (isset($data['photo'])) {
                $this->fileService->delete($data['photo']);
            }
            return redirect()->back()->with('error', $error->getMessage());
        }
    }

    public function destroy(string $uuid)
    {
        try {
            $menu = $this->menuService->getByid($uuid);
            $this->fileService->delete($menu->photo);
            $menu->delete();
            return response()->json(['message' => 'Menu deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while deleting the data. Error: ' . $th->getMessage()]);
        }
    }
}