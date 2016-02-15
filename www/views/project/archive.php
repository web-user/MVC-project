<?php defined('MVCproject') or die('Access denied'); ?>
<article>
	<div class="post-image">
		<div class="post-heading link-kr">
			<a href="/">Главная</a> / <span>Архив новостей</span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		<?php if($_SESSION['auth']['user']): ?>
			<?php if($all_news): ?>
				<?php foreach($all_news as $item): ?>
					<h2 class="title-news-arc"><?php echo $item['name'] ?></h2>
					<span class="date-news"><?php echo $item['date'] ?></span>
					<p><?php echo $item['anons'] ?></p>
				<?php endforeach; ?>
				<?php if( $pages_count > 1 ): ?>
					<div class="col-md-12 col-xs-12 product-line">
						<div class="col-md-12 col-xs-12">
							<?php pagination($page, $pages_count); ?>
						</div>
					</div>
				<?php endif; ?>
			<?php else: ?>
				<h2>Новостей пока нет!</h2>
			<?php endif; ?>
		<?php else: ?>
			<h2>Вы не зарегетстрированы!</h2>
		<?php endif; ?>
		</div>
	</div>
</article>