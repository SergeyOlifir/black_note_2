<div class="footer">
        <div class="container">
                <div class="" id="count-merchant">
                   
                           <? $counters = str_split($countID);
                            if(str_replace(',', '',$countID) < 1000): ?>
                                        <span class="counter Nexa-Bold" id="counter--1">0</span>
                                        <span id="comma"></span>
                                <? endif; 
                            foreach ($counters as $id => $counter):
                                ?>
                
                <? if ($counter == ','): ?> <span id="comma"></span> <? continue; endif; ?>
                <span class="counter Nexa-Bold" id="counter-<?= $id ?>"><?= $counter; ?></span>
            <? endforeach; ?> 
                        <span id="text-merchant" class="Nexa-Light">количество пользователей на сайте...</span>
                    
                </div>
        </div>
    </div>