$(document).ready(function() {
	
	$(document).on('submit', '#frmLogin', function(event) {
		event.preventDefault();
		username = $("#txtUser").val();
		password = $("#txtPass").val();

		if (username != "") {
			if (password != "") {
				$.ajax({
					url: 'startLogin',
					type: 'POST',
					dataType: 'JSON',
					data: {user: username, pass: password},
				})
				.done(function(data) {
					if(data.estado){
						window.location = base_url+ "home/dashboard";
					}else{
						Swal.fire({
							position: 'bottom-end',
							icon: 'error',
							title: res.mensaje,
							showConfirmButton: false,
							timer: 1000
						})
						//console.log(data.mensaje);
					}
				})
				.fail(function() {
					console.log("error");
				});
				
			}else{
				Swal.fire({
					position: 'bottom-end',
					icon: 'error',
					title: 'Contraseña requerida',
					showConfirmButton: false,
					timer: 1000
				})
				//console.log("Password requerida");
			}
		}else{
			Swal.fire({
				position: 'bottom-end',
				icon: 'error',
				title: 'Correo requerido',
				showConfirmButton: false,
				timer: 1000
			})
			//console.log("Username requerido");
		}
	});
});