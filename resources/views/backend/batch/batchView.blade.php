<x-backend-layout>
    @if (session()->has('success'))

    <x-slot name="msg">
        {{ session('success') }}
    </x-slot>
    @endif

    <h2 class="fs-lg fw-medium mb-4">
        {{ $batch->name }} Batch
    </h2>
    <hr>



</x-backend-layout>