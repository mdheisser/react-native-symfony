<?php
/*
 * This file has been automatically generated by doctrine.
 * You can edit this file as it will not be overwritten.
 */

declare(strict_types=1);

namespace App\Dao;

use App\Dao\Generated\AbstractReferDao;

/**
 * The ReferDao class will maintain the persistence of Refer class into the refers table.
 */
class ReferDao extends AbstractReferDao
{
    /**
     * @param string $redeemedId
     * @param string $promotionId
     * @return \App\Model\Refer[]|\doctrine\doctrine\ResultIterator
     */
    public function findByRedeemedAndPromotion(string $redeemedId, string $promotionId)
    {
        return $this->find('redeemed = :redeemedId AND promotion = :promotionId', [
            'redeemedId' => $redeemedId,
            'promotionId' => $promotionId,
        ]);
    }
}
