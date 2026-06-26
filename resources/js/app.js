import './bootstrap';

// Подтверждение удаления
document.addEventListener('submit', (e) => {
    const form = e.target;
    if (form.matches('form[data-confirm]')) {
        if (!confirm(form.getAttribute('data-confirm') || 'Вы уверены?')) {
            e.preventDefault();
        }
    }
});
