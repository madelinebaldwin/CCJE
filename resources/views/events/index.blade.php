@extends('layouts.app')
@section('title', 'Events')
@section('content')
<div class="actions" style="justify-content:space-between;align-items:center">
    <h1>Event Management</h1><a class="btn" href="{{ route('events.create') }}">+ Add Event</a>
</div>
<div class="panel">
<table>
<thead><tr><th>Event</th><th>Date</th><th>Academic Year</th><th>Budget</th><th>Expenses</th><th>Status</th><th>Action</th></tr></thead>
<tbody>
@forelse($events as $event)
<tr>
<td>{{ $event->name }}</td><td>{{ $event->event_date->format('M d, Y') }}</td><td>{{ $event->academic_year }}</td>
<td>₱{{ number_format($event->approved_budget,2) }}</td>
<td>₱{{ number_format($event->expenses->sum('amount'),2) }}</td><td>{{ $event->status }}</td>
<td><a class="btn" href="{{ route('events.show',$event) }}">Manage</a></td>
</tr>
@empty
<tr><td colspan="7">No events have been created yet.</td></tr>
@endforelse
</tbody></table></div>
@endsection
