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
                <p>Algerie Poste</p>
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
                <strong>Numéro du contrat :</strong> {{ $apprenti->numcontrat }}<br>
                <strong>Date de début :</strong> {{ $apprenti->datedebut }}<br>
                <strong>Date de fin :</strong> {{ $apprenti->datefin }}
            </td>
        </tr>
        <tr>
            <td>Désignation du Maître d'apprentissage</td>
            <td>
                <strong>Nom / Prénom :</strong> {{ $maitre->nom }} {{ $maitre->prenom}}<br>
                <strong>Matricule :</strong> {{ $maitre->matricule }}<br>
                <strong>Affectation :</strong> {{$structure->nom}}<br>
                <strong>Fonction :</strong> {{$specialite->nom}}<br>
                <strong>Diplôme :</strong> {{$diplome->nom}}<br>
                <strong>Date de recrutement :</strong> {{ $maitre->daterecrutement }}
            </td>
        </tr>
        <tr>
            <td>Installation de l'apprenti(e)</td>
            <td>
                <strong>Date d'installation de l'apprenti(e) :</strong><br>
                - En chiffre : {{ $pv->dateinstallationchiffre }}<br>
                - En lettre : L'an {{$pv->anneeinstallationlettre}} et le {{$pv->moisinstallationlettre}} du mois de {{$pv->jourinstallationlettre}}<br>
                <strong>Affectation :</strong> {{$structure->nom}} - {{$pv->serviceaffectation}}<br>
                <strong>Dotations :</strong> {{$pv->dotations}}
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
                Copie à titre d'information à {{ $parametre->civilitedfc }} le Directeur du Centre de Formation Professionnelle
            </td>
        </tr>
    </table>

</body>
</html>