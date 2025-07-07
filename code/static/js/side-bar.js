function toggleSubmenu(menuId) {
    const submenu = document.getElementById(menuId);
    const arrow = submenu.previousElementSibling.querySelector('.arrow');
    
    // Close all other submenus
    document.querySelectorAll('.submenu').forEach(menu => {
        if (menu.id !== menuId) {
            menu.classList.remove('active');
            const otherArrow = menu.previousElementSibling.querySelector('.arrow');
            if (otherArrow) {
                otherArrow.style.transform = 'rotate(0deg)';
            }
        }
    });
    
    // Toggle current submenu
    submenu.classList.toggle('active');
    arrow.style.transform = submenu.classList.contains('active') ? 'rotate(180deg)' : 'rotate(0deg)';
}