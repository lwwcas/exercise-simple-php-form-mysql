<?php

namespace Database\Factories;

use Database\Factories\FactoryInterface;

class EmployeeFactory implements FactoryInterface
{
    private array $jobs = [
        'Software Developer',
        'Designer',
        'Project Manager',
        'QA Engineer',
        'DevOps Engineer'
    ];

    public function create(array $overrides = []): array
    {
        $data = [
            'name' => $this->randomName(),
            'age' => rand(22, 60),
            'job' => $this->jobs[array_rand($this->jobs)],
            'salary' => rand(2000, 7000),
            'admission_date' => date('Y-m-d', strtotime('-' . rand(1, 10) . ' years'))
        ];

        return array_merge($data, $overrides);
    }

    private function randomName(): string
    {
        $firstNames = ['John', 'Anna', 'Mark', 'Lucas', 'Sarah'];
        $lastNames = ['Smith', 'Brown', 'Johnson', 'Silva', 'Miller'];

        return $firstNames[array_rand($firstNames)] . ' ' .
               $lastNames[array_rand($lastNames)];
    }
}
