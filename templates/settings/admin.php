<?php
/**
 * This file is part of the CLNPRS App
 * and licensed under the AGPL.
 */

script('clnprs', 'settings');
style('clnprs', 'settings');

?>
<div class="section" id="clnprs-settings" data-save="<?=$_['saveSettingsUrl']?>">
    <h2>
        <?php p($l->t('Random Background Images')); ?>
        <span class="msg success"><?php p($l->t('Saved')); ?></span>
        <span class="msg error"><?php p($l->t('Failed')); ?></span>
    </h2>
    <p class="settings-hint">
        <?php p($l->t('Here you can specify where random backgrounds should be used by default.')); ?>
    </p>
    <form>
        <div>
            <input id="clnprs-style-login" name="clnprs-style-login" data-setting="style/login" type="checkbox" <?=$_['styleLogin'] ? 'checked':''?> class="checkbox">
            <label for="clnprs-style-login"><?php p($l->t('Set random image as login background')); ?></label>
        </div>
        <div>
            <input id="clnprs-style-header" name="clnprs-style-header" data-setting="style/header" type="checkbox" <?=$_['styleHeader'] ? 'checked':''?> class="checkbox">
            <label for="clnprs-style-header"><?php p($l->t('Set random image as header background')); ?></label>
        </div>
        <?php if($_['hasDashboard']): ?>
        <div>
            <input id="clnprs-style-dashboard" name="clnprs-style-dashboard" data-setting="style/dashboard" type="checkbox" <?=$_['styleDashboard'] ? 'checked':''?> class="checkbox">
            <label for="clnprs-style-dashboard"><?php p($l->t('Set random image as dashboard background')); ?></label>
        </div>
        <?php endif; ?>
    </form>
</div>