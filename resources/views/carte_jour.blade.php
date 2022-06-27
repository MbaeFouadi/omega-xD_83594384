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
            <div  id='sectionAimprimer'>
                <div class="_form-08-head">
                    <div class="row">
                        <div class="col-md-2"><img src="assets/images/udc.png" width="50px" height="50px"></div><br><br>
                        <div class="col-md-10">
                            <h3><strong class="text-center">Université des comores</strong></h3>
                            <h6><strong> Direction des études de la scolarité</strong></h6>
                        </div>
                    </div> <br> <br>
                    <div class="container">
                        <p> <strong>{{$carte->nom}} {{$carte->prenom}}</strong> vous êtes prié de bien vouloir vous présenter à la Direction des Etudes et de la Scolarité le {{\Carbon\Carbon::parse($date)->translatedFormat('j F Y')}} pour recuperer votre carte scolaire</p>
                        <p>NB: Vous devez télécharger ce document pour le présenter avant de recuperer votre carte </p>
                    </div>
             
          
            
            </div>
            </div>
          <div class="row" style="text-align:center">
            <div class="col-md-6">
                <a href="{{route('accueil') }}" class="btn btn-primary">Retour</a><br><br>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary" onClick="imprimer('sectionAimprimer')">Télécharger</button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
  <script>
            function imprimer(divName){
                var restorepage=document.body.innerHTML;
                var printContent=document.getElementById(divName).innerHTML;

                document.body.innerHTML=printContent;
                window.print();
                document.body.innerHTML=restorepage;
            }
    </script>
</html>
