<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    public function __invoke(Request $request)
    {
        // chefs
        $chefs = DB::table('chefs')
        ->latest()
        ->limit(6)
        ->get( ['name', 'photo', 'position', 'description', 'instagram_link', 'linkedin_link']);

        // events
        $events = DB::table('events')
        ->latest()
        ->limit(6)
        ->get(['name', 'price', 'description', 'photo']);

        // Image
        $images = DB::table('images')
        ->latest()
        ->limit(6)
        ->get(['file']);

        $videos = DB::table('videos')
        ->latest()
        ->limit(6)
        ->get(['name', 'video_link']);

        return view('frontend.index', [
           'chefs' => $chefs,
           'events' => $events,
           'images' => $images,
           'videos' => $videos,
           'menu_starters' => $this->getMenu(1),
           'menu_breakfasts' => $this->getMenu(2),
           'menu_lunches' => $this->getMenu(3),
           'menu_dinners' => $this->getMenu(4)
        ]);

    }
    public function getMenu(string $id){
        $menu = Menu::with('category:id,title')
        ->where('category_id', $id)
        ->where('status', 'active')
        ->limit(6)
        ->get(['category_id','name', 'price', 'description', 'photo']);
        return $menu;
    }
}

