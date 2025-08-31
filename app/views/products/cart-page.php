<!DOCTYPE html>

<body class="bg-black text-white">
    <!-- Header -->
    <header class="bg-black border-b border-gray-800">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-red-500">SportsStore</a>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="/products" class="text-gray-300 hover:text-white">Produtos</a>
                    <a href="#" class="text-gray-300 hover:text-white">Categorias</a>
                    <a href="#" class="text-gray-300 hover:text-white">Ofertas</a>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-gray-300 hover:text-white"><a href="/cart">🛒</a></button>
                    <a href="/login" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-sm">Login</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Cart Content -->
    <section class="py-12 bg-black min-h-screen">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">Carrinho de Compras</h2>
            
            <!-- Cart Items -->
            <div class="bg-gray-900 rounded-lg p-6 mb-6">
                <div class="flex items-center justify-between border-b border-gray-700 pb-4 mb-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gray-700 rounded"></div>
                        <div>
                            <h3 class="font-semibold">Camiseta Pro Performance</h3>
                            <p class="text-gray-400 text-sm">Tamanho: M</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <button class="w-8 h-8 bg-gray-700 rounded flex items-center justify-center">-</button>
                            <span>2</span>
                            <button class="w-8 h-8 bg-gray-700 rounded flex items-center justify-center">+</button>
                        </div>
                        <p class="text-red-500 font-bold">R$ 179,80</p>
                        <button class="text-red-500 hover:text-red-400">🗑️</button>
                    </div>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gray-700 rounded"></div>
                        <div>
                            <h3 class="font-semibold">Tênis Runner Elite</h3>
                            <p class="text-gray-400 text-sm">Tamanho: 42</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <button class="w-8 h-8 bg-gray-700 rounded flex items-center justify-center">-</button>
                            <span>1</span>
                            <button class="w-8 h-8 bg-gray-700 rounded flex items-center justify-center">+</button>
                        </div>
                        <p class="text-red-500 font-bold">R$ 299,90</p>
                        <button class="text-red-500 hover:text-red-400">🗑️</button>
                    </div>
                </div>
            </div>
            
            <!-- Cart Summary -->
            <div class="bg-gray-900 rounded-lg p-6">
                <h3 class="text-xl font-bold mb-4">Resumo do Pedido</h3>
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between">
                        <span>Subtotal:</span>
                        <span>R$ 479,70</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Frete:</span>
                        <span>R$ 15,00</span>
                    </div>
                    <div class="border-t border-gray-700 pt-2 flex justify-between font-bold text-lg">
                        <span>Total:</span>
                        <span class="text-red-500">R$ 494,70</span>
                    </div>
                </div>
                <button class="w-full bg-red-600 hover:bg-red-700 py-3 rounded-lg font-semibold transition-all">
                    Finalizar Compra
                </button>
            </div>
        </div>
    </section>
</body>

</html>