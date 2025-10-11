<x-app-layout>
    <div class="py-10 px-6 md:px-16">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-8">
            Data Parkir Terbaru
        </h2>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg shadow-md bg-white">
                <thead class="bg-[#3C345C] text-white">
                    <tr>
                        <th class="py-3 px-6 text-left text-sm font-semibold uppercase tracking-wider">Waktu</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold uppercase tracking-wider">Sensor</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold uppercase tracking-wider">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @foreach($logs as $log)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-6 text-gray-700 text-sm">{{ $log->created_at }}</td>
                            <td class="py-3 px-6 text-gray-700 text-sm">{{ $log->topic }}</td>
                            <td class="py-3 px-6">
                                @if ($log->status === 'ISI')
                                    <span class="inline-block px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded-full">
                                        {{ $log->status }}
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 text-xs font-semibold text-white bg-green-500 rounded-full">
                                        {{ $log->status }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
