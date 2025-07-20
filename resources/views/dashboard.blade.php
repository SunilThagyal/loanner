<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('loan.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md
                          font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700
                          focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                          transition ease-in-out duration-150">
                    {{ __('Loan Details') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
