<!DOCTYPE html>

<body class="bg-black text-white">
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-gray-900 to-black">
        <div class="bg-gray-900 p-8 rounded-lg shadow-xl w-full max-w-md">
            <a href="/" class="text-red-500 hover:text-red-400"><- Voltar...</a>

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-red-500">SportsStore</h1>
                <p class="text-gray-400 mt-2">Entre na sua conta</p>
            </div>
            
            <form class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                    <input type="email" class="w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white focus:outline-none focus:border-red-500" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Senha</label>
                    <input type="password" class="w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white focus:outline-none focus:border-red-500" required>
                </div>
                
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 py-2 rounded-lg font-semibold transition-all">
                    Entrar
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <a href="/register" class="text-red-500 hover:text-red-400">Não tem conta? Cadastre-se</a>
            </div>
        </div>
    </div>
</body>

</html>