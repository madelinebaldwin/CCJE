@extends('layouts.app')
@section('title', 'Create Event')
@section('content')
<div class="panel"><h1>Create Event</h1>
<form method="POST" action="{{ route('events.store') }}">@csrf
@include('events._form')
</form></div>
@endsection
