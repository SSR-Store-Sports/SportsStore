document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchUsers');
    const roleFilter = document.querySelector('.role-filter');
    const tableRows = document.querySelectorAll('.users-table tbody tr');
    const modal = document.getElementById('roleModal');
    const closeModal = document.querySelector('.close-modal');
    const btnCancel = document.querySelector('.btn-cancel');
    const btnSave = document.querySelector('.btn-save');
    let currentUserId = null;

    // Função de filtro
    function filterUsers() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedRole = roleFilter.value;

        tableRows.forEach(row => {
            const userName = row.querySelector('.user-info strong').textContent.toLowerCase();
            const userEmail = row.cells[1].textContent.toLowerCase();
            const userRole = row.dataset.role;

            const matchesSearch = userName.includes(searchTerm) || userEmail.includes(searchTerm);
            const matchesRole = selectedRole === '' || userRole === selectedRole;

            if (matchesSearch && matchesRole) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Event listeners para filtros
    searchInput.addEventListener('input', filterUsers);
    roleFilter.addEventListener('change', filterUsers);

    // Modal functions
    function openModal() {
        modal.style.display = 'block';
    }

    function closeModalFunc() {
        modal.style.display = 'none';
        currentUserId = null;
    }

    closeModal.addEventListener('click', closeModalFunc);
    btnCancel.addEventListener('click', closeModalFunc);

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModalFunc();
        }
    });

    // Ações dos botões
    document.querySelectorAll('.btn-view').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const userName = row.querySelector('.user-info strong').textContent;
            alert(`Ver perfil de: ${userName}`);
        });
    });

    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const userName = row.querySelector('.user-info strong').textContent;
            alert(`Editar usuário: ${userName}`);
        });
    });

    document.querySelectorAll('.btn-role').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const userName = row.querySelector('.user-info strong').textContent;
            const currentRole = row.dataset.role;
            
            document.getElementById('userName').textContent = userName;
            document.getElementById('newRole').value = currentRole;
            currentUserId = row.dataset.userId || userName;
            
            openModal();
        });
    });

    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const userName = row.querySelector('.user-info strong').textContent;
            
            if (confirm(`Tem certeza que deseja desativar o usuário: ${userName}?`)) {
                alert(`Usuário ${userName} foi desativado.`);
            }
        });
    });

    // Salvar alteração de perfil
    btnSave.addEventListener('click', function() {
        const newRole = document.getElementById('newRole').value;
        const userName = document.getElementById('userName').textContent;
        
        alert(`Perfil de ${userName} alterado para: ${newRole === 'admin' ? 'Administrador' : 'Cliente'}`);
        closeModalFunc();
    });
});