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

    <title>Universite des comores</title>
  </head>
  <body>
    <section class="form-08">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="_form-08-main">
              <div class="_form-08-head">
                  <div class="row">
                      <div class="col-md-2"><img src="assets/images/udc.png" width="50px" height="50px"></div>
                      <div class="col-md-10">
                          <h3><strong class="text-center">Université des comores</strong></h3>
                          <h6><strong> Direction des études de la scolarité</strong></h6>
                      </div>
                  </div>
                <b style="margin-left: 60px;">Autorisation de paiement</b><br><br>
              <p style="text-align:left;">Le Directeur des Etudes et de la Scolarité, sousigné,autorise</p>
              <div class="row" style="text-align:left;">
                  <!-- <div class="col-md-2"></div> -->
              <div class="col-md-6">
                <p><b>Numero d'autorisation: {{$data->num_auto}}</b></p>
              </div>

              <!-- <div class="col-md-2"></div> -->
            </div>
            <div class="row"  style="text-align: left;">
                <div class="col-md-6">
                  <p>Nom: {{$data->nom}}</p>
                </div>
                <div class="col-md-6">
                 <p>prénom:  {{$data->prenom}}</p>
                </div>
              </div>
              <div class="row"  style="text-align: left;">
                <div class="col-md-12">
                  <p>Ne(é) le: {{$data->date_naiss}} à {{$data->lieu_naiss}}</p>
                </div>
              </div>
              <div class="row"  style="text-align: justify;">
                <div class="col-md-6">
                  <p>NIN: {{$data->nin}}</p>
                </div>
                <div class="col-md-6">
                @if($data->matricule==NULL)
                    @isset($candidats->num_recu)
                    <p>Num reçu: {{$candidats->num_recu}}</p>
                    @endisset
                 @elseif($data->matricule !=NULL)
                 <p>Matricule: {{$data->matricule}}</p>
                @endif
                </div>
              </div>
              <div class="row"  style="text-align: left;">
                <div class="col-md-12">
                  <p>Préinscrit au titre de l'année: {{$data->Annee}}</p>
                </div>
              </div>
              <div class="row"  style="text-align:left;">
                <div class="col-md-12">
                  <p>Composante: {{$composante->design_facult}}</p>
                </div>
              </div>
              <div class="row"  style="text-align:left;">
                <div class="col-md-12">
                  <p>Département: {{$departement->design_depart}}</p>
                </div>
              </div>
              <div class="row"  style="text-align: justify;">
                <div class="col-md-12">
                  <p>Niveau: {{ $niveau->intit_niv}}</p>
                </div>
              </div>
              <div class="row" style="text-align:left;">
                <p>à verser à la BDC</p>
                <p>{{$data->droit}} ({{$data->droit_lettre}} Francs Comorien) de frais d'inscription au compte UDC</p>
            </div>
            @if( $s->date_fin >= $date )
            <div class="row">
                <form method="post" action="{{ url('https://26901.tagpay.fr/online/online.php')}}" >
                    @csrf
                    <input type="hidden" name="sessionid" value="{{ $sessionId }}">
                    <input type="hidden" name="merchantid" value="2532345689566942">
                    <input type="hidden" name="amount"  value="{{$data->droit}}">
                    <input type="hidden" name="currency" value="174">
                    <input type="hidden" name="purchaseref" value=" {{$data->nin}}">
                    <input type="hidden" name="accepturl" value="https://autorisation.univ-comores.km/accepturl">
                    <input type="hidden" name="cancelurl" value="https://autorisation.univ-comores.km/cancelurl">
                    <input type="hidden" name="declineurl" value="https://autorisation.univ-comores.km/declineurl">
                    <input type="submit" class="btn btn-sm btn-primary" name="ok" value="Payer via Holo">
                    <a href="{{route('accueil')}}" class="btn btn-sm btn-primary">Payer après</a>
                </form>
               
            </div>
            @endif
              <!-- <div class="form-group">
                <div class="_btn_04">
                  <a href="choix.html">Debuter l'inscription</a>
                </div>
                <p style="text-align:center;" class="fiche"><a href="#">Cliquez ici si vous avez deja une fiche</a></p>
              </div>
              <div class="sub-01">
                <img src="assets/images/shap-02.png">
              </div> -->
              
          </div>
          <div class="sub-01">
                <img src="assets/images/shap-02.png">
              </div>
        </div>
      </div>
    </section>
  </body>
</html>
