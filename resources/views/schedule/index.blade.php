<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Plan lekcji') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse border border-gray-300 text-sm">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 border border-gray-300 text-left">Godzina</th>
                                    <th class="px-4 py-2 border border-gray-300 text-left">Poniedziałek</th>
                                    <th class="px-4 py-2 border border-gray-300 text-left">Wtorek</th>
                                    <th class="px-4 py-2 border border-gray-300 text-left">Środa</th>
                                    <th class="px-4 py-2 border border-gray-300 text-left">Czwartek</th>
                                    <th class="px-4 py-2 border border-gray-300 text-left">Piątek</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hours as $hour)
                                                            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }}">
                                                                <td class="px-4 py-2 border border-gray-300 font-medium text-gray-800">
                                                                    {{ $hour }}
                                                                </td>
                                                                @for($day = 1; $day <= 5; $day++)
                                                                                                <td class="px-4 py-2 border border-gray-300">
                                                                                                    @php
                                                                                                        $lesson = isset($schedulesGrouped[$day])
                                                                                                            ? $schedulesGrouped[$day]->firstWhere('hour', $hour)
                                                                                                            : null;
                                                                                                    @endphp
                                                                                                    @if($lesson)
                                                                                                        @if($role === 'teacher')
                                                                                                            <div class="text-gray-800 font-semibold">{{ $lesson->classroom->name }}</div>
                                                                                                            <div class="text-gray-800">{{ $lesson->subject->name }}</div>
                                                                                                        @endif


                                                                                                        @if($role === 'student')
                                                                                                            <div class="text-gray-800 font-semibold">{{ $lesson->subject->name }}</div>
                                                                                                            <div class="text-gray-500 text-sm">{{ $lesson->teacher->name }} {{ $lesson->teacher->surname }} </div>
                                                                                                        @endif
                                                                                                    @else
                                                                                                        <div class="text-gray-400 italic">Brak zajęć</div>
                                                                                                    @endif
                                                                                                </td>
                                                                @endfor
                                                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>