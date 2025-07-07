<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/S4/s4_final_exam/code/static/css/side-bar/side-bar.css">
    <link rel="stylesheet" href="/S4/s4_final_exam/code/static/css/remboursement/remboursement.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Remboursement - Gestion Financière</title>
</head>
<body>
    <div class="container">
        <?php include '/S4/s4_final_exam/code/views/templates/side-bar.php'; ?>
        <div class="content">
            <div class="content-header">
                <h1><i class="fas fa-receipt"></i> Remboursement</h1>
                <p>Gérer les remboursements des prêts clients</p>
            </div>
            
            <div class="form-remboursement">
                <div class="form-card">
                    <div class="card-header">
                        <h2><i class="fas fa-money-check-alt"></i> Effectuer un Remboursement</h2>
                        <p>Sélectionnez le client et confirmez le remboursement</p>
                    </div>
                    
                    <form action="#" method="POST">
                        <div class="form-section">
                            <div class="form-group">
                                <label for="client">
                                    <i class="fas fa-user"></i>
                                    Identifiant Client
                                </label>
                                <div class="input-container">
                                    <select name="clientId" id="client" required>
                                        <option value="">Sélectionnez un client</option>
                                        <option value="1">CL-001 - Martin Dupont</option>
                                        <option value="2">CL-002 - Sophie Bernard</option>
                                        <option value="3">CL-003 - Jean-Pierre Moreau</option>
                                        <option value="4">CL-004 - Marie Dubois</option>
                                    </select>
                                    <i class="fas fa-chevron-down select-arrow"></i>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="dateRemboursement">
                                    <i class="fas fa-calendar-alt"></i>
                                    Date de Remboursement
                                </label>
                                <div class="input-container">
                                    <input type="date" name="dateRemboursement" id="dateRemboursement" required>
                                    <i class="fas fa-calendar input-icon"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="info-remboursement">
                            <h3><i class="fas fa-info-circle"></i> Détails du Remboursement</h3>
                            <div class="cards-grid">
                                <div class="info-card montant">
                                    <div class="card-icon">
                                        <i class="fas fa-coins"></i>
                                    </div>
                                    <div class="card-content">
                                        <span class="card-label">Montant Principal</span>
                                        <span class="card-value">5 000 €</span>
                                    </div>
                                </div>
                                
                                <div class="info-card interet">
                                    <div class="card-icon">
                                        <i class="fas fa-percentage"></i>
                                    </div>
                                    <div class="card-content">
                                        <span class="card-label">Intérêts</span>
                                        <span class="card-value">500 €</span>
                                    </div>
                                </div>
                                
                                <div class="info-card penalite">
                                    <div class="card-icon">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="card-content">
                                        <span class="card-label">Pénalité</span>
                                        <span class="card-value">2 jours</span>
                                    </div>
                                </div>
                                
                                <div class="info-card montant-penalite">
                                    <div class="card-icon">
                                        <i class="fas fa-calculator"></i>
                                    </div>
                                    <div class="card-content">
                                        <span class="card-label">Montant Pénalité</span>
                                        <span class="card-value">25 €</span>
                                    </div>
                                </div>
                                
                                <div class="info-card total">
                                    <div class="card-icon">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                    <div class="card-content">
                                        <span class="card-label">Total à Payer</span>
                                        <span class="card-value total-amount">5 525 €</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary">
                                <i class="fas fa-times"></i>
                                Annuler
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check"></i>
                                Confirmer le Remboursement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="/S4/s4_final_exam/code/static/js/side-bar.js"></script>
    <script>
        // Script pour mise à jour dynamique des informations
        document.getElementById('client').addEventListener('change', function() {
            const clientId = this.value;
            if (clientId) {
                // Ici vous pourriez faire un appel AJAX pour récupérer les données du client
                updateClientInfo(clientId);
            }
        });
        
        function updateClientInfo(clientId) {
            // Simulation de données différentes selon le client
            const clientData = {
                1: { montant: 5000, interet: 500, penalite: 2, montantPenalite: 25 },
                2: { montant: 8000, interet: 720, penalite: 0, montantPenalite: 0 },
                3: { montant: 3500, interet: 315, penalite: 5, montantPenalite: 87.5 },
                4: { montant: 12000, interet: 1080, penalite: 1, montantPenalite: 30 }
            };
            
            const data = clientData[clientId];
            if (data) {
                const total = data.montant + data.interet + data.montantPenalite;
                
                document.querySelector('.montant .card-value').textContent = data.montant.toLocaleString('fr-FR') + ' €';
                document.querySelector('.interet .card-value').textContent = data.interet.toLocaleString('fr-FR') + ' €';
                document.querySelector('.penalite .card-value').textContent = data.penalite + ' jour' + (data.penalite > 1 ? 's' : '');
                document.querySelector('.montant-penalite .card-value').textContent = data.montantPenalite.toLocaleString('fr-FR') + ' €';
                document.querySelector('.total .card-value').textContent = total.toLocaleString('fr-FR') + ' €';
            }
        }
    </script>
</body>
</html>