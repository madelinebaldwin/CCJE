<div class="row">
    <div><label>Event Name *</label><input name="name" value="{{ old('name', $event->name ?? '') }}" required></div>
    <div><label>Event Date *</label><input type="date" name="event_date" value="{{ old('event_date', isset($event) ? $event->event_date->format('Y-m-d') : '') }}" required></div>
    <div><label>Academic Year *</label><input name="academic_year" placeholder="2026-2027" value="{{ old('academic_year', $event->academic_year ?? '2026-2027') }}" required></div>
    <div><label>Approved Budget (₱) *</label><input type="number" name="approved_budget" min="0" step="0.01" value="{{ old('approved_budget', $event->approved_budget ?? '0.00') }}" required></div>
    <div><label>Location</label><input name="location" value="{{ old('location', $event->location ?? '') }}"></div>
    <div><label>Status *</label><select name="status" required>
        @foreach(['Planned','Ongoing','Completed'] as $status)
        <option value="{{ $status }}" @selected(old('status', $event->status ?? 'Planned') === $status)>{{ $status }}</option>
        @endforeach
    </select></div>
</div>
<label>Description</label><textarea name="description" rows="3">{{ old('description', $event->description ?? '') }}</textarea>
<button class="btn" type="submit">Save Event</button>
<a class="btn secondary" href="{{ route('events.index') }}">Cancel</a>
