<?php

namespace App\Http\Controllers;

use App\Models\BillingInfo;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    //

    public function index()
    {

        $billing = BillingInfo::latest()->paginate(10);

        if ($billing->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'billing details not found']);
        }

        return response()->json(['status' => 'success', 'data' => $billing]);
    }

    public function store(Request $request)
    {

        $billing = BillingInfo::create([
            'summary' => $request->summary,
            'billing_address' => $request->billing_address,
            'payment_details' => $request->payment_details,
            'customer_id' => $request->customer_id
        ]);

        return response()->json(['status' => 'success', 'data' => $billing]);
    }

    public function update(Request $request, $id)
    {

        $billing = BillingInfo::find($id);

        if ($billing == null) {
            return response()->json(['status' => 'error', 'data' => "billing not found"]);
        }

        $billing->update($request->all());

        return response()->json(['status' => 'success', 'data' => $billing]);
    }

    public function show($id)
    {

        $billing = BillingInfo::find($id);

        if ($billing == null) {
            return response()->json(['status' => 'error', 'data' => "bill not found"]);
        }

        return response()->json(['status' => 'success', 'data' => $billing]);
    }

    public function destroy($id)
    {

        $billing = BillingInfo::find($id);
        if ($billing == null) {
            return response()->json(['status' => 'error', 'data' => "billing not found"]);
        }

        $billing->delete();
        return response()->json(['status' => 'success', 'data' => $billing]);
    }
}
