<?php
/*
This is a concept that must be extended.

Participation is a tool to let the public of a website participate actively.

This means : 

- adding comments
- respond to polls
- adding any kind of (allowed) content

This is translated to : render a public friendly form to add content to a website.

*/

/*
Example implementation can be found in /doc/participation.txt
*/
/*

// Simple use : render a comment post form
$participation = new participation('discussion');
$participation->render();
$participation->renderForm(); // ?


// where is this stuff being put ?
// default to the curent node (global $node)
$participation->setParentNode($node);



// enable publishing "a posteriori"
// else comment / item is published imediately
$participation->enableModeration();


// enable instant publishing if user fills a captcha
// this disables moderation
$participation->enableCaptcha();

// Will add a preview button to let visitors preview their participation before submiting
// need mor thinking on this one as well
$participation->enablePreview();

// enable akismet.com spam check
// this disables moderation
$participation->enable_akismet = true;


// will send an email to $email when something is posted
// will add links to the interface to edit the post
$participation->notifyByEmail($email);

// Various strings
$participation->setTitle('Please submit your comment bellow');
$participation->setSucces('Good!, your comment has been posted');
$participation->setFailure('Too bad, it didn\'t work');
*/


class participation
{
		/**
		* Form title
		*/
		var $title = 'Participate!';
		
		/**
		* message in case all went well
		*/
		var $success_message = 'Your participation has been added';
		
		/**
		* Message if something went wrong
		*/
		var $failure_message = 'System failure : your participation has not been added'; 
		
		/**
		* Message if form has invalid content
		*/
		var $invalid_message = 'Your submited content is not valid, please check the form and resend';
		
		/**
		* If set to true, messages won't appear directly, you will need to publish them
		*/
		var $enable_moderation = true;
		
		/**
		* If set to true, message content will be submited to askimet
		*/
		var $enable_askimet = false; 
		
		/**
		* If set to true, participation will be moved in the bottom of the tree (in the curent branch)
		*/
		var $move_to_bottom = true; 
		
		/**
		* The node where you want to put your participation. Default to global $node
		*/
		var $parent_node; 
		
		
		/**
		* Email of the person to contact in case of new submission
		* This may be changed later to use a general logging system, with email subscriptions
		*/
		var $notification_email = false;
		
		/**
		* Subject of the email sent in case of new participation
		*
		*/
		var $notification_email_subject = 'A new participation : ';
		
		
		function participation($content_type)
		{
				$this->content_type = $content_type;
				
				global $thinkedit;
				$this->content = $thinkedit->newRecord($content_type);
				
				global $node;
				$this->parent_node = $node;
		}
		
		function setParentNode($node)
		{
				$this->parent_node = $node;
		}
		
		
		
		function render()
		{
				global $thinkedit;
				
				// init form
				require_once ROOT . '/class/html_form.class.php';
				$form = new html_form();
				
				// add content
				$form->add('<h1>');
				$form->add($this->title);
				$form->add('</h1>');
				
				// if form sent, validate
				if ($form->isSent())
				{
						$this->content->setArray($_POST);
						
						// first case : invalid content
						if (!$this->content->validate())
						{
								$form->add('<div class="participation_error">');
								$form->add($this->invalid_message);
								$form->add('</div>');
						}
						// second case : valid content submited
						else
						{
								$failure = false;
								// save content to db
								if (!$this->content->insert())
								{
										$failure = true;
								}
								
								// add content to curent node
								if (isset($this->parent_node))
								{
										/*
										if (isset($this->container_node_type))
										{
												// find a node of this type in parent_node
												
												$children = $this->parent_node->getChildren();
												
												if ($children)
												{
														foreach ($children as $child)
														{
																$child_content = $child->getContent();
																if ($child_content->getType() == $this->container_node_type)
																{
																		$container = $child;
																}
														}
												}
												
												// if no container, create one
												
												if (!isset($container))
												{
														$container_content = $thinkedit->newRecord($this->container_node_type);
														$container_content->setTitle($this->container_node_title);
														$container_content->save();
														$container = $this->parent_node->add($container_content);
												}
												
											
												
										}
										else // if no container is defined, container is parent node
										{
												$container = $this->parent_node;
										}
										*/
										
										//$container = $this->parent_node;
										
										// add content in the container
										$new_node = $this->parent_node->add($this->content);
										
										// publish if needed
										if ($this->enable_moderation)
										{
												
										}
										else
										{
												$new_node->publish();
										}
										
										// update db
										if (!$new_node->save())
										{
												$failure = true;
										}
										
										// move to bottom of curent branch if needed
										if ($this->move_to_bottom)
										{
												$new_node->moveBottom();
										}
										else
										{
												$new_node->rebuild();
										}
								}
								
								if ($failure)
								{
										$form->add('<div class="participation_error">');
										$form->add($this->failure_message);
										$form->add('</div>');
								}
								else
								{
										if (isset($this->notification_email))
										{
												require_once ROOT . '/class/mailer.class.php';
												$mailer = new mailer();
												$mailer->isHtml(true);
												$mailer->setTo($this->notification_email);
												
												// todo : find the first email field type in the record to use it as a sender
												// $mailer->setFrom($this->notification_email);
												$mailer->setSubject($this->notification_email_subject . $this->content->getTitle());
												
												$message = '';
												foreach ($this->content->field as $field)
												{
														$message .= '<b>' .  $field->getTitle();
														$message .= ' : '  . '</b>';
														$message .= '<br/>';
														$message .= $field->get();
														$message .= '<br/>';
														$message .= '<br/>';
												}
												$url = $thinkedit->newUrl();
												
												$url->set('node_id', $this->parent_node->getId());
												
												$message .= '<a href="'.  $url->renderAbsoluteUrl('/edit/structure.php')  .'">' . translate('participation_email_admin_link') . '</a>';
												
												
												$mailer->setBody($message);
												$mailer->send();
												
										}
										$form->add('<div class="participation_success">');
										$form->add($this->success_message);
										$form->add('</div>');
								}
								
						}
						
				}
				
				
				// In all cases, build form UI
				foreach ($this->content->field as $field)
				{
						if ($field->isUsedIn('participation') && $field->getType() <> 'id')
						{
								$form->add($field->getTitle() . ' : ' );
								$form->add('<br/>');
								
								if ($form->isSent() && $field->getErrorMessage())
								{
										$form->add('<div class="participation_field_error">');
										$form->add($field->getErrorMessage());
										$form->add('</div>');
								}
								
								$form->add($field->renderUi());
								$form->add('<br/>');
								$form->add('<br/>');
						}
				}
				
				return $form->render();
				
				
		}
		
}


?>
