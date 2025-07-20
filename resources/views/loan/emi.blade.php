<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('EMI Details') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Back button -->
            <div class="mb-4">
                <a href="{{ route('loan.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md
                          font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700
                          focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                          transition ease-in-out duration-150">
                    {{ __('Back to Loan Details') }}
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white border-b border-gray-200 rounded-lg">
                    <!-- Horizontal scroll container -->
                    <div class="overflow-x-auto scrollable-table-container">
                        <table class="w-full min-w-[1500px] divide-y divide-gray-200 text-sm text-left text-gray-700">
                            <thead class="bg-gray-50 sticky top-0 z-10">
                                <tr>
                                    @foreach ($columns as $col)
                                        <th class="px-4 py-2 font-medium text-gray-700 whitespace-nowrap">{{ $col }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($records as $row)
                                    <tr class="hover:bg-gray-50">
                                        @foreach ($columns as $col)
                                            <td class="px-4 py-2 whitespace-nowrap">
                                                @if ($col === 'Client ID')
                                                    {{ $row->clientid }}
                                                @else
                                                    {{ number_format($row->$col, 2) }}
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS for Scrollable Table -->
    <style>
        .scrollable-table-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            max-width: 100%;
            position: relative;
        }

        .scrollable-table-container::-webkit-scrollbar {
            height: 10px;
        }

        .scrollable-table-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 5px;
        }

        .scrollable-table-container::-webkit-scrollbar-thumb {
            background: #6b7280;
            border-radius: 5px;
            border: 2px solid #f1f1f1;
        }

        .scrollable-table-container::-webkit-scrollbar-thumb:hover {
            background: #4b5563;
        }

        .scrollable-table-container {
            scrollbar-width: thin;
            scrollbar-color: #6b7280 #f1f1f1;
        }

        /* Ensure table uses fixed layout for consistent column widths */
        .scrollable-table-container table {
            table-layout: fixed;
            width: 100%;
        }

        /* Set consistent column width */
        .scrollable-table-container th,
        .scrollable-table-container td {
            width: 120px; /* Fixed width for all columns */
            min-width: 120px;
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            box-sizing: border-box;
        }

        /* Make header sticky */
        .scrollable-table-container thead {
            position: sticky;
            top: 0;
            background: #f9fafb; /* Match bg-gray-50 */
            z-index: 10;
        }

        /* Ensure header and body cells align */
        .scrollable-table-container th,
        .scrollable-table-container td {
            padding: 0.5rem 1rem;
            text-align: left;
            vertical-align: middle;
        }
    </style>
</x-app-layout>
