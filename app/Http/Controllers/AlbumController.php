<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Album;
use App\Models\User;

class AlbumController extends Controller 
{
    public function index()
    {
        $user = Auth::user();
      
        $albumes = $user->albums()->with('fotos')->get();
        
        return view('album.mostrar', compact('albumes'));
    }
}