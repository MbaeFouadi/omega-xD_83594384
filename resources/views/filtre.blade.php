<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Filtrage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body> 
    <div class="container"> <br> <br>
        <h1 class="text-center">Filtrage Ngazidja</h1> <br> <br>
        <form action="{{route('photo_ngazidja')}}" method="post">
            @csrf
            <!-- <div class="form-group">
                <select class="form-select" id="faculte" name="faculte" aria-label="Default select example" required>
                    <option selected value="">Composante</option>
                    @foreach ( $facultes as $faculte )
                    <option value="{{$faculte->code_facult}}">{{$faculte->design_facult}}</option>
                    @endforeach
                </select>
            </div> <br> 
            <div class="form-group">
                <select class="form-select" name="departement" id="departement" aria-label="Default select example required">
                    <option selected value="">Departement</option>
                 
                </select>
            </div> <br>  -->
            <div class="form-group">
                <input type="date" name="dates"  class="form-control" id="" required>
            </div> <br>
            <div class="form-group">
                <input type="submit" name="" value="valider" class="btn btn-primary" id="">
            </div>
        </form>
    </div>
<script src="//code.jquery.com/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script type=text/javascript>
    $('#faculte').change(function() {

      var faculte = $(this).val();
      if (faculte) {
     

        $.ajax({
          type: "POST",
          // url:"{{url('getCorps')}}?country_id="+countryID,
          url: "{{route('getDepartement')}}",
          data: {
            faculte: faculte,
            _token: '{{csrf_token()}}'
          },
          success: function(res) {
            if (res) {
                
              $("#departement").empty();
              $("#departement").append("<option value=''>Selectionner le departement</option>");
              $.each(res, function(key, value) {
                $("#departement").append('<option value="' + key + '">' + value + '</option>');
              });

            } else {
              $("#departement").empty();
            }
          }
        });
      } else {
        $("#corps").empty();
        $("#classes").empty();
      }
    });

    
   
  </script>
</body>

</html>