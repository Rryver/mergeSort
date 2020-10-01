<?php
namespace app\models;

/**
 * Class MergeSort
 * @package app\models
 */
class MergeSort
{
    /**
     * @param int[] $mass
     * @param int $firstIndex Индекс первого элемента
     * @param int $lastIndex Индекс последнего элемента
     */
    public function Sort(&$mass, $firstIndex, $lastIndex) {
        if ($firstIndex < $lastIndex) {
            $mid = round(($firstIndex + $lastIndex) / 2, 0, PHP_ROUND_HALF_DOWN);
            $this->Sort($mass, $firstIndex, $mid);
            $this->Sort($mass, $mid + 1, $lastIndex);
            $this->merge($mass, $firstIndex, $mid, $lastIndex);
        }
    }


    /**
     * @param $mass
     * @param int $left Левая граница сортируемой части массива
     * @param int $mid Середина сортируемой части массива
     * @param int $right Правая граница сортируемой части массива
     */
    public function merge(&$mass, $left, $mid, $right) {
        $tmpLeft = 0;
        $tmpRight = 1;
        $result = [];

        $leftIndex = $left + $tmpLeft;
        $rightIndex = $mid + $tmpRight;
        while (($left + $tmpLeft <= $mid) && ($mid + $tmpRight <= $right)) {
            if ($mass[$leftIndex] < $mass[$rightIndex]) {
                array_push($result, $mass[$leftIndex]);
                $tmpLeft++;
            } else if ($mass[$leftIndex] > $mass[$rightIndex]) {
                array_push($result, $mass[$rightIndex]);
                $tmpRight++;
            } else {
                array_push($result, $mass[$leftIndex], $mass[$rightIndex]);
                $tmpLeft++;
                $tmpRight++;
            }
            $leftIndex = $left + $tmpLeft;
            $rightIndex = $mid + $tmpRight;
        }
        for ($leftIndex; $leftIndex <= $mid; $leftIndex++)
            array_push($result, $mass[$leftIndex]);
        for ($rightIndex; $rightIndex <= $right; $rightIndex++)
            array_push($result, $mass[$rightIndex]);

        $resultIndex = 0;
        for ($i = $left; $i <= $right; $i++) {
            $mass[$i] = $result[$resultIndex];
            $resultIndex++;
        }
    }
}