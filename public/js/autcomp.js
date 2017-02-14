$(document).ready(function() {
    $("#autocomplete").autocomplete({
        source: data,
        focus: function (event, ui) {
            // prevent autocomplete from updating the textbox
            event.preventDefault();
            // manually update the textbox
            $(this).val(ui.item.label);
        },
        select: function (event, ui) {
            // prevent autocomplete from updating the textbox
            event.preventDefault();
            // manually update the textbox and hidden field
            $(this).val(ui.item.label);
            $("#nombreInst").val(ui.item.value);
        }
    });
});