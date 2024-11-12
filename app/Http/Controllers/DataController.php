<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;

class DataController extends Controller
{
    public function receive(Request $request)
{
    try {
        // Validate the incoming request
        $validated = $request->validate([
            'applicants' => 'required|array',
            'applicants.*.id' => 'required|integer',
            'applicants.*.name' => 'required|string',
            'applicants.*.email' => 'required|email',
            'total_count' => 'required|integer',
            'sent_at' => 'required|date'
        ]);

        // Process each applicant
        foreach ($request->applicants as $applicantData) {
            // Create or update applicant in UI system
            Applicant::updateOrCreate(
                ['id' => $applicantData['id']], // Find by ID
                [
                    'name' => $applicantData['name'],
                    'email' => $applicantData['email'],
                    // Add other fields as needed
                ]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Data received successfully',
            'count' => count($request->applicants)
        ]);

    } catch (\Exception $e) {
        \Log::error('Error receiving applicant data: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Error processing data: ' . $e->getMessage()
        ], 500);
    }
}
}