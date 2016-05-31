<?php

namespace Wame\TextBlockModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\Columns;

/**
 * @ORM\Table(name="wame_text_block")
 * @ORM\Entity
 */
class TextBlockEntity extends \Wame\Core\Entities\BaseEntity 
{
	use Columns\Identifier;

	/**
     * @ORM\OneToMany(targetEntity="TextBlockLangEntity", mappedBy="textBlock")
     */
    protected $langs;

	/**
     * @ORM\ManyToOne(targetEntity="\Wame\ComponentModule\Entities\ComponentEntity", inversedBy="id")
     * @ORM\JoinColumn(name="component_id", referencedColumnName="id", nullable=false)
     */
    protected $component;
	
}