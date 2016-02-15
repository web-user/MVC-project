	<footer>
	<div id="sub-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-6">
						<div class="copyright">
							<p>
								<span>&copy; Web developer 2015</span>
							</p>
						</div>
					</div>

					<div class="col-md-6">
					</div>
				</div>
			</div>
		</div>
	</div>
	</footer>
</div>

<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo TEMPLATE; ?>js/custom.js"></script>
<script src="<?php echo TEMPLATE; ?>js/jquery-1.7.2.min.js"></script>
<script src="<?php echo TEMPLATE; ?>/js/jquery.cookie.js"></script>
<script type="text/javascript"> var query = "<?=$_SERVER['SERVER_NAME']?>";</script>
<script src="<?php echo TEMPLATE; ?>js/bootstrap.min.js"></script>

<!--Javascripts-->
<script type="text/javascript" src="<?php echo TEMPLATE; ?>js/script.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script>
// just for the demos, avoids form submit
jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});

$( "#myform" ).validate({
  rules: {
    field: {
      required: true,
      email: true
    }
  }
});

</script>


</body>
</html>