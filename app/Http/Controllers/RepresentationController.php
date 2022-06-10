<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Representation;
use Carbon\Carbon;
use App\Models\Show;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class RepresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $representations = Representation::all();

        return view('representation.index',[
            'representations' => $representations,
            'resource' => 'représentations',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shows = Show::all();
        $rooms = Room::all();

        return view('representation.create',[
            'shows' => $shows,
            'rooms' => $rooms,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    /*    if(!Auth::user() || Auth::user()->role->role!='admin') {
            return redirect()->route('representation_create')
                ->withErrors(['msg' => 'Vous devez être administrateur!']);;
        }
*/
        //Empêcher l'ajout si la salle est déjà occupée au même moment
        $representation = Representation::where('room_id',$request->input('room_id'))
            ->where('when',$request->input('when'))->first();

        if($representation) {
            return redirect()->route('representation_create')
                ->withErrors(['msg' => 'Il y a déjà une représenation dans cette salle à la même heure!']);;
        }

        //Validation des données du formulaire
        $validated = $request->validate([
            'when' => 'required|date',
            'show_id' => 'required|numeric',
            'room_id' => [
                'nullable',
                'numeric',
            ],
        ]);

	   //Le formulaire a été validé, nous créons une nouvelle représenation à insérer
        $representation = new Representation();

        //Assignation des données et sauvegarde dans la base de données
        $representation->when = $validated['when'];
        $representation->show_id = $validated['show_id'];
        $representation->room_id = $validated['room_id'];

        $representation->save();

        return redirect()->route('representation_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $representation = Representation::find($id);
        $date = Carbon::parse($representation->when)->format('d/m/Y');
        $time = Carbon::parse($representation->when)->format('G:i');
        
        return view('representation.show',[
            'representation' => $representation,
            'date' => $date,
            'time' => $time,
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
