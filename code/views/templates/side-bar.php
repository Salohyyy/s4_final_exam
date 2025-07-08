<div class="side-bar">
            <div class="sidebar-header">
                <h2><i class="fas fa-university"></i> FinanceApp</h2>
                <p>Gestion Financière</p>
            </div>

            <div class="menu-section">
                <div class="menu-title">
                    <i class="fas fa-piggy-bank"></i> test
                </div>
                <div class="menu-item" onclick="toggleSubmenu('test-menu')">
                    <i class="fas fa-wallet"></i>
                    <span>Test</span>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>
                <div class="submenu" id="test-menu">
                    <div class="submenu-item" onclick="loadContent('ajouter-fond')">
                        <i class="fas fa-plus-circle"></i> 
                        <a href="/test">Ajouter Fond</a>
                    </div>
                </div>
            </div>

            <div class="menu-section">
                <div class="menu-title">
                    <i class="fas fa-piggy-bank"></i> Fonds
                </div>
                <div class="menu-item" onclick="toggleSubmenu('fonds-menu')">
                    <i class="fas fa-wallet"></i>
                    <span>Gestion des Fonds</span>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>
                <div class="submenu" id="fonds-menu">
                    <div class="submenu-item" onclick="loadContent('ajouter-fond')">
                        <i class="fas fa-plus-circle"></i> Ajouter Fond
                    </div>
                    <div class="submenu-item" onclick="loadContent('detail-fond')">
                        <i class="fas fa-info-circle"></i> Détails
                    </div>
                </div>
            </div>

            <div class="menu-section">
                <div class="menu-title">
                    <i class="fas fa-users"></i> Clients
                </div>
                <div class="menu-item" onclick="toggleSubmenu('client-menu')">
                    <i class="fas fa-user-tie"></i>
                    <span>Gestion Client</span>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>
                <div class="submenu" id="client-menu">
                    <div class="submenu-item" onclick="loadContent('encaissement')">
                        <i class="fas fa-money-bill-wave"></i> Encaissement/Décaissement
                    </div>
                    <div class="submenu-item" onclick="loadContent('pret')">
                        <i class="fas fa-hand-holding-usd"></i> Prêt
                    </div>
                    <div class="submenu-item" onclick="loadContent('remboursement')">
                        <i class="fas fa-receipt"></i> Remboursement
                    </div>
                    <div class="submenu-item" onclick="loadContent('pret-attente')">
                        <i class="fas fa-clock"></i> Prêt en Attente de Validation
                    </div>
                </div>
            </div>

            <div class="menu-section">
                <div class="menu-title">
                    <i class="fas fa-cogs"></i> Configuration
                </div>
                <div class="menu-item" onclick="toggleSubmenu('type-pret-menu')">
                    <i class="fas fa-list-alt"></i>
                    <span>Gestion Type Prêt</span>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>
                <div class="submenu" id="type-pret-menu">
                    <div class="submenu-item" onclick="loadContent('liste-type')">
                        <i class="fas fa-list"></i> Liste
                    </div>
                    <div class="submenu-item" onclick="loadContent('ajouter-type')">
                        <i class="fas fa-plus"></i> Ajouter
                    </div>
                </div>
            </div>
        </div>