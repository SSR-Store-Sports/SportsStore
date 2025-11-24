document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchSuppliers');
    const supplierCards = document.querySelectorAll('.supplier-card');
    const modal = document.getElementById('supplierModal');
    const btnAddSupplier = document.querySelector('.btn-add-supplier');
    const closeModal = document.querySelector('.close-modal');
    const btnCancel = document.querySelector('.btn-cancel');

    // Busca de fornecedores
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        supplierCards.forEach(card => {
            const supplierName = card.querySelector('h3').textContent.toLowerCase();
            const supplierType = card.querySelector('.supplier-type').textContent.toLowerCase();
            
            if (supplierName.includes(searchTerm) || supplierType.includes(searchTerm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Modal
    btnAddSupplier.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    btnCancel.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Ações dos cards
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            const card = this.closest('.supplier-card');
            const supplierName = card.querySelector('h3').textContent;
            alert(`Editar fornecedor: ${supplierName}`);
        });
    });

    document.querySelectorAll('.btn-products').forEach(btn => {
        btn.addEventListener('click', function() {
            const card = this.closest('.supplier-card');
            const supplierName = card.querySelector('h3').textContent;
            alert(`Ver produtos do fornecedor: ${supplierName}`);
        });
    });

    // Form submit
    document.querySelector('.supplier-form').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Fornecedor cadastrado com sucesso!');
        modal.style.display = 'none';
        this.reset();
    });
});