<?php

namespace App\Repository\trait;

trait CommunMethodsRepositoryTrait
{
    public function customFieldFindAll(string $field): array
    {
        $types = $this->createQueryBuilder('t')
            ->getQuery()
            ->getArrayResult();
        return array_column($types, $field);
    }
}
