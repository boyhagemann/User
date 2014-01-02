<?php

namespace Boyhagemann\User\Controller;

use Boyhagemann\Crud\CrudController;
use Boyhagemann\Form\FormBuilder;
use Boyhagemann\Model\ModelBuilder;
use Boyhagemann\Overview\OverviewBuilder;
use User;

class GroupController extends CrudController
{
	/**
	 * @param FormBuilder $fb
	 */
	public function buildForm(FormBuilder $fb)
	{
		$fb->text('name')->label('E-mail')->rules('required');
	}

	/**
	 * @param ModelBuilder $mb
	 */
	public function buildModel(ModelBuilder $mb)
	{
		$mb->name('Cartalyst\Sentry\Groups\Eloquent\Group')->table('groups');
	}

	/**
	 * @param OverviewBuilder $ob
	 */
	public function buildOverview(OverviewBuilder $ob)
	{
		$ob->fields(array('name'));
	}
}

