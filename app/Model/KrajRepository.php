<?php
declare(strict_types=1);

namespace App\Model;

use Nette\Database\Explorer;

final class KrajRepository
{
    public function __construct(private Explorer $db) {}

    public function findAll(): array
    {
        return $this->db->table('kraj')->order('Kraj')->fetchAll();
    }

    public function exists(int $krajId): bool
    {
        return (bool) $this->db->table('kraj')->where('ID', $krajId)->count('*');
    }

    public function get(int $krajId)
    {
        return $this->db->table('kraj')->get($krajId);
    }
}
