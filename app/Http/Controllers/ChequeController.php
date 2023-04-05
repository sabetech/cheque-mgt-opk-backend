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
     * Display the specified resource.
     */
    public function show($id)
    {
        //Get the cheque
        $cheque = Cheque::with('user')->findOrFail($id);

        //Return the cheque as a resource
        return new ChequeResource($cheque);
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
        $cheque->user;

        return response()->json([
            'message' => 'Cheque created successfully',
            'data' => $cheque
        ], 201);
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
            'message' => 'Cheque deleted successfully'
        ], 201);
    }
}
