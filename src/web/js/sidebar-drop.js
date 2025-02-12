// Listen for clicks on dropdown toggles
document.querySelectorAll('[data-collapse-toggle]').forEach(button => {
    button.addEventListener('click', function() {
        const dropdownId = this.getAttribute('data-dropdown-id');
        const isExpanded = this.getAttribute('aria-expanded') === 'true';
        
        // Toggle aria-expanded attribute
        this.setAttribute('aria-expanded', !isExpanded);
        
        // Save the state in local storage
        localStorage.setItem(dropdownId, !isExpanded ? 'open' : 'closed');
        
        // Optionally toggle dropdown content visibility
        const dropdownContent = document.querySelector(`#${dropdownId}`);
        if (dropdownContent) {
            dropdownContent.classList.toggle('hidden');
        }

        // Toggle the rotation of the SVG icon
        const svgIcon = this.querySelectorAll('svg')[1];
        if (svgIcon) {
            svgIcon.classList.toggle('rotate-90');
            localStorage.setItem(`${dropdownId}-rotate`, svgIcon.classList.contains('rotate-90') ? 'rotated' : 'normal');
        }
    });
});

// Restore dropdown states on page load
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

        // Restore the rotation of the SVG icon
        const svgIcon = button.querySelectorAll('svg')[1];
        const rotateState = localStorage.getItem(`${dropdownId}-rotate`);
        if (svgIcon && rotateState === 'rotated') {
            svgIcon.classList.add('rotate-90');
        }
    });
});