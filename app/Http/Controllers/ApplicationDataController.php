<?php

namespace App\Http\Controllers;

// ini_set('memory_limit', '512M');

use App\Models\{
    ApplicationReqData,
};
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ApplicationDataController extends Controller
{
    //
    public function store(Request $request)
    {
        try {
            $client_id = auth()->user()->client_id;
            if ($client_id === null) {
                return back()->withErrors([
                    'error' => "Please complete your profile information to process your data."
                ]);
            }
            $data = $request->all();
            $requirementId = $data['requirement_id'];
            $applicationId = $data['application_id'];


            if ($requirementId == null) {
                return redirect()->back()->withToast('error', 'Please select a requirement to submit the form!');
            };

            if ($applicationId == null) {
                return redirect()->back()->withToast('error', 'Please select an application to submit the form!');
            };


            unset($data['requirement_id'], $data['application_id']);
            foreach (array_keys($data) as $key) {
                $value = $data[$key];
                ApplicationReqData::updateOrCreate([
                    'key' => $key,
                    'requirement_id' => $requirementId,
                    'application_id' => $applicationId,
                    'client_id' => $client_id
                ], [
                    'value' => $value,
                ]);
            }
            return redirect()->back()->withToast('success', 'Application form submitted successfully!');
        } catch (Exception $err) {
            Log::info(substr($err->getTraceAsString(), 0, 1000));
            print_r($err);
        }
    }
}
