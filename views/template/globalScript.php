<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= URL ?>public/js/scripts.js"></script>
<script src="<?= URL ?>public/js/jquery-3.6.3.min.js"></script>
<script src="<?= URL ?>public/js/sweetalert2.all.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		base_url = "<?php echo URL; ?>";
		$(document).on('click', '#CloseSession', function() {
			$.ajax({
					url: base_url + 'login/cerrarSession',
					type: 'POST',
					dataType: 'JSON',
					data: {
						estado: true
					},
				})
				.done(function(data) {
					if (data.status) {
						window.location = "login/index";
					}
				})
				.fail(function() {
					console.log("error");
				});

		});
	});
</script>