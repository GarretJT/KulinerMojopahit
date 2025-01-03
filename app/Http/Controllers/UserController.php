<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Category;
use App\About;
use App\Article;
use App\Destination;
use App\Suvenir;
use App\Menu;
use App\Gallery;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    
  public function __construct()
  {
      // $this->middleware('auth');
  }

  
  public function home()
  {
      $data = [
          'categories' => Category::all(),
          'about'      => About::all(),
          'galleries'  => Gallery::all() // Add galleries here
      ];
  
      // Log the data for debugging
      Log::info('Gallery Data:', $data['galleries']->toArray());
  
      return view('user.home', $data);
  }
  

  public function blog(Request $request){

    $keyword    = $request->get('s') ? $request->get('s') : '';
    $category   = $request->get('c') ? $request->get('c') : '';

    $articles = Article::with('categories')
                ->whereHas('categories', function($q) use($category){
                    $q->where('name', 'LIKE', "%$category%");
                })
                ->where('status', 'PUBLISH')
                ->where('title', 'LIKE', "%$keyword%")
                ->orderBy('created_at','desc')
                ->paginate(10);
    $recents = Article::select('title','slug')->where('status', 'PUBLISH')->orderBy('created_at','desc')->limit(5)->get();

    $data = [
      'articles'  => $articles,
      'recents'   => $recents
    ];

    return view('user/blog', $data);
  }


  public function show_article($slug)
  {
    $articles   = Article::where('slug', $slug)->first();
    $recents    = Article::select('title','slug')->where('status', 'PUBLISH')->orderBy('created_at','desc')->limit(5)->get();
    $data = [
      'articles'  => $articles,
      'recents'   => $recents
    ];
    return view('user/blog', $data);
  }

  public function destination(Request $request){
      $keyword    = $request->get('s') ? $request->get('s') : '';

      $destinations           = Destination::where('title', 'LIKE', "%$keyword%")->orderBy('created_at', 'desc')->paginate(10);
      $other_destinations     = Destination::select('title','slug')->where('status', 'PUBLISH')->orderBy('created_at','desc')->limit(5)->get();

      $data = [
          'destinations'  => $destinations,
          'other'         => $other_destinations
      ];

      return view('user/destination', $data);
  }

  public function show_destination($slug){
      $destinations       = Destination::where('slug', $slug)->firstOrFail();
      $other_destinations = Destination::select('title','slug')->where('status', 'PUBLISH')->orderBy('created_at','desc')->limit(5)->get();

      $data = [
          'destinations'  => $destinations,
          'other'         => $other_destinations
      ];

      return view('user/destination', $data);
  }

  public function contact(){
      return view('user/contact');
  }

  // Show all souvenirs
public function suvenir()
{
    $suvenirs = Suvenir::where('status', 'PUBLISH')
                      ->orderBy('created_at', 'desc')
                      ->paginate(6); // Use pagination if needed

    return view('user.suvenir', compact('suvenirs'));
}

// Show specific souvenir
public function show_suvenir($id)
{
    $suvenir = Suvenir::findOrFail($id);
    
    return view('user.suvenir-detail', compact('suvenir'));
}
  
public function showTenantMenus($slug)
{
    // Find the tenant by slug (or use ID if preferred)
    $tenant = Destination::where('slug', $slug)->firstOrFail();

    // Fetch the menus associated with this tenant
    $menus = Menu::where('tenant_id', $tenant->id)->get();

    return view('user.menu', compact('tenant', 'menus'));
}


}
