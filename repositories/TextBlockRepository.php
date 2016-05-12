<?php

namespace Wame\TextBlockModule\Repositories;

use Wame\TextBlockModule\Entities\TextBlockEntity;

class TextBlockRepository extends \Wame\Core\Repositories\BaseRepository
{		
	public function __construct(\Nette\DI\Container $container, \Kdyby\Doctrine\EntityManager $entityManager, \h4kuna\Gettext\GettextSetup $translator, \Nette\Security\User $user, $entityName = null) {
		parent::__construct($container, $entityManager, $translator, $user, TextBlockEntity::class);
	}

	
	/**
	 * Create text block
	 * 
	 * @param TextBlockEntity $textBlockEntity
	 * @return TextBlockEntity
	 * @throws \Wame\Core\Exception\RepositoryException
	 */
	public function create($textBlockEntity)
	{
		$create = $this->entityManager->persist($textBlockEntity);
		
		$this->entityManager->persist($textBlockEntity->langs);
		
		if (!$create) {
			throw new \Wame\Core\Exception\RepositoryException(_('Text block could not be created.'));
		}
		
		return $textBlockEntity;
	}
	
	
	/**
	 * Update text block
	 * 
	 * @param TextBlockEntity $textBlockEntity
	 */
	public function update($textBlockEntity)
	{
		return $textBlockEntity;
	}
	
}