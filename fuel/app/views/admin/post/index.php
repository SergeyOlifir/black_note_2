<?= render('admin/post/tabs'); ?>
<div class="well">
    <legend>Список постов</legend>
    <? if (isset($organisations)): ?>
        <table class="table">
            <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Status</th>
                  <th>User</th>
                  <th>Тип</th>
                  <th>Организация</th>
                  <th>Примечания</th>
                  <th>Дейстия</th>
                </tr>
            </thead>
            <tbody>
                <? foreach($organisations as $organisation): ?>
                    <tr <?= ($organisation->status == 2) ? 'class="warning"' : ''; ?>>
                        <td><?= $organisation->id; ?></td>
                        <td><?= $organisation->title; ?></td>
                        <td><?= Model_Post::$post_status[$organisation->status]; ?></td>
                        <td><?= $organisation->user->username; ?></td>
                        <td><?= Model_Post::$post_types[$organisation->type]; ?></td>
                        <td><?= Fuel\Core\Html::anchor('/admin/organisation/view/' . $organisation->organisation->id, $organisation->organisation->title); ?></td>
                        <td>HUI</td>
                        <td><?= Fuel\Core\Html::anchor('admin/post/view/' . $organisation->id, 'Подробнее', array('class' => 'btn btn-default')); ?></td>
                    </tr>
                <? endforeach; ?>
            </tbody>
        </table>
    <? endif; ?>
</div>


