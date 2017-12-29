<?php

namespace App\Http\Controllers\maintainance;

use App\Confirmation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Maintainance\Confirmation\StoreConfirmation;
use App\Http\Requests\Maintainance\Confirmation\UpdateConfirmation;

class ConfirmationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['type']) && $_GET['type'] == 'all'){
            $confirmations = Confirmation::orderBy('confirmation_name','asc')->get();
        }
        else{
            $confirmations = Confirmation::orderBy('confirmation_name','asc')->paginate(10);
        }

        return $confirmations;
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
    public function store(StoreConfirmation $request)
    {
        Confirmation::create([
            'confirmation_name' => $request['confirmation_name']
        ]);

        return ['message' => 'New record has been saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Confirmation  $confirmation
     * @return \Illuminate\Http\Response
     */
    public function show(Confirmation $confirmation)
    {
        return $confirmation;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Confirmation  $confirmation
     * @return \Illuminate\Http\Response
     */
    public function edit(Confirmation $confirmation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Confirmation  $confirmation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConfirmation $request, Confirmation $confirmation)
    {
       $confirmation->update($request->all());

       return ['message' => 'Changes has been saved'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Confirmation  $confirmation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Confirmation $confirmation)
    {
        if(auth()->user()->userType != 1)
        {
            // abort(403,'Request Unauthorized');
            return response('Unauthorized action', 403);
        }

        $confirmation->delete();
        
        return ['message' => 'Record has been deleted'];
    }
}
