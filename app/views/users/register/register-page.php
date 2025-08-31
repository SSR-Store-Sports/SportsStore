<!DOCTYPE html>

<body class="bg-black text-white">
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-gray-900 to-black py-12">
        <div class="bg-gray-900 p-8 rounded-lg shadow-xl w-full max-w-md">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-red-500">SportsStore</h1>
                <p class="text-gray-400 mt-2">Crie sua conta</p>
            </div>
            
            <form class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Nome</label>
                        <input type="text" class="w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white focus:outline-none focus:border-red-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Sobrenome</label>
                        <input type="text" class="w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white focus:outline-none focus:border-red-500" required>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                    <input type="email" class="w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white focus:outline-none focus:border-red-500" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">CPF</label>
                    <input type="text" class="w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white focus:outline-none focus:border-red-500" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Senha</label>
                    <input type="password" class="w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white focus:outline-none focus:border-red-500" required>
                </div>
                
                <div class="flex items-center">
                    <input type="checkbox" class="mr-2" required>
                    <label class="text-sm text-gray-300">Aceito os termos de uso</label>
                </div>
                
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 py-2 rounded-lg font-semibold transition-all">
                    Cadastrar
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <a href="/login" class="text-red-500 hover:text-red-400">Já tem conta? Faça login</a>
            </div>
        </div>
    </div>
</body>

</html>