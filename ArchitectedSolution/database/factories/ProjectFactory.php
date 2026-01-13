<?php

namespace Database\Factories;

use App\Enums\ProjectStatusEnum;

final class ProjectFactory
{
    public function create(array $overrides = []): array
    {
        $data = [
            'description' => 'Project ' . strtoupper(uniqid()),
            'value' => random_int(5000, 50000),
            'status' => ProjectStatusEnum::cases()[array_rand(ProjectStatusEnum::cases())]->value,
            'delivery_date' => date('Y-m-d')
        ];

        return array_merge($data, $overrides);
    }
}
