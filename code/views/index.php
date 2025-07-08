<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/S4/s4_final_exam/code/static/css/side-bar/side-bar.css">
    <link rel="stylesheet" href="/S4/s4_final_exam/code/static/css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">

        <div class="side-bar">
            <div class="sidebar-header">
                <h2><i class="fas fa-university"></i> Test</h2>
                <p>Dashboard</p>
            </div>

            <div class="menu-section">
                <div class="menu-title">
                    <i class="fas fa-piggy-bank"></i> Test dashboard
                </div>
                <div class="menu-item" onclick="toggleSubmenu('dashboard-menu')">
                    <i class="fas fa-wallet"></i>
                    <span>Gestion des dashboard</span>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>
                <div class="submenu" id="dashboard-menu">
                    <div class="submenu-item" onclick="loadContent('dashboard/dashboard.html')">
                        <i class="fas fa-plus-circle"></i> Ajouter Fond
                    </div>
                    <div class="submenu-item" onclick="loadContent('detail-fond')">
                        <i class="fas fa-info-circle"></i> Détails
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            
        </div>
    </div>

    <script>
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
            fetch(page)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Erreur lors du chargement de la page : " + page);
                    }
                    return response.text();
                })
                .then(html => {
                    document.querySelector('.content').innerHTML = html;
                })
                .catch(error => {
                    console.error(error);
                    document.querySelector('.content').innerHTML = "<p style='color:red;'>Erreur de chargement du contenu.</p>";
                });
        }

    </script>
</body>
</html>
<a href=""></a>