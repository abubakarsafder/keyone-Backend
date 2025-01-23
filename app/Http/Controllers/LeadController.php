<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function getAllLeads()
    {
        $leads = Lead::all();

        return response()->json(
            [
                'status' => 'success',
                'messages' => [['type' => 'success', 'message' => 'All Leads.']],
                'data' => ['leads' => $leads]
            ],
            200
        );
    }

    public function storeLead(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile_code' => 'required|string|max:10',
            'mobile_number' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'property_type' => 'required|string|max:255',
            'no_of_bedrooms' => 'required|integer',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'messages' => ['type' => 'error', 'message' => $validator->errors()->all()[0]],
                    'data' => []
                ],
                400
            );
        }

        $lead = Lead::create($validator->validated());

        return response()->json(
            [
                'status' => 'success',
                'messages' => [['type' => 'success', 'message' => 'Lead created successfully.']],
                'data' => ['lead' => $lead]
            ],
            201
        );
    }

    /**
     * Display the specified lead.
     */
    public function getLead(Request $request)
    {
        $lead = Lead::find($request->id);

        if (!$lead) {
            return response()->json(
                [
                    'status' => 'error',
                    'messages' => [
                        ['type' => 'error', 'message' => 'Lead not found.']
                    ],
                    'data' => []
                ],
                404
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'messages' => [['type' => 'success', 'message' => 'Get Lead.']],
                'data' => ['lead' => $lead]
            ],
            200
        );
    }

    /**
     * Update the specified lead in storage.
     */
    public function updateLead(Request $request)
    {
        $lead = Lead::find($request->id);

        if (!$lead) {
            return response()->json(
                [
                    'status' => 'error',
                    'messages' => [
                        ['type' => 'error', 'message' => 'Lead not found.']
                    ],
                    'data' => []
                ],
                404
            );
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile_code' => 'required|string|max:10',
            'mobile_number' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'property_type' => 'required|string|max:255',
            'no_of_bedrooms' => 'required|integer',
            'message' => 'required|string',
        ]);


        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'messages' => [$validator->errors()],
                    'data' => []
                ],
                400
            );
        }

        $lead->update($validator->validated());

        return response()->json(
            [
                'status' => 'success',
                'messages' => [['type' => 'success', 'message' => 'Lead updated successfully.']],
                'data' => ['lead' => $lead]
            ],
            200
        );
    }

    /**
     * Remove the specified lead from storage.
     */
    public function destroyLead(Request $request)
    {
        $lead = Lead::find($request->id);

        if (!$lead) {
            return response()->json(
                [
                    'status' => 'error',
                    'messages' => [
                        ['type' => 'error', 'message' => 'Lead not found.']
                    ],
                    'data' => []
                ],
                404
            );
        }

        $lead->delete();

        return response()->json(
            [
                'status' => 'success',
                'messages' => [
                    ['type' => 'success', 'message' => 'Lead deleted successfully.']
                ],
                'data' => []
            ],
            200
        );
    }
}
