<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Http\Services\VideoService;

class VideoController extends Controller
{
    public function __construct(
        private VideoService $videoService
    ){
        // Menggunakan middleware untuk kontrol akses berdasarkan role
        $this->middleware('can:owner', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.video.index',[
            'videos' => $this->videoService->select(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VideoRequest $request)
    {
        $video = $request->validated();
        try {
            $this->videoService->create($video);
            return redirect()->route('panel.video.index')->with('success', 'Menu has been created');
        } catch (\Exception $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $video = $this->videoService->getByid($id);
        return view('backend.video.show',[
            'video' => $video
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('backend.video.edit', [
            'video' => $this->videoService->getByid($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VideoRequest $request, string $id)
    {
        $video = $request->validated();
        try {
            $this->videoService->update($video, $id);
            return redirect()->route('panel.video.index')->with('success', 'Menu has been updated');
        } catch (\Exception $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $video = $this->videoService->getByid($id);
            $video->delete();
            return response()->json(['message' => 'Image deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while deleting the data. Error: ' . $th->getMessage()]);
        }
    }
}

