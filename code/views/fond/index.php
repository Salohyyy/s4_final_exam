<?php
    // Conversion PHP en JSON JavaScript
    $ticketsO_json = json_encode(array_map(fn($e) => (int)$e['nombre_tickets'], $ticketsO));
    $ticketsF_json = json_encode(array_map(fn($e) => (int)$e['nombre_tickets'], $ticketsF));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Analytique</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/dark-theme.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/dashboard.css">
    <script src="<?=BASE_URL?>/js/plotly-latest.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1><i class="fas fa-chart-line"></i> Tableau de Bord Analytique</h1>
            <p>Statistiques et indicateurs clés de performance</p>
        </header>

        <div class="dashboard-grid">
            <!-- Graphique principal -->
            <section class="dashboard-card wide-card">
                <div class="card-header">
                    <h2><i class="fas fa-ticket-alt"></i> Tickets par Mois</h2>
                </div>
                <div class="card-body">
                    <div id="graph" class="chart-container"></div>
                </div>
            </section>

            <!-- KPI Cards -->
            <section class="dashboard-card">
                <div class="card-header">
                    <h2><i class="fas fa-clock"></i> Temps Moyen</h2>
                </div>
                <div class="card-body">
                    <div class="kpi-value">
                        <?= $dureeMoyenne ?> jours
                    </div>
                    <p class="kpi-label">pour la clôture d'un ticket</p>
                </div>
            </section>

            <section class="dashboard-card">
                <div class="card-header">
                    <h2><i class="fas fa-star"></i> Satisfaction</h2>
                </div>
                <div class="card-body">
                    <div class="rating-container">
                        <?php foreach ($noteMoyenne as $note): ?>
                            <div class="rating-item">
                                <span class="rating-category"><?= $note['anom'] ?></span>
                                <div class="rating-stars">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="fas fa-star <?= $i <= round($note['moyenne']) ? 'filled' : '' ?>"></i>
                                    <?php endfor; ?>
                                    <span class="rating-value">(<?= number_format($note['moyenne'], 1) ?>/5)</span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <!-- Notes extrêmes -->
            <section class="dashboard-card">
                <div class="card-header">
                    <h2><i class="fas fa-trophy"></i> Meilleure Note</h2>
                </div>
                <div class="card-body">
                    <?php foreach ($notesEleve as $note): ?>
                        <div class="extreme-note positive">
                            <div class="note-value"><?= $note['valeur'] ?>/5</div>
                            <div class="note-detail">Client #<?= $note['id_client'] ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="dashboard-card">
                <div class="card-header">
                    <h2><i class="fas fa-exclamation-triangle"></i> Plus Basse Note</h2>
                </div>
                <div class="card-body">
                    <?php foreach ($notesBasse as $note): ?>
                        <div class="extreme-note negative">
                            <div class="note-value"><?= $note['valeur'] ?>/5</div>
                            <div class="note-detail">Client #<?= $note['id_client'] ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </div>

    <script>
        // Graphique principal
        const data = [
            {
                x: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
                y: <?= $ticketsO_json ?>,
                type: 'scatter',
                mode: 'lines+markers',
                name: 'Tickets Ouverts',
                line: { 
                    color: '#ff4d6d',
                    width: 3,
                    shape: 'spline'
                },
                marker: {
                    size: 8,
                    color: '#ff4d6d'
                }
            },
            {
                x: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
                y: <?= $ticketsF_json ?>,
                type: 'scatter',
                mode: 'lines+markers',
                name: 'Tickets Fermés',
                line: { 
                    color: '#52b788',
                    width: 3,
                    shape: 'spline'
                },
                marker: {
                    size: 8,
                    color: '#52b788'
                }
            }
        ];

        const layout = {
            plot_bgcolor: 'rgba(0,0,0,0)',
            paper_bgcolor: 'rgba(0,0,0,0)',
            font: {
                color: '#e0e0e0'
            },
            xaxis: { 
                title: 'Mois',
                gridcolor: '#3d3d3d'
            },
            yaxis: { 
                title: 'Nombre de tickets',
                gridcolor: '#3d3d3d'
            },
            legend: {
                orientation: 'h',
                y: -0.2
            },
            margin: {
                t: 30,
                b: 80,
                l: 50,
                r: 30
            }
        };

        Plotly.newPlot('graph', data, layout, {responsive: true});
    </script>
</body>
</html>