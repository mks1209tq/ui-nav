<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Applicant;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

test('index displays view', function (): void {
    $applicants = Applicant::factory()->count(3)->create();

    $response = get(route('applicants.index'));

    $response->assertOk();
    $response->assertViewIs('applicant.index');
    $response->assertViewHas('applicants');
});


test('create displays view', function (): void {
    $response = get(route('applicants.create'));

    $response->assertOk();
    $response->assertViewIs('applicant.create');
});


test('store uses form request validation')
    ->assertActionUsesFormRequest(
        \App\Http\Controllers\ApplicantController::class,
        'store',
        \App\Http\Requests\ApplicantStoreRequest::class
    );

test('store saves and redirects', function (): void {
    $response = post(route('applicants.store'));

    $response->assertRedirect(route('applicants.index'));
    $response->assertSessionHas('applicant.id', $applicant->id);

    assertDatabaseHas(applicants, [ /* ... */ ]);
});


test('show displays view', function (): void {
    $applicant = Applicant::factory()->create();

    $response = get(route('applicants.show', $applicant));

    $response->assertOk();
    $response->assertViewIs('applicant.show');
    $response->assertViewHas('applicant');
});


test('edit displays view', function (): void {
    $applicant = Applicant::factory()->create();

    $response = get(route('applicants.edit', $applicant));

    $response->assertOk();
    $response->assertViewIs('applicant.edit');
    $response->assertViewHas('applicant');
});


test('update uses form request validation')
    ->assertActionUsesFormRequest(
        \App\Http\Controllers\ApplicantController::class,
        'update',
        \App\Http\Requests\ApplicantUpdateRequest::class
    );

test('update redirects', function (): void {
    $applicant = Applicant::factory()->create();

    $response = put(route('applicants.update', $applicant));

    $applicant->refresh();

    $response->assertRedirect(route('applicants.index'));
    $response->assertSessionHas('applicant.id', $applicant->id);
});


test('destroy deletes and redirects', function (): void {
    $applicant = Applicant::factory()->create();

    $response = delete(route('applicants.destroy', $applicant));

    $response->assertRedirect(route('applicants.index'));

    assertSoftDeleted($applicant);
});
