$(function () {
        //Datapicker js
        $('#timepickerfrom').datetimepicker({
            format: 'LT',
            stepping: 30,
                
        });
        $('#timepickerto').datetimepicker({
            format: 'LT',
            stepping: 30,
            useCurrent: false //Important! See issue #1075
                
        });
        $("#timepickerfrom").on("dp.change", function (e) {
            $('#timepickerto').data("DateTimePicker").minDate(e.date);
        });
        $("#timepickerto").on("dp.change", function (e) {
            $('#timepickerfrom').data("DateTimePicker").maxDate(e.date);
        });        
        $('.datepicker').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        //Spinner js
        $('.spinner .btn:first-of-type').on('click', function() {
            $('.spinner input').val( parseInt($('.spinner input').val(), 10) + 1);
        });
        $('.spinner .btn:last-of-type').on('click', function() {
            $('.spinner input').val( parseInt($('.spinner input').val(), 10) - 1);
        });
        
        //setting availability of end_repeat field
        if ($("#repeat").val() != 0) {
            $("#end_repeat").prop('readonly', false);
        }
        else {
            $("#end_repeat").prop('readonly', true);
        }
        
        $("#repeat").on("click change", function() {
            if ($("#repeat").val() != 0) {
                $("#end_repeat").addClass('rq');
                $("#end_repeat").prop('readonly', false);
            }
            else {
                $("#end_repeat").prop('readonly', true);
                $("#end_repeat").removeClass('rq');
                $("#end_repeat").val('');
                
            }
        });
        
        $('.check_rq_fields').on("click change", function() {
            var f = $(".rq");
            var cansubmit = true;
            for (var i = 0; i < f.length; i++) {
                if (f[i].value.length == 0) cansubmit = false;
            }
            $('#signup').prop('disabled', !cansubmit);
        });
        
        
    
});
    
    