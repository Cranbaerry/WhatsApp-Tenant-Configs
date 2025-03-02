<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Dt_whatsapp_tenants_configs
 * @author     dreamztech <support@dreamztech.com.my>
 * @copyright  2025 dreamztech
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Uri\Uri;
use \Joomla\CMS\Router\Route;
use \Joomla\CMS\Language\Text;
use \Joomla\CMS\Session\Session;
use Joomla\Utilities\ArrayHelper;

$canEdit = Factory::getApplication()->getIdentity()->authorise('core.edit', 'com_dt_whatsapp_tenants_configs');

if (!$canEdit && Factory::getApplication()->getIdentity()->authorise('core.edit.own', 'com_dt_whatsapp_tenants_configs'))
{
	$canEdit = Factory::getApplication()->getIdentity()->id == $this->item->created_by;
}
?>

<div class="item_fields">
<?php if ($this->params->get('show_page_heading')) : ?>
    <div class="page-header">
        <h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
    </div>
    <?php endif;?>
	<table class="table">
		

		<tr>
			<th><?php echo Text::_('COM_DT_WHATSAPP_TENANTS_CONFIGS_FORM_LBL_WHATSAPPTENANTSCONFIG_CALLBACK_URL'); ?></th>
			<td><?php echo $this->item->callback_url; ?></td>
		</tr>

		<tr>
			<th><?php echo Text::_('COM_DT_WHATSAPP_TENANTS_CONFIGS_FORM_LBL_WHATSAPPTENANTSCONFIG_FORWARD_URL'); ?></th>
			<td><?php echo $this->item->forward_url; ?></td>
		</tr>

		<tr>
			<th><?php echo Text::_('COM_DT_WHATSAPP_TENANTS_CONFIGS_FORM_LBL_WHATSAPPTENANTSCONFIG_APP_ID'); ?></th>
			<td><?php echo $this->item->app_id; ?></td>
		</tr>

		<tr>
			<th><?php echo Text::_('COM_DT_WHATSAPP_TENANTS_CONFIGS_FORM_LBL_WHATSAPPTENANTSCONFIG_TOKEN'); ?></th>
			<td><?php echo $this->item->token; ?></td>
		</tr>

		<tr>
			<th><?php echo Text::_('COM_DT_WHATSAPP_TENANTS_CONFIGS_FORM_LBL_WHATSAPPTENANTSCONFIG_PHONE_NUMBER'); ?></th>
			<td><?php echo $this->item->phone_number; ?></td>
		</tr>

		<tr>
			<th><?php echo Text::_('COM_DT_WHATSAPP_TENANTS_CONFIGS_FORM_LBL_WHATSAPPTENANTSCONFIG_USER_ID'); ?></th>
			<td><?php echo $this->item->user_id_name; ?></td>
		</tr>
		
		<tr>
			<th><?php echo Text::_('COM_DT_WHATSAPP_TENANTS_CONFIGS_FORM_LBL_WHATSAPPTENANTSCONFIG_BUSINESS_ACCOUNT_ID'); ?></th>
			<td><?php echo $this->item->business_account_id; ?></td>
		</tr>

	</table>

</div>

<?php $canCheckin = Factory::getApplication()->getIdentity()->authorise('core.manage', 'com_dt_whatsapp_tenants_configs.' . $this->item->id) || $this->item->checked_out == Factory::getApplication()->getIdentity()->id; ?>
	<?php if($canEdit && $this->item->checked_out == 0): ?>

	<a class="btn btn-outline-primary" href="<?php echo Route::_('index.php?option=com_dt_whatsapp_tenants_configs&task=whatsapptenantsconfig.edit&id='.$this->item->id); ?>"><?php echo Text::_("COM_DT_WHATSAPP_TENANTS_CONFIGS_EDIT_ITEM"); ?></a>
	<?php elseif($canCheckin && $this->item->checked_out > 0) : ?>
	<a class="btn btn-outline-primary" href="<?php echo Route::_('index.php?option=com_dt_whatsapp_tenants_configs&task=whatsapptenantsconfig.checkin&id=' . $this->item->id .'&'. Session::getFormToken() .'=1'); ?>"><?php echo Text::_("JLIB_HTML_CHECKIN"); ?></a>

<?php endif; ?>

<?php if (Factory::getApplication()->getIdentity()->authorise('core.delete','com_dt_whatsapp_tenants_configs.whatsapptenantsconfig.'.$this->item->id)) : ?>

	<a class="btn btn-danger" rel="noopener noreferrer" href="#deleteModal" role="button" data-bs-toggle="modal">
		<?php echo Text::_("COM_DT_WHATSAPP_TENANTS_CONFIGS_DELETE_ITEM"); ?>
	</a>

	<?php echo HTMLHelper::_(
                                    'bootstrap.renderModal',
                                    'deleteModal',
                                    array(
                                        'title'  => Text::_('COM_DT_WHATSAPP_TENANTS_CONFIGS_DELETE_ITEM'),
                                        'height' => '50%',
                                        'width'  => '20%',
                                        
                                        'modalWidth'  => '50',
                                        'bodyHeight'  => '100',
                                        'footer' => '<button class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button><a href="' . Route::_('index.php?option=com_dt_whatsapp_tenants_configs&task=whatsapptenantsconfig.remove&id=' . $this->item->id, false, 2) .'" class="btn btn-danger">' . Text::_('COM_DT_WHATSAPP_TENANTS_CONFIGS_DELETE_ITEM') .'</a>'
                                    ),
                                    Text::sprintf('COM_DT_WHATSAPP_TENANTS_CONFIGS_DELETE_CONFIRM', $this->item->id)
                                ); ?>

<?php endif; ?>