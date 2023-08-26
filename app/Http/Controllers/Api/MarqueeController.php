<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MarqueeResource;
use App\Models\Marquee;
use Illuminate\Http\Request;

class MarqueeController extends Controller
{
    public function getMarquee()
    {
        try {
            $marquees = Marquee::all();
            if ($marquees->isNotEmpty()) {
                return response()->json([
                    'status' => 200,
                    'Message' => 'All Your Marquees Listed Below',
                    MarqueeResource::collection($marquees),
                ]);
            }
            return response()->json([
                'status' => 204,
                'message' => 'No Record Found',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
