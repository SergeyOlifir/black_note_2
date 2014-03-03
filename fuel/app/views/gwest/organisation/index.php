<div class="well">
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
            <? $i = 0; ?>
            <? foreach($organisations as $organisation): ?>
                    <tr>
                        <td>
                            <?= ++$i; ?>
                        </td>
                        <td>
                            <?= Fuel\Core\Html::anchor('/gwest/organisation/view/' . $organisation->id, $organisation->title);  ?>
                        </td>
                        <td>
                            <?= Model_Country::find($organisation->country_id)->title;  ?> &nbsp <?= Model_Region::find($organisation->region_id)->title;  ?> обл. &nbsp; г. <?= Model_Sity::find($organisation->sity_id)->title; ?>
                        </td>
                        <td>
                            <?= $organisation->adress; ?>
                        </td>
                        <td>
                            тел. <?= $organisation->phone; ?>
                        </td>
                        <td>
                             <?= $organisation->ovner; ?>
                        </td>
                        <td>
                             <?= $organisation->raiting; ?>
                        </td>
                    </tr>
            <? endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

