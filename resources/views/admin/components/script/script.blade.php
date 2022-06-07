<script src="{{ asset('adminAssets/js/lib/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('adminAssets/js/lib/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('adminAssets/js/lib/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('adminAssets/js/jquery.slimscroll.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('adminAssets/js/sidebarmenu.js') }}"></script>
<!--stickey kit -->
<script src="{{ asset('adminAssets/js/lib/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>

<script src="{{ asset('adminAssets/js/lib/toastr/toastr.min.js') }}"></script>
<!-- scripit init-->
<script src="{{ asset('adminAssets/js/lib/toastr/toastr.init.js') }}"></script>

<script src="{{ asset('adminAssets/js/lib/sweetalert/sweetalert.min.js') }}"></script>

 <!-- Amchart -->
    <script src="{{ asset('adminAssets/js/lib/morris-chart/raphael-min.js')}}"></script>
    <script src="{{ asset('adminAssets/js/lib/morris-chart/morris.js')}}"></script>
    <script src="{{ asset('adminAssets/js/lib/morris-chart/dashboard1-init.js')}}"></script>


    <script src="{{ asset('adminAssets/js/lib/calendar-2/moment.latest.min.js')}}"></script>
    <!-- scripit init-->
    <script src="{{ asset('adminAssets/js/lib/calendar-2/semantic.ui.min.js')}}"></script>
    <!-- scripit init-->
    <script src="{{ asset('adminAssets/js/lib/calendar-2/prism.min.js')}}"></script>
    <!-- scripit init-->
    <script src="{{ asset('adminAssets/js/lib/calendar-2/pignose.calendar.min.js')}}"></script>
    <!-- scripit init-->
    <script src="{{ asset('adminAssets/js/lib/calendar-2/pignose.init.js')}}"></script>

    <script src="{{ asset('adminAssets/js/lib/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('adminAssets/js/lib/owl-carousel/owl.carousel-init.js')}}"></script> 

<script type="text/javascript" src="{{ asset('adminAssets/js/grocers.min.js') }}"></script>
<script src="{{ asset('adminAssets/js/lib/select2/select2.full.min.js')}}"></script>
<script>
       $('.multiSelection').select2();

       $('.multiSelection').on('select2:opening select2:closing', function( event ) {
              var $searchfield = $(this).parent().find('.select2-search__field');
              $searchfield.prop('disabled', true);
       });
</script>
<!--Custom JavaScript -->
<script src="{{ asset('adminAssets/js/scripts.js') }}"></script>
 {!! Html::script('adminAssets/js/lib/datatables.net/js/jquery.dataTables.min.js') !!}

  {!! Html::script('adminAssets/js/lib/datatables.net-bs4/js/dataTables.bootstrap4.min.js') !!}
    
  <!-- Buttons examples -->
  {!! Html::script('adminAssets/js/lib/datatables.net-buttons/js/dataTables.buttons.min.js') !!}

  {!! Html::script('adminAssets/js/lib/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') !!}

  {!! Html::script('adminAssets/js/lib/jszip/jszip.min.js') !!}

  {!! Html::script('adminAssets/js/lib/pdfmake/build/pdfmake.min.js') !!}

  {!! Html::script('adminAssets/js/lib/pdfmake/build/vfs_fonts.js') !!}

  {!! Html::script('adminAssets/js/lib/datatables.net-buttons/js/buttons.html5.min.js') !!}

  {!! Html::script('adminAssets/js/lib/datatables.net-buttons/js/buttons.print.min.js') !!}

  {!! Html::script('adminAssets/js/lib/datatables.net-buttons/js/buttons.colVis.min.js') !!}
  
  <!-- Responsive examples -->
  {!! Html::script('adminAssets/js/lib/datatables.net-responsive/js/dataTables.responsive.min.js') !!}
  
  {!! Html::script('adminAssets/js/lib/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') !!}

  {!! Html::script('adminAssets/js/lib/datatables/jquery-datatables-checkboxes/js/dataTables.checkboxes.js') !!}

  {!! Html::script('adminAssets/js/lib/datatables/jquery-datatables-checkboxes/js/dataTables.checkboxes.min.js') !!}

  <script type="text/javascript" src="{{ asset('adminAssets/js/lib/tag-manager/tagmanager.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('adminAssets/js/lib/tag-manager/tagmanager.edit.js') }}"></script>
  <script type="text/javascript">
    $("#meta_tags").tagsManager();
  </script>
  
  <script>
       $(function(){
              
              $('.banglaType').avro( {'bangla':true}, function(isBangla){
                            //console.log('Bangla enabled = ' + isBangla);
                     }
              );
       })

  </script>
  <script src="{{ asset('adminAssets/js/lib/avro/avro-v1.1.4.min.js') }}"></script>
  
  <script src="{{ asset('adminAssets/js/lib/tinymce/tinymce.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('adminAssets/js/lib/tinymce/tinymce.init.js') }}"></script>
  <script src="{{ asset('adminAssets/js/lib/datatables/datatables-init.js') }}"></script>
  

