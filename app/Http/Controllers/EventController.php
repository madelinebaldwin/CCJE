<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Classroom;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::with('expenses', 'eventClassrooms.payments')->latest()->get();
        return view('events.index', compact('events'));
    }

    public function create(): View
    {
        return view('events.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'approved_budget' => ['required', 'numeric', 'min:0'],
            'academic_year' => ['required', 'string', 'max:20'],
            'status' => ['required', 'in:Planned,Ongoing,Completed'],
        ]);

        $event = Event::create($data);
        return redirect()->route('events.show', $event)->with('success', 'Event created successfully.');
    }

    public function show(Event $event): View
    {
        $event->load('expenses', 'eventClassrooms.classroom', 'eventClassrooms.payments');
        $classrooms = Classroom::orderBy('year_level')->orderBy('section')->get();
        return view('events.show', compact('event', 'classrooms'));
    }

    public function edit(Event $event): View
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'approved_budget' => ['required', 'numeric', 'min:0'],
            'academic_year' => ['required', 'string', 'max:20'],
            'status' => ['required', 'in:Planned,Ongoing,Completed'],
        ]);

        $event->update($data);
        return redirect()->route('events.show', $event)->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted.');
    }

    public function report(Event $event): View
    {
        $event->load('expenses', 'eventClassrooms.classroom', 'eventClassrooms.payments');
        $totalExpenses = (float) $event->expenses->sum('amount');
        $totalExpected = (float) $event->eventClassrooms->sum('expected_amount');
        $totalCollected = (float) $event->eventClassrooms->sum(fn ($ec) => $ec->payments->sum('amount'));
        return view('events.report', compact('event', 'totalExpenses', 'totalExpected', 'totalCollected'));
    }
}
