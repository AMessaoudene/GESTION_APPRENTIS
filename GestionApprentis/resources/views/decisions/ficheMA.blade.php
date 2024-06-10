<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document 1</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 70%;
            margin: 0 auto;
            border: 1px solid black;
            padding: 20px;
        }
        .header {
            text-align: center;
            font-weight: bold;
        }
        .content {
            margin-top: 20px;
        }
        .article {
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Direction : Direction de l'Unité Postale de la wilaya de {{ $structure->nom }}<br>
            Décision de prise en charge salariale du présalaire des apprentis<br>
            Date : {{$decision->datedma}}<br>
            Référence : {{$decision->referencedma}}<br>
        </div>
        <div class="content">
            Le Directeur de l'Unité Postale de la wilaya de Constantine<br>
            <div class="article">
                <strong>Vu :</strong><br>
                - la loi N° 81/07 du 27/06/1981, modifiée et complétée par la loi N° 18/10 du 10 Juin 2018, notamment l'article N° 39 et 45 portant désignation ainsi que l'octroi d'une prime d'encadrement pédagogique ;<br>
                - la loi N° 90/11 du 21 Avril 1990, modifiée et complétée, relative aux relations de travail ;<br>
                - la loi N° 90-02 du 06/02/1995, fixant la comptabilité, relative aux assurances sociales et de sécurité sociale ;<br>
                - la loi N°97-02 du 31 Décembre 1997 portant loi de finances pour 1998, notamment ses articles 55 et 56 ;<br>
                - la loi N° 06-24 du 26 décembre 2006 portant loi de finances pour 2007, notamment ses articles 79 et 80 ;<br>
                - le Code des Impôts Direct et Taxes Assimilées ;<br>
                - le décret exécutif N° 20-240 du 31 Août 2020, fixant le salaire de référence ;<br>
                - le décret exécutif N° 02-241 du 12 Septembre 2002, fixant les conditions de désignation du maître d'apprentissage, ses missions ainsi que les modalités d'octroi de la prime d'encadrement pédagogique des apprentis ;<br>
                - le décret exécutif N° 0243 du 14 Janvier 2002, portant création d'Algérie Poste ;<br>
                - la décision {{$parametre->typedecisiondg}} N° {{$parametre->datedecisiondg}}, portant désignation de {{$parametre->civilitedg}} {{$parametre->nomprenomdg}} en qualité de Directeur Général de l'Etablissement Public à caractère Industriel et Commercial « Algérie Poste » ;<br>
                - la décision de désignation de {{$structure->civiliteresponsable}} {{$structure->nomresponsable}} {{$structure->prenomresponsable}}, N° {{$structure->referencedecisionresponsable}}, du {{$structure->datedecisionresponsable}}, en qualité de Directeur de l'Unité Postale de la wilaya de {{$structure->nom}} ;<br>
                - la convention collective de l'Etablissement Public à caractère Industriel Commercial « Algérie Poste » N° 31/2013 du 28/07/2013 ;<br>
                - le règlement intérieur de l'Etablissement Public à caractère Industriel et Commercial « Algérie Poste » ;<br>
                - le contrat d'apprentissage N° {{$apprenti->numcontrat}} de @if ($apprenti->civilite == 'Homme')
                    Mr.
                @else
                    Mme.
                @endif 
                {{$apprenti->nom}} {{$apprenti->prenom}};<br>
                - le procès verbal d'installation N° {{$pv->reference}} du {{$pv->datepv}} relatif à l'installation de {{$apprenti->civilite}} {{$apprenti->nom}} {{$apprenti->prenom}} en qualité d'apprenti de l'Unité Postale de la wilaya de {{$structure->nom}} et la désignation de {{$maitre->civilite}} {{$maitre->nom}} {{$maitre->prenom}} en qualité de son maître d'apprentissage.
            </div>
        </div>
        <div class="header">Décide :</div>
        <div class="content">
            <div class="article">
                <strong>Article 01er : Désignation</strong><br>
                {{$apprenti->civilite}} {{$apprenti->nom}} {{$apprenti->prenom}} occupant le poste de IGE, est désigné(e) en qualité de maître d'apprentissage chargé(e) d'assurer sur le poste d'apprentissage la formation pratique, le suivi et l'évaluation de l'apprenti @if ($apprenti->civilite == 'Homme')
                    Mr.
                @else
                    Mme.
                @endif 
                {{$apprenti->nom}} {{$apprenti->prenom}} en milieu professionnel.
            </div>
            <div class="article">
                <strong>Art 02 : Durée et sanction de la formation</strong><br>
                - La durée de la formation est fixée à {{$diplome->duree}} Mois ;<br>
                - La date de début de la formation : {{$apprenti->datedebut}}<br>
                - La date de fin de la formation : {{$apprenti->datefin}}<br>
                - Diplôme préparé : {{$diplome->nom}}<br>
                - Niveau de qualification : {{$apprenti->niveauscolaire}}
            </div>
            <div class="article">
                <strong>Art 03 : Modalités d'octroi de la prime d'encadrement pédagogique</strong><br>
                Le maître d'apprentissage perçoit une prime d'encadrement pédagogique, versée mensuellement par l'employeur, durant toute la formation.<br>
                Le montant de la prime mensuelle est de {{$bareme->montantchiffres1_maitreapprentis}} DA : {{$bareme->montantlettres1_maitreapprentis}}, soit un taux de 25% du montant de salaire de référence.
            </div>
            <div class="article">
                <strong>Art 04 : Date d'effet</strong><br>
                La présente décision prend effet à compter du {{$apprenti->datedebut}}.
            </div>
            <div class="article">
                <strong>Article 05 : Exécution</strong><br>
                Monsieur le Directeur des Ressources Humaines et Madame la Directrice des Finances et de la Comptabilité sont chargés, chacun en ce qui le concerne, de l'exécution de la présente décision.
            </div>
        </div>
        <div>
            <strong>Signature :</strong>
        </div>
    </div>
    <div class="footer">
        <div>
            Copie :<br>
            01 Copie : Dossier DRH<br>
            01 Copie : Intéressé<br>
            01 Copie : Dossier de la taxe formation
        </div>
    </div>
</body>
</html>