@extends('russian.base')

@section('content')
<script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function material_db() {
            if (ValidateCar()){
            $("#submit").prop("disabled", true);
            $.ajax({
                type: "post",
                url: "{{ route('vaqt.storeru') }}",
                cache: false,
                data: $('#material').serialize(),
                success: function(response) {
                    try {
                        //alert(response);
                        $('#suss_message2').html("<center><h5 style='color:white'>" + response + " </h5></center>");
                        $('#suss_message2').fadeIn().delay(1200).fadeOut();
                        window.setTimeout(function() {
                            window.location.href = "{{ route('vaqtru') }}";
                        }, 4000);
                    } catch (e) {
                        alert('Exception while request1: ' + e);
                    }
                },
                error: function(xhr, status, error) {
    console.log('Error:', xhr.responseText); // Log the full response text
    console.log('Status:', status); // Log the status
    console.log('Error:', error); // Log any additional error message
    alert('Error while request2: ' + error); // Display an alert with the error message
}

            });
        }
        }

    function ValidateCar() 
    {
    var Vaqt = document.material.vaqt;

	if (V_vaqt(Vaqt))
    {							
					return true;
	  }
    return false;

			function V_vaqt(Vaqt){
            var add = Vaqt.value.length;
            if (add == 0)
            {
                $('#suss_message').html("<center><h5 style='color:#ffffff;'>Введите!</h5></center>");
                $('#suss_message').fadeIn().delay(1200).fadeOut();
                //alert('First name must have alphabet characters only');
                Vaqt.focus();
                return false;
            }
            else
            {
                return true;
            }
        }		
    }
//delete
function deleteSelectedItems() {
    var selectedIds = [];

    // Loop through all checkboxes and add the checked ones to selectedIds array
    $('.checkbox1:checked').each(function() {
        selectedIds.push($(this).val());
    });

    if (selectedIds.length === 0) {
        // Show message if no items are selected
        $('#suss_message').html("<center><h5 style='color:white'>Выберите!</h5></center>");
        $('#suss_message').fadeIn().delay(1200).fadeOut();
    } else {
        // Send AJAX request to delete selected items
        $.ajax({
            type: 'POST',
            url: "{{ route('delete.vaqtru') }}",
            data: {
                selectedIds: selectedIds,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                // Handle success response
                $('#suss_message').html("<center><h5 style='color:white'>" + response + " </h5></center>");
                $('#suss_message').fadeIn().delay(1200).fadeOut();
                setTimeout(function() {
                    window.location.href = "{{ route('vaqtru') }}";
                }, 4000);
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(error);
                alert('Error sending selected IDs to controller: ' + error);
            }
        });
    }
}

</script>
<div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Введите время приема</h3>
          </div>
          <div id="suss_message" class="ajax_warning" style="display: none"></div>
        <div id="suss_message2" class="ajax_Message" style="display: none"></div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
              <form class="form-horizontal" action="{{ route('vaqtru') }} " name="material" id="material" method="post">
              @csrf <!-- CSRF token -->

                <!-- /.form-group -->
                <div class="form-group">
    <label>Время начала работы</label>
    <select name="boshlash" class="form-control" style="width: 100%;">
        @php
            $time = strtotime('00:00');
        @endphp
        @while($time < strtotime('24:00'))
            <option>{{ date('H:i', $time) }}</option>
            @php
                $time = strtotime('+1 hour', $time);
            @endphp
        @endwhile
    </select>
</div>
<!-- /.form-group -->
<div class="form-group">
    <label>Время окончания работы</label>
    <select name="tugash" class="form-control" style="width: 100%;">
        @php
            $time = strtotime('00:00');
        @endphp
        @while($time < strtotime('24:00'))
            <option>{{ date('H:i', $time) }}</option>
            @php
                $time = strtotime('+1 hour', $time);
            @endphp
        @endwhile
    </select>
</div>
<!-- /.form-group -->
<div class="form-group">
    <label>Время приема, отведенное для одного человека (в минутах))</label>
    <input type="number" name="vaqt" id="vaqt" class="form-control" min="1">
</div>
</div>             

 <!-- /.col -->
            </div>
                  <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          <button type="button" id="submit" class="btn btn-primary" onclick="material_db()">Сохранить</button>
          </div>
  </form>
        </div>

        <div class="card">
    <div class="card-header">
        <h3 class="card-title">Время приема</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <form action="" name="shartnoma" id="shartnoma" method="post">
    @csrf <!-- CSRF token -->

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 5%"><input type="checkbox" id="selecctall" /></th>
                    <th>День</th>
                    <th>Время приема</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vaqt as $v)
                @php
                $kun = '';
                switch ($v->kun) {
                    case '1':
                        $kun = 'Понедельник';
                        break;
                    case '2':
                        $kun = 'Вторник';
                        break;
                    case '3':
                        $kun = 'Среда';
                        break;
                    case '4':
                        $kun = 'Четверг';
                        break;
                    case '5':
                        $kun = 'Пятница';
                        break;
                    case '6':
                        $kun = 'Суббота';
                        break;
                    case '7':
                        $kun = 'Воскресенье';
                        break;
                    default:
                        $kun = 'Неизвестно';
                        break;
                }
                @endphp
                <tr>
                    <td><input class="checkbox1" type="checkbox" name="selectedItems[]" value="{{ $v->id }}"></td>
                    <td>{{ $kun }}</td>
                    <td>{{ $v->vaqt }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>День</th>
                    <th>Время приема</th>
                </tr>
            </tfoot>
        </table>
            </form>
    </div>
    <!-- /.card-body -->
    <button style="float: right; margin-right: 1%; width: 200px" type="button" id="submit" class="btn btn-danger" onclick="deleteSelectedItems()">Удаление</button>

</div>



@endsection
