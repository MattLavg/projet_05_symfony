$(document).ready(function () {

    $('.dateMember').datepicker($.extend({ 
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: "1950:2020", 
        altFormat: 'yy-mm-dd',
        altField: $(this).next()
    },
    $.datepicker.regional[ "fr" ]));

    $('.dateMember').datepicker('option', 'altField', $('.dateMember').next());
});