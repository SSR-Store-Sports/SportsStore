function toggleSearch() {
    const searchInput = document.getElementById('searchInput');
    
    if (searchInput.style.display === 'none' || searchInput.style.display === '') {
        searchInput.style.display = 'block';
        searchInput.focus();
    } else {
        searchInput.style.display = 'none';
    }
}

function searchProducts() {
    const searchInput = document.getElementById('searchInput');
    const searchTerm = searchInput.value.trim().toLowerCase();
    
    if (searchTerm === '') {
        return;
    }
    
    window.location.href = `/products?search=${encodeURIComponent(searchTerm)}`;
}

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchProducts();
            }
        });
        
        searchInput.addEventListener('blur', function() {
            setTimeout(() => {
                searchInput.style.display = 'none';
            }, 200);
        });
    }
});