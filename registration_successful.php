<!DOCTYPE html>

<?php
	include("initial-header.php");
?>
		<div class='page-content container'>
			<div class='row'>
				<div class='col-md-4 col-md-offset-4'>
					<div class='login-wrapper'>
						<div class='box'>
							<div class='content-wrap'>
								<h6>Registration Successfull!</h6>
								<div class='social'>
									<p>You will be redirected to Login page in <span id='counter'>3</span> second(s).</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php include('initial-footer.php'); ?>
			</div>
		</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src='https://code.jquery.com/jquery.js'></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src='bootstrap/js/bootstrap.min.js'></script>
		<script src='js/custom.js'></script>
		<script type="text/javascript">
			window.onload = function WindowLoad(event) {
				setInterval(function(){ countdown(); },1000);
			}
			function countdown() {
				var i = document.getElementById('counter');
				if (parseInt(i.innerHTML)<2) {
					location.href = 'login.php';
				}
				i.innerHTML = parseInt(i.innerHTML)-1;
			}
		</script>
	</body>
</html>