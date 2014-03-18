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
    <?php echo Form::open(array('action' => 'mainpage/add_comment', 'id' => 'form_add_comment')); ?>
    <table>
        <tr>
            <th>Add Comment :
                <input type="text" name="comment" value="" class="comments" id="input_comment" />
            </th>
            <td>
                <input type="submit" value="send" class="send"/>
            </td>

        </tr>
    </table>
    <?php echo Form::close(); ?>
    <div class="error"><?php echo $errorStr; ?> </div>
</div>
<?php if ($comments): ?>
    <ul class="listComments">

        <?php foreach ($comments as $key => $value): ?>
            <li class="clearfix">
                <div class="viewFace">
                    <?php if ($value['image']): ?>
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
        
        <input type="hidden" name="last_item" value="<?php if ($end_id) echo $end_id; ?>" id="last_item" />
        <input type="hidden" name="num" value="<?php if ($num) echo $num; ?>" id="num_record" />
        <input type="hidden" name="total" value="<?php if ($total) echo $total; ?>" id="total" />
    </ul>
    <?php echo Form::open(array('action' => 'mainpage/more_comment', 'id' => 'form_read_more')); ?>

    <div class="read-more"> <a href="#" class="more"><span>Read More</span></a>
        <p class="record"><span id="show_record"></span> record &frasl; <span id="total_record"></span> record</p>
    </div>
    <?php echo Form::close(); ?>
<?php endif; ?>

