document.addEventListener('DOMContentLoaded', function() {
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const nextBtn = document.getElementById('nextStep');
    const prevBtn = document.getElementById('prevStep');

    nextBtn.addEventListener('click', function() {
        // Validar campos da etapa 1
        const requiredFields = step1.querySelectorAll('input[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.style.borderColor = '#ff4444';
            } else {
                field.style.borderColor = '';
            }
        });

        // Validar se senhas coincidem
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;
        
        if (password !== confirmPassword) {
            isValid = false;
            document.getElementById('confirm-password').style.borderColor = '#ff4444';
        }

        if (isValid) {
            step1.classList.remove('active');
            step2.classList.add('active');
        }
    });

    prevBtn.addEventListener('click', function() {
        step2.classList.remove('active');
        step1.classList.add('active');
    });

    // Validação customizada dos termos antes de submeter
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const termsCheckbox = document.getElementById('terms');
        const termsError = document.getElementById('terms-error-message'); // Elemento de erro

        if (!termsCheckbox.checked) {
            e.preventDefault();
            // Exibe a mensagem de erro customizada
            termsError.style.display = 'block';
            termsCheckbox.focus();
        } else {
            // Esconde a mensagem se estiver marcado
            termsError.style.display = 'none';
        }
    });
});