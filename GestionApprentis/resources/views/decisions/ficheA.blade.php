<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document 3</title>
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
            Date : {{$decision->dateda}}<br>
            Référence : {{$decision->referenceda}}<br>
        </div>
        <div class="content">
            Le Directeur de l'Unité Postale de la wilaya de {{$structure->nom}}<br>
            <div class="article">
                <strong>Vu :</strong><br>
                - la loi N° 90/11 du 21 Avril 1990, modifiée et complétée, relative aux relations de travail ;<br>
                - la loi N° 18/04 du 10 Juin 2018, fixant les règles générales en matière de poste et Télécommunications ;<br>
                - la loi N° 18/10 du 10 Juin 2018, fixant les règles applicables en matière d'apprentissage ;<br>
                - le décret présidentiel N° 21/137 du 07 Avril 2021, fixant le salaire national minimum garanti « SNMG » ;<br>
                - le décret exécutif N° 20-240 du 31 Août 2020, fixant le salaire de référence ;<br>
                - le décret exécutif N° 02-241 du 12 Septembre 2002, fixant les conditions de désignation du maître d'apprentissage ;<br>
                - l'arrêté N° 002/SP/MPTIC du 21 Janvier 2010, portant réorganisation de l'Etablissement Public à caractère Industriel et Commercial « Algérie Poste » ;<br>
                - la décision {{$parametre->typedecisiondg}} N° {{$parametre->datedecisiondg}}, portant désignation de {{$parametre->civilitedg}} {{$parametre->nomprenomdg}} en qualité de Directeur Général de l'Etablissement Public à caractère Industriel et Commercial « Algérie Poste » ;<br>
                - la décision de désignation de {{$structure->civiliteresponsable}} {{$structure->nomresponsable}} {{$structure->prenomresponsable}}, N° {{$structure->referencedecisionresponsable}}, du {{$structure->datedecisionresponsable}}, en qualité de Directeur de l'Unité Postale de la wilaya de {{$structure->nom}} ;<br>
                - le règlement intérieur de l'Etablissement Public à caractère Industriel et Commercial « Algérie Poste » ;<br>
                - le contrat d'apprentissage N° {{$apprenti->numcontrat}} de @if ($apprenti->civilite == 'Homme')
                    Mr.
                @else
                    Mme.
                @endif 
                {{$apprenti->nom}} {{$apprenti->prenom}};<br>
                - le procès verbal d'installation N° {{$pv->reference}} du {{$pv->datepv}} relatif à l'installation de {{$apprenti->civilite}} {{$apprenti->nom}} {{$apprenti->prenom}} en qualité d'apprenti de l'Unité Postale de la wilaya de {{$structure->nom}} et la désignation de {{$maitre->civilite}} {{$maitre->nom}} {{$maitre->prenom}} en qualité de son maître d'apprentissage.
            </div>
            <div class="article">
                <strong>Décide :</strong><br>
                <strong>Article 01er :</strong> Il est attribué à 
                @if ($apprenti->civilite == 'Homme')
                    Mr.
                @else
                    Mme.
                @endif 
                {{$apprenti->nom}} {{$apprenti->prenom}}, Apprenti affecté(e) à la Direction de l'Unité Postale de la wilaya de {{$structure->nom}}, du {{$apprenti->datedebut}} au {{$apprenti->datefin}}, un présalaire, fixé comme suit :<br>
                - Premier semestre : {{$bareme->montantlettres1_apprentis}} {{$bareme->montantchiffres1_apprentis}} DA, représentant {{$bareme->tauxs1_apprentis}}% du SNMG, du {{$decision->datedebutpresalaireS1}} au {{$decision->datefinpresalaireS1}}<br>
                - Deuxième semestre : {{$bareme->montantlettres2_apprentis}} {{$bareme->montantchiffres2_apprentis}} DA, représentant {{$bareme->tauxs2_apprentis}}% du SNMG, du {{$decision->datedebutpresalaireS2}} au {{$decision->datefinpresalaireS2}}<br>
                @if ($bareme->tauxs3_apprentis)
                    - Troisième semestre : {{$bareme->montantlettres3_apprentis}} {{$bareme->montantchiffres3_apprentis}} DA, représentant {{$bareme->tauxs3_apprentis}}% du SNMG, du {{$decision->datedebutpresalaireS3}} au {{$decision->datefinpresalaireS3}}<br>
                @endif
                @if ($bareme->tauxs4_apprentis)
                    - Quatrième semestre : {{$bareme->montantlettres4_apprentis}} {{$bareme->montantchiffres4_apprentis}} DA, représentant {{$bareme->tauxs4_apprentis}}% du SNMG, du {{$decision->datedebutpresalaireS4}} au {{$decision->datefinpresalaireS4}}<br>
                @endif
                @if ($bareme->tauxs5_apprentis)
                    - Cinquième semestre : {{$bareme->montantlettres5_apprentis}} {{$bareme->montantchiffres5_apprentis}} DA, représentant {{$bareme->tauxs5_apprentis}}% du SNMG, du {{$decision->datedebutpresalaireS5}} au {{$decision->datefinpresalaireS5}}<br>
                @endif
                Ce présalaire est exonéré des cotisations dues par l'apprenti au titre des assurances sociales et de l'impôt.
            </div>
            <div class="article">
                <strong>Art 02 :</strong> Le présalaire de l'apprenti ainsi que la prime d'encadrement pédagogique sont suspendus en cas de rupture, suspension de la relation de travail, ou de résiliation du contrat d'apprentissage.
            </div>
            <div class="article">
                <strong>Art 03 :</strong> Monsieur le Directeur des Ressources Humaines et Madame la Directrice des Finances et de la Comptabilité sont chargés, chacun en ce qui le concerne, de l'exécution de la présente décision.
            </div>
        </div>
        <div class="footer">
            <div>
                <strong>Signature :</strong>
            </div>
        </div>
    </div>
</body>
</html>