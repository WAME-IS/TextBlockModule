<?php

namespace App\AdminModule\Presenters;

use Wame\ComponentModule\Forms\ComponentForm;
use Wame\PositionModule\Repositories\PositionRepository;
use Wame\TextBlockModule\Forms\TextFormContainer;
use Wame\TextBlockModule\Forms\ShowTitleFormContainer;

class TextBlockPresenter extends \App\AdminModule\Presenters\BasePresenter
{		
	/** @var ComponentForm @inject */
	public $componentForm;

	/** @var PositionRepository @inject */
	public $positionRepository;

	/** @var TextFormContainer @inject */
	public $textFormContainer;

	/** @var ShowTitleFormContainer @inject */
	public $showTitleFormContainer;
	
	
	public function actionCreate()
	{
		if (!$this->user->isAllowed('textBlock', 'create')) {
			$this->flashMessage(_('To enter this section you do not have have enough privileges.'), 'danger');
			$this->redirect(':Admin:Dashboard:');
		}
		
		if ($this->getParameter('p')) {
			$position = $this->positionRepository->get(['id' => $this->getParameter('p')]);
			
			if (!$position) {
				$this->flashMessage(_('This position does not exist.'), 'danger');
				$this->redirect(':Admin:Component:', ['id' => null]);
			}
			
			if ($position->status == PositionRepository::STATUS_REMOVE) {
				$this->flashMessage(_('This position is removed.'), 'danger');
				$this->redirect(':Admin:Component:', ['id' => null]);
			}
			
			if ($position->status == PositionRepository::STATUS_DISABLED) {
				$this->flashMessage(_('This position is disabled.'), 'warning');
			}
		}
	}
	
	
	public function actionEdit()
	{
		if (!$this->user->isAllowed('textBlock', 'edit')) {
			$this->flashMessage(_('To enter this section you do not have have enough privileges.'), 'danger');
			$this->redirect(':Admin:Dashboard:');
		}
	}
	

	/**
	 * Menu component form
	 * 
	 * @return ComponentForm
	 */
	protected function createComponentTextBlockForm()
	{
		$form = $this->componentForm
						->setType('TextBlockComponent')
						->setId($this->id)
						->addFormContainer($this->textFormContainer, 'TextFormContainer', 75)
						->addFormContainer($this->showTitleFormContainer, 'ShowTitleFormContainer', 25)
						->build();

		return $form;
	}
	
	
	public function renderCreate()
	{
		$this->template->setFile(__DIR__ . '/templates/TextBlock/detail.latte');
		$this->template->siteTitle = _('Create text block');
	}
	
	
	public function renderEdit()
	{
		$this->template->setFile(__DIR__ . '/templates/TextBlock/detail.latte');
		$this->template->siteTitle = _('Edit text block');
	}
	
}
