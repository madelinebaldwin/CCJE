<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $events = Event::with('expenses', 'eventClassrooms.payments')->latest()->get();

        $totalBudget = (float) $events->sum('approved_budget');
        $totalExpenses = (float) $events->sum(fn ($event) => $event->expenses->sum('amount'));
        $totalExpected = (float) $events->sum(fn ($event) => $event->eventClassrooms->sum('expected_amount'));
        $totalCollected = (float) $events->sum(fn ($event) =>
            $event->eventClassrooms->sum(fn ($ec) => $ec->payments->sum('amount'))
        );

        return view('dashboard', compact(
            'events', 'totalBudget', 'totalExpenses', 'totalExpected', 'totalCollected'
        ));
    }
}
