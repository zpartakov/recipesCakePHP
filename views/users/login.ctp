<?php
/**
* @version        $Id: login.ctp v1.0 02.03.2010 12:07:38 CET $
* @package        Эrgolang
* @copyright    Copyright (C) 2009 - 2013 Open Source Matters. All rights reserved.
* @license        GNU/GPL, see LICENSE.php
* Эrgolang is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

$this->pageTitle = "Authentification";
?> 
<h1><? echo $this->pageTitle; ?></h1>
 <? if ($session->check('Message.auth')) $session->flash('auth');?> 
 <?
echo $session->flash('auth');
    echo $form->create('User', array('action' => 'login'));
    echo $form->input('username', array('label' => 'Utilisateur'));
    echo $form->input('password', array('label' => 'Mot de passe'));
    echo $form->end('Login');
?>
<!--
 <br />
<ul>
<li>Mot de passe oublié? <a href="<? echo CHEMIN; ?>users/passwordreminder">Faites-vous envoyer votre mot de passe</a></li>
<li>Vous n'avez pas encore de compte? <a href="<? echo CHEMIN; ?>users/ajouter">Enregistrez-vous</a></li>
</ul>
-->
<br>
<br>
<h1><a href=logout>Logout</a></h1>
