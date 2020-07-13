<!-- jquery latest version -->
<script src="{{ asset('admin/js/vendor/jquery-2.2.4.min.js') }}"></script>
<!-- bootstrap 4 js -->
<script src="{{ asset('admin/js/dropzone.min.js') }}"></script>
<script src="{{ asset('admin/js/popper.min.js') }}"></script>
<script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('admin/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('admin/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin/js/jquery.slicknav.min.js') }}"></script>

<!-- start chart js -->
<script src="{{ asset('admin/js/Chart.min.js') }}"></script>
{{--  <!-- start highcharts js -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<!-- start amcharts -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/ammap.js"></script>
<script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>  --}}
{{-- <!-- all line chart activation -->
<script src="{{ asset('admin/js/line-chart.js') }}"></script>
<!-- all pie chart -->
<script src="{{ asset('admin/js/pie-chart.js') }}"></script>
<!-- all bar chart -->
<script src="{{ asset('admin/js/bar-chart.js') }}"></script>
<!-- all map chart -->
<script src="{{ asset('admin/js/maps.js') }}"></script>
 --}}<!-- others plugins -->
<script src="{{ asset('admin/js/plugins.js') }}"></script>
<script src="{{ asset('admin/js/scripts.js') }}"></script>
<script src="{{ asset('admin/js/codemirror.min.js') }}"></script>
<script src="{{ asset('admin/js/xml.min.js') }}"></script>
<script src="{{ asset('admin/js/froala_editor.pkgd.min.js') }}"></script>
<script> $(function() { $('textarea').froalaEditor({
	toolbarSticky: false,
	toolbarButtons: ['undo', 'redo' , '|', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'outdent', 'indent', 'clearFormatting', 'insertTable', 'html'],
      toolbarButtonsXS: ['undo', 'redo' , '-', 'bold', 'italic', 'underline']
}) }); </script>