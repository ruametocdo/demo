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