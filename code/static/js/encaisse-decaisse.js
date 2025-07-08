    const apiBase = "http://localhost/S4/s4_final_exam/code/ws";
    const id_contributeur = 1; // Par exemple, un employé enregistré
  
    function ajax(method, url, data, callback, errorCallback) {
      const xhr = new XMLHttpRequest();
      xhr.open(method, apiBase + url, true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = () => {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) callback(JSON.parse(xhr.responseText));
          else if (errorCallback) errorCallback(xhr.responseText);
        }
      };
      xhr.send(data);
    }
  
    function afficherMessage(message, color = "red") {
      const msg = document.getElementById("message");
      msg.style.color = color;
      msg.textContent = message;
      setTimeout(() => msg.textContent = "", 4000);
    }
  
    function chargerClients() {
      ajax("GET", "/clients", null, (data) => {
        const select = document.getElementById("client-select");
        data.forEach(client => {
          const opt = document.createElement("option");
          opt.value = client.id;
          opt.textContent = client.nom + " " + client.prenom;
          select.appendChild(opt);
        });
      });
    }
  
    function chargerComptes() {
      const idClient = document.getElementById("client-select").value;
      console.log(idClient);
      if (!idClient) return;
  
      ajax("GET", `/comptes-client?id_client=${idClient}`, null, (data) => {
        const select = document.getElementById("compte-select");
        select.innerHTML = '<option value="">-- Sélectionner un compte --</option>';
        data.forEach(compte => {
          const opt = document.createElement("option");
          opt.value = compte.id;
          opt.textContent = `Compte #${compte.numero} - Solde: ${compte.solde ?? 0} Ar`;
          select.appendChild(opt);
        });
      });
    }
  
    function insererMouvement() {
      const idClient = document.getElementById("client-select").value;
      const idCompte = document.getElementById("compte-select").value;
      const montant = document.getElementById("montant").value;
      const typeMouvement = document.querySelector('input[name="mouvement"]:checked');
  
      if (!idClient || !idCompte || !montant || !typeMouvement) {
        afficherMessage("Tous les champs sont obligatoires.");
        return;
      }
  
      const mouvement = typeMouvement.value; // 'encaissement' ou 'decaissement'
  
      // On récupère l'id du type de mouvement (1 = encaissement, 2 = décaissement)
      const urlType = `/compte_type_mouvement?entree=${mouvement === "encaissement" ? 1 : 0}`;
      ajax("GET", urlType, null, (typeData) => {
        const idType = typeData.id;
        const data = `id_compte_type_mouvement=${idType}&id_compte=${idCompte}&id_contributeur=${id_contributeur}&date_mouvement=${new Date().toISOString().split("T")[0]}&montant=${montant}`;
  
        ajax("POST", "/compte_mouvements", data, () => {
          afficherMessage("Mouvement inséré avec succès ✅", "green");
          document.getElementById("montant").value = "";
          document.querySelectorAll('input[name="mouvement"]').forEach(r => r.checked = false);
        }, () => {
          afficherMessage("Erreur lors de l'insertion ❌");
        });
  
      }, () => {
        afficherMessage("Type de mouvement introuvable ❌");
      });
    }