<?php

namespace App\Http\Controllers;

use App\Http\Requests\PassportStoreRequest;
use App\Http\Requests\PassportUpdateRequest;
use App\Models\Passport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PassportController extends Controller
{
    public function index(Request $request): View
    {
        $passports = Passport::all();

        return view('passport.index', compact('passports'));
    }

    public function create(Request $request): View
    {
        return view('passport.create');
    }

    public function store(PassportStoreRequest $request): RedirectResponse
    {
        // dd($request->all());

        $passport = Passport::create($request->validated());
        // dd($passport);

        $request->session()->flash('passport.id', $passport->id);

        return redirect()->route('dashboard');
    }

    public function show(Request $request, Passport $passport): View
    {
        return view('passport.show', compact('passport'));
    }

    public function edit(Request $request, Passport $passport): View
    {
        return view('apps.hr.passport.data-entry.edit', compact('passport'));
    }

    public function update(PassportUpdateRequest $request, Passport $passport): RedirectResponse
    {
        $passport->update($request->validated());

        $request->session()->flash('passport.id', $passport->id);

        return redirect()->route('passports.index');
    }

    public function destroy(Request $request, Passport $passport): RedirectResponse
    {
        $passport->delete();

        return redirect()->route('passports.index');
    }
}
