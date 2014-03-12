<div>
    <label>Add comment</label><input type="text" name="content" id="content" value="" /> <input type="submit" value="Send" />
</div>
<div>
    <?php foreach ($items as $key => $value): ?>
    <p>
        <label><?php echo $value['username'] . ' / ' . $value['gender'] ?></label>
   <textarea rows="4" cols="50">
    <?php echo $value['content']  ?>
   </textarea>
        <label><?php echo $value['created']; ?></label>
    </p>
    <?php endforeach; ?>
</div>
