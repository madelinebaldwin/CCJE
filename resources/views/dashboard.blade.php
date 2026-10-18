@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<h1>Financial Dashboard</h1>
<p class="muted">Overview of CCJE SBO events, classroom collections, and expenses.</p>
<div class="cards">
    <div class="card">Total Events<div class="metric">{{ $events->count() }}</div></div>
    <div class="card">Approved Budgets<div class="metric">₱{{ number_format($totalBudget, 2) }}</div></div>
    <div class="card">Collections Received<div class="metric">₱{{ number_format($totalCollected, 2) }}</div></div>
    <div class="card">Total Expenses<div class="metric">₱{{ number_format($totalExpenses, 2) }}</div></div>
    <div class="card">Outstanding Collections<div class="metric">₱{{ number_format(max(0, $totalExpected - $totalCollected), 2) }}</div></div>
</div>
<div class="panel">
    <div class="actions" style="justify-content:space-between;align-items:center">
        <h2>Events</h2><a class="btn" href="{{ route('events.create') }}">Create Event</a>
    </div>
    @if($events->isEmpty())
        <p>No events yet. Create your first event to begin.</p>
    @else
    <table>
        <thead><tr><th>Event</th><th>Academic Year</th><th>Date</th><th>Budget</th><th>Expenses</th><th>Status</th><th>Action</th></tr></thead>
        <tbody>
        @foreach($events as $event)
            <tr>
                <td>{{ $event->name }}</td><td>{{ $event->academic_year }}</td>
                <td>{{ $event->event_date->format('M d, Y') }}</td>
                <td>₱{{ number_format($event->approved_budget,2) }}</td>
                <td>₱{{ number_format($event->expenses->sum('amount'),2) }}</td>
                <td>{{ $event->status }}</td>
                <td><a class="btn" href="{{ route('events.show',$event) }}">Manage</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
