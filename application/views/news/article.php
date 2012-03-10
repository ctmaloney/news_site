<div class="single">
<h2><?php echo $article['title'] ?></h2>
<h3><?php echo date('M j, Y - h:i a',$article['entry_time']); ?></h3>
<a class="edit" href="/news/edit/<?php echo $article['url_title'] ?>">Edit this article</a>
<p><?php echo $article['article'] ?></p>
</div>
<?php
if(isset($prev['url_title'])) echo '<a class="button prev" href="/news/article/'.$prev['url_title'].'">Previous Article</a>';
if(isset($next['url_title'])) echo '<a class="button next" href="/news/article/'.$next['url_title'].'">Next Article</a>';
?>