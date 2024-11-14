@php
use Illuminate\Support\Facades\Cache;
@endphp

<x-app-layout>
    <div class="m-3 p-3 xl:m-6 xl:p-6 border-2 border-red-500">
        <div class="max-w-2xl mx-auto">
            <form method="POST" action="{{ route('passports.store') }}" class="space-y-6">
                @csrf
                
                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                    <div class="px-4 py-6 sm:p-8">
                        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8">
                            <div class="col-span-full">
                                <x-text-input 
                                    label="File Name"
                                    id="file_name"
                                    name="file_name"
                                    :error="$errors->first('file_name')"
                                    icon="document" 
                                    placeholder="Enter file name" 
                                    :value="old('file_name')" 
                                    type="text"
                                />
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                        <input type="hidden" name="employee_id" value="20000">
                        
                        <button type="submit" 
                            class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="m-6 p-6 border-2 border-red-500">
        {{ $errors }}
    </div>
</x-app-layout>
