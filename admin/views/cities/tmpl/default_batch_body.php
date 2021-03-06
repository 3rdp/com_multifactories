<?php
/**
 * @package     com_multifactories
 * @subpackage  cities
 *
 */
 /* @var $this MultifactoriesViewCity */
defined('_JEXEC') or die;

$published = $this->state->get('filter.published');
?>
<div class="row-fluid">
	<div class="control-group span6">
		<div class="controls">
			<?php echo JHtml::_('batch.language'); ?>
		</div>
	</div>
	<!--<div class="control-group span6">
		<div class="controls">
			<?php //echo JHtml::_('city.optionsSets'); ?>
		</div>
	</div>
</div>-->
<div class="row-fluid">
	<?php if ($published >= 0) : ?>
		<div class="control-group span6">
			<div class="controls">
				<?php echo JHtml::_('batch.item', 'com_multifactories'); ?>
			</div>
		</div>
	<?php endif; ?>
</div>
