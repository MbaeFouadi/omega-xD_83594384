<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Photo Anjouan</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/datatables.min.css" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/datatables.min.js"></script>
</head>

<body>
  <div class="container">
    <br />
    <br />
    <table class="table" id="table_id">
      <thead>
        <tr> 

          <th scope="col">Matricule</th>
          <th scope="col">Nom</th>
          <th scope="col">Prenom</th>
          <th scope="col">Faculté</th>
          <th scope="col">Departement</th>
          <th scope="col">Photo</th>
          <th scope="col">Date</th>
          <th scope="col">Statut</th>


        </tr>
      </thead>
      <tbody>
        @foreach($datas as $data)
        <tr>
          <th scope="row">{{$data->matricule}}</th>
          <td>{{$data->nom}}</td>
          <td>{{$data->prenom}}</td>
          <td>{{$data->faculte}}</td>
          <td>{{$data->departement}}</td>
          <td> <a href="photo_carte/{{$data->Photo}}">{{$data->Photo}}</a> </td>
          <td>{{$data->date}}</td>
          <td> <a href="{{route('photo_an',$data->matricule)}}">Déjà telechargé?</a> </td>

        </tr>
        @endforeach 
       
       


      </tbody>
    </table>
    <a href="{{route('filtre_anjouan')}}" class="btn btn-primary">Retour</a>
  </div>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $('#table_id').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
    });
  </script>
</body>

</html>