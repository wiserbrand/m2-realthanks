<?php
declare(strict_types=1);

namespace RealThanks\GiftProvider\Model;

use Magento\Framework\Model\AbstractModel;
use RealThanks\GiftProvider\Api\Data\RtGiftInterface;
use RealThanks\GiftProvider\Model\ResourceModel\RtGift as ResourceModel;

class RtGift extends AbstractModel implements RtGiftInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'wb_rt_gift_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritdoc
     */
    public function getDescription(): ?string
    {
        return $this->getData(self::DESCRIPTION);
    }

    public function getRtId(): int
    {
        return (int) $this->getData(self::RT_ID);
    }

    /**
     * @inheritdoc
     */
    public function getCost(): float
    {
        return (float) $this->getData(self::COST);
    }

    public function getImageUrl(): string
    {
        return $this->getData(self::IMAGE_URL);
    }

    /**
     * Get creation time
     *
     * @return string
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Get update time
     *
     * @return string
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Is active
     *
     * @return bool
     */
    public function isActive():bool
    {
        return (bool)$this->getData(self::ACTIVE);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    public function setName(string $name)
    {
        return $this->setData(self::NAME, $name);
    }

    public function setDescription(string $description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    public function setRtId($rtId)
    {
        return $this->setData(self::RT_ID, $rtId);
    }

    public function setCost($cost)
    {
        return $this->setData(self::COST, $cost);
    }

    public function setImageUrl($url)
    {
        return $this->setData(self::IMAGE_URL, $url);
    }

    public function setActive($isActive)
    {
        return $this->setData(self::ACTIVE, $isActive);
    }
}
