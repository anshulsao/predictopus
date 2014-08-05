<div class="module <?php echo $moduleClasses?>" id="<?php echo $moduleId?>">
    <?php if(!empty($head)) { ?>
        <div class="module-head">
            <?php echo $head?>
        </div>
    <?php } ?>
    <div class="module-content"><?php echo $content?></div>
    <?php if(!empty($foot)) { ?>
        <div class="module-foot">
            <?php echo $foot?>
        </div>
    <?php } ?>
</div>

