<?php
require_once 'inc/header.php';
?>

	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<article>
					<?php include $view.'.php'; ?>
				</article>
			</div>
			<div class="col-md-4">
				<article>
					<?php include 'inc/sidebar.php'; ?>
				</article>
			</div>
		</div>
	</div>
	</section>

<?php
require_once 'inc/footer.php';
?>