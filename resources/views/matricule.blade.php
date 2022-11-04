<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet">
  <link rel="shortcut icon" href="image/udc.png">


  <title>Universite des comores</title>
</head>

<body>
  <section class="form-08">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="_form-08-main">
            <div id='sectionAimprimer'>
              <div class="_form-08-head">
                <div class="row">
                  <div class="col-md-2"><img src="assets/images/udc.png" width="50px" height="50px"></div><br><br>
                  <div class="col-md-10">
                    <h3><strong class="text-center">Université des comores</strong></h3>
                    <h6><strong> Direction des études et de la scolarité</strong></h6>
                  </div>
                </div> <br> <br>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">Matricule: {{$mat->mat_etud}}</div>
                        <div class="col-md-6">Nom et Prénom: {{$mat->nom }} {{$mat->prenom }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Date de naissance: {{$mat->date_naiss }}</div>
                        <div class="col-md-6">Lieu de naissance: {{$mat->lieu_naiss }}</div>
                    </div>
                </div>



              </div>
            </div>
            <div class="row" style="text-align:center">
              <div class="col-md-6">
                <a href="{{route('accueil') }}" class="btn btn-primary">Retour</a><br><br>
              </div>
             
            </div>
          </div>
        </div>
  </section>
</body>
<script>
  function imprimer(divName) {
    var restorepage = document.body.innerHTML;
    var printContent = document.getElementById(divName).innerHTML;

    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = restorepage;
  }
</script>

</html>