<?php defined('STROI') or die('Access denied'); ?>
	<div class="col-md-3">
		<aside class="left-sidebar">
		<div class="widget">
			<h2 class="widgetheading">Каталог</h2>
			<ul class="tags">
				<li><i class="icon-angle-right"></i><a href="?view=new">Новинки</a></li>
				<li><i class="icon-angle-right"></i><a href="?view=hits">Лидеры продаж</a></li>
				<li><i class="icon-angle-right"></i><a href="?view=sale">Распродажа</a></li>
			</ul>
		</div>
		<!-- меню категорий -->
		<div class="widget">
			<h4 class="widgetheading">Строй материалы</h4>
			<ul class="recent" id="accordion">
				<?php foreach($cat as $key => $item) : ?>
					<!-- if the parent category -->
					<?php if( count($item) > 1 ) :  ?>
						<h3>
							<li>
								<a href="#"><?php echo $item[0]; ?></a>
							</li>
						</h3>
						<ul>
							<li>- <a href="?view=cat&category=<?php echo $key; ?>">Все товары</a></li>
							<?php foreach( $item['sub'] as $key => $sub ) : ?>
								<li>
									<a href="?view=cat&category=<?php echo $key; ?>">- <?php echo $sub; ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php elseif($item[0]) : //если самостоятельная категория?>
						<li>
							<a href="?view=cat&category=<?php echo $key; ?>"><?php echo $item[0]; ?></a>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>
		<!-- новости -->
		<?php if($news): ?>
			<div class="widget news">
				<h4 >Новости</h4>
				<?php foreach($news as $item): ?>
					<p>
						<span><?php echo $item['date']; ?></span>
						<a href="?view=news&amp;news_id=<?php echo $item['news_id']; ?>"><?php echo $item['title']; ?></a>
					</p> 
				<?php endforeach; ?>
				<a href="?view=archive" class="news-arh">Архив новостей</a>
			</div><!--widget news-->
<!-- 		<?php else: ?>
			<div class="widget news">
				<h4 >Новостей нет</h4>
			</div> -->
		<?php endif; ?>
		<!-- информеры -->
		<?php foreach( $informers as $informer ): ?>
			<div class="widget news">
				<h4 ><?php echo $informer[0]; ?>:</h4>
				<?php foreach( $informer['sub'] as $key => $sub ): ?>
					<p>
						<a href="?view=informer&amp;informer_id=<?php echo $key; ?>">- <?php echo $sub; ?></a>
					</p>
				<?php endforeach; ?>
			</div><!-- .news -->
		<?php endforeach; ?>
		</aside>
	</div>