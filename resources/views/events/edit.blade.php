@extends('layouts.app')
@section('title', 'Edit Event')
@section('content')
<div class="panel"><h1>Edit Event</h1>
<form method="POST" action="{{ route('events.update',$event) }}">@csrf @method('PUT')
@include('events._form')
</form></div>
@endsection
