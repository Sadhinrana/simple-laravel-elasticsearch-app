<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $product->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Back to Products
                </a>
                @auth
                    <a href="{{ route('products.edit', $product) }}" 
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Edit Product
                    </a>
                @endauth
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Product Image -->
                        <div>
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-96 object-cover rounded-lg shadow-md">
                            @else
                                <div class="w-full h-96 bg-gray-200 rounded-lg shadow-md flex items-center justify-center">
                                    <span class="text-gray-500 text-lg">No Image Available</span>
                                </div>
                            @endif
                        </div>

                        <!-- Product Details -->
                        <div class="space-y-6">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                                <p class="text-xl text-indigo-600 font-semibold mb-4">${{ number_format($product->price, 2) }}</p>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                                <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h4 class="font-semibold text-gray-900">Brand</h4>
                                    <p class="text-gray-700">{{ $product->brand }}</p>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Category</h4>
                                    <p class="text-gray-700">{{ $product->category }}</p>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Stock Quantity</h4>
                                    <p class="text-gray-700">{{ $product->stock_quantity }}</p>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Status</h4>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>

                            @if($product->specifications && count($product->specifications) > 0)
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Specifications</h3>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <dl class="space-y-2">
                                            @foreach($product->specifications as $key => $value)
                                                <div class="flex justify-between">
                                                    <dt class="font-medium text-gray-900 capitalize">{{ str_replace('_', ' ', $key) }}:</dt>
                                                    <dd class="text-gray-700">{{ $value }}</dd>
                                                </div>
                                            @endforeach
                                        </dl>
                                    </div>
                                </div>
                            @endif

                            <div class="pt-4">
                                <div class="text-sm text-gray-500">
                                    <p>Created: {{ $product->created_at->format('M d, Y') }}</p>
                                    <p>Last updated: {{ $product->updated_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

