<x-app-layout>
    <div class="p-6 m-6">
        <form action="{{ route('applicants.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Name">
            <input type="text" name="email" placeholder="Email">
            
            <button type="submit">Create</button>
        </form>
    </div>
    
</x-app-layout>
