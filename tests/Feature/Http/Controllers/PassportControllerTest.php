<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Passport;
use function Pest\Faker\fake;
use function Pest\Laravel\assertModelMissing;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

test('index displays view', function (): void {
    $passports = Passport::factory()->count(3)->create();

    $response = get(route('passports.index'));

    $response->assertOk();
    $response->assertViewIs('passport.index');
    $response->assertViewHas('passports');
});


test('create displays view', function (): void {
    $response = get(route('passports.create'));

    $response->assertOk();
    $response->assertViewIs('passport.create');
});


test('store uses form request validation')
    ->assertActionUsesFormRequest(
        \App\Http\Controllers\PassportController::class,
        'store',
        \App\Http\Requests\PassportStoreRequest::class
    );

test('store saves and redirects', function (): void {
    $employee_id = fake()->word();
    $file_name = fake()->word();
    $is_passport = fake()->boolean();
    $is_visa = fake()->boolean();
    $is_photo = fake()->boolean();
    $is_no_file_uploaded = fake()->boolean();
    $is_issue = fake()->boolean();

    $response = post(route('passports.store'), [
        'employee_id' => $employee_id,
        'file_name' => $file_name,
        'is_passport' => $is_passport,
        'is_visa' => $is_visa,
        'is_photo' => $is_photo,
        'is_no_file_uploaded' => $is_no_file_uploaded,
        'is_issue' => $is_issue,
    ]);

    $passports = Passport::query()
        ->where('employee_id', $employee_id)
        ->where('file_name', $file_name)
        ->where('is_passport', $is_passport)
        ->where('is_visa', $is_visa)
        ->where('is_photo', $is_photo)
        ->where('is_no_file_uploaded', $is_no_file_uploaded)
        ->where('is_issue', $is_issue)
        ->get();
    expect($passports)->toHaveCount(1);
    $passport = $passports->first();

    $response->assertRedirect(route('passports.index'));
    $response->assertSessionHas('passport.id', $passport->id);
});


test('show displays view', function (): void {
    $passport = Passport::factory()->create();

    $response = get(route('passports.show', $passport));

    $response->assertOk();
    $response->assertViewIs('passport.show');
    $response->assertViewHas('passport');
});


test('edit displays view', function (): void {
    $passport = Passport::factory()->create();

    $response = get(route('passports.edit', $passport));

    $response->assertOk();
    $response->assertViewIs('passport.edit');
    $response->assertViewHas('passport');
});


test('update uses form request validation')
    ->assertActionUsesFormRequest(
        \App\Http\Controllers\PassportController::class,
        'update',
        \App\Http\Requests\PassportUpdateRequest::class
    );

test('update redirects', function (): void {
    $passport = Passport::factory()->create();
    $employee_id = fake()->word();
    $file_name = fake()->word();
    $is_passport = fake()->boolean();
    $is_visa = fake()->boolean();
    $is_photo = fake()->boolean();
    $is_no_file_uploaded = fake()->boolean();
    $is_issue = fake()->boolean();

    $response = put(route('passports.update', $passport), [
        'employee_id' => $employee_id,
        'file_name' => $file_name,
        'is_passport' => $is_passport,
        'is_visa' => $is_visa,
        'is_photo' => $is_photo,
        'is_no_file_uploaded' => $is_no_file_uploaded,
        'is_issue' => $is_issue,
    ]);

    $passport->refresh();

    $response->assertRedirect(route('passports.index'));
    $response->assertSessionHas('passport.id', $passport->id);

    expect($employee_id)->toEqual($passport->employee_id);
    expect($file_name)->toEqual($passport->file_name);
    expect($is_passport)->toEqual($passport->is_passport);
    expect($is_visa)->toEqual($passport->is_visa);
    expect($is_photo)->toEqual($passport->is_photo);
    expect($is_no_file_uploaded)->toEqual($passport->is_no_file_uploaded);
    expect($is_issue)->toEqual($passport->is_issue);
});


test('destroy deletes and redirects', function (): void {
    $passport = Passport::factory()->create();

    $response = delete(route('passports.destroy', $passport));

    $response->assertRedirect(route('passports.index'));

    assertModelMissing($passport);
});
