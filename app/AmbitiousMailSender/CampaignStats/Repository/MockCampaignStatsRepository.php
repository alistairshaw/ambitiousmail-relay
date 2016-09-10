<?php namespace App\AmbitiousMailSender\CampaignStats\Repository;

use App\AmbitiousMailSender\Base\ValueObjects\Collection;
use App\AmbitiousMailSender\CampaignStats\CampaignStats;
use App\AmbitiousMailSender\CampaignStats\CampaignStatsRepository;

class MockCampaignStatsRepository implements CampaignStatsRepository {

    /**
     * @param int $id
     * @return CampaignStats
     */
    public function find($id)
    {
        $data['clicked'] = 0;
        $data['opened'] = 0;
        $data['submitted'] = 0;
        $data['unsubscribed'] = 0;
        $data['bounced'] = 0;
        $data['delivered'] = 0;
        $data['complained'] = 0;
        $data['dropped'] = 0;

        return new CampaignStats($data);
    }

    /**
     * This is specific to mailgun
     * @param $domain
     */
    public function setDomain($domain)
    {
        // do nothing
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
     * @return mixed
     */
    public function search($searchParams, $limit = 0, $offset = 0)
    {
        return null;
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