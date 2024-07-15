@extends('admin.base')

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
                url: "{{ route('vaqt.store') }}",
                cache: false,
                data: $('#material').serialize(),
                success: function(response) {
                    try {
                        //alert(response);
                        $('#suss_message2').html("<center><h5 style='color:white'>" + response + " </h5></center>");
                        $('#suss_message2').fadeIn().delay(1200).fadeOut();
                        window.setTimeout(function() {
                            window.location.href = "{{ route('vaqt') }}";
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
                $('#suss_message').html("<center><h5 style='color:#ffffff;'>Kiriting!</h5></center>");
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
        $('#suss_message').html("<center><h5 style='color:white'>Tanlang!</h5></center>");
        $('#suss_message').fadeIn().delay(1200).fadeOut();
    } else {
        // Send AJAX request to delete selected items
        $.ajax({
            type: 'POST',
            url: "{{ route('delete.vaqt') }}",
            data: {
                selectedIds: selectedIds,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                // Handle success response
                $('#suss_message').html("<center><h5 style='color:white'>" + response + " </h5></center>");
                $('#suss_message').fadeIn().delay(1200).fadeOut();
                setTimeout(function() {
                    window.location.href = "{{ route('vaqt') }}";
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
            <h3 class="card-title">Qabul Vaqtlarini Kiriting</h3>
          </div>
          <div id="suss_message" class="ajax_warning" style="display: none"></div>
        <div id="suss_message2" class="ajax_Message" style="display: none"></div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
              <form class="form-horizontal" action="{{ route('vaqt') }} " name="material" id="material" method="post">
              @csrf <!-- CSRF token -->

                <!-- /.form-group -->
                <div class="form-group">
    <label>Ish Boshlash Vaqti</label>
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
    <label>Ish Tugatish Vaqti</label>
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
    <label>Bir Insonga Ajratilgan Qabul Vaqti (daqiqalarda)</label>
    <input type="number" name="vaqt" id="vaqt" class="form-control" min="1">
</div>
</div>             

 <!-- /.col -->
            </div>
                  <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          <button type="button" id="submit" class="btn btn-primary" onclick="material_db()">Saqlash</button>
          </div>
  </form>
        </div>

        <div class="card">
    <div class="card-header">
        <h3 class="card-title">Qabul Vaqtlari</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <form action="" name="shartnoma" id="shartnoma" method="post">
    @csrf <!-- CSRF token -->

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 5%"><input type="checkbox" id="selecctall" /></th>
                    <th>Kun</th>
                    <th>Qabul Vaqtlari</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vaqt as $v)
                @php
                $kun = '';
                switch ($v->kun) {
                    case '1':
                        $kun = 'Dushanba';
                        break;
                    case '2':
                        $kun = 'Seshanba';
                        break;
                    case '3':
                        $kun = 'Chorshanba';
                        break;
                    case '4':
                        $kun = 'Payshanba';
                        break;
                    case '5':
                        $kun = 'Juma';
                        break;
                    case '6':
                        $kun = 'Shanba';
                        break;
                    case '7':
                        $kun = 'Yakshanba';
                        break;
                    default:
                        $kun = 'Noma\'lum';
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
                    <th>Kun</th>
                    <th>Qabul Vaqtlari</th>
                </tr>
            </tfoot>
        </table>
            </form>
    </div>
    <!-- /.card-body -->
    <button style="float: right; margin-right: 1%; width: 200px" type="button" id="submit" class="btn btn-danger" onclick="deleteSelectedItems()">O`chirish</button>

</div>



@endsection
