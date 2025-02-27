<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Dt_whatsapp_tenants_configs
 * @author     dreamztech <support@dreamztech.com.my>
 * @copyright  2025 dreamztech
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Comdtwhatsapptenantsconfigs\Component\Dt_whatsapp_tenants_configs\Site\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

/**
 * Display Component Controller
 *
 * @since  1.0.0
 */
class DisplayController extends \Joomla\CMS\MVC\Controller\BaseController
{
	/**
	 * Constructor.
	 *
	 * @param  array                $config   An optional associative array of configuration settings.
	 * Recognized key values include 'name', 'default_task', 'model_path', and
	 * 'view_path' (this list is not meant to be comprehensive).
	 * @param  MVCFactoryInterface  $factory  The factory.
	 * @param  CMSApplication       $app      The JApplication for the dispatcher
	 * @param  Input              $input    Input
	 *
	 * @since  1.0.0
	 */
	public function __construct($config = array(), MVCFactoryInterface $factory = null, $app = null, $input = null)
	{
		parent::__construct($config, $factory, $app, $input);
	}

	/**
	 * Method to display a view.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached.
	 * @param   boolean  $urlparams  An array of safe URL parameters and their variable types, for valid values see {@link InputFilter::clean()}.
	 *
	 * @return  \Joomla\CMS\MVC\Controller\BaseController  This object to support chaining.
	 *
	 * @since   1.0.0
	 */
	public function display($cachable = false, $urlparams = false)
	{

		$view = $this->input->getCmd('view', 'whatsapptenantsconfigs');
		$view = $view == "featured" ? 'whatsapptenantsconfigs' : $view;
		$this->input->set('view', $view);
		
		var_dump($view);
		// edit: tenant-config?task=whatsapptenantsconfig.edit&id={id}
		// view index.php?option=com_dt_whatsapp_tenants_configs&view=whatsapptenantsconfig&id=5
		// Check if config exists
		$model = $this->getModel('whatsapptenantsconfig');
		$user  = Factory::getUser();
		$user_id = $user->get('id');
		$config = $model->getItemByUserId($user_id);
		if (!empty($user_id)) {
			switch($view) {
				case 'whatsapptenantsconfigs':
					if (!empty($config)) {
						// Redirect to respective edit
						$this->setRedirect('index.php?option=com_dt_whatsapp_tenants_configs&task=whatsapptenantsconfig.edit&id=' . $config->id);
					}
					break;
				case 'whatsapptenantsconfig':
					$id = $this->input->getInt('id');
					var_dump('current id: ' . $id);
					var_dump('config id: ' . $config->id);
					if ($id != $config->id) {
						$this->setRedirect('index.php?option=com_dt_whatsapp_tenants_configs&view=whatsapptenantsconfig&id=' . $config->id);
					}					
					break;
			}
		}

		parent::display($cachable, $urlparams);
		return $this;
	}
}
