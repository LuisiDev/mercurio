document.querySelectorAll('[data-collapse-toggle]').forEach(button => {
    button.addEventListener('click', function() {
        const dropdownId = this.getAttribute('data-dropdown-id');
        const isExpanded = this.getAttribute('aria-expanded') === 'true';
        
        this.setAttribute('aria-expanded', !isExpanded);
        
        localStorage.setItem(dropdownId, !isExpanded ? 'open' : 'closed');
        
        const dropdownContent = document.querySelector(`#${dropdownId}`);
        if (dropdownContent) {
            dropdownContent.classList.toggle('hidden');
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-collapse-toggle]').forEach(button => {
        const dropdownId = button.getAttribute('data-dropdown-id');
        const state = localStorage.getItem(dropdownId);
        
        if (state === 'open') {
            button.setAttribute('aria-expanded', true);
            const dropdownContent = document.querySelector(`#${dropdownId}`);
            if (dropdownContent) {
                dropdownContent.classList.remove('hidden');
            }
        }
    });
});
