<?= render('admin/organisation/tabs'); ?>
<div class="well">
    <legend>Список организаций</legend>
    <? if (isset($organisations)): ?>
        <table class="table">
            <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Status</th>
                  <th>Страна</th>
                  <th>Область</th>
                  <th>Город</th>
                  <th>Дейстия</th>
                </tr>
            </thead>
            <tbody>
                <? foreach($organisations as $organisation): ?>
                    <tr <?= ($organisation->status == 1) ? 'class="warning"' : ''; ?>>
                        <td><?= $organisation->id; ?></td>
                        <td><?= $organisation->title; ?></td>
                        <td><?= Model_Organisation::$organisation_status[$organisation->status]; ?></td>
                        <td><?= $organisation->country->title; ?></td>
                        <td><?= $organisation->region->title; ?></td>
                        <td><?= $organisation->city->title; ?></td>
                        <td><?= Fuel\Core\Html::anchor('admin/organisation/view/' . $organisation->id, 'Подробнее', array('class' => 'btn btn-default')); ?></td>
                    </tr>
                <? endforeach; ?>
            </tbody>
        </table>
    <? endif; ?>
</div>


