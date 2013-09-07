<?php 
/**
 * @package	API
 * @version 1.5
 * @author 	Rafael Corral
 * @link 	http://www.rafaelcorral.com
 * @copyright Copyright (C) 2011 Edge Web Works, LLC. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

defined('_JEXEC') or die;

class ApiAuthenticationLogin extends ApiAuthentication
{
	protected $auth_method     = null;
	protected $domain_checking = null;

	public function authenticate()
	{
		$username = JRequest::getVar( 'username' );
		$password = JRequest::getVar( 'password' );
		$user = $this->loadUserByCredentials( $username, $password );
		
<<<<<<< HEAD

		if ( $user === false ) {
			$this->setError(JText::_('Username/password does not match'));
			return false;
		}
		
		return $user;
=======
		// Remove username and password from request for when it gets logged
		$uri = JFactory::getURI();
		$uri->delVar('username');
		$uri->delVar('password');

		if ( $user === false ) {
			// Errors are already set, just return
			return false;
		}
		
		return $user->id;
>>>>>>> origin/1.5
	}

	public function loadUserByCredentials( $user, $pass )
	{
<<<<<<< HEAD
		
		$app = JFactory::getApplication();
		$response = $app->login(array('username'=>$user, 'password'=>$pass));
	
		if ($response === true) {
			$db = JFactory::getDBO();
			$db->setQuery("SELECT id FROM #__users WHERE username = " . $db->Quote($user));
			$userid = $db->loadResult();	
			$app->logout();
			return $userid;
		} else {
			return false;
		}
		
		
=======
		jimport('joomla.user.authentication');

		$authenticate = JAuthentication::getInstance();
		 
		$response = $authenticate->authenticate(array( 'username' => $user, 'password' => $pass ),$options = array());
		
		if ($response->status ===JAUTHENTICATE_STATUS_SUCCESS) {
			$instance = JUser::getInstance($response->username);
			if ( $instance === false ) {
				$this->setError( JError::getError() );
				return false;
			}
		} else {
			if ( isset( $response->error_message ) ) {
				$this->setError( $response->error_message );
			}else {
				$this->setError( $response->getError() );
			}

			return false;
		}

		return $instance;
>>>>>>> origin/1.5
	}
}
