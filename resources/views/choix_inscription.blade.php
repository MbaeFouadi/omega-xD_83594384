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
             @if($s->date_fin >= $date )
              <div class="_form-08-head">
                <h2>Choix d'inscription</h2>
              </div>
              <form class="text-center"  method="POST" action="{{ route('inscription') }}">
                @csrf
              
                <div class="form-check form-check-inline" >
                    <input class="form-check-input" type="radio" name="inscription" value="re-inscription" id="inlineRadio1" >
                    <label class="form-check-label" for="inlineRadio1">Re-inscription</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inscription" id="inlineRadio2"  value="nv_inscription">
                    <label class="form-check-label" for="inlineRadio2">Inscription à l'UDC pour la 1ère fois</label>
                  </div><br><br>
                                   
                 
                      
                    <button type="submit" class="btn btn-primary text-right"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                    </svg></button> <br> <br>
                   
           

                    <div class="sub-01">
                <img src="assets/images/shap-02.png">
              </div>
            </div>
              </form>
              
              @else 
              <div class="text-center bold">
                <p> Désolé les inscriptions sont déjà fermées </p>
              </div>
            <!--   <div class="sub-01">
                <img src="assets/images/shap-02.png">
              </div> -->
              @endif
              
            <!-- <div class="sub-01">
                <img src="assets/images/shap-02.png">
              </div> 
          </div>

        </div>
      </div>
    </section>
  </body>
</html>
