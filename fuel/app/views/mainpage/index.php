<?php
if (isset($errors)) {
    foreach ($errors as $error) {
        $errorStr = '<p>' . $error . '</p';
    }
} else {
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
            <li class="clearfix">
                <div class="viewFace">
                    <?php if($value['image']): ?>
                     <img src="/files/<?php echo $value['image'] ?>" width="100" height="100" alt="" />
                    <?php else: ?>
                    <img src="/assets/img/ico_face.png" width="100" height="100" alt="" />
                    <?php endif; ?>
                    <h3><?php echo $value['username']; ?>/<?php echo $value['gender']; ?></h3>
                </div>
                <div class="commentList">
                    <p><?php echo $value['content']; ?></p>
                    <p class="date"><?php echo date('Y/m/d H:s', $value['created']); ?></p>
                </div>

            </li>
        <?php endforeach; ?>        

    </ul>
    <?php echo Form::open(array('action' => 'mainpage/more_comment')); ?>
    <input type="hidden" name="" value="<?php if($end_id) echo $end_id; ?>" id="last-item" />
    <div class="read-more"> <a href="#" class="more"><span>Read More</span></a>
        <p class="record"><span>10</span> record &frasl; <span>28</span> record</p>
    </div>
    <?php echo Form::close(); ?>
<?php endif; ?>

