<!-- start passport content -->
<x-app-layout>
    <div class="m-3 p-3 xl:m-6 xl:p-6 border-2 border-red-500">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="-mx-4 mt-10 ring-1 ring-gray-300 sm:mx-0 sm:rounded-lg">
                <?php
                if (Auth::user()->is_admin) {
                    $passports = App\Models\Passport::all()->where('is_data_entered', false);
                } else {
                    $passports = App\Models\Passport::all()->where('is_data_entered', false)->where('user_id', auth()->user()->id);
                }
                ?>
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($passports as $passport)
                        <tr>
                            <td class="relative py-4 pl-4 pr-3 text-sm sm:pl-6">
                                @if ($passport->verify_count > 1)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                @endif
                                <a href="{{ route('passports.edit', $passport->id) }}">{{ $passport->id}}&nbsp;
                                    {{ $passport->file_name }}
                                </a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- end passport content -->