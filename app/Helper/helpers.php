<?php

//Set Siderbar item active

function setActive(array $route)
{

    if (is_array($route)) {
        foreach ($route as $r) {
            if (request()->routeIs($r)) {
                return 'active';
            }
        }
    }
}



//İndirim Kontrolü
function checkDiscount($product)
{
    $currentDate = date('Y-m-d');

    if ($product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date) {
        return true;
    }
    return false;
}


//İndirim Hesaplama
function caculateDiscount($originalPrice, $discountPrice)
{
    $discountAmount = $originalPrice - $discountPrice;
    $discountPercent = ($discountAmount / $originalPrice) * 100;
    return number_format($discountPercent, 0);
}



function productType(string $type): string
{
    switch ($type) {
        case 'new_arrival':
            return 'New';
            break;
        case 'featured':
            return 'Featured';
            break;
        case 'top_product':
            return 'Top';
            break;

        case 'best_product':
            return 'Best';
            break;

        default:
            return '';
            break;
    }
}
