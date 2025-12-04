document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchOrders');
    const statusFilter = document.querySelector('.status-filter');
    const tableRows = document.querySelectorAll('.orders-table tbody tr');

    function filterOrders() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedStatus = statusFilter.value.toLowerCase();

        tableRows.forEach(row => {
            const customerName = row.querySelector('.customer-info strong').textContent.toLowerCase();
            const customerEmail = row.querySelector('.customer-info span').textContent.toLowerCase();
            const orderId = row.querySelector('.order-id').textContent.toLowerCase();
            const status = row.querySelector('.status-badge').textContent.toLowerCase();

            const matchesSearch = customerName.includes(searchTerm) || 
                                customerEmail.includes(searchTerm) || 
                                orderId.includes(searchTerm);
            
            const matchesStatus = selectedStatus === '' || status.includes(selectedStatus);

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Event listeners
    searchInput.addEventListener('input', filterOrders);
    statusFilter.addEventListener('change', filterOrders);

    // Funcionalidade dos botões de ação
    document.querySelectorAll('.btn-view').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const orderId = row.querySelector('.order-id').textContent;
            alert(`Ver detalhes do pedido ${orderId}`);
        });
    });

    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const orderId = row.querySelector('.order-id').textContent;
            const currentStatus = row.querySelector('.status-badge').textContent;
            
            const newStatus = prompt(`Alterar status do pedido ${orderId}:\n\nStatus atual: ${currentStatus}\n\nNovo status:`, currentStatus);
            if (newStatus && newStatus !== currentStatus) {
                alert(`Status do pedido ${orderId} alterado para: ${newStatus}`);
            }
        });
    });

    document.querySelectorAll('.btn-print').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const orderId = row.querySelector('.order-id').textContent;
            alert(`Imprimir pedido ${orderId}`);
        });
    });
});