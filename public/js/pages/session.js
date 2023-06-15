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
					console.log(data.mensaje);
					if(data.estado){
						window.location = base_url+ "home/dashboard";
					}else{
						Swal.fire({
							position: 'bottom-end',
							icon: 'error',
							title: data.mensaje,
							showConfirmButton: false,
							timer: 1000
						})
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
			}
		}else{
			Swal.fire({
				position: 'bottom-end',
				icon: 'error',
				title: 'Correo requerido',
				showConfirmButton: false,
				timer: 1000
			})
		}
	});
});