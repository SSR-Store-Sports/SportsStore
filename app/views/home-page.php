<!DOCTYPE html>

<body class="bg-black text-white">
    <!-- Header -->
    <header class="bg-black border-b border-gray-800">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-red-500">SportsStore</h1>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="/products" class="text-gray-300 hover:text-white">Produtos</a>
                    <a href="#" class="text-gray-300 hover:text-white">Categorias</a>
                    <a href="#" class="text-gray-300 hover:text-white">Ofertas</a>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-gray-300 hover:text-white"><a href="/cart">🛒</a></button>
                    <button class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-sm"><a href="/login">Login</a></button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center bg-gradient-to-r from-gray-900 to-black">
        <div class="text-center max-w-4xl mx-auto px-4">
            <h2 class="text-6xl md:text-8xl font-bold mb-6">
                <span class="text-white">SPORTS</span>
                <span class="text-red-500">STORE</span>
            </h2>
            <p class="text-xl md:text-2xl text-gray-300 mb-8">
                Equipamentos esportivos de alta performance para atletas que não desistem
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="bg-red-600 hover:bg-red-700 px-8 py-4 rounded-lg text-lg font-semibold transition-all">
                    Explorar Produtos
                </button>
                <button class="border border-gray-600 hover:border-white px-8 py-4 rounded-lg text-lg transition-all">
                    Ver Ofertas
                </button>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="py-20 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4">
            <h3 class="text-4xl font-bold text-center mb-16">Categorias</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-800 rounded-lg p-8 hover:bg-gray-700 transition-all cursor-pointer">
                    <div class="text-4xl mb-4">👕</div>
                    <h4 class="text-xl font-semibold mb-2">Camisetas</h4>
                    <p class="text-gray-400">Performance e conforto</p>
                </div>
                <div class="bg-gray-800 rounded-lg p-8 hover:bg-gray-700 transition-all cursor-pointer">
                    <div class="text-4xl mb-4">👟</div>
                    <h4 class="text-xl font-semibold mb-2">Tênis</h4>
                    <p class="text-gray-400">Tecnologia avançada</p>
                </div>
                <div class="bg-gray-800 rounded-lg p-8 hover:bg-gray-700 transition-all cursor-pointer">
                    <div class="text-4xl mb-4">🩳</div>
                    <h4 class="text-xl font-semibold mb-2">Shorts</h4>
                    <p class="text-gray-400">Liberdade de movimento</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-20 bg-black">
        <div class="max-w-7xl mx-auto px-4">
            <h3 class="text-4xl font-bold text-center mb-16">Produtos em Destaque</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-gray-900 rounded-lg overflow-hidden hover:scale-105 transition-transform">
                    <div class="h-48 bg-gray-700"></div>
                    <div class="p-4">
                        <h4 class="font-semibold mb-2">Camiseta Pro</h4>
                        <p class="text-red-500 font-bold">R$ 89,90</p>
                    </div>
                </div>
                <div class="bg-gray-900 rounded-lg overflow-hidden hover:scale-105 transition-transform">
                    <div class="h-48 bg-gray-700"></div>
                    <div class="p-4">
                        <h4 class="font-semibold mb-2">Tênis Runner</h4>
                        <p class="text-red-500 font-bold">R$ 299,90</p>
                    </div>
                </div>
                <div class="bg-gray-900 rounded-lg overflow-hidden hover:scale-105 transition-transform">
                    <div class="h-48 bg-gray-700"></div>
                    <div class="p-4">
                        <h4 class="font-semibold mb-2">Short Flex</h4>
                        <p class="text-red-500 font-bold">R$ 69,90</p>
                    </div>
                </div>
                <div class="bg-gray-900 rounded-lg overflow-hidden hover:scale-105 transition-transform">
                    <div class="h-48 bg-gray-700"></div>
                    <div class="p-4">
                        <h4 class="font-semibold mb-2">Jaqueta Sport</h4>
                        <p class="text-red-500 font-bold">R$ 199,90</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h4 class="text-2xl font-bold text-red-500 mb-4">SportsStore</h4>
            <p class="text-gray-400">© 2024 SportsStore. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>

</html>