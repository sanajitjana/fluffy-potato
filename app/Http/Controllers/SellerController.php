<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    //

    public function index()
    {

        $seller = Seller::latest()->paginate(10);

        // not found any seller then 404

        if ($seller->isEmpty()) {
            return response()->json([
                'status' => "Error",
                'message' => 'not found seller'
            ]);
        }

        return response()->json([
            'status' => true,
            'seller' => $seller
        ]);
    }

    public function store(Request $request)
    {

        $seller = Seller::create([
            'business_details' => $request->business_details,
            'personal_details' => $request->personal_details,
            'customer_id' => $request->customer_id,

        ]);

        return response()->json([
            'status' => true,
            'seller' => $seller
        ]);
    }

    public function show($id)
    {

        $seller = Seller::find($id);

        if ($seller == null) {
            return response()->json([
                'status' => "Error",
                'message' => 'not found seller'
            ]);
        }

        return response()->json([
            'status' => true,
            'seller' => $seller
        ]);
    }

    public function update($id, Request $request)
    {

        $seller = Seller::find($id);

        if ($seller == null) {
            return response()->json([
                'status' => false,
                'message' => "seller not found",
            ]);
        }

        $seller->update($request->all());

        return response()->json([
            'status' => 'success',
            'seller' => $seller
        ]);
    }

    public function destroy($id)
    {

        $seller = Seller::find($id);

        if ($seller == null) {
            return response()->json([
                'status' => false,
                'message' => "seller not found",
            ]);
        }

        $seller->delete();

        return response()->json([
            'status' => true,
            'data' => $seller
        ]);
    }
}
