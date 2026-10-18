@extends('layouts.app')
@section('title', 'Add Expense')
@section('content')
<div class="panel"><h1>Add Expense</h1><p class="muted">Event: {{ $event->name }}</p>
<form method="POST" action="{{ route('expenses.store',$event) }}">@csrf
<div class="row">
<div><label>Category *</label><select name="category" required>
@foreach(['Food and Refreshments','Printing and Materials','Transportation','Supplies','Venue','Equipment','Other'] as $category)
<option value="{{ $category }}">{{ $category }}</option>
@endforeach
</select></div>
<div><label>Expense Date *</label><input type="date" name="expense_date" value="{{ date('Y-m-d') }}" required></div>
<div><label>Quantity *</label><input id="quantity" type="number" name="quantity" min="1" value="1" required></div>
<div><label>Unit Cost (₱) *</label><input id="unit_cost" type="number" name="unit_cost" min="0" step="0.01" value="0.00" required></div>
</div>
<label>Description *</label><input name="description" required placeholder="e.g. Packed meals">
<label>Receipt / Reference Number</label><input name="receipt_reference">
<label>Remarks</label><textarea name="remarks" rows="2"></textarea>
<p>Calculated amount: <strong id="total">₱0.00</strong></p>
<button class="btn" type="submit">Save Expense</button>
<a class="btn secondary" href="{{ route('events.show',$event) }}">Cancel</a>
</form></div>
<script>
function updateTotal() {
    const q = Number(document.getElementById('quantity').value || 0);
    const c = Number(document.getElementById('unit_cost').value || 0);
    document.getElementById('total').textContent = '₱' + (q * c).toLocaleString('en-PH', {minimumFractionDigits:2, maximumFractionDigits:2});
}
document.getElementById('quantity').addEventListener('input', updateTotal);
document.getElementById('unit_cost').addEventListener('input', updateTotal);
updateTotal();
</script>
@endsection
