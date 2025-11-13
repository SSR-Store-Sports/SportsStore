<link rel="stylesheet" href="/src/views/_components/header/styles.css">
<script src="/public/js/search.js"></script>

<header>
    <nav class="navbar">
        <button class="menu-toggle" aria-label="Menu">
            <i class="ph ph-list"></i>
        </button>

        <div class="logo">
            <a href="/">
                <img width="50px" src="/public/images/logo.png" alt="TatiFit Sports Logo" />
            </a>
        </div>

        <div class="nav-actions">
            <button class="cart-btn" aria-label="Carrinho">
                <a href="/cart"><i class="ph ph-shopping-cart"></i></a>
            </button>
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Buscar produtos..." class="search-input" style="display: none;">
                <button class="search-btn" onclick="toggleSearch()" aria-label="Buscar">
                    <i class="ph ph-magnifying-glass"></i>
                </button>
            </div>
        </div>
    </nav>
</header>