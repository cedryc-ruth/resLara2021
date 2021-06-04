<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;


class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = Agent::all();
        
        return view('agent.index',[
            'agents' => $agents,
        ]);
    }

}
