<?php $ak = $prefs->getValue('widget_accesskey') ? Horde::getAccessKey($_prefs[$pref]['desc']) : '' ?>
<p><a href="<?php echo (isset($_prefs[$pref]['url'])) ? Horde::applicationUrl($_prefs[$pref]['url']) : $_prefs[$pref]['xurl'] ?>"<?php if (!empty($ak)) echo ' accesskey="' . $ak . '"' ?>><?php if (isset($_prefs[$pref]['img'])) echo Horde::img($_prefs[$pref]['img'], $_prefs[$pref]['desc'], 'hspace="3"') ?><b><?php echo Horde::highlightAccessKey($_prefs[$pref]['desc'], $ak) ?></b></a>&nbsp;<?php echo $helplink ?></p>