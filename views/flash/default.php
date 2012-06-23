<ul id="messages">
	<?php foreach ($flash as $message): ?>
		<li class="<?php echo $message->type; ?>">
			<?php echo $message->text; ?>
		</li>
	<?php endforeach; ?>
</ul>
