<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\TagResource;
use App\Models\Show;
use App\Models\Tag;
use Illuminate\Http\Resources\Json\JsonResource;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/show/{id}/tag/{tag}', function (Request $request, $id, $tag) {
    //Récupérer le mot-clé
    $tag = Tag::firstWhere('tag',$tag);

    if(empty($tag)) {
        return new JsonResource(null);
    }

    //Vérifier si le mot-clé est déjà associé avec ce show
    $result = DB::table('show_tag')
        ->where('show_id',$id)
        ->where('tag_id',$tag->id)
        ->get();

    return new JsonResource($result);
});