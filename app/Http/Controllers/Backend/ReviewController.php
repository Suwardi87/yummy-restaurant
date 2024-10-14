<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:operator', ['except' => ['index', 'show']]);
    }

    public function index(): View
    {
        return view('backend.review.index', [
            'reviews' => Review::with('transaction:id,code')->paginate(10),
        ]);
    }

    public function show(string $uuid, Request $request): RedirectResponse|View
    {
        if ($request->session()->get('role') === 'owner') {
            return redirect()->route('panel.review.index')->with('error', 'You dont have permission to edit review');
        }

        $review = Review::with('transaction:id,code,name,type')
        ->whereUuid($uuid)->firstOrFail();

        return view('backend.review.show', [
            'review' => $review
        ]);
    }

    public function destroy(string $uuid, Request $request): JsonResponse
    {
        if ($request->session()->get('role') === 'owner') {
            return response()->json([
                'message' => 'You dont have permission to delete review'
            ], 403);
        }

        $review = Review::where('uuid', $uuid)->firstOrFail();
        $review->delete();

        return response()->json([
            'message' => 'Review deleted successfully'
        ]);
    }
}
