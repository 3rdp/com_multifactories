<?php
/**
 * @package     com_multifactories
 * @subpackage  crudfactories
 *
 */
 /* @var $this MultifactoriesView */
defined('_JEXEC') or die;
?>
<button class="btn" type="button" onclick="document.getElementById('batch-category-id').value='';document.getElementById('batch-client-id').value='';document.getElementById('batch-language-id').value=''" data-dismiss="modal">
	<?php echo JText::_('JCANCEL'); ?>
</button>
<button class="btn btn-success" type="submit" onclick="Joomla.submitbutton('crudfactories.batch');">
	<?php echo JText::_('JGLOBAL_BATCH_PROCESS'); ?>
</button>
