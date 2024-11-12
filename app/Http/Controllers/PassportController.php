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
    public function index(Request $request): Response
    {
        $passports = Passport::all();

        return view('passport.index', compact('passports'));
    }

    public function create(Request $request): Response
    {
        return view('passport.create');
    }

    public function store(PassportStoreRequest $request): Response
    {
        $passport = Passport::create($request->validated());

        $request->session()->flash('passport.id', $passport->id);

        return redirect()->route('passports.index');
    }

    public function show(Request $request, Passport $passport): Response
    {
        return view('passport.show', compact('passport'));
    }

    public function edit(Request $request, Passport $passport): Response
    {
        return view('passport.edit', compact('passport'));
    }

    public function update(PassportUpdateRequest $request, Passport $passport): Response
    {
        $passport->update($request->validated());

        $request->session()->flash('passport.id', $passport->id);

        return redirect()->route('passports.index');
    }

    public function destroy(Request $request, Passport $passport): Response
    {
        $passport->delete();

        return redirect()->route('passports.index');
    }
}
