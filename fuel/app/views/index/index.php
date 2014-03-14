<?php 
if(isset($errors)){
    foreach ($errors as $error){
        $errorStr = '<p>' . $error . '</p';
    }
}  else {
    $errorStr = '';
}
?>
<div class="commentWrap">
    <?php echo Form::open(array()); ?>
    <table>
        <tr>
            <th>Add Comment :
                <input type="text" name="comment" value="" class="comments" />
            </th>
            <td>
                <input type="submit" value="send" class="send"/>
            </td>

        </tr>
    </table>
    <?php echo Form::close(); ?>
    <div class="error"><?php echo $errorStr; ?> </div>
</div>
<?php if ($items): ?>
<ul class="listComments">
    
        <?php foreach ($items as $key => $value): ?>
            <li class="clearfix"> <img src="/public/asset/img/ico_face." width="100" height="100" alt="" /><span><?php echo $value['username']; ?>/<?php echo $value['gender']; ?></span>
                <div class="commentList">
                    <p><?php echo $value['content']; ?></p>
                    <p class="date"><?php echo date('Y/m/d H:s',$value['created']); ?></p>
                </div>
            </li>
        <?php endforeach; ?>
  
</ul>
<div class="read-more"> <a href="#" class="more"><span>Read More</span></a>
    <p class="record"><span>10</span> record &frasl; <span>28</span> record</p>
</div>
  <?php endif; ?>