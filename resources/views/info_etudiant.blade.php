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


  <title>Université Des Comores</title>
</head>

<body>
  <section class="form-08">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="_form-08-main">
            <div class="_form-08-head">
              <h2>Information étudiant</h2>
              @isset($resultat)
              <h6>Resultat: {{$resultat}}</h6><br>
              @endisset
              <form method="POST" action="{{route('autorisation_an')}}" @if($p==1) onsubmit="return confirm('Etes-vous sur de vouloir confirmez ce niveau?')" @endif>
                @csrf
                <!-- <div class="col-md-2"></div> -->
                <div class="row" style="text-align: left;">

                  <div class="col-md-6">
                    <p>Nin: {{$nin}}</p>
                  </div>
                  <div class="col-md-6">
                    @if($p==1)
                    <p>Matricule: {{$matricule}}</p>
                    @elseif($p==0)
                    <p>Type de Pré-inscription: {{$recu->nom_type}}</p>
                    @endif
                  </div>
                  <!-- <div class="col-md-2"></div> -->
                </div>
                <div class="row" style="text-align: justify;">
                  <div class="col-md-6">
                    <p>Nom:{{$nom}}</p>
                  </div>
                  <div class="col-md-6">
                    <p>prénom: {{$prenom}}</p>
                  </div>
                </div>
                <div class="row" style="text-align:left;">
                  <div class="col-md-6">
                    <p>Date Naissance: {{$date_n}}</p>
                  </div>
                  <div class="col-md-6">
                    <p>Lieu naissance: {{$lieu_naiss}}</p>
                  </div>
                </div>
                <div class="row" style="text-align:left;">
                  <div class="col-md-12">
                    @if($p==0)
                    <p>Retenu: {{$departement->design_depart}}
                    <p>
                      @elseif($p==1)
                    <p>Niveau: {{$niv}}
                    <p>
                      @endif
                  </div>
                </div>
                <div class="row" style="text-align: left;">
                  <div class="col-md-6">
                    @if($p==0)
                    @if($type_recu==1 || $type_recu==41 || $type_recu==51 )
                    <input type="hidden" value="l1" name="niveau" class="form-control" id="inputEmail3">
                    @elseif($type_recu==2 || $type_recu==42 || $type_recu==52)
                    <input type="hidden" value="l2" name="niveau" class="form-control" id="inputEmail3">
                    @elseif($type_recu==3 || $type_recu==43 || $type_recu==53 )
                    <input type="hidden" value="l3" name="niveau" class="form-control" id="inputEmail3">
                    @elseif($type_recu==6 || $type_recu==56)
                    <input type="hidden" value="N4" name="niveau" class="form-control" id="inputEmail3">
                    @elseif($type_recu==7 || $type_recu==57)
                    <input type="hidden" value="N5" name="niveau" class="form-control" id="inputEmail3">
                  </div>
                @endif

                </div>
                @endif

             
                <input type="hidden" value="{{$nin}}" name="nin" class="form-control" id="inputEmail3">
                <input type="hidden" value="{{$matricule}}" name="matricule" class="form-control" id="inputEmail3">
            </div>

          </div><br>
          <div class="row" style="text-align: justify;">
            <div class="col-md-8">
              {{-- <button type="submit" class="btn btn-primary" >Confirmer</button> --}}
              <a href="{{ route('choix') }}" class="btn btn-sm btn-primary ">retour</a><br><br>

            </div>
            <div class="col-md-4 col-sm-6">
              {{-- <a href="{{ route('inscription') }}" class="btn btn-primary " >retour</a> --}}
              <button type="submit" class="btn btn-sm btn-primary">Confirmer</button>

            </div>
          </div>

          </form>

          <!-- <div class="form-group">
                <div class="_btn_04">
                  <a href="choix.html">Debuter l'inscription</a>
                </div>
                <p style="text-align:center;" class="fiche"><a href="#">Cliquez ici si vous avez deja une fiche</a></p>
              </div>
              <div class="sub-01">
                <img src="assets/images/shap-02.png">
              </div> -->
        </div><br><br><br>
        <div class="sub-01">
          <img src="assets/images/shap-02.png">
        </div>
      </div>
    </div>
  </section>
</body>

</html>