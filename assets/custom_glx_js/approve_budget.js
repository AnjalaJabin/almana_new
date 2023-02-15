$(document).ready(function() {
   
   /* Add data */ /*Form Submit*/
	$("#approve_budget_form").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("add_type", 'update_approve_budget');
		fd.append("form", action);
		e.preventDefault();
		$('.icon-spinner3').show();
		$('.save').prop('disabled', true);
		
		$.ajax({
			url: site_url+'/budgeting/read_approve_budget/',//e.target.action,
			type: "POST",
			data:  fd,
			contentType: false,
			cache: false,
			processData:false,
			success: function(JSON)
			{
				if (JSON.error != '') {
					Swal.fire({
                        text: JSON.error,
                        icon: "error",
                    });
				} else {
					Swal.fire({
                        text: JSON.result,
                        icon: "success",
                    });
                    
                    window.location = JSON.redirect_url;
    				window.location.replace(JSON.redirect_url);
    				window.location.href = JSON.redirect_url;
				}
			},
			error: function() 
			{
				toastr.error(JSON.error);
				$('.icon-spinner3').hide();
				$('.save').prop('disabled', false);
			} 	        
	   });
	});
	
	
	
	$('#assign_budget_employee').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var budget_id = button.data('budget_id');
		var sub_cat_id = button.data('sub_cat_id');
		$('.icon-spinner3').show();
		
		var modal = $(this);
		$.ajax({
			url: site_url+'budgeting/budget_assign_read/',
			type: "GET",
			data: 'jd=1&budget_id='+budget_id+'&sub_cat_id='+sub_cat_id+'&type=budget_assign',
			success: function (response) {
				if(response) {
					$('.icon-spinner3').hide();
					$("#ajax_budget_employee").html(response);
				}
			}
	    });
    });
    
});