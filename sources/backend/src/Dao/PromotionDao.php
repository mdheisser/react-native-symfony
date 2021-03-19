<?php
/*
 * This file has been automatically generated by doctrine.
 * You can edit this file as it will not be overwritten.
 */

declare(strict_types=1);

namespace App\Dao;

use App\Dao\Generated\AbstractPromotionDao;
use App\Enums\StatusEnum;
use App\Model\Promotion;
use doctrine\doctrine\ResultIterator;

/**
 * The PromotionDao class will maintain the persistence of Promotion class into the promotions table.
 */
class PromotionDao extends AbstractPromotionDao
{
    /**
     * Get all approved Promotion records.
     *
     * @return Promotion[]|ResultIterator
     */
    public function findAllApprovedPromotions() : ResultIterator
    {
        return $this->findByStatus(StatusEnum::APPROVED);
    }

    /**
     * Get all approved, active and target not reached Promotion records, ordered by updated_date DESC
     * withOrder() is not supported for rawSQL result.. So if you want custom order you have to add them one by one
     *
     * @return Promotion[]|ResultIterator
     */
    public function findAllApprovedAndActivePromotions() : ResultIterator
    {
        $result = $this->findFromRawSql('SELECT promotions.*, COUNT(refers.uuid)
                                                FROM promotions LEFT OUTER JOIN refers ON promotions.uuid = refers.promotion_id 
                                                WHERE status = :status AND NOW() >= start_date AND (is_online_promo OR NOW() <= end_date)
                                                GROUP BY promotions.uuid 
                                                HAVING COUNT(refers.uuid) < target_number 
                                                ORDER BY promotions.created_date DESC;', [
            'status' => StatusEnum::APPROVED,
        ]);
        return $result;
    }
}
