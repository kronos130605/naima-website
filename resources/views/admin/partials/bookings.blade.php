<div class="py-8 px-4 max-w-7xl mx-auto">
    <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-6">Bookings</h2>

    {{-- Stats --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
        @foreach([
            ['label' => 'Total',     'value' => $stats['total'],     'color' => 'blue'],
            ['label' => 'Pending',   'value' => $stats['pending'],   'color' => 'amber'],
            ['label' => 'Contacted', 'value' => $stats['contacted'], 'color' => 'indigo'],
            ['label' => 'Confirmed', 'value' => $stats['confirmed'], 'color' => 'green'],
        ] as $s)
            <div class="rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-4 text-center shadow-sm">
                <div class="text-2xl font-bold text-{{ $s['color'] }}-600 dark:text-{{ $s['color'] }}-400">{{ $s['value'] }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">{{ $s['label'] }}</div>
            </div>
        @endforeach
    </div>

    {{-- Status filter --}}
    <div class="flex flex-wrap gap-2 mb-6">
        @foreach([
            ''           => 'All',
            'pending'    => 'Pending',
            'contacted'  => 'Contacted',
            'confirmed'  => 'Confirmed',
            'cancelled'  => 'Cancelled',
        ] as $value => $label)
            <a
                href="{{ route('admin.bookings.index', ['locale' => app()->getLocale(), 'status' => $value ?: null]) }}"
                hx-get="{{ route('admin.bookings.index', ['locale' => app()->getLocale(), 'status' => $value ?: null]) }}"
                hx-target="#admin-content" hx-swap="innerHTML" hx-push-url="true"
                class="rounded-full px-3 py-1 text-xs font-semibold border transition-colors {{ $current_status === $value
                    ? 'bg-blue-600 text-white border-blue-600'
                    : 'bg-white text-slate-600 border-slate-200 hover:border-blue-300 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-600' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    {{-- Table --}}
    <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="border-b border-slate-100 dark:border-slate-700 text-left text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                    <th class="px-4 py-3 font-medium">Name</th>
                    <th class="px-4 py-3 font-medium">Email</th>
                    <th class="px-4 py-3 font-medium hidden sm:table-cell">Level</th>
                    <th class="px-4 py-3 font-medium hidden md:table-cell">Lang</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium hidden lg:table-cell">Date</th>
                    <th class="px-4 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                @forelse($bookings as $booking)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                        <td class="px-4 py-3 font-medium text-slate-800 dark:text-slate-100">
                            {{ $booking->name }}
                            @if($booking->phone)
                                <div class="text-xs text-slate-400 font-normal">{{ $booking->phone }}</div>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-slate-600 dark:text-slate-400">
                            <a href="mailto:{{ $booking->email }}" class="hover:text-blue-600 transition-colors">{{ $booking->email }}</a>
                        </td>
                        <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden sm:table-cell">
                            {{ $booking->student_level ?? '—' }}
                        </td>
                        <td class="px-4 py-3 hidden md:table-cell">
                            <span class="rounded-full bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-xs px-2 py-0.5 font-medium uppercase">
                                {{ $booking->locale }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            @php
                                $colors = [
                                    'pending'   => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                                    'contacted' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                                    'confirmed' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                                    'cancelled' => 'bg-slate-100 text-slate-500 dark:bg-slate-700 dark:text-slate-400',
                                ];
                            @endphp
                            <span class="rounded-full px-2 py-0.5 text-xs font-semibold {{ $colors[$booking->status] ?? '' }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-xs text-slate-400 hidden lg:table-cell">
                            {{ $booking->created_at->format('M j, Y') }}
                        </td>
                        <td class="px-4 py-3">
                            <form method="POST" action="{{ route('admin.bookings.status', ['locale' => app()->getLocale(), 'id' => $booking->id]) }}">
                                @csrf @method('PATCH')
                                <select
                                    name="status"
                                    onchange="this.form.submit()"
                                    class="rounded-lg border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 text-xs px-2 py-1 text-slate-700 dark:text-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-300"
                                >
                                    @foreach(['pending', 'contacted', 'confirmed', 'cancelled'] as $s)
                                        <option value="{{ $s }}" @selected($booking->status === $s)>{{ ucfirst($s) }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                    </tr>
                    @if($booking->message)
                        <tr class="bg-slate-50/50 dark:bg-slate-700/10">
                            <td colspan="7" class="px-4 py-2 text-xs text-slate-500 dark:text-slate-400 italic">
                                "{{ $booking->message }}"
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-16 text-center text-slate-400">
                            <div class="text-4xl mb-2">📭</div>
                            <p class="text-sm">No booking requests yet.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($bookings->hasPages())
        <div class="mt-6 flex justify-center">{{ $bookings->links() }}</div>
    @endif
</div>
