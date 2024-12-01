<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DishModifierSeeder extends Seeder
{
    public function run()
    {
        $dishModifiers = [
            // Напитки
            ['dish_id' => 1, 'modifier_id' => 4], // Americano с сахаром
            ['dish_id' => 1, 'modifier_id' => 8], // Americano с сгущённым молоком
            ['dish_id' => 2, 'modifier_id' => 4], // Чай с сахаром
            ['dish_id' => 2, 'modifier_id' => 5], // Чай с лимоном
            ['dish_id' => 2, 'modifier_id' => 6], // Чай с мёдом

            // Салаты
            ['dish_id' => 4, 'modifier_id' => 1], // Салат з креветками с солью
            ['dish_id' => 4, 'modifier_id' => 2], // Салат з креветками с перцем
            ['dish_id' => 4, 'modifier_id' => 3], // Салат з креветками с хлебом
            ['dish_id' => 5, 'modifier_id' => 1], // Цезарь с солью
            ['dish_id' => 5, 'modifier_id' => 2], // Цезарь с перцем
            ['dish_id' => 5, 'modifier_id' => 3], // Цезарь с хлебом
            ['dish_id' => 6, 'modifier_id' => 1], // Олів'є домашнє с солью
            ['dish_id' => 6, 'modifier_id' => 2], // Олів'є домашнє с перцем
            ['dish_id' => 6, 'modifier_id' => 3], // Олів'є домашнє с хлебом
            ['dish_id' => 7, 'modifier_id' => 1], // Оселедець під шубою с солью
            ['dish_id' => 7, 'modifier_id' => 2], // Оселедець під шубою с перцем
            ['dish_id' => 7, 'modifier_id' => 3], // Оселедець під шубою с хлебом
            ['dish_id' => 8, 'modifier_id' => 1], // Грецький с солью
            ['dish_id' => 8, 'modifier_id' => 2], // Грецький с перцем
            ['dish_id' => 8, 'modifier_id' => 3], // Грецький с хлебом
            ['dish_id' => 9, 'modifier_id' => 1], // Мімоза з тунцем с солью
            ['dish_id' => 9, 'modifier_id' => 2], // Мімоза з тунцем с перцем
            ['dish_id' => 9, 'modifier_id' => 3], // Мімоза з тунцем с хлебом

            // Первые блюда
            ['dish_id' => 10, 'modifier_id' => 1], // Сирний крем-суп с солью
            ['dish_id' => 10, 'modifier_id' => 2], // Сирний крем-суп с перцем
            ['dish_id' => 10, 'modifier_id' => 3], // Сирний крем-суп с хлебом
            ['dish_id' => 10, 'modifier_id' => 9], // Сирний крем-суп с зеленью
            ['dish_id' => 10, 'modifier_id' => 10], // Сирний крем-суп с сухариками
            ['dish_id' => 11, 'modifier_id' => 1], // Фінська уха с солью
            ['dish_id' => 11, 'modifier_id' => 2], // Фінська уха с перцем
            ['dish_id' => 11, 'modifier_id' => 3], // Фінська уха с хлебом
            ['dish_id' => 11, 'modifier_id' => 9], // Фінська уха с зеленью
            ['dish_id' => 11, 'modifier_id' => 10], // Фінська уха с сухариками
            ['dish_id' => 12, 'modifier_id' => 1], // Крем-суп з білими грибами с солью
            ['dish_id' => 12, 'modifier_id' => 2], // Крем-суп з білими грибами с перцем
            ['dish_id' => 12, 'modifier_id' => 3], // Крем-суп з білими грибами с хлебом
            ['dish_id' => 12, 'modifier_id' => 9], // Крем-суп з білими грибами с зеленью
            ['dish_id' => 12, 'modifier_id' => 10], // Крем-суп з білими грибами с сухариками            
            ['dish_id' => 13, 'modifier_id' => 1], // Курячий бульйон з локшиною с солью
            ['dish_id' => 13, 'modifier_id' => 2], // Курячий бульйон з локшиною с перцем
            ['dish_id' => 13, 'modifier_id' => 3], // Курячий бульйон з локшиною с хлебом
            ['dish_id' => 13, 'modifier_id' => 9], // Курячий бульйон з локшиною с зеленью
            ['dish_id' => 13, 'modifier_id' => 10], // Курячий бульйон з локшиною с сухариками
            ['dish_id' => 14, 'modifier_id' => 1], // Борщ український с солью
            ['dish_id' => 14, 'modifier_id' => 2], // Борщ український с перцем
            ['dish_id' => 14, 'modifier_id' => 3], // Борщ український с хлебом
            ['dish_id' => 14, 'modifier_id' => 9], // Борщ український с зеленью
            ['dish_id' => 14, 'modifier_id' => 10], // Борщ український с сухариками

            // Основные блюда
            ['dish_id' => 15, 'modifier_id' => 1], // Котлета по-київськи с солью
            ['dish_id' => 15, 'modifier_id' => 2], // Котлета по-київськи с перцем
            ['dish_id' => 15, 'modifier_id' => 3], // Котлета по-київськи с хлебом
            ['dish_id' => 15, 'modifier_id' => 11], // Котлета по-київськи с часниковим соусом
            ['dish_id' => 16, 'modifier_id' => 1], // Дієтична індичка с солью
            ['dish_id' => 16, 'modifier_id' => 2], // Дієтична індичка с перцем
            ['dish_id' => 16, 'modifier_id' => 3], // Дієтична індичка с хлебом
            ['dish_id' => 16, 'modifier_id' => 11], // Дієтична індичка с часниковим соусом
            ['dish_id' => 17, 'modifier_id' => 1], // М'ясо "ЕдОК" с солью
            ['dish_id' => 17, 'modifier_id' => 2], // М'ясо "ЕдОК" с перцем
            ['dish_id' => 17, 'modifier_id' => 3], // М'ясо "ЕдОК" с хлебом
            ['dish_id' => 17, 'modifier_id' => 11], // М'ясо "ЕдОК" с часниковим соусом
            ['dish_id' => 18, 'modifier_id' => 1], // Ребра в гірчично-медовому соусі с солью
            ['dish_id' => 18, 'modifier_id' => 2], // Ребра в гірчично-медовому соусі с перцем
            ['dish_id' => 18, 'modifier_id' => 3], // Ребра в гірчично-медовому соусі с хлебом
            ['dish_id' => 18, 'modifier_id' => 11], // Ребра в гірчично-медовому соусі с часниковим соусом
            ['dish_id' => 19, 'modifier_id' => 1], // Шашлик зі свинини с солью
            ['dish_id' => 19, 'modifier_id' => 2], // Шашлик зі свинини с перцем
            ['dish_id' => 19, 'modifier_id' => 3], // Шашлик зі свинини с хлебом
            ['dish_id' => 19, 'modifier_id' => 11], // Шашлик зі свинини с часниковим соусом
            ['dish_id' => 20, 'modifier_id' => 1], // Смажена картопля с солью
            ['dish_id' => 20, 'modifier_id' => 2], // Смажена картопля с перцем
            ['dish_id' => 20, 'modifier_id' => 3], // Смажена картопля с хлебом
            ['dish_id' => 20, 'modifier_id' => 11], // Смажена картопля с часниковим соусом

            // Десерты
            ['dish_id' => 21, 'modifier_id' => 6], // Червоні вареники с медом
            ['dish_id' => 21, 'modifier_id' => 8], // Червоні вареники с сгущённым молоком
            ['dish_id' => 22, 'modifier_id' => 6], // Вафельний тортик с медом
            ['dish_id' => 22, 'modifier_id' => 7], // Вафельний тортик с шоколадной крошкой
            ['dish_id' => 22, 'modifier_id' => 8], // Вафельний тортик с сгущённым молоком
            ['dish_id' => 23, 'modifier_id' => 6], // Сирники зі сметаною с медом
            ['dish_id' => 23, 'modifier_id' => 8], // Сирники зі сметаною с сгущённым молоком
            ['dish_id' => 24, 'modifier_id' => 6], // Морозиво с медом
            ['dish_id' => 24, 'modifier_id' => 7], // Морозиво с шоколадной крошкой
            ['dish_id' => 24, 'modifier_id' => 8], // Морозиво с сгущённым молоком
        ];

        DB::table('dish_modifiers')->insert($dishModifiers);
    }
}
