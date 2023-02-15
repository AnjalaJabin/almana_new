"use strict";
var KTSigninGeneral = function() {
    var t, e, i;
    return {
        init: function() {
            t = document.querySelector("#kt_sign_in_form"), e = document.querySelector("#kt_sign_in_submit"), i = FormValidation.formValidation(t, {
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: "Email address is required"
                            },
                            emailAddress: {
                                message: "The value is not a valid email address"
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "The password is required"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row"
                    })
                }
            }), e.addEventListener("click", (function(n) {
                n.preventDefault(), i.validate().then((function(i) {
                    "Valid" == i ? (e.setAttribute("data-kt-indicator", "on"), e.disabled = !0, setTimeout((function() {
                        
                        var obj = $('#kt_sign_in_form'), action = obj.attr('name'), redirect_url = obj.data('redirect'), form_table = obj.data('form-table'),  is_redirect = obj.data('is-redirect');
                        $.ajax({
                        	type: "POST",
                        	url: base_url+'index/login/',
                        	data: obj.serialize()+"&is_ajax=1&form="+form_table,
                        	cache: false,
                        	success: function (JSON) {
                        		if (JSON.error != '') {
                        			//toastr.error(JSON.error);
                        			
                        			e.removeAttribute("data-kt-indicator"), e.disabled = !1, Swal.fire({
                                        text: JSON.error,
                                        icon: "error",
                                    });
                                    
                        			$('.save').prop('disabled', false);
                        			$('.icon-spinner3').hide();
                        		} else {
                        			toastr.success(JSON.result);
                        			
                        			e.removeAttribute("data-kt-indicator"), e.disabled = !1, Swal.fire({
                                        text: JSON.result,
                                        icon: "success",
                                    });
                        			
                        			$('.save').prop('disabled', false);
                        			$('.icon-spinner3').hide();
                        			if(is_redirect==1) {
                        				window.location = redirect_url;
                        			}
                        		}
                        	}
                        });
                        
                    }), 0)) : Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    })
                }))
            }))
        }
    }
}();
KTUtil.onDOMContentLoaded((function() {
    KTSigninGeneral.init()
}));