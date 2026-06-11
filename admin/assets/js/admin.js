// admin/assets/js/admin.js

document.addEventListener('DOMContentLoaded', () => {
    // 1. Page Loader Transition
    const loader = document.getElementById('pageLoader');
    if (loader) {
        setTimeout(() => {
            loader.classList.add('hidden');
            document.body.classList.add('fade-enter');
        }, 300); // Brief delay for smooth effect
    }

    // 2. Sidebar Toggle
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');

    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    }

    // 3. Modal Foundation
    window.AdminModal = {
        overlay: document.getElementById('adminModal'),
        title: document.getElementById('modalTitle'),
        body: document.getElementById('modalBody'),
        footer: document.getElementById('modalFooter'),
        closeBtn: document.getElementById('modalCloseBtn'),

        show: function(titleText, bodyHTML, footerHTML = '') {
            if(!this.overlay) return;
            this.title.textContent = titleText;
            this.body.innerHTML = bodyHTML;
            this.footer.innerHTML = footerHTML;
            this.overlay.classList.add('active');
        },
        
        hide: function() {
            if(!this.overlay) return;
            this.overlay.classList.remove('active');
        }
    };

    if (window.AdminModal.closeBtn) {
        window.AdminModal.closeBtn.addEventListener('click', () => {
            window.AdminModal.hide();
        });
    }

    // Close modal on outside click
    window.addEventListener('click', (e) => {
        if (e.target === window.AdminModal.overlay) {
            window.AdminModal.hide();
        }
    });

    // 4. Toast Notification System
    window.Toast = {
        container: document.getElementById('toastContainer'),
        
        show: function(message, type = 'info', duration = 3000) {
            if(!this.container) return;
            
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            
            let icon = '';
            if(type === 'success') icon = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>';
            if(type === 'error') icon = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>';
            
            toast.innerHTML = `${icon} <span>${message}</span>`;
            
            this.container.appendChild(toast);
            
            // Trigger animation
            setTimeout(() => toast.classList.add('show'), 10);
            
            // Remove after duration
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 400); // Wait for transition
            }, duration);
        }
    };
});
