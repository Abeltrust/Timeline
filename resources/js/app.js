import './bootstrap';
import Alpine from 'alpinejs';
import * as lucide from 'lucide';

window.Alpine = Alpine;
Alpine.start();

// Initialize Lucide icons
document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();
});

window.lucide = lucide;
