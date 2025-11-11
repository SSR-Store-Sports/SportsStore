<link rel="stylesheet" href="/app/views/products/cart/styles.css">

<main class="cart-main">
    <div class="cart-header">
        <h1><i class="ph ph-shopping-cart"></i> Carrinho de compras</h1>
        <span class="cart-count">1 produto</span>
    </div>
    
    <div class="cart-content">
        <div class="cart-items">
            <div class="cart-item">
                <input type="checkbox" class="item-checkbox" checked>
                <div class="item-image">
                    <img src="public/images/image 14.jpg" alt="Legging Fitness">
                </div>
                <div class="item-details">
                    <h3>Legging Fitness Preta Premium - Tecido Respirável</h3>
                    <p class="item-brand">SportsStore</p>
                    <p class="item-size">Tamanho: M | Cor: Preto</p>
                    <div class="item-badges">
                        <span class="badge-shipping">Frete grátis</span>
                        <span class="badge-full">Produto completo</span>
                    </div>
                    <div class="item-actions">
                        <button class="action-btn"><i class="ph ph-heart"></i> Favoritar</button>
                        <button class="action-btn remove-btn"><i class="ph ph-trash"></i> Remover</button>
                    </div>
                </div>
                <div class="item-quantity">
                    <label>Quantidade:</label>
                    <div class="quantity-controls">
                        <button class="qty-btn">-</button>
                        <input type="number" class="quantity" value="1" min="1">
                        <button class="qty-btn">+</button>
                    </div>
                    <p class="stock-info">Estoque disponível</p>
                </div>
                <div class="item-price">
                    <div class="price-old">R$ 119,90</div>
                    <div class="price-current">R$ 89,90</div>
                    <div class="price-installments">12x R$ 7,49 sem juros</div>
                    <div class="price-discount">25% OFF</div>
                </div>
            </div>
            
            <div class="cart-item">
                <input type="checkbox" class="item-checkbox" checked>
                <div class="item-image">
                    <img src="public/images/shorts-fit.jpg" alt="Shorts Fitness">
                </div>
                <div class="item-details">
                    <h3>Shorts Fitness Masculino - Alta Performance</h3>
                    <p class="item-brand">SportsStore</p>
                    <p class="item-size">Tamanho: G | Cor: Azul</p>
                    <div class="item-badges">
                        <span class="badge-shipping">Frete grátis</span>
                    </div>
                    <div class="item-actions">
                        <button class="action-btn"><i class="ph ph-heart"></i> Favoritar</button>
                        <button class="action-btn remove-btn"><i class="ph ph-trash"></i> Remover</button>
                    </div>
                </div>
                <div class="item-quantity">
                    <label>Quantidade:</label>
                    <div class="quantity-controls">
                        <button class="qty-btn">-</button>
                        <input type="number" class="quantity" value="2" min="1">
                        <button class="qty-btn">+</button>
                    </div>
                    <p class="stock-info">Últimas 3 unidades</p>
                </div>
                <div class="item-price">
                    <div class="price-current">R$ 65,90</div>
                    <div class="price-installments">10x R$ 6,59 sem juros</div>
                </div>
            </div>
        </div>
        
        <div class="cart-sidebar">
            <div class="cart-summary">
                <h2>Resumo da compra</h2>
                <div class="summary-line">
                    <span>Produtos (3)</span>
                    <span>R$ 221,70</span>
                </div>
                <div class="summary-line">
                    <span>Frete</span>
                    <span class="free-shipping">Grátis</span>
                </div>
                <div class="summary-line total">
                    <span>Total</span>
                    <span>R$ 221,70</span>
                </div>
                <div class="installments-info">
                    <p>em até <strong>12x de R$ 18,48</strong> sem juros</p>
                </div>
                <button class="checkout-btn">
                    <i class="ph ph-credit-card"></i>
                    Finalizar compra
                </button>
                <div class="security-info">
                    <i class="ph ph-shield-check"></i>
                    <span>Compra 100% segura</span>
                </div>
            </div>
            
            <div class="shipping-calculator">
                <h3>Calcular frete</h3>
                <div class="cep-input">
                    <input type="text" placeholder="Digite seu CEP" maxlength="9">
                    <button class="calc-btn">Calcular</button>
                </div>
                <a href="#" class="cep-link">Não sei meu CEP</a>
            </div>
        </div>
    </div>
</main>
