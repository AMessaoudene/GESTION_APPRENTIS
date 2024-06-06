@section('title','Fiche PV')
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procès Verbal d Installation</title>
        <style>
        table {
            width: 90%;
            border-collapse: collapse;
            font-size: 16px;
            margin-left: 50px;
            margin-right: 50px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center; /* Centrer horizontalement */
            vertical-align: middle; /* Centrer verticalement */
            font-size: 18px;
        }
        th {
            background-color: white;
        }
        .header-row {
            background-color:#ffffff;
            height: 100px; /* Ajuster la hauteur de la rangée d'en-tête */
        }
        .header-left {
            display: flex;
            justify-content: center; /* Centrer le logo horizontalement */
            align-items: center; /* Centrer le logo verticalement */
        }
        img {
            height: 80px; /* Ajuster la hauteur du logo */
        }
        .signature-row {
            height: 100px; /* Espace pour les signatures */
        }
        h2 {
            text-align: center;
        }
        </style>
    
</head>
<body>  
   
    <h2>PROCÈS VERBAL D INSTALLATION « APPRENTI(E) »</h2>

    <table>
        <tr class="header-row">
            <td class="header-left">
                <!-- Place pour le logo -->
                <img class="logo" src="photo_2024-04-20_18-29-05 (2).jpg" alt="Logo">
            </td>
            <td colspan="2" class="header-right">
                <strong>Date :</strong> {{ $pv->datepv }}<br>
                <strong>Référence :</strong> {{ $pv->reference }}
            </td>
        </tr>
        <tr>
            <th>Section</th>
            <th>Information</th>
        </tr>
        <tr>
            <td>Apprenti(e)</td>
            <td>
                <strong>Nom / Prénom :</strong> {{ $apprenti->nom }} {{ $apprenti->prenom }}<br>
                <strong>Spécialité de formation :</strong> {{ $specialite->nom }}<br>
                <strong>Diplôme :</strong> {{ $diplome->nom }}
            </td>
        </tr>
        <tr>
            <td>Contrat</td>
            <td>
                <strong>Numéro du contrat :</strong> « Numéro de l'APC au verso du contrat d'apprentissage »<br>
                <strong>Date de début :</strong> « Date de début du contrat d'apprentissage »<br>
                <strong>Date de fin :</strong> « Date de fin du contrat d'apprentissage »
            </td>
        </tr>
        <tr>
            <td>Désignation du Maître d'apprentissage</td>
            <td>
                <strong>Nom / Prénom :</strong> « Nom et prénom du maître d'apprentissage »<br>
                <strong>Matricule :</strong> « Matricule SAGE du maître d'apprentissage »<br>
                <strong>Affectation :</strong> « Direction d'affectation du maître d'apprentissage »<br>
                <strong>Fonction :</strong> « Fonction du maître d'apprentissage »<br>
                <strong>Diplôme :</strong> « Formation de base du maître d'apprentissage »<br>
                <strong>Date de recrutement :</strong> « Date de recrutement à Algérie Poste »
            </td>
        </tr>
        <tr>
            <td>Installation de l'apprenti(e)</td>
            <td>
                <strong>Date d'installation de l'apprenti(e) :</strong><br>
                - En chiffre : ……/………/……….<br>
                - En lettre : L'an ……………… et le …………. du mois de …………………..<br>
                <strong>Affectation :</strong> « Direction d'affectation » - « Service d'affectation »<br>
                <strong>Dotations :</strong> « Equipements ou badge ou autres dotations mis à la disposition de l'apprenti »
            </td>
        </tr>
        <tr class="signature-row">
            <td>Signature du Responsable de la Structure d Accueil</td>
            <td>______________________</td>
        </tr>
        <tr class="signature-row">
            <td>Signature du Maître d'Apprentissage</td>
            <td>______________________</td>
        </tr>
        <tr class="signature-row">
            <td>Signature de l'Apprenti(e)</td>
            <td>______________________</td>
        </tr>
        <tr>
            <td>Copie à titre d information</td>
            <td>
                Copie à titre d'information à Monsieur le Directeur du Centre de Formation Professionnelle
            </td>
        </tr>
    </table>

</body>
</html>