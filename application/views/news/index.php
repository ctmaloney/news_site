<ul>
<?php foreach ($articles as $article): ?>
  <li>
	<h2><?php echo $article['title'] ?></h2>
	<h3><?php echo date('M j, Y - h:i a',$article['entry_time']); ?></h3>
	<p><?php echo substr($article['article'],0,100) ?>...</p>
	<a class="button" href="/news/article/<?php echo $article['url_title'] ?>">Read More</a>
	</li>
<?php endforeach ?>
</ul>