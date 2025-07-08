employe:
    nom
    prenom
    email
    dtn
    mdp

employe_etat:
    libelle (embauche, renvoye, demission)

employe_historique:
    id_employe
    id_employe_etat
    date

--//////////////////////////////////
client:
    nom
    prenom
    email

compte_type:
    descritpion (client ou institutionelle)

compte:
    numero
    id_compte_type

compte_client:
    id_client
    id_compte
    date
    attribution (boolean)

contributeur:
    libelle (client ou etat ou actionnaire ou investisseur ou EF)

compte_type_mouvement:
    descritpion (encaissement, decaissement, investissememt)
    entree (boolean)

compte_mouvement:
    id_compte_type_mouvement
    id_compte
    id_contributeur
    date_mouvement
    montant

pret_type:
    descritpion
    but

pret_caracteristique:
    id_pret_type
    montant_min
    montant_max
    duree_min
    duree_max
    taux_interet
    date_modif
    remboursement_par_an (boolean)

pret:
    id_pret_type
    id_client
    montant
    duree
    descritpion

pret_statut:
    libelle (en attente, valide, rembourse)

pret_etat:
    id_pret
    id_pret_statut
    date_etat
    id_employe

remboursement_pret:
    id_pret
    amortissement
    assurance
    date_prevue
    interet
    date_remboursement
    montant_penalite

pret_seuil:
    pourcentage
    date_modif

tva:
    taux
    date_modif

penalite:
    pourcentage
    date_modif

assurance: 
    pourcentage
    date_modif