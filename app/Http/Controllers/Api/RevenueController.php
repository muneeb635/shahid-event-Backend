<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\RevenueResource;
use App\Models\Revenue;

class RevenueController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $revenue = Revenue::create([
                'hall' => $request->input('hall'),
                'date' => $request->input('date'),
                'marque_revenue' => $request->input('marque_revenue'),
                'owner_revenue' => $request->input('owner_revenue'),
                'partner_revenue' => $request->input('partner_revenue'),
                'marquee_id' => $request->input('marquee_id'),
            ]);
            $revenue->save();
            DB::commit();
            return response()->json([
                'status' => 201,
                'message' => 'Revenue Added Successfully',
                new RevenueResource($revenue),
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function all()
    {
        try {
            $revenues = Revenue::all();
            if ($revenues->isNotEmpty()) {
                return response()->json([
                    'status' => 200,
                    'Message' => 'All Your Revenues Listed Below',
                    RevenueResource::collection($revenues),
                ]);
            }
            return response()->json([
                'status' => 204,
                'message' => 'No Record Found',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
