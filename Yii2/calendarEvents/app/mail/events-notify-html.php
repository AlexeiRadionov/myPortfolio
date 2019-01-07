<h4>Your events to day:</h4>

<?php foreach ($items as $item): ?>

	<?php if (is_array($item)): ?>

		<?php foreach ($item as $value): ?>
			<p><?php echo $value; ?></p>
		<?php endforeach; ?>

	<?php else: ?>
		
		<p><?php echo $item; ?></p>

	<?php endif; ?>

<?php endforeach; ?>