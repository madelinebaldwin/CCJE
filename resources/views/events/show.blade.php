@extends('layouts.app')
@section('title', $event->name)
@section('content')
<div class="actions" style="justify-content:space-between;align-items:center">
    <div><h1>{{ $event->name }}</h1><p class="muted">{{ $event->event_date->format('F d, Y') }} · {{ $event->academic_year }} · {{ $event->status }}</p></div>
    <div class="actions no-print">
        <a class="btn secondary" href="{{ route('events.edit',$event) }}">Edit Event</a>
        <a class="btn" href="{{ route('events.report',$event) }}">Event Report</a>
        <a class="btn" href="{{ route('expenses.create',$event) }}">+ Add Expense</a>
    </div>
</div>
<div class="cards">
    <div class="card">Approved Budget<div class="metric">₱{{ number_format($event->approved_budget,2) }}</div></div>
    <div class="card">Total Expenses<div class="metric">₱{{ number_format($event->expenses->sum('amount'),2) }}</div></div>
    <div class="card">Remaining Budget<div class="metric">₱{{ number_format($event->approved_budget - $event->expenses->sum('amount'),2) }}</div></div>
    <div class="card">Classrooms Linked<div class="metric">{{ $event->eventClassrooms->count() }}</div></div>
</div>
<div class="panel">
    <h2>Expense Records</h2>
    <table><thead><tr><th>Date</th><th>Category</th><th>Description</th><th>Quantity</th><th>Unit Cost</th><th>Total</th><th class="no-print">Action</th></tr></thead><tbody>
    @forelse($event->expenses->sortByDesc('expense_date') as $expense)
    <tr>
        <td>{{ $expense->expense_date->format('M d, Y') }}</td><td>{{ $expense->category }}</td><td>{{ $expense->description }}</td>
        <td>{{ $expense->quantity }}</td><td>₱{{ number_format($expense->unit_cost,2) }}</td><td>₱{{ number_format($expense->amount,2) }}</td>
        <td class="no-print"><form method="POST" action="{{ route('expenses.destroy',$expense) }}" onsubmit="return confirm('Delete this expense record?')">@csrf @method('DELETE')<button class="btn secondary">Delete</button></form></td>
    </tr>
    @empty <tr><td colspan="7">No expenses recorded for this event.</td></tr> @endforelse
    </tbody></table>
</div>
<div class="panel">
    <h2>Classroom Collections</h2>
    <p class="muted">Classroom collection entry and payment forms can be added next. This starter shows any classrooms already linked to this event.</p>
    <table><thead><tr><th>Year Level</th><th>Section</th><th>Students</th><th>Expected</th><th>Collected</th><th>Remaining</th></tr></thead><tbody>
    @forelse($event->eventClassrooms as $ec)
    <tr><td>{{ $ec->classroom->year_level }}</td><td>{{ $ec->classroom->section }}</td><td>{{ $ec->classroom->total_students }}</td>
    <td>₱{{ number_format($ec->expected_amount,2) }}</td><td>₱{{ number_format($ec->total_collected,2) }}</td><td>₱{{ number_format($ec->remaining_collection,2) }}</td></tr>
    @empty <tr><td colspan="6">No classrooms linked to this event yet.</td></tr> @endforelse
    </tbody></table>
</div>
@endsection
