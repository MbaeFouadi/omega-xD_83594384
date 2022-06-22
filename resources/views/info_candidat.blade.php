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
    <link rel="shortcut icon" href="image/udc.png">


    <title>Universite des comores</title>
  </head>
  <body>
    <section class="form-08">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="_form-08-main">
              <div class="_form-08-head">
                <h2>Information candidat</h2><br>
                <form method="POST" action="{{route('autorisation.store')}}" onsubmit="return confirm('Etes-vous sur de vouloir confirmez ce département?')">
                    @csrf
              <div class="row" style="text-align: left;">
                  <!-- <div class="col-md-2"></div> -->
              <div class="col-md-6">
                <p>Nin: {{$candidat->nin}}</p>
              </div>
              {{-- <div class="col-md-6">
               <p>type préinscription:  {{$recu->nom_type}}</p>
              </div> --}}
              <!-- <div class="col-md-2"></div> -->
            </div>
            <div class="row"  style="text-align: left;">
                <div class="col-md-6">
                  <p>Nom: {{$candidat->nom}}</p>
                </div>
                <div class="col-md-6">
                 <p>prénom: {{$candidat->prenom}}</p>
                </div>
              </div>
              <div class="row"  style="text-align: left;">
                <div class="col-md-6">
                  <p>Date Naissance: {{$candidat->date_naiss}}</p>
                </div>
                <div class="col-md-6">
                 <p>Lieu naissance: {{$candidat->lieu_naiss}}</p>
                </div>
              </div>
              <div class="row"  style="text-align: left;">
                <div class="col-md-6">
                  <p>Retenu: {{$departement->design_depart}}</p>
                </div>
              </div>
              <div class="col-md-2 ">
                <input type="hidden" value="{{$candidat->nin}}" name="nin" class="form-control" placeholder="Nin" id="inputEmail3">
               @if($recu->id_type==1)
                <input type="hidden" value="l1" name="niveau" class="form-control"  id="inputEmail3">
                @elseif($recu->id_type==2)
                <input type="hidden" value="l2" name="niveau" class="form-control"  id="inputEmail3">
                @elseif($recu->id_type==3)
                <input type="hidden" value="l3" name="niveau" class="form-control" id="inputEmail3">
                @elseif($recu->id_type==6)
                <input type="hidden" value="N4" name="niveau" class="form-control"  id="inputEmail3">
                @elseif($recu->id_type==7)
                <input type="hidden" value="N5" name="niveau" class="form-control"  id="inputEmail3">
               @endif
              </div>
              {{-- <div class="form-group"> --}}
                <div class="row" style="text-align: justify;">
                    <div class="col-md-8"  >
                        <a href="{{ route('inscription') }}" class="btn btn-sm btn-primary " >retour</a><br><br>
                      {{-- <button type="submit" class="btn btn-primary" >Confirmer</button><br><br> --}}
                    </div>
                      <div class="col-md-4">
                      <button type="submit" class="btn btn-sm btn-primary" >Confirmer</button>
                          {{-- <a href="{{ route('inscription') }}" class="btn btn-primary " >retour</a> --}}
                      </div>
                </div>
              {{-- </div> --}}
              </div>
                </form> <br> <br> <br>
                <div class="sub-01">
                <img src="assets/images/shap-02.png">
              </div>
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
        </div>
      </div>
    </section>
  </body>
</html>
