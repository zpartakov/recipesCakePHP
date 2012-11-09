<?php
/*
 * a contact MVC
 * src: Formulaire de contact avec CakePHP
 * http://www.formation-cakephp.com/71/formulaire-de-contact-avec-cakephp
 * mod: fradeff@akadamia.ch, 2012-09-21
*/

class ContactsController extends AppController
{
	var $name = 'Contacts';
 
	var $components = array('Email');
 
	function index()
	{
		if(!empty($this->data))
		{
			$this->Contact->create($this->data);
 
			if(!$this->Contact->validates())
			{
				$this->Session->setFlash("Veuillez corriger les erreurs mentionnées.", 'message_notice');
				$this->validateErrors($this->Contact);
			}
			else 
			{
		        	// Nettoyage de la saisie
				App::import('Sanitize');
				$this->data = Sanitize::clean($this->data);
 
				$this->set('data', $this->data);
 
				//$this->Email->charset  = 'ISO-8859-1';
				$this->Email->charset  = 'UTF-8';
				$this->Email->to       = array($this->data['Contact']['email']);
				$this->Email->bcc      = 'fradeff@akademia.ch';
				$this->Email->from     = $this->data['Contact']['email'];
				$this->Email->sendAs   = 'both';
				$this->Email->subject  = "Formulaire de contact";
				$this->Email->template = 'contact';
 
				// Envoi de l'email
				$this->Email->send();
 
				$this->redirect(array('action' => 'confirmation'));
			}
		}
	}
 
	// Page de remerciement
	function confirmation() {}
}
?>