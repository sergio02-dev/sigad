// JavaScript Document
/*******************************
*	Valida envio el  login     *
*	Creacion 03 de abril 2013  *
*	ANDRES MORENO COLLAZOS     *
********************************/

function validar_asopano(){
	


	$("#loginform").validate({
		rules: {
			textUsuario:{
				required: true,
				minlength: 6
			},
			textPassword:{
				required: true,
				minlength:5,
			}
		},

		messages:{
			textUsuario:{
				required: "Digite el usuario",
				minlength:"debe ser mayor a 6 caracteres",
			},
			textPassword:{
				required: "Digite la contraseña",
				minlength:"debe ser mayor a 6 caracteres",
			}

		},
		errorPlacement : function(error, element) {
				$(element).closest('.form-group').find('.help-block').html(error.html());
		},
		highlight : function(element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function(element, errorClass, validClass) {
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
				$(element).closest('.form-group').find('.help-block').html('');
		},
		submitHandler: function(form){
			
			var user = $('#inputUsuario').val();
			var passwd = $('#inputPassword').val();

			var oculto_srnm=hex_md5(user);
			var oculto_psswd=hex_sha1(passwd);

			

			$.ajax({
				type: "POST",
				url:'acceso',
				data:'user='+oculto_srnm+'&pswd='+oculto_psswd,
				success: function(response)
				{
					response = response.trim();
					
					if(response == 'acceso_ok'){
						window.location.replace('home');
					}
					else{
						
						$(".error_login").html("<strong>Usuario y/ó Contraseña incorrectas</strong>");
					}
				}
			});		
		
			
		}
	});
}