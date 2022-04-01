<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Universite des comores</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/masonry/">



    <!-- Bootstrap core CSS -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="styles.css" rel="stylesheet">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


  </head>
  <body>

<main class="container py-5">
   <div class="container text-center rad" style="margin-top:150px;">
    <div class="row">
        <div class="col-md-2"><img style="margin-left:-120px;" src="image/udc.png" width="50%" height="100"></div>
        <div class="col-md-10">
            <h3 style=""><STRONG>UNIVERSITE DES COMORES</STRONG></h1>
            <h4 style=""><strong>DIRECTION DES ETUDES ET DE LA SCOLARITE</h1></strong>
            <h4 style="margin-left:20px;margin-bottom:20px;margin-top:20px;font-family:Arial Rounde MT Bold"><strong>AUTORISATION DE PAIEMENT</strong></h5>

        </div>
        <p>Le Directeur des Etudes et de la Scolarité, sousigné, autorise</p>
        <div style="text-align:justify">
            <div class="row">
                <strong style="text-align:center">Numero d'autorisation: {{$data->num_auto}}</strong>
                <div class="col-md-3"></div>
                <div class="col-md-3">Nom: {{$data->nom}}</div>
                <div class="col-md-3">Prénom: {{$data->prenom}}</div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3">N(é) le:{{$data->lieu_naiss}}</div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3">Nin: {{$data->nin}}</div>
                <div class="col-md-3">Matricule:</div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3">Préinscrit au titre de l'année:{{$data->Annee}}</div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3">Composante:{{$composante->design_facult}}</div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3">Département:{{$departement->design_depart}}</div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3">Niveau:{{ $niveau->intit_niv}}</div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <div style="text-align:left">
        <p>à verser à la BDC</p>
        <p>- de frais d'inscription au compte de l'université des comores </p>
        </div>
    </div>
   </div>
</main>


    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

      <script async src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous"></script>
  </body>
</html>
