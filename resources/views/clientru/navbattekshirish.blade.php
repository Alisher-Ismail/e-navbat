@extends('clientru.base')

@section('content')
  <!-- /.navbar -->

  <!-- Main content wrapper -->
  <div class="wrapper">
    <!-- Content Wrapper -->
    <div class="card content-wrapper2" style="margin: 2%">
      <div class="card-header">
        <h3 class="card-title">Проверьте, если вы записаны на прием</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">

      <center>
        <form method="get" action="{{ route('navbat.tekshirishru') }}" id="add-form" enctype="multipart/form-data">
            @csrf
          <input name="tel" required placeholder="Введите ваш номер телефона" autofocus style="width: 400px; color: white; border-color: white" type="text" class="control-group navbar-dark"/>
          <button type="submit" class="btn btn-outline-secondary btn-lg" style="margin-left: 1%; color: white">Проверка</button>
        </form>
</center>
<hr/>
        <form action="" name="shartnoma" id="shartnoma" method="post">
          @csrf <!-- CSRF token -->
          <table id="example1" class="navbar-dark table table-bordered table-striped">
            <thead >
              <tr style="color: #343a40;">
              <th>ФИО заказчика</th>
              <th>Цель записи на прием</th>
              <th>ФИО специалиста</th>
              <th>Тип специальности</th>
              <th>Адрес</th>
              <th>Телефон</th>
              <th>Время приема</th>
              <th>Дата</th>
              <th>Отмена</th>
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
                    <a class="btn btn-outline-secondary" style="color: white" href="{{ route('navbat.bekorru', ['nid' => $n->id]) }}">Отмена</a>             
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