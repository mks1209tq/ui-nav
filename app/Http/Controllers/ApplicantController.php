<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicantStoreRequest;
use App\Http\Requests\ApplicantUpdateRequest;
use App\Models\Applicant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApplicantController extends Controller
{
    public function index(Request $request): Response
    {
        $applicants = Applicant::all();

        return view('applicant.index', compact('applicants'));
    }

    public function create(Request $request): Response
    {
        return view('applicant.create');
    }

    public function store(ApplicantStoreRequest $request): Response
    {
        $applicant = Applicant::create($request->validated());

        $request->session()->flash('applicant.id', $applicant->id);

        return redirect()->route('applicants.index');
    }

    public function show(Request $request, Applicant $applicant): Response
    {
        return view('applicant.show', compact('applicant'));
    }

    public function edit(Request $request, Applicant $applicant): Response
    {
        return view('applicant.edit', compact('applicant'));
    }

    public function update(ApplicantUpdateRequest $request, Applicant $applicant): Response
    {
        $applicant->update($request->validated());

        $request->session()->flash('applicant.id', $applicant->id);

        return redirect()->route('applicants.index');
    }

    public function destroy(Request $request, Applicant $applicant): Response
    {
        $applicant->delete();

        return redirect()->route('applicants.index');
    }

    public function receive(Request $request)
{
    \Log::info('Received applicant data:', $request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data received successfully'
        ]);
    }
}
