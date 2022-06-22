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
                    </div>
                  <b style="margin-left: 60px;">Fiche de renseignement</b><br><br>
                {{-- <p style="text-align:left;">Le Directeur des Etudes et de la Scolarité, sousigné,autorise</p> --}}
                <div class="row" style="text-align:left;">
                    <!-- <div class="col-md-2"></div> -->
                <div class="col-md-12">
                  <p>Matricule: {{$data->mat_etud}}</p>
                </div>
                <!-- <div class="col-md-2"></div> -->
              </div>
              <div class="row" style="text-align:left;">
                  <!-- <div class="col-md-2"></div> -->
              <div class="col-md-12">
                  <p>NIN: {{$data->NIN}}</p>
              </div>
              <!-- <div class="col-md-2"></div> -->
            </div>
              <div class="row"  style="text-align: left;">
                  <div class="col-md-12">
                    <p>Nom: {{$data->nom}}</p>
                  </div>
              </div>
              <div class="row"  style="text-align: left;">
                  <div class="col-md-12">
                   <p>Prénom:  {{$data->prenom}}</p>
                  </div>
              </div>
                <div class="row"  style="text-align: left;">
                  <div class="col-md-12">
                    <p>Date de naissance: {{$data->date_naiss}}</p>
                  </div>
                </div>
                <div class="row"  style="text-align:left;">
                  <div class="col-md-12">
                      <p>Lieu de naissance: {{$data->lieu_naiss}}</p>
                    </div>
                </div>
                <div class="row">
                  <div class="">
                      <h5 class="text-center">Parcours de {{ $data->nom }} {{ $data->prenom }} à l'UDC</h5>
                  </div>
                </div>
                <div class="row table-responsive">
                  <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="font-size:14px;" scope="col">Composante</th>
                          <th style="font-size:14px;" scope="col">Département</th>
                          <th style="font-size:14px;" scope="col">Niveau</th>
                          <th style="font-size:14px;" scope="col">Année Universitaire</th>
                        </tr>
                      </thead>
                      @foreach($datas as $data)
                      <tbody>
                        <tr>
                          <td style="font-size:14px;">{{ $data->design_facult }}</td>
                          <td style="font-size:14px;">{{ $data->design_depart  }}</td>
                          <td style="font-size:14px;">{{ $data->intit_niv  }}</td>
                          <td style="font-size:14px;">{{ $data->Annee }}</td>
                        </tr>
                      </tbody>
                      @endforeach
                    </table>
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
