<div class="events-list clearfix">
    <div id="sort-events">
        <?=Form::open(array('action' => '', 'method' => 'post')); ?>       

                <? foreach ($filters as $filtersName => $filtersValues):?>
                    <? if(isset($post['filter'][$filtersName])? $selected = $post['filter'][$filtersName] : $selected = '');?>
                    <select class="form-control pull-left" name="filter[<?=$filtersName?>]">
                        <? foreach ($filtersValues as $filterName => $filterValue):  ?>
                            <option <? if($filterValue == $selected) echo 'selected'; ?> value="<?=$filterValue?>"><?=$filterName?></option>
                        <? endforeach; ?>
                    </select>
               <? endforeach;?>

                <? foreach ($sorts as $sortsName => $sortsValues):?>
                    <? if(isset($post['sort'][$sortsName])) $selected = $post['sort'][$sortsName]; ?>
                    <select class="form-control pull-left" name="sort[<?=$sortsName?>]">
                        <? foreach ($sortsValues as $sortName => $sortValue): ?>
                            <option <?  if($sortValue == $selected) echo 'selected'; ?> value="<?=$sortValue?>"><?=$sortName?></option>
                        <? endforeach; ?>
                    </select>
               <? endforeach;?>     

            <input type="search" class="form-control pull-left" name="search"  maxlength='50' placeholder="Search by keyword" value='<?= isset($post['search']) ? $post['search'] : '';?>'/>
            <button type="submit" class="btn btn-primary">Search</button>
        <?=Form::close(); ?>   
            
    </div>

    <div class="row">
            <div class="col-md-4 col-xs-12 col-sm-4">
                <a data-toggle="modal" href="#createevent" class="pull-left event-link">
                    <div class="create-ivent">
                        <h2><span class="glyphicon glyphicon-plus-sign"></span>Create New Event</h2>
                    </div>
                </a>
            </div>
        <?
            if(!empty($events)):
                foreach ($events as $event):
                    $randomClass = rand(1, 2);
                        $randomClass == 1?  $class = 'horizontal' : $class = 'vertical';
                            echo render('host/layout/events/partials/event', array('events' => $event, 'class' => $class));
                endforeach;
            endif;
        ?>
            </div>
        </div>
</div>

<?= render('host/layout/events/create'); ?>