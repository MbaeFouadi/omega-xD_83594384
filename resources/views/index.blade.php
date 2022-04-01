<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <title>Universite Des Comores</title>
  </head>
  <body>
    
    <section class="form-08">
      <div class="container">
        <div class="row">
          <div class="col-md-12"> 
            <div class="_form-08-main">
              <div class="_form-08-head">
                <h2>Bienvenue sur Omega xD </h2>
              </div>
              @if($s->date_fin >= $date )
              <div class="form-group">
                <div class="_btn_04" >
                  <a href="{{ route('choix') }}">Débuter l'inscription </a>
                </div>
                <hr>
               <div class="container" >
                 <div class="row" >
                   <div class="col-md-6">
                      <p style="text-align:center" class="fiche"><a href="{{ route('auto') }}" style="color:red;">Cliquez ici si vous avez déjà une fiche d'autorisation</a><br><br>
                      <a href="{{ route('fiche') }}" style="color:red;">Cliquez ici pour afficher votre fiche de renseignement</a></p>
                   </div>
                   <div class="col-md-6">
                      <p style="text-align:center;" class="fiche"><a href="{{ route('fin_inscription') }}"  style="color:red;">Cliquez ici pour finaliser votre inscription</a><br><br>
                      <a href="{{ route('photo_carte') }}"  style="color:red;">Cliquez ici pour televerser votre photo pour la carte d'étudiant</a></p>
                   </div>
                 </div>
                 <!-- <h5>Avis aux étudiants</h5>
                 <div class="row">
                   <div class="col-md-12">
                     <p style="font-size: 12px;">- Votre fiche de renseignement s'affichera une fois que votre inscription sera completement achévée. <br>
                     - Le téléversement de la photo sera disponible après avoir terminé votre inscription. <br>
                    - La finalisation de l'inscription se fera seulement si vous avez verser l'argent vers le compte UDC. <br>
                    Telecharger: <br>
                  - <a href="">Manuel d'inscription</a></p>
                   </div>
                 </div><br> -->
               </div>
          
              </div>
              <div class="sub-01">
                <img src="assets/images/shap-02.png">
              </div>
            </div>
              @else 
              <div class="text-center bold">
                <p> Désolé les inscriptions sont déjà fermées </p>
              </div>
            <!--   <div class="sub-01">
                <img src="assets/images/shap-02.png">
              </div> -->
              @endif
              
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
