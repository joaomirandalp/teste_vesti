<?php

namespace App\Models;

class ProdutoModel
{
    private string $integration_id;
    private string $code;
    private string $name;
    private bool $active;
    private string $description;
    private string $composition;
    private string $brand;
    private float $price;
    private bool $promotion;
    private float $price_promotional;
    private int $weight;
    private int $height;
    private int $width;
    private int $length;
    private array $variations;

    /**
     * Summary of __construct
     * @param mixed $integration_id
     * @param mixed $code
     * @param mixed $name
     * @param mixed $active
     * @param mixed $description
     * @param mixed $composition
     * @param mixed $brand
     * @param mixed $price
     * @param mixed $price_promotional
     */
    public function __construct(
        string $integration_id,
        string $code,
        string $name,
        string $description,
        string $composition,
        string $brand,
        float $price,
        float $price_promotional,
        bool $active = true,
    ) {
        $this->integration_id = $integration_id;
        $this->code = $code;
        $this->name = $name;
        $this->active = $active;
        $this->description = $description;
        $this->composition = $composition;
        $this->brand = $brand;
        $this->price = $price;
        $this->setPromotionPrice($price_promotional);
        $this->variations = [];
    }

    public function setPromotionPrice($promotionPrice) {
        $this->price_promotional = $promotionPrice;
        if ($promotionPrice > 0) {
            $this->promotion = true;
        } else {
            $this->promotion = false;
        }
    }

    /**
     * @return 
     */
    public function getIntegrationId(): string
    {
        return $this->integration_id;
    }

    /**
     * @param  $variations 
     * @return self
     */
    public function setVariations(array $variations): self
    {
        $this->variations = $variations;
        return $this;
    }

    /**
     * @return 
     */
    public function getProduto(): object
    {
        return (object) [
            'integration_id' => $this->integration_id,
            'code' => $this->code,
            'name' => $this->name,
            'active' => $this->active,
            'description' => $this->description,
            'composition' => $this->composition,
            'brand' => $this->brand,
            'price' => $this->price,
            'promotion' => $this->promotion,
            'price_promotional' => $this->price_promotional,
            'variations' => $this->variations
        ];
    }
}