<? if(isset($post)): ?>
    <div class="well">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?= $post->title; ?>
                    <? if($post->status === '2'): ?><span class="label label-info">Ожидает модерации</span><? endif; ?>
                    <? if($post->status === '0'): ?><span class="label label-danger">Пост отклонен модератором</span><? endif; ?>
                </h3>
            </div>
            <div class="panel-body">
                <?= $post->body; ?>
            </div>
            <div class="panel-footer clearfix">
                <div class="well well-sm pull-left">
                    Создан: <?= Date::forge($post->created_at)->set_timezone('Europe/Kiev')->format("%m/%d/%Y %H:%M"); ?>
                </div>
                <div class="well well-sm pull-left">
                    Организация: <?= Fuel\Core\Html::anchor('/gwest/organisation/view/' . $post->organisation->id, $post->organisation->title); ?>
                </div>
                <div class="well well-sm pull-left">
                    Пользователь: <?= Fuel\Core\Html::anchor('/gwest/user/view/' . $post->user->id, $post->user->username); ?>
                </div>
              
            </div>
        </div>
    </div>
    <?php 
            if (Auth::check() && (int)$post->user->group_id > 2) 
                {
                ?>
                <label>Комментарии:</label>
                <div class="leave_comment clearfix">
                    <div class="avatar pull-left">
                        <a href="">
                            <? if(\Auth\Auth::get('avatar')): ?>
                    <img class="user-avatar" src="<?= Auth\Auth::get('avatar'); ?>">
                    <? else: ?>
                        <img class="user-avatar" src="/files/avatars/no_foto.jpg">
                    <? endif; ?>
                        </a>
                    </div>
                    <div class="comment_form pull-left">
                        
                    
                 <?= Form::open(array('method' => 'post', 'role' => 'form', 'action' => 'gwest/posts/addcomment')); ?>
                        
                  <textarea rows="10" cols="85" name="comment" class="form-control" placeholder="Введите текст комментария"></textarea>
                  <p class="help-block">Текст комментария не должен нарушать правил пользования ресурсом, подробнее о <a href="/gwest/abaut">правилах пользования…</a></p>
                  <?= Form::hidden('post_id', $post->id);?>
                    <button class="btn btn-default btn pull-right" type="submit">Сохранить</button>
                <?= \Fuel\Core\Form::close(); ?>
                    </div>
                    </div>
                <?php } else { ?>
            <h1>Что бы просматривать и  оставлять комментарии нужно пройти <a data-target='#login' data-toggle="modal"  href="">Регистрацию</a></h1> 
               <?php } ?>
         
<? endif; ?>
<div class="clearfix"></div>
    <ul class="comments-list list-unstyled">
        <? if (Auth::check() && (int)$post->user->group_id > 2): ?>
        <?php echo renderComments($comments, 0, $post->id); ?>
         <? endif; ?>
    </ul>
<?php

function getAvatar($user) {
    if(isset($user)) {
        return $user;
    } else {
            return '/files/avatars/no_foto.jpg';
    }

}

            function renderComments($comments, $parentId, $post_id) {
                
                $res = '';
                foreach ($comments as $comment) {
                    if($comment->parent_id == $parentId) {
                        //$user = reset($comment->user->metadata);
                        if(isset($comment->user->avatar)) {
                            $avatar = $comment->user->avatar;
                        } else  {
                            $avatar = '/files/avatars/no_foto.jpg';
                        }
                        $res = $res .' <li  class="comment">
       <div class="media">
           <a class="pull-left" href="/gwest/user/view/'.$comment->user->id.'">
               <img src="'. $avatar .'">
           </a>
           <div class="media-body">
           <h4 class="media-heading">
               <a href="/gwest/user/view/'.$comment->user->id.'" class="">'. $comment->user->username   .'</a>&nbsp;&nbsp;&nbsp;
               <a href="#" class="reply" data-comment-id="' . $comment->id .'"> Ответить</a>
           </h4>
           <p>'   
                . $comment->comment . '
                <form data-comment-id="'.$comment->id.'" class="answer" method="post" role="form" action="/gwest/posts/addcomment.html" accept-charset="utf-8">                <textarea rows="10" cols="25" name="comment" class="form-control" placeholder="Введите текст комментария"></textarea>
                   <input name="post_id" value="'.$post_id.'" type="hidden" id="form_post_id">
                   <input name="parent_id" value="'.$comment->id.'" type="hidden" id="form_post_id"><button class="btn btn-default btn pull-right" type="submit">Сохранить</button>
                </form>
            </p>
       </div>
       
       <ul class="comments-list ">
            '  .  renderComments($comments, $comment->id, $post_id)  . '
       </ul>
       <div class="footer_message">
              
       </div>
   </li>';
               
                    }  
                }
                
                return $res;
            }
?>
<script>
    $(document).ready(function() {
        $('.reply').click(function(e) {
            var id = $(e.currentTarget).attr('data-comment-id');
            $('form[data-comment-id="'+id+'"]').show();
            return false;
        });
    });
</script>
