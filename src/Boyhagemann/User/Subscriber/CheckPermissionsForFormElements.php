<?php

namespace Boyhagemann\User\Subscriber;

use Illuminate\Events\Dispatcher as Events;
use Boyhagemann\Form\FormBuilder;
use Boyhagemann\Form\Element;
use Sentry;

class CheckPermissionsForFormElements
{
	/**
	 * Register the listeners for the subscriber.
	 *
	 * @param Events $events
	 */
	public function subscribe(Events $events)
	{
		$events->listen('form.formBuilder.buildElement.before', array($this, 'onBuildElement'));
	}

	/**
	 * @param Model          $model
	 * @param CrudController $controller
	 */
	public function onBuildElement(Element $element, FormBuilder $fb)
	{
		$user = Sentry::getUser();

		if(!$user) {
			return;
		}

		$permission = sprintf('view.form.%s.element.%s', $fb->getName(), $element->getName());

		if(!$user->hasPermission($permission)) {
			$fb->remove($element);
		}

	}
}