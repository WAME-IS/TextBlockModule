<?php

namespace Wame\TextBlockModule\Repositories;

use h4kuna\Gettext\GettextSetup;
use Kdyby\Doctrine\EntityManager;
use Nette\DI\Container;
use Nette\Security\User;
use Wame\Core\Exception\RepositoryException;
use Wame\Core\Repositories\TranslatableRepository;
use Wame\TextBlockModule\Entities\TextBlockEntity;

class TextBlockRepository extends TranslatableRepository
{		
	public function __construct(Container $container, EntityManager $entityManager, GettextSetup $translator, User $user, $entityName = null) {
		parent::__construct($container, $entityManager, $translator, $user, TextBlockEntity::class);
	}

	
	/**
	 * Create text block
	 * 
	 * @param TextBlockEntity $textBlockEntity
	 * @return TextBlockEntity
	 * @throws RepositoryException
	 */
	public function create($textBlockEntity)
	{
		$this->entityManager->persist($textBlockEntity);
		
		$this->entityManager->persist($textBlockEntity->langs);
		
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