<div class="well">
    <legend>Список пользователей</legend>
    <? if (isset($users)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                  <th>#</th>
                  <th>User Name</th>
                  <th>Email</th>
                  <th>Группа</th>
                  <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <? foreach($users as $user): ?>
                    <? if ($user->group->id != 2): ?>
                        <tr>
                            <td><?= $user->id; ?></td>
                            <td><?= $user->username; ?></td>
                            <td><?= $user->email; ?></td>
                            <td><?= $user->group->name; ?></td>
                            <td><div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                  Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Посмотреть</a></li>
                                    <li><a href="#">Статьи</a></li>
                                    <li><a href="#">Статьи на модерации</a></li>
                                    <li class="divider"></li>
                                    <? if($user->group->id > 2): ?>
                                    <li><?= Fuel\Core\Html::anchor('admin/user/bun/' . $user->id, 'Забанить'); ?></li>
                                    <? else: ?>
                                      <li><?= Fuel\Core\Html::anchor('admin/user/unbun/' . $user->id, 'Разбанить'); ?></li>
                                    <? endif; ?>
                                    <? if(($user->group->id > 2) and ($user->group->id < 4)): ?>
                                        <li><?= Fuel\Core\Html::anchor('admin/user/admin/' . $user->id, 'Сделать админиом'); ?></li>
                                    <? elseif ($user->group->id > 3): ?>
                                        <li><?= Fuel\Core\Html::anchor('admin/user/unadmin/' . $user->id, 'Не админ'); ?></li>
                                    <? endif; ?>
                                </ul>
                              </div>
                            </td>
                        </tr>
                    <? endif; ?>
                <? endforeach; ?>
            </tbody>
        </table>
    <? else: ?>
        <h3>Пользователей пока нет(</h3>
    <? endif; ?>
</div>
