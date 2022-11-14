<?php

namespace App\Service;

class Container
{
    //SMALL = 2, MEDIUM = 5 and LARGE = 8
    public const SMALL = 2;
    public const MEDIUM = 5;
    public const LARGE = 8;


    public function inbox(int $numberCake): array
    {
        $delivery = [
            0,
            0,
            0
        ];

        //Automatically prepare boxes according number of cakes
        $remainingCakes = $numberCake;
        while($remainingCakes > 0){
            if($remainingCakes > self::MEDIUM){
                $delivery[0] += 1;
                $remainingCakes -= self::LARGE;
            }
            else if($remainingCakes > self::SMALL){
                $delivery[1] += 1;
                $remainingCakes -= self::MEDIUM;
            }
            else{
                $delivery[2] += 1;
                $remainingCakes -= self::SMALL;
            }
        }

        //Optimize boxing
        return $delivery;
    }
}
