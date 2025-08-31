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
                    <a href="/products" class="text-white">Produtos</a>
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

    <!-- Filters -->
    <section class="bg-gray-900 py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-wrap gap-4 items-center">
                <input type="text" placeholder="Buscar produtos..." class="px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white focus:outline-none focus:border-red-500">
                <select class="px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white">
                    <option>Todas as categorias</option>
                    <option>Camisetas</option>
                    <option>Tênis</option>
                    <option>Shorts</option>
                </select>
                <select class="px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white">
                    <option>Ordenar por</option>
                    <option>Menor preço</option>
                    <option>Maior preço</option>
                    <option>Mais vendidos</option>
                </select>
            </div>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="py-12 bg-black">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">Produtos</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Produto 1 -->
                <div class="bg-gray-900 rounded-lg overflow-hidden hover:scale-105 transition-transform">
                    <div class="h-48 bg-gray-700"></div>
                    <div class="p-4">
                        <h3 class="font-semibold mb-2">Camiseta Pro Performance</h3>
                        <p class="text-gray-400 text-sm mb-2">Tecnologia Dri-FIT</p>
                        <p class="text-red-500 font-bold text-lg">R$ 89,90</p>
                        <button class="w-full mt-3 bg-red-600 hover:bg-red-700 py-2 rounded-lg text-sm transition-all">
                            Adicionar ao Carrinho
                        </button>
                    </div>
                </div>
                
                <!-- Produto 2 -->
                <div class="bg-gray-900 rounded-lg overflow-hidden hover:scale-105 transition-transform">
                    <div class="h-48 bg-gray-700"></div>
                    <div class="p-4">
                        <h3 class="font-semibold mb-2">Tênis Runner Elite</h3>
                        <p class="text-gray-400 text-sm mb-2">Amortecimento avançado</p>
                        <p class="text-red-500 font-bold text-lg">R$ 299,90</p>
                        <button class="w-full mt-3 bg-red-600 hover:bg-red-700 py-2 rounded-lg text-sm transition-all">
                            Adicionar ao Carrinho
                        </button>
                    </div>
                </div>
                
                <!-- Produto 3 -->
                <div class="bg-gray-900 rounded-lg overflow-hidden hover:scale-105 transition-transform">
                    <div class="h-48 bg-gray-700"></div>
                    <div class="p-4">
                        <h3 class="font-semibold mb-2">Short Flex Training</h3>
                        <p class="text-gray-400 text-sm mb-2">Liberdade total</p>
                        <p class="text-red-500 font-bold text-lg">R$ 69,90</p>
                        <button class="w-full mt-3 bg-red-600 hover:bg-red-700 py-2 rounded-lg text-sm transition-all">
                            Adicionar ao Carrinho
                        </button>
                    </div>
                </div>
                
                <!-- Produto 4 -->
                <div class="bg-gray-900 rounded-lg overflow-hidden hover:scale-105 transition-transform">
                    <div class="h-48 bg-gray-700"></div>
                    <div class="p-4">
                        <h3 class="font-semibold mb-2">Jaqueta Sport Wind</h3>
                        <p class="text-gray-400 text-sm mb-2">Proteção contra vento</p>
                        <p class="text-red-500 font-bold text-lg">R$ 199,90</p>
                        <button class="w-full mt-3 bg-red-600 hover:bg-red-700 py-2 rounded-lg text-sm transition-all">
                            Adicionar ao Carrinho
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                <div class="flex space-x-2">
                    <button class="px-3 py-2 bg-gray-800 rounded-lg hover:bg-gray-700">1</button>
                    <button class="px-3 py-2 bg-red-600 rounded-lg">2</button>
                    <button class="px-3 py-2 bg-gray-800 rounded-lg hover:bg-gray-700">3</button>
                </div>
            </div>
        </div>
    </section>
</body>

</html>