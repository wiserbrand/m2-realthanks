<?php
namespace RealThanks\GiftProvider\Ui\Component\SalesOrder\Listing\Action;

use RealThanks\GiftProvider\Ui\Component\SendGiftActionColumn;

class SendGift extends SendGiftActionColumn
{
    /**
     * @inheritDoc
     */
    public function prepareDataSource(array $dataSource)
    {
        $dataSource = parent::prepareDataSource($dataSource);

        if (empty($dataSource['data']['items'])) {
            return $dataSource;
        }

        foreach ($dataSource['data']['items'] as & $item) {
            $item[$this->getData('name')]['rt'] = [
                'callback' => [
                    [
                        'provider' => 'index = send_gift_form_loader',
                        'target' => 'destroyInserted',
                    ],
                    [
                        'provider' => 'index = send_gift_form_loader',
                        'target' => 'updateData',
                        'params' => [
                            'email' => $item['customer_email']
                        ]
                    ],
                    [
                        'provider' => 'index = send_gift_modal',
                        'target' => 'openModal'
                    ]
                ],
                'href' => '#',
                'label' => __('Send gift')
            ];
        }

        return $dataSource;
    }
}
