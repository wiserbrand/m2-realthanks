<?php
declare(strict_types=1);

namespace WiserBrand\RealThanks\Controller\Adminhtml\Config;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Response\Http;
use Psr\Log\LoggerInterface;
use WiserBrand\RealThanks\Model\RealThanks\Sync\SynchronizerInterface;
use WiserBrand\RealThanks\Model\RealThanks\Sync\SynchronizerListInterface;

class Update extends Action implements HttpGetActionInterface
{
    /**
     * @var SynchronizerListInterface
     */
    private $syncList;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param Context $context
     * @param SynchronizerListInterface $syncList
     * @param LoggerInterface $logger
     */
    public function __construct(
        SynchronizerListInterface $syncList,
        LoggerInterface $logger,
        Context $context
    ) {
        $this->syncList = $syncList;
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $result = new \stdClass();
        // @todo if one of sync is failed needs to send error to the template
        try {
            /** @var SynchronizerInterface $synchronizer */
            foreach ($this->syncList as $synchronizer) {
                $synchronizer->synchronize();
            }
            $result->success = true; // @todo is it necessary?
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            $this->getResponse()->setStatusHeader(500, null, __('Cannot update data'));
            $result->error = __('Cannot update data');
        }

        /** @var Http $response */
        $response = $this->getResponse();
        return $response->representJson(json_encode($result));
    }
}
