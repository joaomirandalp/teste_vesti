<?php

namespace App\Models;

class VariacaoModel
{
    private string $sku;
    private string $size;
    private string $color;
    private int $quantity;
    private int $order;
    private string $unit_type;

    /**
     * Summary of __construct
     * @param mixed $sku
     * @param mixed $size
     * @param mixed $color
     * @param mixed $quantity
     * @param mixed $order
     * @param mixed $unit_type
     */
    public function __construct(
        string $sku,
        string $size,
        string $color,
        int $quantity,
        int $order,
        string $unit_type
    ) {
        $this->sku = $sku;
        $this->size = $size;
        $this->color = $color;
        $this->quantity = $quantity;
        $this->order = $order;
        $this->unit_type = $unit_type;
    }

    /**
     * @return 
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @return 
     */
    public function getVariacao(): object
    {
        return (object) [
            'sku' => $this->sku,
            'size' => $this->size,
            'color' => $this->color,
            'quantity' => $this->quantity,
            'order' => $this->order,
            'unit_type' => $this->unit_type
        ];
    }
}