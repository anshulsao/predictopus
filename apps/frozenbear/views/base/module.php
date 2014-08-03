<div class="module <?php echo $moduleClasses?>" id="<?php echo $moduleId?>">
    <?php if(!empty($head)) { ?>
        <div class="module-head">
            <h3 class="title-text z2t-theme"><?php echo $head?></h3>
        </div>
    <?php } ?>
    <div class="module-content"><?php echo $content?></div>
    <?php if(!empty($foot)) { ?>
        <div class="module-foot">
            <?php echo $foot?>
        </div>
    <?php } ?>
</div>

