@extends('client.base')

@section('content')
  <!-- /.navbar -->
  <!-- Main content wrapper -->
  <div class="wrapper">
    <!-- Content Wrapper -->
    <div class="card content-wrapper2" style="margin: 2%">
      <div class="card-header">
        <h3 class="card-title">Mutaxassisni tanlab qabuliga yozilish</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form action="" name="shartnoma" id="shartnoma" method="post">
          @csrf <!-- CSRF token -->
          <table id="example1" class="navbar-dark table table-bordered table-striped">
            <thead >
              <tr style="color: #343a40;">
                <th>Ism-Sharifi</th>
                <th>Mutaxassislik Turi</th>
                <th>Manzil</th>
                <th>Telefon</th>
                <th>Qabulga Yozilish</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($qidiruv as $q)
              <tr>
                <td>{{ $q->name }}</td>
                <td>{{ $q->mutaxassislik }}</td>
                <td>{{ $q->manzil }}</td>
                <td>{{ $q->tel }}</td>

                <td> 
                    <a class="btn btn-outline-secondary" style="color: white" href="{{ route('navbat', ['uid' => $q->id]) }}">Qabulga Yozilish</a>             
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- Footer -->
    
  </div>

  <!-- Scripts -->
  
<div class="navbar-dark" style="position: fixed; bottom: 0; width: 100%; text-align: center; color: white; padding: 10px;">Copyright <a href="http://urobot.uz/" target="_blank" >Urobot.uz </div></body>
@endsection
