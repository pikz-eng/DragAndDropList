


// sortable list JQuery
$(function () {
    $('li').on('contextmenu', function (event) {
        event.preventDefault();
        var id = $(this).attr('id');
        var name = $(this).text();
        var result = confirm("DID YOU FINISH THIS TASK: " + name + "?");
        if (result) {
            saveToDatabase(id, 0);
            $(this).remove();
            updatePositions();
        }
    });
    //$('#sortable').prepend($('.item-text'));
    $("#sortable").sortable({
        connectWith: ".connectedSortable",
        update: function () {
            var customerIds = $('#sortable').sortable('toArray').toString();
            var data = {customerIds: customerIds};
            // update position
            updatePositions();
            saveToDatabase();
        }
    });
});

function saveToDatabase(id, active) {
    if (typeof id === 'undefined') {
        id = $('#sortable li:first').attr('id');
    }
    if (typeof active === 'undefined') {
        active = 1;
    }
    var customerIds = $('#sortable').sortable('toArray').toString();
    $.ajax({
        type: "POST",
        url: 'ajax/save.php',
        dataType: "text",
        data: {id: id, active: active, customerIds: customerIds},

        success: function (response) {
            if (response == "Success") {
                console.log("Success: The record was updated successfully.");
            } else if (response == "Failed.") {
                console.log("Failed: The record update failed.");
            } else {
                console.log("Unknown response: " + response);
            }
        }
    });
}

function updatePositions() {
    $('#sortable .position').each(function (index) {
        $(this).text(index + 1 + ".");
    });

}
