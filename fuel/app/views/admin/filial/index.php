<div class="well">
    <legend>Список филиалов</legend>
    <? if (isset($filials)): ?>
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
                <? foreach($filials as $filial): ?>
                    <tr <?= ($filial->status == 1) ? 'class="warning"' : ''; ?>>
                        <td><?= $filial->id; ?></td>
                        <td><?= $filial->title; ?></td>
                        <td><?= Model_Organisation::$organisation_status[$filial->status]; ?></td>
                        <td><?= $filial->country->title; ?></td>
                        <td><?= $filial->region->title; ?></td>
                        <td><?= $filial->city->title; ?></td>
                        <td><?= Fuel\Core\Html::anchor('admin/filial/view/' . $filial->id, 'Подробнее', array('class' => 'btn btn-default')); ?></td>
                    </tr>
                <? endforeach; ?>
            </tbody>
        </table>
    <? endif; ?>
</div>


