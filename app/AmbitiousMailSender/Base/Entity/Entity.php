<?php namespace App\AmbitiousMailSender\Base\Entity;

use App\AmbitiousMailSender\Base\ValueObjects\DateTime;

interface Entity {

	/**
	 * @return int
	 */
	public function id();

	/**
	 * @param int $id
	 */
	public function setId($id);

	/**
	 * @return string
	 */
	public function createdAt();

	/**
	 * @param DateTime $createdAt
	 */
	public function setCreatedAt(DateTime $createdAt);

	/**
	 * @return string
	 */
	public function updatedAt();

	/**
	 * @param DateTime $updatedAt
	 */
	public function setUpdatedAt(DateTime $updatedAt);
}