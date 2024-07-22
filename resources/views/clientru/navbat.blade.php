@extends('clientru.base')

@section('content')
  <!-- /.navbar -->
  <div class="wrapper">
    <!-- Content Wrapper -->
   
 
    <div class="row" style="margin-bottom:5%;margin-top:2%;margin-left:3%;margin-right:3%;">
          
    <div class="col-md-6">
    @if($errors->any())
                                            <div class="col-12">
                                                @foreach($errors->all() as $err)
                                                <div id="suss_message" class="ajax_warning">
                                                        {{$err}}
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                        @if(session()->has('error'))
                                        <div id="suss_message" class="ajax_warning">
                                                {{session('error')}}
                                            </div>
                                        @endif

                                        @if(session()->has('success'))
                                        <div id="suss_message" class="ajax_Message navbar-dark">
                                                {{session('success')}}
                                            </div>
                                        @endif
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Запись на прием (Специалист: {{ $user->name }}  )</h3>
              </div>
              <div class="card-body">
                <!-- Date dd/mm/yyyy -->
                <input type="hidden" name="mutaxassis" id="mutaxassis"  value="{{ $uid }}"/>

                <div class="form-group">
                  <label>ФИО:</label>
                    <div class="input-group" >
                        <input type="text" name="ism" id="ism" class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                  <label>Телефонный номер:</label>
                    <div class="input-group " >
                        <input type="text" name="telefon" id="telefon" class="form-control" />
                    </div>
                </div>
                
                <div class="form-group">
                  <label>Цель записи на прием:</label>
                    <div class="input-group">
                        <textarea class="form-control" name="maqsad" id="maqsad"></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                  <label>Дата:</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="date" id="sana" name="sana" class="form-control"/>
                    </div>
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (left) -->
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Подтверждение: Если вы выберете время приема, ваши данные будут отправлены в базу данных</h3>
              </div>
              <div class="card-body">
                <!-- Date -->
                <div id="vaqt-links"></div>
              </div>
            </div>
          </div>
        </div>
        <br/><br/>
       
  <!-- Scripts -->
  <script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
  <script src="{{asset('admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
  <script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
  <script src="{{asset('admin/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
  <script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <script src="{{asset('admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
  <script src="{{asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <script src="{{asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
  <script src="{{asset('admin/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
  <script src="{{asset('admin/plugins/dropzone/min/dropzone.min.js')}}"></script>
  <script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
  <script src="{{asset('admin/dist/js/demo.js')}}"></script>
  <script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{asset('admin/plugins/jszip/jszip.min.js')}}"></script>
  <script src="{{asset('admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
  <script src="{{asset('admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
  <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
  <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

  <!-- Page specific script -->
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  <script>
    $(function () {
      $('.select2').select2();
      $('.select2bs4').select2({ theme: 'bootstrap4' });
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' });
      $('[data-mask]').inputmask();
      $('#reservationdate').datetimepicker({ format: 'DD/MM/YYYY'});
      $('#reservation').daterangepicker();
      $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' } });
      $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      );
      $('#timepicker').datetimepicker({ format: 'LT' });
      $('.duallistbox').bootstrapDualListbox();
      $('.my-colorpicker1').colorpicker();
      $('.my-colorpicker2').colorpicker();
      $('.my-colorpicker2').on('colorpickerChange', function (event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      });
      $("input[data-bootstrap-switch]").each(function () {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });
    });
  </script>
<script>
$(document).ready(function() {
   // Function to format date as Y-m-d
   function formatDate(date) {
        var year = date.getFullYear();
        var month = ('0' + (date.getMonth() + 1)).slice(-2);  // Months are zero-indexed
        var day = ('0' + date.getDate()).slice(-2);
        return year + '-' + month + '-' + day;
    }
    // Barcode change event
    $('#sana').on('change', function() {
        var sana = $(this).val();
        var userId = $('#mutaxassis').val();  // Assuming #mutaxassis is the input for userId
        var ism = $('#ism').val();
        var tel = $('#telefon').val();
        var maqsad = $('#maqsad').val();
        var today = new Date();
        var formattedToday = formatDate(today);  // Format today's date as Y-m-d
        // Check if all fields are filled
        //alert(formattedToday);

        if (sana && userId && ism && tel && maqsad) {
          if(sana >= formattedToday){
           
            $.ajax({
                url: '{{ url("api/qabulvaqtlari") }}',
                type: 'GET',
                data: { sana1: sana, uid: userId },  // Sending sana1 and uid
                success: function(data) {
                    // Clear the previous links
                    $('#vaqt-links').empty();
                    
                    // Check if there are any vaxt values
                    if (data.vaqt && data.vaqt.length > 0) {
                        // Iterate through each vaxt value and create a link
                        data.vaqt.forEach(function(vaqt) {
                            var link = $('<a>', {
                                text: vaqt,
                                href: `/navbatstoreru/?userid=${userId}&sana=${sana}&vaqt=${vaqt}&ism=${ism}&tel=${tel}&maqsad=${maqsad}`,  // Construct the URL with parameters
                                class: 'btn btn-outline-secondary',
                                css: {
                                    'color': 'white', 
                                    'margin': '1%'
                                }
                            });
                            
                            // Check if the current vaxt is in navbat and disable the link if true
                            if (data.navbat.includes(vaqt)) {
                              link.addClass('disabled btn-outline-primary'); 
                              link.css({
                                    'color': 'black',  // Apply custom CSS properties
                                    'background-color': 'white'  
                                  });
                            }

                            $('#vaqt-links').append(link);  // Append the link
                            
                        });
                    } else {
                        $('#vaqt-links').append('<p>Информация не найдена</p>');
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                }
            });
          }else{
            alert("Дата должна быть сегодняшней или будущей");
            window.location.reload();
          }
        } else {
            alert('Введите ваши данные');
        }
    });
});


</script>

<div class="navbar-dark" style="margin-top: 7%; position: fixed; bottom: 0; width: 100%; text-align: center; color: white; padding: 10px;">Copyright <a href="http://urobot.uz/" target="_blank" >Urobot.uz </div></body>
@endsection