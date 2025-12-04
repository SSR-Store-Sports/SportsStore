document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchUsers');
    const roleFilter = document.querySelector('.role-filter');
    const tableRows = document.querySelectorAll('.users-table tbody tr');
    const modal = document.getElementById('roleModal');
    const closeModal = document.querySelector('.close-modal');
    const btnCancel = document.querySelector('.btn-cancel');
    const btnSave = document.querySelector('.btn-save');
    let currentUserId = null;

    // Modal functions
    function openModal() {
        if (modal) {
            modal.style.display = 'block';
        }
    }

    function closeModalFunc() {
        if (modal) {
            modal.style.display = 'none';
        }
        currentUserId = null;
    }

    // Função de filtro
    function filterUsers() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedRole = roleFilter ? roleFilter.value : '';

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
    if (searchInput) {
        searchInput.addEventListener('input', filterUsers);
    }
    if (roleFilter) {
        roleFilter.addEventListener('change', filterUsers);
    }

    if (closeModal) {
        closeModal.addEventListener('click', closeModalFunc);
    }
    if (btnCancel) {
        btnCancel.addEventListener('click', closeModalFunc);
    }

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

    document.addEventListener('click', function(e) {
        if (e.target.closest('.btn-role')) {
            e.preventDefault();
            const container = e.target.closest('tr') || e.target.closest('.user-card');
            const userName = container.querySelector('.user-info strong')?.textContent || container.querySelector('.user-card-name')?.textContent;
            const currentRole = container.dataset.role;
            
            const userNameElement = document.getElementById('userName');
            const newRoleElement = document.getElementById('newRole');
            
            if (userNameElement) userNameElement.textContent = userName;
            if (newRoleElement) newRoleElement.value = currentRole;
            currentUserId = container.dataset.userId;
            
            console.log('Opening modal for user:', userName, 'ID:', currentUserId);
            openModal();
        }
        
        if (e.target.closest('.btn-delete')) {
            const container = e.target.closest('tr') || e.target.closest('.user-card');
            const userName = container.querySelector('.user-info strong')?.textContent || container.querySelector('.user-card-name')?.textContent;
            const userId = container.dataset.userId;
            
            if (confirm(`Tem certeza que deseja desativar o usuário: ${userName}?`)) {
                deactivateUser(userId, userName);
            }
        }
    });

    // Salvar alteração de perfil
    if (btnSave) {
        btnSave.addEventListener('click', function() {
            const newRoleElement = document.getElementById('newRole');
            const userNameElement = document.getElementById('userName');
            
            if (newRoleElement && userNameElement && currentUserId) {
                const newRole = newRoleElement.value;
                const userName = userNameElement.textContent;
                changeUserRole(currentUserId, newRole, userName);
            }
        });
    }

    // Função para alterar perfil
    async function changeUserRole(userId, newRole, userName) {
        try {
            const response = await fetch('/admin/usuarios/alterar-perfil', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    userId: userId,
                    newRole: newRole
                })
            });

            const result = await response.json();

            if (result.success) {
                alert(`Perfil de ${userName} alterado para: ${newRole === 'admin' ? 'Administrador' : 'Cliente'}`);
                location.reload();
            } else {
                alert('Erro: ' + result.message);
            }
        } catch (error) {
            alert('Erro ao alterar perfil');
        }
        closeModalFunc();
    }

    // Função para desativar usuário
    async function deactivateUser(userId, userName) {
        try {
            const response = await fetch('/admin/usuarios/desativar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    userId: userId
                })
            });

            const result = await response.json();

            if (result.success) {
                alert(`Usuário ${userName} foi desativado com sucesso`);
                location.reload();
            } else {
                alert('Erro: ' + result.message);
            }
        } catch (error) {
            alert('Erro ao desativar usuário');
        }
    }
});