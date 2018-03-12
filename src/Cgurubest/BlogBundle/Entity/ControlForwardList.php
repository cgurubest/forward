<?php

namespace Cgurubest\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserList
 *
 * @ORM\Table(name="forward_document")
 * @ORM\Entity
 */

class ControlForwardList
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $user_id;

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getDocId()
    {
        return $this->doc_id;
    }

    /**
     * @param int $doc_id
     */
    public function setDocId($doc_id)
    {
        $this->doc_id = $doc_id;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->is_active;
    }

    /**
     * @param bool $is_active
     */
    public function setIsActive($is_active)
    {
        $this->is_active = $is_active;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="doc_id", type="integer")
     */
    private $doc_id;


    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $is_active;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }



}
