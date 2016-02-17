<?php
// src/Blogger/BlogBundle/Entity/Blog.php

namespace BlogBundle\Entity\Blog;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog")
 * @ORM\HasLifecycleCallbacks
 */
class Blog
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $author;

    /**
     * @ORM\Column(type="text")
     */
    protected $blog;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $image;

    /**
     * @ORM\Column(type="text")
     */
    protected $tags;

    protected $comments;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated;
    
    public function __construct()
    {
    	$this->setCreated(new \DateTime());
    	$this->setUpdated(new \DateTime());
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedValue()
    {
    	$this->setUpdated(new \DateTime());
    }
    
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getAuthor() {
		return $this->author;
	}
	public function setAuthor($author) {
		$this->author = $author;
		return $this;
	}
	public function getBlog() {
		return $this->blog;
	}
	public function setBlog($blog) {
		$this->blog = $blog;
		return $this;
	}
	public function getImage() {
		return $this->image;
	}
	public function setImage($image) {
		$this->image = $image;
		return $this;
	}
	public function getTags() {
		return $this->tags;
	}
	public function setTags($tags) {
		$this->tags = $tags;
		return $this;
	}
	public function getComments() {
		return $this->comments;
	}
	public function setComments($comments) {
		$this->comments = $comments;
		return $this;
	}
	public function getCreated() {
		return $this->created;
	}
	public function setCreated($created) {
		$this->created = $created;
		return $this;
	}
	public function getUpdated() {
		return $this->updated;
	}
	public function setUpdated($updated) {
		$this->updated = $updated;
		return $this;
	}
	
}