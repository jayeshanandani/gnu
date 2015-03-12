$(function() {
    function getData(selectedValue, targetUrl, destination) {
        var request = $.ajax({
            type: 'get',
            url: targetUrl,
            dataType: 'json'
          });
        
        request.done(function( response ) {
            if (response.departments) {
              destination.empty(),
              destination.append('<option value="Please Select">Please Select</option>');
              appendData(response.departments, destination);
            }
            
            if (response.staffs) {
              destination.empty(),
              destination.append('<option value="Please Select">Please Select</option>');
              appendData(response.staffs, destination);
            }
        });
 
        request.fail(function( jqXHR, textStatus ) {
           alert( "Request failed: " + textStatus );
        });
    
    }

	function appendData(data, destination) {
		for (var prop in data) {
			if (data.hasOwnProperty(prop)) {
			$(destination).append('<option value="' + prop + '">' + data[prop] + '</option>');
			}
		}
	}

    $('#institutions').on('change',function() {
        var selectedValue	=	$(this).val(),
            destination 	=	$('#departments'),
            destination_staff	=	$('#staffs');

		if(selectedValue != '') {
      targetUrl = $(this).attr('rel') + '?id=' + selectedValue;
      getData(selectedValue, targetUrl, destination);
			destination_staff.empty(),
			destination_staff.append('<option value="Select Department First">Select Department First</option>');
		}	else {
      destination.empty(),
      destination.append('<option value="Select Institution First">Select Institution First</option>');
		  destination_staff.empty(),
		  destination_staff.append('<option value="Select Department First">Select Department First</option>');
		}
    });

    $('#departments').on('change',function() {
  		var selectedValue = $(this).val(),
  			  destination = $('#staffs');
  		if(selectedValue != 'Please Select') {
  			targetUrl = $(this).attr('rel') + '?id=' + selectedValue;
  			getData(selectedValue, targetUrl, destination);
  		}	else {
  		  destination.empty(),
  		  destination.append('<option value="Select Department First">Select Department First</option>');
  		}
    });
});
