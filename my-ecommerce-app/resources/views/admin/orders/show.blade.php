<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }} #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Customer Info -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Customer Info</h3>
                <p><strong>Name:</strong> {{ $order->user->name }}</p>
                <p><strong>Email:</strong> {{ $order->user->email }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Total:</strong> ₱{{ number_format($order->total_price, 2) }}</p>
            </div>

            <!-- Products in Order -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Products</h3>
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border-b text-left">Name</th>
                            <th class="px-4 py-2 border-b text-left">Price</th>
                            <th class="px-4 py-2 border-b text-left">Quantity</th>
                            <th class="px-4 py-2 border-b text-left">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->products as $product)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border-b">{{ $product->name }}</td>
                                <td class="px-4 py-2 border-b">₱{{ number_format($product->price, 2) }}</td>
                                <td class="px-4 py-2 border-b">{{ $product->pivot->quantity }}</td>
                                <td class="px-4 py-2 border-b">₱{{ number_format($product->price * $product->pivot->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Status Update Form -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Update Order Status</h3>

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach (['pending', 'processing', 'completed', 'shipped', 'cancelled'] as $status)
                                <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <x-primary-button>
                        {{ __('Update Status') }}
                    </x-primary-button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
