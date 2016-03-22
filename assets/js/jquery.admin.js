$(document).ready(function(){
	$('select:not(.not-chosen, .ui-datepicker select)').chosen({ width: '100%' });
	$('.datetimepicker').datetimepicker({defaultDate:"moment", format:"YYYY-MM-DD HH:mm"});
});