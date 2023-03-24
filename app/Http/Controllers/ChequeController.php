<?php

namespace App\Http\Controllers;

use App\Models\Cheque;
use App\Http\Resources\ChequeResource;
use Illuminate\Http\Request;

class ChequeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Get all cheques
        $cheques = Cheque::all();

        //Return the cheques as a resource
        return ChequeResource::collection($cheques);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //receive the request to create a new cheque
        //validate the request data
        $request->validate([
            'amount' => 'required',
            'cheque_number' => 'required',
            'cheque_date' => 'required',
            'cheque_date_due' => 'required',   
            'cheque_image' => 'required',
            'status' => 'required',
        ]);

        //create the cheque
        //return the cheque as a resource

        $cheque = new Cheque;
        $cheque->amount = $request->input('amount');
        $cheque->serial_no = $request->input('cheque_number');
        $cheque->date_issued = $request->input('cheque_date');
        $cheque->date_due = $request->input('cheque_date_due');
        $cheque->img_url = $request->input('cheque_image');
        $cheque->status = $request->input('status');
        $cheque->user_id = $request->input('user_id');
        $cheque->save();

        return response()->json([
            'message' => 'Cheque created successfully',
            'data' => $cheque
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cheque $cheque)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cheque $cheque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cheque $cheque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cheque $cheque)
    {
        //
    }
}
