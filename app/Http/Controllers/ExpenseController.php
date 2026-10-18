<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Expense;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    public function create(Event $event): View
    {
        return view('expenses.create', compact('event'));
    }

    public function store(Request $request, Event $event): RedirectResponse
    {
        $data = $request->validate([
            'category' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:1'],
            'unit_cost' => ['required', 'numeric', 'min:0'],
            'expense_date' => ['required', 'date'],
            'receipt_reference' => ['nullable', 'string', 'max:100'],
            'remarks' => ['nullable', 'string'],
        ]);

        $data['event_id'] = $event->id;
        $data['amount'] = round((float) $data['quantity'] * (float) $data['unit_cost'], 2);

        Expense::create($data);

        return redirect()->route('events.show', $event)->with('success', 'Expense recorded successfully.');
    }

    public function destroy(Expense $expense): RedirectResponse
    {
        $eventId = $expense->event_id;
        $expense->delete();

        return redirect()->route('events.show', $eventId)->with('success', 'Expense deleted.');
    }
}
