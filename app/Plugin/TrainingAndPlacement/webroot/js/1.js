$(window).load(function(){
function fetchCheckbox(state,targetUrl,destination) {
  $.ajax({
            type: 'get',
            url: targetUrl,
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function(response) {
             appendData(response.departments, destination);
            },

            error: function(response) {
                alert("An error occurred: " + e.responseText.message);
                console.log(response);
            }
        });
}
 function appendData(data, destination) {
        for (var prop in data) {
            if (data.hasOwnProperty(prop)) {
            $(destination).append('<input type="checkbox" value="' + prop + '">' +data[prop]);
            $(destination).append('<br>');
            }
        }
    }
var output = $("#checkboxes");

$('#institutions').change(function(){
     var state =    $(this).val(),
           destination =    $('#checkboxes');

    if(state !== "") {
        targetUrl = $(this).attr('rel') + '?id=' + state;
        destination.empty();
        fetchCheckbox(state,targetUrl,destination);
    }
    else{
    destination.empty();
}
});
});

