<?php
declare(strict_types=1);

namespace App\Model;

use Nette\Database\Explorer;

final class ObecRepository
{
    public function __construct(private Explorer $db) {}

    /**
     * Vrátí obce v okresu (distinct přes ObecID).
     */
    public function findByOkres(int $okresId): array
    {
        return $this->db->table('obec')
            ->select('Obec, ObecID')
            ->where('OkresID', $okresId)
            ->group('ObecID')
            ->order('Obec')
            ->fetchAll();
    }
}
