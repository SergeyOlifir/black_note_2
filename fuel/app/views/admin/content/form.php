<?= Asset::js('ckeditor/ckeditor.js'); ?>
<script type="text/javascript">
	window.onload = function()
	{
		CKEDITOR.replace( 'preview', {
			filebrowserBrowseUrl : '/ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl : '/ckfinder/ckfinder.html?Type=Images',
			filebrowserFlashBrowseUrl : '/ckfinder/ckfinder.html?Type=Flash',
			filebrowserUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
			height: 300, 
		} );
		
		CKEDITOR.replace( 'body', {
			filebrowserBrowseUrl : '/ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl : '/ckfinder/ckfinder.html?Type=Images',
			filebrowserFlashBrowseUrl : '/ckfinder/ckfinder.html?Type=Flash',
			filebrowserUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
			height: 600, 
		} );
		
	};
</script>

<div class="well">
    <?= \Fuel\Core\Form::open(); ?>
        <fieldset>
            <legend> Статья </legend>
            
            <div class="form-group">
                <label>Тип</label>
                <?= Fuel\Core\Form::select('type', isset($content['type']) ? $content['type'] : 0, array('0' => 'Статья', '1' => 'Законодательство') , array('class' => 'form-control')); ?>
                <?= isset($errors['type']) ? "<span class=\"help-block\">{$errors['type']}</span>" : ''; ?>
            </div>
            
            <div class="form-group">
                <label>Заголовок</label>
                <?= Fuel\Core\Form::input('title', isset($content['title']) ? $content['title'] : '', array('class' => 'form-control')); ?>
                <?= isset($errors['title']) ? "<span class=\"help-block\">{$errors['title']}</span>" : ''; ?>
            </div>
            
            <div class="form-group">
                <label>Краткое содержание</label>
                <?= Fuel\Core\Form::textarea('preview', isset($content['preview']) ? $content['preview'] : '', array('class' => 'form-control', 'id' => 'preview')); ?>
                <?= isset($errors['preview']) ? "<span class=\"help-block\">{$errors['preview']}</span>" : ''; ?>
            </div>
            
            <div class="form-group">
                <label>Текст</label>
                <?= Fuel\Core\Form::textarea('body', isset($content['body']) ? $content['body'] : '', array('class' => 'form-control', 'id' => 'body')); ?>
                <?= isset($errors['body']) ? "<span class=\"help-block\">{$errors['body']}</span>" : ''; ?>
            </div>
            
            <div class="form-group">
                <button class="btn btn-default btn-lg" type="submit">Сохранить</button>
            </div>
        </fieldset>
    <?= \Fuel\Core\Form::close(); ?>
</div>