@section('title','Fiche')
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css"/>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Fiche PV d'installation</title>
</head>
<body>
@foreach($pv->getAttributes() as $key => $value)
<li>{{$key}} : {{$value}}</li> 
@endforeach
@foreach($maitre_apprentis->getAttributes() as $key => $value)
    <h3>Maitre apprentis</h3>
    <li>{{$key}} : {{$value}}</li> 
@break
@endforeach
<div style="position:absolute;top:1.72in;left:0.68in;width:1.59in;line-height:0.14in;">
<DIV style="position:relative; left:0.06in;">
<span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:TimesNewRomanPS-BoldMT;color:#000000">EPIC ALGERIE POSTE</span>
<span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:TimesNewRomanPS-BoldMT;color:#000000"> </span><br/></DIV><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:TimesNewRomanPS-BoldMT;color:#000000">DIRECTION  GENERALE</span><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:TimesNewRomanPS-BoldMT;color:#000000"> </span><br/></SPAN></div>
<div style="position:absolute;top:0.67in;left:2.51in;width:0.78in;line-height:0.20in;"><span style="font-style:normal;font-weight:normal;font-size:14pt;font-family:Arial Narrow;color:#000000">Direction : </span><span style="font-style:normal;font-weight:normal;font-size:14pt;font-family:Arial Narrow;color:#000000"> {{$pv->direction}}</span><br/></SPAN></div>
<div style="position:absolute;top:0.68in;left:7.09in;width:1.18in;line-height:0.17in;">
<span style="font-style:normal;font-weight:bold;font-size:12pt;font-family:Arial Narrow;color:#000000">ERQ/DFP/113/V2</span>
<br/>
</SPAN>
</div>
<div style="position:absolute;top:1.07in;left:3.12in;width:3.00in;line-height:0.22in;">
<span style="font-style:normal;font-weight:bold;font-size:14pt;font-family:Arial Narrow;color:#000000">PROCES VERBAL D’INSTALLATION</span>
<br/>
<DIV style="position:relative; left:0.76in;">
<span style="font-style:normal;font-weight:bold;font-size:14pt;font-family:Arial Narrow;color:#000000">« APPRENTI (e) »</span></SPAN></DIV><br/></div>
</SPAN>
</DIV>
<br/></div>
<div style="position:absolute;top:1.22in;left:6.94in;width:0.46in;line-height:0.17in;">
<span style="font-style:normal;font-weight:bold;font-size:12pt;font-family:Arial Narrow;color:#000000">Date : {{ $pv->datepv }}</span>
</SPAN>
<br/>
</div>
<div style="position:absolute;top:1.74in;left:2.51in;width:0.86in;line-height:0.17in;"><span style="font-style:normal;font-weight:bold;font-size:12pt;font-family:Arial Narrow;color:#000000">Référence : </span></SPAN><span>{{ $pv->reference }}</span><br/></div>
<div style="position:absolute;top:1.74in;left:6.94in;width:0.74in;line-height:0.17in;"><span style="font-style:normal;font-weight:bold;font-size:12pt;font-family:Arial Narrow;color:#000000">Page: 1/1</span></SPAN><br/></div>
<div style="position:absolute;top:2.71in;left:1.09in;width:0.78in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Apprenti(e)</span></SPAN></div>
<div style="position:absolute;top:2.40in;left:2.50in;width:0.96in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Nom / Prénom</span></SPAN></div>
<div style="position:absolute;top:2.40in;left:4.22in;width:2.13in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">{{$apprenti->nom}} {{$apprenti->prenom}}</span></SPAN></div>
<div style="position:absolute;top:2.72in;left:2.50in;width:4.34in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Spécialité de formation </span>
</SPAN>
<br/>
</div>
<div style="position:absolute;top:2.72in;left:2.50in;width:4.34in;line-height:0.17in;">
<DIV style="position:relative; left:1.72in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">{{$apprenti->specialite}}</span>
<br/>
</SPAN>
</DIV>
</div>
<div style="position:absolute;top:3.03in;left:2.50in;width:0.55in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Diplôme</span>
<br/>
</SPAN>
</div>
<div style="position:absolute;top:3.03in;left:4.22in;width:2.26in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">{{$apprenti->diplome1_id}}</span>
</SPAN>
</div>
<div style="position:absolute;top:3.83in;left:1.23in;width:0.49in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Contrat</span></SPAN></div>
<div style="position:absolute;top:3.54in;left:2.50in;width:1.24in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Numéro du contrat</span></SPAN></div>
<div style="position:absolute;top:3.54in;left:4.22in;width:3.81in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">{{$apprenti->numcontrat}}</span></SPAN></div>
<div style="position:absolute;top:3.83in;left:2.50in;width:0.94in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Date de début</span></SPAN></div>
<div style="position:absolute;top:3.83in;left:4.22in;width:2.99in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">{{$apprenti->datedebut}}</span></SPAN></div>
<div style="position:absolute;top:4.12in;left:2.50in;width:0.72in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Date de fin</span></SPAN></div>
<div style="position:absolute;top:4.12in;left:4.22in;width:2.77in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">{{$apprenti->datefin}}</span></SPAN></div>
<div style="position:absolute;top:5.18in;left:0.75in;width:1.45in;line-height:0.19in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Désignation du Maitre </span><br/><DIV style="position:relative; left:0.20in;"><span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">d’apprentissage</span><br/></SPAN></DIV></div>
<div style="position:absolute;top:4.62in;left:2.50in;width:0.96in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Nom / Prénom</span><br/></SPAN></div>
<div style="position:absolute;top:4.62in;left:4.22in;width:3.03in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">«Nom et prénom du maitre d’apprentissage»</span><br/></SPAN></div>
<div style="position:absolute;top:4.88in;left:2.50in;width:0.60in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Matricule</span><br/></SPAN></div>
<div style="position:absolute;top:4.88in;left:4.22in;width:3.07in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">« Matricule  SAGE du  maitre  d’apprentissage »</span><br/></SPAN></div>
<div style="position:absolute;top:5.14in;left:2.50in;width:0.71in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Affectation</span></SPAN></div>
<div style="position:absolute;top:5.14in;left:4.22in;width:3.44in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">« Direction d’affectation  du maitre  d’apprentissage »</span>
</SPAN></div>
<div style="position:absolute;top:5.41in;left:2.50in;width:0.57in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Fonction</span></SPAN></div>
<div style="position:absolute;top:5.41in;left:4.22in;width:2.58in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">« Fonction du  maitre  d’apprentissage »</span></SPAN></div>
<div style="position:absolute;top:5.67in;left:2.50in;width:0.55in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Diplôme</span></SPAN></div>
<div style="position:absolute;top:5.67in;left:4.22in;width:3.25in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">« Formation de base du maitre d’apprentissage »</span></SPAN></div>
<div style="position:absolute;top:5.94in;left:2.50in;width:1.36in;line-height:0.17in;"><span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Date de recrutement</span></SPAN></div>
<div style="position:absolute;top:5.94in;left:4.22in;width:2.66in;line-height:0.17in;"><span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">« Date de recrutement à Algérie Poste »</span></SPAN></div>
<div style="position:absolute;top:7.07in;left:0.96in;width:1.04in;line-height:0.19in;"><DIV style="position:relative; left:0.16in;"><span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Installation de l’apprenti (e)</span>
</SPAN>
</DIV>
</div>
<div style="position:absolute;top:6.65in;left:2.50in;width:1.38in;line-height:0.19in;"><span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Date d’installation de l’apprenti (e)</span></SPAN></div>
<div style="position:absolute;top:6.45in;left:4.22in;width:2.07in;line-height:0.17in;"><span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">En chiffre: </span><span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000"> {{$pv->dateinstallationchiffre}}</span></SPAN></div>
<div style="position:absolute;top:6.81in;left:4.22in;width:4.18in;line-height:0.17in;"><span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">En lettre : </span></SPAN><br/></div>
<div style="position:absolute;top:6.81in;left:4.22in;width:4.18in;line-height:0.17in;"><DIV style="position:relative; left:0.79in;"><span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">L’an </span></SPAN></DIV><br/></div>
<div style="position:absolute;top:6.81in;left:4.22in;width:4.18in;line-height:0.17in;"><DIV style="position:relative; left:1.17in;"><span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">{{$pv->anneeinstallationlettre}} </span></SPAN></DIV><br/></div>
<div style="position:absolute;top:6.81in;left:4.22in;width:4.18in;line-height:0.17in;"><DIV style="position:relative; left:2.17in;"><span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">et le</span></SPAN></DIV><br/></div>
<div style="position:absolute;top:6.81in;left:4.22in;width:4.18in;line-height:0.17in;"><DIV style="position:relative; left:2.61in;"><span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000"> {{$pv->jourinstallationlettre}} </span></SPAN></DIV><br/></div>
<div style="position:absolute;top:6.81in;left:4.22in;width:4.18in;line-height:0.17in;"><DIV style="position:relative; left:3.34in;"><span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">du </span></SPAN></DIV><br/></div>
<div style="position:absolute;top:6.81in;left:4.22in;width:4.18in;line-height:0.17in;">
<DIV style="position:relative; left:3.61in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">mois  </span>
</SPAN>
</DIV>
<br/>
</div>
<div style="position:absolute;top:6.81in;left:4.22in;width:4.18in;line-height:0.19in;">
<DIV style="position:relative; left:4.02in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">de</span>
<br/>
</DIV>
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000"> {{$pv->moisinstallationlettre}}</span>
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000"> </span>
<br/>
</SPAN>
</div>
<div style="position:absolute;top:7.37in;left:2.50in;width:0.71in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Affectation</span>
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000"> </span>
<br/></SPAN></div>
<div style="position:absolute;top:7.37in;left:4.22in;width:3.41in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">{{$pv->directionaffectation}} </span>
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000"> - {{$pv->serviceaffectation}}</span>
</SPAN>
</div>
<div style="position:absolute;top:7.79in;left:2.50in;width:0.63in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Dotations</span>
</SPAN></div>
<div style="position:absolute;top:8.50in;left:0.86in;width:2.12in;line-height:0.19in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Signature du Responsable de la</span>
<DIV style="position:relative; left:0.44in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Structure d’Accueil</span>
</SPAN>
</DIV>
</div>
<div style="position:absolute;top:8.60in;left:3.44in;width:2.41in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Signature de Maitre d’Apprentissage</span>
</SPAN></div>
<div style="position:absolute;top:8.60in;left:6.37in;width:1.73in;line-height:0.17in;">
<span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Arial Narrow;color:#000000">Signature de l'apprenti (e)</span>
<br/>
</SPAN>
</div>
<div style="position:absolute;top:11.47in;left:0.62in;width:5.46in;line-height:0.16in;">
<span style="font-style:italic;font-weight:normal;font-size:11pt;font-family:Arial Narrow;color:#000000">Copie à titre d’information à Monsieur le Directeur du Centre de Formation Professionnelle</span>
<br/>
</SPAN>
</div>
</body>
</html>
