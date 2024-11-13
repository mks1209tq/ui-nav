<x-app-layout>

<div class="p-6 m-6"> 
    <!-- Create Applicant -->
    <form action="{{ route('applicants.create') }}" method="get">
    @csrf
    <button type="submit">Create</button>
    </form>

    <!-- List Applicants -->
    @foreach ($applicants as $applicant)
        <p>{{ $applicant->name }}</p>
    @endforeach
</div>

</x-app-layout>