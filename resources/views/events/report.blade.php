@extends('layouts.app')
@section('title', 'Event Financial Report')
@section('content')
<div class="actions no-print" style="justify-content:flex-end"><button class="btn" onclick="window.print()">Print / Save as PDF</button></div>
<div class="panel">
    <h1 style="text-align:center">CCJE SBO</h1>
    <h2 style="text-align:center">EVENT FINANCIAL REPORT</h2>
    <p><strong>Event:</strong> {{ $event->name }}</p>
    <p><strong>Date:</strong> {{ $event->event_date->format('F d, Y') }}</p>
    <p><strong>Academic Year:</strong> {{ $event->academic_year }}</p>
    <p><strong>Location:</strong> {{ $event->location ?: 'Not specified' }}</p>
    <hr>
    <h3>Expense Details</h3>
    <table><thead><tr><th>No.</th><th>Date</th><th>Description</th><th>Category</th><th>Qty</th><th>Unit Cost</th><th>Amount</th></tr></thead><tbody>
    @forelse($event->expenses->sortBy('expense_date') as $i => $expense)
    <tr><td>{{ $i+1 }}</td><td>{{ $expense->expense_date->format('M d, Y') }}</td><td>{{ $expense->description }}</td><td>{{ $expense->category }}</td><td>{{ $expense->quantity }}</td><td>₱{{ number_format($expense->unit_cost,2) }}</td><td>₱{{ number_format($expense->amount,2) }}</td></tr>
    @empty <tr><td colspan="7">No expense records.</td></tr> @endforelse
    </tbody></table>
    <h3>Financial Summary</h3>
    <table><tbody>
    <tr><th>Approved Budget</th><td>₱{{ number_format($event->approved_budget,2) }}</td></tr>
    <tr><th>Total Collections Recorded</th><td>₱{{ number_format($totalCollected,2) }}</td></tr>
    <tr><th>Total Expected Collections</th><td>₱{{ number_format($totalExpected,2) }}</td></tr>
    <tr><th>Total Expenses</th><td>₱{{ number_format($totalExpenses,2) }}</td></tr>
    <tr><th>Remaining Budget</th><td>₱{{ number_format($event->approved_budget - $totalExpenses,2) }}</td></tr>
    <tr><th>Outstanding Collections</th><td>₱{{ number_format(max(0, $totalExpected - $totalCollected),2) }}</td></tr>
    </tbody></table>
    <br><br>
    <div class="row"><div>Prepared by: ____________________</div><div>Reviewed by: ____________________</div><div>Approved by: ____________________</div></div>
</div>
@endsection
