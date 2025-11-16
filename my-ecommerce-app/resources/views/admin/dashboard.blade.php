<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <h3 class="text-lg font-semibold">Total Orders</h3>
                <p class="text-2xl mt-2">{{ $totalOrders }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <h3 class="text-lg font-semibold">Total Products</h3>
                <p class="text-2xl mt-2">{{ $totalProducts }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <h3 class="text-lg font-semibold">Total Customers</h3>
                <p class="text-2xl mt-2">{{ $totalCustomers }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <h3 class="text-lg font-semibold">Total Revenue</h3>
                <p class="text-2xl mt-2">₱{{ number_format($totalRevenue, 2) }}</p>
            </div>
        </div>
    </div>
    
</x-app-layout>
