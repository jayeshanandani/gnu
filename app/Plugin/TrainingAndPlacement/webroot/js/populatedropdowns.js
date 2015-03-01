$(function() {
    function getData(selectedValue, targetUrl, destination) {
        $.ajax({
            type: 'get',
            url: targetUrl,
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function(response) {
                if (response.departments) {
					destination.empty(),
					destination.append('<option value="Please Select">Please Select</option>');
					appendData(response.departments, destination); // Another from duch with the appendData function added as well, but not working either.
                }
                if (response.degrees) {
					destination.empty(),
					destination.append('<option value="Please Select">Please Select</option>');
					appendData(response.degrees, destination);
				}
				if (response.academicyears) {
					destination.empty(),
					destination.append('<option value="Please Select">Please Select</option>');
					appendData(response.academicyears, destination);
				}
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
			$(destination).append('<option value="' + prop + '">' + data[prop] + '</option>');
			}
		}
	}

    $('#institutions').change(function() {
        var selectedValue	=	$(this).val(),
            destination 	=	$('#departments'),
            destcity		=	$('#degrees');

		if(selectedValue != '')
		{
            targetUrl = $(this).attr('rel') + '?id=' + selectedValue;
            getData(selectedValue, targetUrl, destination);
			destcity.empty(),
			destcity.append('<option value="0">Select Department First</option>');

		}	else {
        destination.empty(),
        destination.append('<option value="0">Select Institution First</option>');
		destcity.empty(),
		destcity.append('<option value="0">Select Department First</option>');
		}
    });

    $('#departments').change(function() {
		var selectedValue = $(this).val(),
			  destination = $('#degrees');
		if(selectedValue != 'Please Select')
		{
			targetUrl = $(this).attr('rel') + '?id=' + selectedValue;
			getData(selectedValue, targetUrl, destination);
		}	else {
		destination.empty(),
		destination.append('<option value="0">Select Department First</option>');
		}
    });
        $('#degrees').change(function() {
		var selectedValue = $('#institutions').val(),
			  destination = $('#academic_years');
		if(selectedValue != 'Please Select')
		{
			targetUrl = $(this).attr('rel') + '?id=' + selectedValue;
			getData(selectedValue, targetUrl, destination);
		}	else {
		destination.empty(),
		destination.append('<option value="0">Select Degree First</option>');
		}
    }); 

});
