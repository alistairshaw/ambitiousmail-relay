<?php namespace App\AmbitiousMailSender\CampaignEvents\Repository;

use App\AmbitiousMailSender\Base\Exceptions\MailgunApiFailureException;
use App\AmbitiousMailSender\Base\Repository\AbstractMailgunRepository;
use App\AmbitiousMailSender\Base\ValueObjects\Collection;
use App\AmbitiousMailSender\CampaignEvents\CampaignEventFactory;
use App\AmbitiousMailSender\CampaignEvents\CampaignEventRepository;
use Mailgun\Mailgun;

class MailgunCampaignEventRepository extends AbstractMailgunRepository implements CampaignEventRepository
{

    /**
     * @param CampaignEventFactory $campaignEventFactory
     */
    public function __construct(CampaignEventFactory $campaignEventFactory)
    {
        parent::__construct();

        $this->factory = $campaignEventFactory;
    }

    /**
     * @param array $searchParams
     * @param int $limit
     * @param int $offset
     * @return Collection
     * @throws MailgunApiFailureException
     */
    public function search($searchParams, $limit = 0, $offset = 0)
    {
        try
        {
            $mg = new Mailgun($this->key);
            $apiParams['event'] = $searchParams['event'];
            if (isset($searchParams['recipient']) && $searchParams['recipient']) $apiParams['recipient'] = $searchParams['recipient'];
            if ($limit > 0) $apiParams['limit'] = $limit;
            if ($limit > 0) $apiParams['page'] = ($offset > 0) ? (int)($offset / $limit) + 1 : 1;

            $result = $mg->get($this->domain . '/campaigns/' . $searchParams['id'] . '/events', $apiParams);
        }
        catch (\Exception $e)
        {
            throw new MailgunApiFailureException($e->getMessage());
        }

        $final = [];
        foreach ($result->http_response_body as $event)
        {
            $recordArray = (array)$event;
            $final[] = $this->factory->create($recordArray);
        }

        return Collection::make($final);
    }

}