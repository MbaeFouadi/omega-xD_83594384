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


  <title>Université des Comores</title>
</head>

<body>
  <section class="form-08">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="_form-08-main">
            <div class="_form-08-head">
              <h2>Photo pour la carte universitaire</h2>
              @isset($message)
              <div class="alert alert-danger col-md-12">{{ $message }}</div>
              @endisset
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
              <form method="POST" action="{{route('add_photo')}}" enctype="multipart/form-data">
                @csrf
            </div class="row">
            <div class="form-group col-md-6">
              <input type="text" name="matricule" class="form-control" placeholder="Matricule" required="" aria-required="true">
            </div>
            <div class="form-group col-md-6">
              <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"  placeholder="photo" required="" aria-required="true">
            </div>

            <!-- <div class="form-group">
              <button type="submit" class="btn btn-sm btn-primary" >Validez</button>
            </div> -->
            <div class="form-group">
              <div class="row">
                <div class="col-md-10 col-sm-6">
                  <a href="{{ route('accueil') }}" class="btn btn-sm btn-primary ">retour</a><br><br>
                  {{-- <button type="submit" class="btn btn-primary " >Validez</button><br><br> --}}
                </div>
                <div class="col-md-2 col-sm-6">
                  <button type="submit" class="btn btn-sm btn-primary ">Valider</button>

                  {{-- <a href="{{ route('accueil') }}" class="btn btn-primary " >retour</a> --}}
                </div>
              </div>
              <!-- <button type="submit" class="btn btn-sm btn-primary" >Validez</button> -->
            </div>

            </form><br> <br> <br> <br>
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
    </div>
  </section>
</body>

</html>