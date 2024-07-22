@extends('clienteng.base')

@section('content')
  <!-- /.navbar -->

  <!-- Main content wrapper -->
  <div class="wrapper">
    <!-- Content Wrapper -->
    <div class="card content-wrapper2" style="margin: 2%">
      <div class="card-header">
        <h3 class="card-title">Check Your Appointment</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">

      <center>
        <form method="get" action="{{ route('navbat.tekshirisheng') }}" id="add-form" enctype="multipart/form-data">
            @csrf
          <input name="tel" required placeholder="Enter your phone Number" autofocus style="width: 400px; color: white; border-color: white" type="text" class="control-group navbar-dark"/>
          <button type="submit" class="btn btn-outline-secondary btn-lg" style="margin-left: 1%; color: white">Check</button>
        </form>
</center>
<hr/>
        <form action="" name="shartnoma" id="shartnoma" method="post">
          @csrf <!-- CSRF token -->
          <table id="example1" class="navbar-dark table table-bordered table-striped">
            <thead >
              <tr style="color: #343a40;">
                <th>Name of the appointer</th>
                <th>Purpose of the appointment</th>
                <th>Name of the Expert</th>
                <th>Expert Type</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Appointment Time</th>
                <th>Date</th>
                <th>Cancel</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($navbat as $n)
              <tr>
              <td>{{ $n->ism }}</td>
              <td>{{ $n->maqsad }}</td>
              @foreach ($user as $u)
                @if($u->id == $n->userid)
                <td>{{ $u->name }}</td>
                <td>{{ $u->mutaxassislik }}</td>
                <td>{{ $u->manzil }}</td>
                <td>{{ $u->tel }}</td>
                <td>{{ $n->vaqt }}</td>
                <td>{{ $n->sana }}</td>
                <td> 
                    <a class="btn btn-outline-secondary" style="color: white" href="{{ route('navbat.bekoreng', ['nid' => $n->id]) }}">Cancel</a>             
                  </td>
                  @endif
              @endforeach
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