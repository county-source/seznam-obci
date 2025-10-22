<?php
declare(strict_types=1);

namespace App\Model;

use Nette\Database\Explorer;

final class OkresRepository
{
    public function __construct(private Explorer $db) {}

    /**
     * Vrátí okresy v daném kraji (distinct přes OkresID).
     */
    public function findByKraj(int $krajId): array
    {
        // 'obec' obsahuje sloupce Okres a OkresID – získáme unikátní dvojice
        return $this->db->table('obec')
            ->select('Okres, OkresID')
            ->where('KrajID', $krajId)
            ->group('OkresID')
            ->order('Okres')
            ->fetchAll();
    }

    public function belongsToKraj(int $okresId, int $krajId): bool
    {
        return (bool) $this->db->table('obec')->where('OkresID = ? AND KrajID = ?', $okresId, $krajId)->limit(1)->fetch();
    }

    public function getById(int $okresId): ?array
    {
        $row = $this->db->table('obec')->select('Okres, OkresID')->where('OkresID', $okresId)->limit(1)->fetch();
        return $row ? ['Okres' => $row->Okres, 'OkresID' => (int) $row->OkresID] : null;
    }
}
