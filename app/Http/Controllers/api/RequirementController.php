<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ApplicationReqData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequirementController extends Controller
{
    //
    public function getClientApplicationRequirementData(
        Request $request
    ) {
        $requirementId = $request->requirement_id;
        $applicationId = $request->application_id;

        $client_id = auth()->user()->client_id;

        Log::info("----------");
        Log::info($requirementId);
        Log::info($applicationId);
        Log::info($client_id);
        Log::info("----------");

        $requirementData = ApplicationReqData::where('client_id', $client_id)->get();
        return response()->json($requirementData);
    }
}
