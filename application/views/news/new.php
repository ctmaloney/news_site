<div class="errors">
<?php echo validation_errors(); ?>
</div>

<?php echo form_open('news/new') ?>

	<p><label for="title">* Title</label> 
	<input type="input" name="title" value="<?php echo set_value('title') ?>" /></p>

	<p><label for="article">* Content</label>
	<textarea name="article"><?php echo set_value('article') ?></textarea></p>
	
	<input class="submit" type="submit" name="submit" value="Submit" /> 

</form>