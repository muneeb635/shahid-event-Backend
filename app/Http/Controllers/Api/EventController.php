<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;

class EventController extends Controller
{
    public function getServicesData($id)
    {
        try {
            $events = Event::where('marquee_id', $id)->get();
            if ($events->isNotEmpty()) {
                return response()->json([
                    'status' => 200,
                    'Message' => 'All Your Events Listed Below',
                    EventResource::collection($events),
                ]);
            }
            return response()->json([
                'status' => 204,
                'message' => 'No Record Found',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'something went wrong',
            ]);
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $event =  Event::create([
                'services' => $request->input('services'),
                'marquee_id' => $request->input('marquee_id'),
            ]);
            $event->save();
            DB::commit();
            return response()->json([
                'status' => 201,
                'message' => 'Event Added Successfully',
                new EventResource($event),
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->input('event_id');
            $event = Event::findorfail($id);
            if ($event) {
                $event->delete();
                DB::commit();
                return response()->json([
                    'status' => 200,
                    'Message' => 'Deleted Successfully',
                ]);
            }
            return response()->json([
                'status' => 204,
                'message' => 'No Record Found',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->input('event_id');
            $event = Event::where('id', $id)->first();
            if ($event) {
                $event->update(['services' => $request['services'], 'marquee_id' => $request['marquee_id']]);
                DB::commit();
                return response()->json([
                    'status' => 200,
                    'Message' => 'Updated Successfully',
                    new EventResource($event),
                ]);
            }
            return response()->json([
                'status' => 204,
                'message' => 'No Record Found',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
