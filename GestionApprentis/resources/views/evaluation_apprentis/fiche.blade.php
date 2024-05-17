
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche d'Évaluation de l'Apprenti(e)</title>
    <style>
        table {
            width: 100%; /* Le tableau prend toute la largeur */
            border-collapse: collapse;
            font-size: 16px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center; /* Centrer horizontalement */
            vertical-align: middle; /* Centrer verticalement */
        }
        th {
            background-color: #f2f2f2;
        }
        .header-row {
            background-color: #e3e3e3;
            height: 100px; /* Pour le logo */
        }
        .header-left {
            display: flex;
            justify-content: center; /* Centrer le logo */
            align-items: center; /* Centrer verticalement */
        }
        img {
            height: 80px; /* Taille du logo */
        }
        .signature-row {
            height: 100px; /* Espace pour les signatures */
        }
        .decision{
            height: 100px;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Fiche d'Évaluation de l'Apprenti(e)</h1> <!-- Centrer le titre -->
    <table>
        <tr class="header-row">
            <td class="header-left" colspan="2"> <!-- Utiliser colspan pour fusionner les cellules -->
                <!-- Place pour le logo -->
                <img src="{{ asset('asset/images/AlgeriePoste.svg') }}" alt="Logo" />
            </td>
            <td colspan="5"> <!-- Fusion des colonnes pour correspondre au tableau -->
                Réf : DGAP/……….<br>
                Page 1/1
            </td>
        </tr>
        <tr>
            <th>Section</th>
            <th colspan="5">Information</th>
        </tr>
        <tr>
            <td >Période d'Évaluation</td>
            <td colspan="5" >Du ……………… Au ……………..</td>
        </tr>
        <tr>
            <td>Nom et prénom de l'Apprenti(e)</td>
            <td colspan="5">[Nom de l'apprenti]</td>
        </tr>
        <tr>
            <td>Spécialité</td>
            <td colspan="5">[Spécialité de l'apprenti]</td>
        </tr>
        <tr>
            <td>Structure d'attache</td>
            <td colspan="5">[Structure d'attache]</td>
        </tr>
        <tr>
            <td>Évaluateur</td>
            <td colspan="5">[Nom de l'évaluateur]</td>
        </tr>
        <tr>
            <td>Fonction</td>
            <td colspan="5">[Fonction de l'évaluateur]</td>
        </tr>
        <tr>
            <th>Critère</th>
            <th>Note</th>
            <th>Observation</th>
        </tr>
        <tr>
            <td class="criteria">Comportement et sociabilité</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="criteria">Communication</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="criteria">Organisation et hygiène</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="criteria">Ponctualité et assiduité</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="criteria">Respect du règlement intérieur</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="criteria">Discipline</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th colspan="6">Critère 02 : Aptitudes Professionnelles</th>
        </tr>
        <tr>
            <td class="criteria">Intérêt au travail</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="criteria">Motivation</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="criteria">Esprit d’initiative</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="criteria">Evolution du processus d’intégration</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="criteria">Qualifications professionnelles</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="criteria">Sens de la responsabilité</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Décision</td>
            <td colspan="5" class="decision">[Décision finale]</td> <!-- Fusionner les colonnes pour plus d'espace -->
        </tr>
        <tr class="signature-row">
            <td>Signature du premier responsable</td>
            <td colspan="5">______________________</td>
        </tr>
    </table>

</body>
</html>
