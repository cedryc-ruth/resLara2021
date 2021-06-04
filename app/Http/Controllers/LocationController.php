<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::all();
        
        return view('location.index',[
            'locations' => $locations,
            'resource' => 'lieux',
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::find($id);

        //Récupérer la note
        $userLocation = DB::table('user_location')->where([
            'user_id'=>Auth::id(),
            'location_id'=>$id
        ])->first();
        
        $note = $userLocation->note ?? 0;

        return view('location.show',[
            'location' => $location,
            'note' => $note,
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function note(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'note' => 'required|integer|between:1,5',
        ], $messages = [
            'required' => 'The :attribute field is required.',
            'integer' => 'The :attribute field must be an integer.',
            'between' => 'The :attribute field must be between 1 and 5.',
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('location_show',$id)
                        ->withErrors($validator)
                        ->withInput();
        }

        //user_id, location_id, note
        $note = $request->note;
        $userId = Auth::id();
        $locationId = $id;

        //Persister
        $affected = DB::table('user_location')->updateOrInsert(
            ['user_id' => $userId, 'location_id' => $locationId],
            ['note' => $note]
        );

        if($affected) {
            Session::flash('success', 'Votre note a bien été enregistrée.');
        } else {
            Session::flash('error', 'La note n\'a pas été modifiée !');
        }

        $location = Location::find($id);
        
        return view('location.show',[
            'location' => $location,
            'note' => $note,
        ]);
    }
}
