<?php
/**
 * @package     com_multifactories
 * @subpackage  cities
 *
 */
 /* @var $this MultifactoriesViewCity */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user      = JFactory::getUser();
$userId    = $user->get('id');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
//$canOrder  = $user->authorise('core.edit.state', 'com_multifactories.category');
$archived  = $this->state->get('filter.published') == 2 ? true : false;
$trashed   = $this->state->get('filter.published') == -2 ? true : false;
$saveOrder = $listOrder == 'a.ordering';

if ($saveOrder){
	$saveOrderingUrl = 'index.php?option=com_multifactories&task=cities.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
?>

<form action="<?php echo JRoute::_('index.php?option=com_multifactories&view=cities'); ?>" method="post" name="adminForm" id="adminForm">
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
		<?php
		// Search tools bar
		echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
		?>
		<?php if (empty($this->items)) : ?>
			<div class="alert alert-no-items">
				<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
			</div>
		<?php else : ?>
			<table class="table table-striped" id="articleList">
				<thead>
					<tr>
						
						<th width="1%" class="center">
							<?php echo JHtml::_('grid.checkall'); ?>
						</th>
						
						<th class="nowrap center">
						<?php echo JHtml::_('searchtools.sort', 'COM_MULTIFACTORIES_HEADING_SUBDOMAIN_NAME', 'a.subdomain_name', $listDirn, $listOrder); ?>
							
						</th>
						<th class="nowrap center">
						<?php echo JHtml::_('searchtools.sort', 'COM_MULTIFACTORIES_HEADING_FACTORY_ID', 'a.factory_id', $listDirn, $listOrder); ?>
							
						</th>
				</thead>
				<tfoot>
					<tr>
						<td colspan="13">
							<?php echo $this->pagination->getListFooter(); ?>
						</td>
					</tr>
				</tfoot>
				<tbody>
					<?php foreach ($this->items as $i => $item) :
						$canCreate  = $user->authorise('core.create');
						$canEdit    = $user->authorise('core.edit');
						//$canCheckin = $user->authorise('core.manage',     'com_checkin') || $item->checked_out == $userId || $item->checked_out == 0;
						$canChange  = $user->authorise('core.edit.state');// && $canCheckin;
						?>
						<tr class="row<?php echo $i % 2; ?>" sortable-group-id="<?php //echo $item->catid; ?>">
							
							
							
							<td class="nowrap has-context">
								<div class="pull-left">
									<?php if ($item->checked_out) : ?>
										<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'cities.', $canCheckin); ?>
									<?php endif; ?>
									<?php if ($canEdit) : ?>
										<a href="<?php echo JRoute::_('index.php?option=com_multifactories&task=city.edit&id=' . (int) $item->id); ?>">
											<?php echo $this->escape($item->subdomain_name); ?></a>
									<?php else : ?>
										<?php echo $this->escape($item->subdomain_name); ?>
									<?php endif; ?>
									
								</div>
							</td>
							
								
							<td class="small nowrap hidden-phone">
								<?php echo $this->escape($item->subdomain_name); ?>
							</td>
							
								
							<td class="small nowrap hidden-phone">
								<?php echo $this->escape($item->factory_id); ?>
							</td>
							
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php // Load the batch processing form. ?>
			<?php if ($user->authorise('core.create', 'com_multifactories')
				&& $user->authorise('core.edit', 'com_multifactories')
				&& $user->authorise('core.edit.state', 'com_multifactories')) : ?>
				<?php echo JHtml::_(
					'bootstrap.renderModal',
					'collapseModal',
					array(
						'title' => JText::_('COM_MULTIFACTORIES_BATCH_OPTIONS'),
						'footer' => $this->loadTemplate('batch_footer')
					),
					$this->loadTemplate('batch_body')
				); ?>
			<?php endif; ?>
		<?php endif; ?>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
