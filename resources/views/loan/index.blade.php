<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Loan Details') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Process Button -->
            <form method="POST" action="{{ route('loan.process') }}">
                @csrf
                <div class="mb-4">
                    <x-primary-button>
                        {{ __('Process Data') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Loan Details Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white border-b border-gray-200 overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200 text-sm text-left text-gray-700">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 font-medium text-gray-700">Client ID</th>
                                <th class="px-4 py-2 font-medium text-gray-700">Payments</th>
                                <th class="px-4 py-2 font-medium text-gray-700">First Date</th>
                                <th class="px-4 py-2 font-medium text-gray-700">Last Date</th>
                                <th class="px-4 py-2 font-medium text-gray-700">Loan Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($loans as $loan)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $loan->clientid }}</td>
                                <td class="px-4 py-2">{{ $loan->num_of_payment }}</td>
                                <td class="px-4 py-2">{{ $loan->first_payment_date }}</td>
                                <td class="px-4 py-2">{{ $loan->last_payment_date }}</td>
                                <td class="px-4 py-2">{{ number_format($loan->loan_amount, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-center text-gray-500">No loan data found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
