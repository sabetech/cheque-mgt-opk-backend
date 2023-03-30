<?php

namespace App\Http\Controllers;

use App\Models\Cheque;
use App\Http\Resources\ChequeResource;
use Illuminate\Http\Request;
use Log;
use Auth;

class ChequeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Get all cheques
        $cheques = Cheque::with('user')->get();

        //Return the cheques as a resource
        return ChequeResource::collection($cheques);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request->file('image')) {
            $path = $request->file('image')->store('public/cheques');
        }

        $cheque = new Cheque;
        $cheque->amount = $request->input('amount');
        $cheque->serial_no = $request->input('cheque_number');
        $cheque->date_issued = $request->input('cheque_date');
        $cheque->date_due = $request->input('cheque_date_due');
        $cheque->img_url = $path;
        $cheque->status = 'pending';
        $cheque->user_id = $request->user()->id;
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
        $cheque->update($request->all());
        return response()->json([
            'message' => 'Cheque updated successfully',
            'data' => $cheque
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cheque $cheque)
    {
        //
        $cheque->delete();
        return response()->json([
            'message' => 'Cheque deleted successfully',
            'data' => $cheque
        ], 201);
    }
}
