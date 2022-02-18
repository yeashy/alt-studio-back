<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Placemark;

class PlacemarkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function add()
    {
        if (!request('id')) {
            $name = request('name');
            $latitude = request('latitude');
            $longitude = request('longitude');
            $user_id = auth()->payload()->get('id');

            $placemark = new Placemark();
            $placemark->name = $name;
            $placemark->latitude = $latitude;
            $placemark->longitude = $longitude;
            $placemark->user_id = $user_id;
            $placemark->save();

            return response()->json(['message' => 'Placemark added']);
        }
        else {
            $id = request('id');
            $placemark = Placemark::find($id);

            $name = request('name');
            $latitude = request('latitude');
            $longitude = request('longitude');

            $placemark->name = $name;
            $placemark->latitude = $latitude;
            $placemark->longitude = $longitude;
            $placemark->save();
            
            return response()->json(['message' => 'Placemark updated']);
        }
    }

    public function get()
    {
        $user_id = auth()->payload()->get('id');

        $data = DB::table('placemarks')->select('id', 'name', 'latitude', 'longitude')->where('user_id', $user_id)->get();

        return response()->json(['placemarks' => $data]);
    }

    public function delete(Request $req)
    {
        Placemark::find($req->id)->delete();

        return response()->json(['message' => 'Placemark deleted']);
    }
}
