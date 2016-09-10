<?php namespace App\AmbitiousMailSender\CampaignEvents\Repository;

use App\AmbitiousMailSender\Base\ValueObjects\Collection;
use App\AmbitiousMailSender\CampaignEvents\CampaignEvent;
use App\AmbitiousMailSender\CampaignEvents\CampaignEventRepository;

class SmtpCampaignEventRepository implements CampaignEventRepository {

    /**
     * @param int $id
     * @return CampaignEvent
     */
    public function find($id)
    {
        return null;
    }

    /**
     * This is specific to mailgun
     * @param $domain
     * @return null
     */
    public function setDomain($domain)
    {
        return null;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Collection
     */
    public function all($limit = 0, $offset = 0)
    {
        return null;
    }

    /**
     * @param array $searchParams
     * @param int $limit
     * @param int $offset
     * @return array of CampaignEvent objects
     */
    public function search($searchParams, $limit = 0, $offset = 0)
    {
        return [];
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function save($entity)
    {
        return null;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return null;
    }
}