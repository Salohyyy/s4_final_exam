<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Montant disponible par mois</title>
</head>
<body>
  <div class="content-header">
    <h1>Montant disponible à disposition de l’EF</h1>
  </div>

  <div id="message" style="color: red; font-weight: bold;"></div>

  <div style="margin-bottom: 20px;">
    <label>Mois début :</label>
    <select id="mois-debut">
      ${[...Array(12).keys()].map(m => `<option value="${m + 1}">${m + 1}</option>`).join('')}
    </select>

    <label>Année début :</label>
    <input type="number" id="annee-debut" placeholder="ex: 2024" />

    <label>Mois fin :</label>
    <select id="mois-fin">
      ${[...Array(12).keys()].map(m => `<option value="${m + 1}">${m + 1}</option>`).join('')}
    </select>

    <label>Année fin :</label>
    <input type="number" id="annee-fin" placeholder="ex: 2025" />

    <button id="btn-filtrer">Filtrer</button>
  </div>

  <table border="1" cellpadding="8">
    <thead>
      <tr>
        <th>Mois</th>
        <th>Année</th>
        <th>Montant non emprunté</th>
        <th>Remboursements reçus</th>
        <th>Total disponible</th>
      </tr>
    </thead>
    <tbody id="table-body"></tbody>
  </table>

  <script>
    (() => {
      const apiBase = "http://localhost/S4/s4_final_exam/code/ws";

      function afficherMessage(msg, color = "red") {
        const msgBox = document.getElementById("message");
        msgBox.style.color = color;
        msgBox.textContent = msg;
        setTimeout(() => msgBox.textContent = "", 4000);
      }

      function ajaxGET(url, callback, errorCallback) {
        fetch(apiBase + url)
          .then(res => {
            if (!res.ok) throw new Error("Erreur réseau");
            return res.json();
          })
          .then(callback)
          .catch(err => {
            if (errorCallback) errorCallback(err);
            else afficherMessage("Erreur lors du chargement.");
          });
      }

      function chargerTableau() {
        const moisDebut = document.getElementById("mois-debut").value;
        const anneeDebut = document.getElementById("annee-debut").value;
        const moisFin = document.getElementById("mois-fin").value;
        const anneeFin = document.getElementById("annee-fin").value;

        if (!moisDebut || !anneeDebut || !moisFin || !anneeFin) {
          afficherMessage("Veuillez remplir tous les champs de filtre.");
          return;
        }

        const url = `/disponibilite?mois_debut=${moisDebut}&annee_debut=${anneeDebut}&mois_fin=${moisFin}&annee_fin=${anneeFin}`;

        ajaxGET(url, (data) => {
          const tbody = document.getElementById("table-body");
          tbody.innerHTML = "";

          data.forEach(row => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
              <td>${row.mois}</td>
              <td>${row.annee}</td>
              <td>${parseFloat(row.non_emprunte).toFixed(2)} Ar</td>
              <td>${parseFloat(row.rembourse).toFixed(2)} Ar</td>
              <td><strong>${parseFloat(row.total_disponible).toFixed(2)} Ar</strong></td>
            `;
            tbody.appendChild(tr);
          });
        });
      }

      document.getElementById("btn-filtrer").addEventListener("click", chargerTableau);
    })();
  </script>
</body>
</html>
