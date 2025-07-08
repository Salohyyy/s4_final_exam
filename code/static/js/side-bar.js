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

function loadContent(page) {
    const title = document.getElementById('page-title');
    const subtitle = document.getElementById('page-subtitle');
    const contentBody = document.getElementById('content-body');
    
    // Remove active class from all menu items
    document.querySelectorAll('.submenu-item').forEach(item => {
        item.classList.remove('active');
    });
    
    // Add active class to clicked item
    event.target.classList.add('active');
    
    // Update content based on page
    switch(page) {
        case 'ajouter-fond':
            title.textContent = 'Ajouter un Fond';
            subtitle.textContent = 'Créer un nouveau fond d\'investissement';
            contentBody.innerHTML = '<div class="form-container"><h3>Formulaire d\'ajout de fond</h3><p>Interface pour ajouter un nouveau fond...</p></div>';
            break;
        case 'detail-fond':
            title.textContent = 'Détails des Fonds';
            subtitle.textContent = 'Consulter les détails des fonds existants';
            contentBody.innerHTML = '<div class="details-container"><h3>Détails des fonds</h3><p>Liste et détails des fonds...</p></div>';
            break;
        case 'encaissement':
            title.textContent = 'Encaissement / Décaissement';
            subtitle.textContent = 'Gérer les opérations d\'encaissement et de décaissement';
            contentBody.innerHTML = '<div class="operations-container"><h3>Opérations financières</h3><p>Interface pour les encaissements et décaissements...</p></div>';
            break;
        case 'pret':
            title.textContent = 'Gestion des Prêts';
            subtitle.textContent = 'Accorder et gérer les prêts clients';
            contentBody.innerHTML = '<div class="loan-container"><h3>Prêts clients</h3><p>Interface de gestion des prêts...</p></div>';
            break;
        case 'remboursement':
            title.textContent = 'Remboursements';
            subtitle.textContent = 'Suivre les remboursements des prêts';
            contentBody.innerHTML = '<div class="repayment-container"><h3>Suivi des remboursements</h3><p>Interface de suivi des remboursements...</p></div>';
            break;
        case 'pret-attente':
            title.textContent = 'Prêts en Attente';
            subtitle.textContent = 'Valider les demandes de prêt en attente';
            contentBody.innerHTML = '<div class="pending-container"><h3>Validation des prêts</h3><p>Interface de validation des demandes...</p></div>';
            break;
        case 'liste-type':
            title.textContent = 'Liste des Types de Prêt';
            subtitle.textContent = 'Consulter tous les types de prêt disponibles';
            contentBody.innerHTML = '<div class="list-container"><h3>Types de prêt</h3><p>Liste des types de prêt configurés...</p></div>';
            break;
        case 'ajouter-type':
            title.textContent = 'Ajouter un Type de Prêt';
            subtitle.textContent = 'Créer un nouveau type de prêt';
            contentBody.innerHTML = '<div class="add-type-container"><h3>Nouveau type de prêt</h3><p>Formulaire d\'ajout d\'un type de prêt...</p></div>';
            break;
    }
}