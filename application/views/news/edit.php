<div class="errors">
<?php echo validation_errors(); ?>
</div>

<?php echo form_open('news/edit/'.$article['url_title']) ?>
  <input type="hidden" name="id" value="<?php echo set_value('id',$article['id']) ?>" />

	<p><label for="title">* Title</label>
	<input type="input" name="title" value="<?php echo set_value('title',$article['title']) ?>" /></p>
	
	<p><label for="url_title">* URL Title</label> 
	<input type="input" name="url_title" value="<?php echo set_value('url_title',$article['url_title']) ?>" /></p>

	<p><label for="article">* Content</label>
	<textarea name="article"><?php echo set_value('article',$article['article']) ?></textarea></p>
	
	<input class="submit" type="submit" name="submit" value="Submit" /> | <a class="delete" href="/news/delete/<?php echo $article['id'] ?>">Delete this article</a>
  
</form>