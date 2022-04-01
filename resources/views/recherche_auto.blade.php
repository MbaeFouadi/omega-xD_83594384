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

    <title>Université des Comores</title>
  </head>
  <body>
    <section class="form-08">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="_form-08-main">
               @if($s->date_fin >= $date )
              <div class="_form-08-head">
                <h2>Recherche Autorisation</h2>
                @isset($message)
                    <div class="alert alert-danger col-md-12">{{ $message }}</div>
                @endisset
                <form method="POST" action="{{route('recherche_auto')}}">
                @csrf
              </div class="row">
              <div class="form-group col-md-4">
                <input type="text" name="nin" class="form-control" placeholder="Nin" required="" aria-required="true">
              </div>
              {{-- <div class="form-group col-md-4">
                <input type="text" name="matricule" class="form-control" placeholder="Matricule" required="" aria-required="true">
              </div> --}}
              <div class="form-group">
                <div class="row">
                    <div class="col-md-10 col-sm-6">
                    <a href="{{ route('accueil') }}" class="btn btn-sm btn-primary " >retour</a><br><br>
                  {{-- <button type="submit" class="btn btn-primary " >Validez</button><br><br> --}}
                  </div>
                  <div class="col-md-2 col-sm-6">
                  <button type="submit" class="btn btn-sm btn-primary " >Valider</button>

                      {{-- <a href="{{ route('accueil') }}" class="btn btn-primary " >retour</a> --}}
                  </div>
                </div>
              <!-- <button type="submit" class="btn btn-sm btn-primary" >Validez</button> -->
            </div>

        </form><br><br><br><br>
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
