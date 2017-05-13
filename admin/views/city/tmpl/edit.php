<?php
/**
 * @package     com_multifactories
 * @subpackage  cities
 *
 */

/* @var $this MultifactoriesViewCity */

defined('_JEXEC') or die;

JHtml::_('behavior.formvalidator');
JHtml::_('formbehavior.chosen', 'select');

JFactory::getDocument()->addScriptDeclaration('
	Joomla.submitbutton = function(task){
		if (task == "city.cancel" || document.formvalidator.isValid(document.getElementById("city-form")))
		{
			Joomla.submitform(task, document.getElementById("city-form"));
		}
	};
');
?>

<form action="<?php echo JRoute::_('index.php?option=com_multifactories&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="city-form" class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('COM_MULTIFACTORIES_CITY_DETAILS', true)); ?>
		<div class="row-fluid">
			<div class="span9">
				<?php echo $this->form->getControlGroups('fields'); ?>
			</div>
			<div class="span3">
				<?php //echo JLayoutHelper::render('joomla.edit.global', $this); ?>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		<?php echo JHtml::_('bootstrap.endTabSet'); ?>
	</div>

	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>
