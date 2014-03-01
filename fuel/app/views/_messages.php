<div class="alert alert-dismissable alert-<?= Session::get('notice_type'); ?>" data-alert="alert">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<p><?= implode('</p><p>', (array) $messages); ?></p>
</div>

