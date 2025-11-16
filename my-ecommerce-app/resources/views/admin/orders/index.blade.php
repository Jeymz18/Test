<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border-b">Order ID</th>
                            <th class="px-4 py-2 border-b">Customer</th>
                            <th class="px-4 py-2 border-b">Status</th>
                            <th class="px-4 py-2 border-b">Total</th>
                            <th class="px-4 py-2 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border-b">{{ $order->id }}</td>
                                <td class="px-4 py-2 border-b">{{ $order->user->name }}</td>
                                <td class="px-4 py-2 border-b">{{ ucfirst($order->status) }}</td>
                                <td class="px-4 py-2 border-b">₱{{ number_format($order->total_price, 2) }}</td>
                                <td class="px-4 py-2 border-b">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-4 text-center text-gray-500">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
