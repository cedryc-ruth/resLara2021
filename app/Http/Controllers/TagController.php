<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;
use App\Models\Show;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tag' => 'required|max:60',
        ]);

        $show = Show::find($request['show_id']);

        //Rechercher le tag
        $tag = Tag::firstWhere('tag',$request['tag']);

        //Ajouter à la table tags si nouveau mot-clé
        if(empty($tag)) {
            $tag = new Tag;
            $tag->tag = $request['tag'];
            $result = $tag->save();

            if(!$result) {
                $request->session()->flash('message','Le nouveau mot-clé n\'a pas pu être ajouté !');
                $request->session()->flash('alert-class','alert-danger');

                return redirect()->route('show_show',$show->id);
            }
        }

        if($tag) {
            //Ajouter à la table show_tag
            try {
                $result = DB::table('show_tag')->insert([
                    ['show_id' => $show->id, 'tag_id' => $tag->id],
                ]);
            } catch(\Illuminate\Database\QueryException $qe) {
                $request->session()->flash('message','Une exception s\'est produite ! Le mot-clé n\'a pas pu être associé à ce spectacle !');
                $request->session()->flash('alert-class','alert-danger');

                return redirect()->route('show_show',$show->id);
            }

            if($result) {
                $request->session()->flash('message','Le mot-clé a bien été associé à ce spectacle !');
                $request->session()->flash('alert-class','alert-success');

                return redirect()->route('show_show',$show->id);
            }
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        
        return view('tag.show',[
            'tag' => $tag,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
