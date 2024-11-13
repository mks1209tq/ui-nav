<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicantStoreRequest;
use App\Http\Requests\ApplicantUpdateRequest;
use App\Models\Applicant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

use Illuminate\Http\Response;

class ApplicantController extends Controller
{
    public function index(Request $request): view
    {
        $applicants = Applicant::all();

        return view('applicant.index', compact('applicants'));
    }

    public function create(Request $request): view
    {
        return view('applicant.create');
    }

    public function store(ApplicantStoreRequest $request): RedirectResponse
    {
        $applicant = Applicant::create($request->validated());

        $request->session()->flash('applicant.id', $applicant->id);

        return redirect()->route('applicants.index')
        ->with('success', 'Applicant created successfully');
    }

    public function show(Request $request, Applicant $applicant): view
    {
        return view('applicant.show', compact('applicant'));
    }

    public function edit(Request $request, Applicant $applicant): view
    {
        return view('applicant.edit', compact('applicant'));
    }

    public function update(ApplicantUpdateRequest $request, Applicant $applicant): RedirectResponse
    {
        $applicant->update($request->validated());

        $request->session()->flash('applicant.id', $applicant->id);

        return redirect()->route('applicants.index');
    }

    public function destroy(Request $request, Applicant $applicant): RedirectResponse
    {
        $applicant->delete();

        return redirect()->route('applicants.index');
    }

    public function receive(Request $request): JsonResponse
{
    \Log::info('Received applicant data:', $request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data received successfully'
        ]);
    }
}
