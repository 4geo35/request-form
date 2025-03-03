<?php

namespace GIS\RequestForm\Interfaces;

interface RequestFormShowInterface
{
    public function showForm(string $key): void;
    public function closeForm(): void;
    public function resetFields(): void;
}
