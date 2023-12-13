<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    /**
     * Display houses.
     */
    public function getList(Request $request)
    {
        $form = $request->params ?? '';

        if ($form) {
            return response()->json([
                "query" => $request->toArray(),
                "body" => House::getFilteredHouses($form),
                "error" => '',
                "message" => ''
            ]);
        }

        return response()->json([
            "query" => $request->toArray(),
            "body" => '',
            "error" => true,
            "message" => 'No from detected'
        ]);
    }
}
