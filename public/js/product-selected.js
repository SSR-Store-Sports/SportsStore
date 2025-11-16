document.addEventListener('DOMContentLoaded', function() {
    // Controle de quantidade
    const decreaseBtn = document.getElementById('decreaseQty');
    const increaseBtn = document.getElementById('increaseQty');
    const quantityInput = document.getElementById('quantity');

    decreaseBtn.addEventListener('click', function() {
        const currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });

    increaseBtn.addEventListener('click', function() {
        const currentValue = parseInt(quantityInput.value);
        const maxValue = parseInt(quantityInput.max);
        if (currentValue < maxValue) {
            quantityInput.value = currentValue + 1;
        }
    });

    // Galeria de imagens
    const thumbs = document.querySelectorAll('.thumb');
    const mainImage = document.querySelector('.product-image > img');

    thumbs.forEach(thumb => {
        thumb.addEventListener('click', function() {
            thumbs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            mainImage.src = this.src;
        });
    });

    // Validação do formulário
    const productForm = document.getElementById('productForm');
    
    productForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const color = document.querySelector('input[name="color"]:checked');
        const size = document.querySelector('input[name="size"]:checked');
        
        if (!color) {
            alert('Por favor, selecione uma cor.');
            return;
        }
        
        if (!size) {
            alert('Por favor, selecione um tamanho.');
            return;
        }
        
        // Aqui você pode adicionar a lógica para adicionar ao carrinho
        alert('Produto adicionado ao carrinho!');
    });

    // Botão comprar agora
    const buyNowBtn = document.querySelector('.btn-buy-now');
    buyNowBtn.addEventListener('click', function() {
        const color = document.querySelector('input[name="color"]:checked');
        const size = document.querySelector('input[name="size"]:checked');
        
        if (!color || !size) {
            alert('Por favor, selecione cor e tamanho antes de comprar.');
            return;
        }
        
        // Redirecionar para checkout
        window.location.href = '/carrinho';
    });
});