@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">

    @if(session()->has('message'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('message') }}
    </div>
    @endif

    @livewire('notes-manager')
    @livewire('note-delete')
</div>
@endsection