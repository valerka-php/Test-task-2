<?php

/*
 * Task 1
You need to write a function which receives one (integer) argument.
The result of the function should be a string with arrows (“<>”).
Number of arrows should be equal to the argument number (on both sides).
 *
 */

function createArrows(int $int): string
{
    $left = '';
    $right = '';

    for ($i = 0; $i < $int; $i++) {
        $left .= '<';
        $right .= '>';
    }

    return '("' . $left . $right . '")';
}

// echo createArrows(10);


/*
 * Task 2
 * You need to write a function to sort array of delivery methods;
 */

$deliveryMethodsArray = [
    [
        'code' => 'dhl',
        'customer_costs' => [
            22 => '1.000',
            11 => '3.000',
        ]
    ],
    [
        'code' => 'fedex',
        'customer_costs' => [
            22 => '4.000',
            11 => '6.000',
        ]
    ]
];


function sortDeliveryMethods(array $products): array
{
    $result = [];

    foreach ($products as $items) {
        foreach ($items['customer_costs'] as $id => $value) {
            $result[$id][$items['code']] = $value;
        }
    }
    return $result;
}

//echo '<pre>';
//var_dump(sortDeliveryMethods($deliveryMethodsArray));
//echo '</pre>';
