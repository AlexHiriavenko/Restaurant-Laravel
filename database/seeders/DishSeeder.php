<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dish;

class DishSeeder extends Seeder
{
    public function run()
    {
        $dishes = [
            [
                'name' => 'кава Americano',
                'description' => 'ароматна кава з Бразилії',
                'price' => 40,
                'discount_percent' => null,
                'category_id' => 5, // drinks
                'img' => 'imgs/categories/drinks/americano.jpg',
            ],
            [
                'name' => 'чай',
                'description' => 'індійський чорний чай',
                'price' => 30,
                'discount_percent' => null,
                'category_id' => 5, // drinks
                'img' => 'imgs/categories/drinks/chaj.jpg',
            ],
            [
                'name' => 'узвар',
                'description' => 'солодкий напій із сушених фруктів і свіжих ягід',
                'price' => 50,
                'discount_percent' => null,
                'category_id' => 5, // drinks
                'img' => 'imgs/categories/drinks/uzvar.jpg',
            ],
            [
                'name' => 'Салат з креветками',
                'description' => 'Креветка, листя салату, перець, огірок, лимон, соус бальзамік, соус прованський, кунжут, томати чері. Вага: 250г',
                'price' => 325,
                'discount_percent' => 15,
                'category_id' => 3, // salads
                'img' => 'imgs/categories/salads/salat-z-krevetkami-gril.jpg',
            ],
            [
                'name' => 'Цезар',
                'description' => 'бекон, пармезан,куряче філе,томати, яйце, салат айсберг,крутони,заправка Вага: 250',
                'price' => 235,
                'discount_percent' => 10,
                'category_id' => 3, // salads
                'img' => 'imgs/categories/salads/tsezar.jpg',
            ],
            [
                'name' => 'Олів\'є домашнє',
                'description' => 'Картопля, морква, яйце, огірок свіжий та солоний, горошок, майонез, балик Вага: 300г',
                'price' => 210,
                'discount_percent' => null,
                'category_id' => 3, // salads
                'img' => 'imgs/categories/salads/olv-domashn.jpg',
            ],
            [
                'name' => 'Оселедець під шубою',
                'description' => 'Картопля, морква, буряк, оселедець, цибуля маринована, яблуко, яйця перепелині, майонез, зелень.',
                'price' => 225,
                'discount_percent' => null,
                'category_id' => 3, // salads
                'img' => 'imgs/categories/salads/oseledets-pd-shuboyu.jpg',
            ],
            [
                'name' => 'Грецький',
                'description' => 'сир Фета,огірок,томати,болгрський перець,цибуля, маслини Вага: 250г',
                'price' => 199,
                'discount_percent' => null,
                'category_id' => 3, // salads
                'img' => 'imgs/categories/salads/gretskiy.jpg',
            ],
            [
                'name' => 'Мімоза з тунцем',
                'description' => 'Тунець консервований, картопля, морква, цибуля маринована, яйця курячі, сир гауда, майонез, зелень. Вага: 350г',
                'price' => 220,
                'discount_percent' => null,
                'category_id' => 3, // salads
                'img' => 'imgs/categories/salads/mimoza.jpg',
            ],
            [
                'name' => 'Сирний крем-суп',
                'description' => 'Картопля, бульйон, вершкове масло, вершки, сир плавлений, крутони, бекон Вага: 350г',
                'price' => 190,
                'discount_percent' => null,
                'category_id' => 2, // soups
                'img' => 'imgs/categories/soups/sirniy-krem-sup.jpg',
            ],
            [
                'name' => 'Фінська уха',
                'description' => 'Картопля, цибуля, вершки, зелень, морква, масло, лосось, шафран. Вага: 300г',
                'price' => 230,
                'discount_percent' => 20,
                'category_id' => 2, // soups
                'img' => 'imgs/categories/soups/fnska-ukha.jpg',
            ],
            [
                'name' => 'Крем-суп з білими грибами',
                'description' => 'Гриби білі, шампіньйони, цибуля, курячий бульйон, вершки, крутони, зелень. Вага: 300',
                'price' => 195,
                'discount_percent' => null,
                'category_id' => 2, // soups
                'img' => 'imgs/categories/soups/krem-sup-z-blimi-gribami.jpg',
            ],
            [
                'name' => 'Курячий бульйон з локшиною',
                'description' => 'куряче філе, локшина, бульйон курячий, зелень, яйце куряче Вага: 300',
                'price' => 130,
                'discount_percent' => 10,
                'category_id' => 2, // soups
                'img' => 'imgs/categories/soups/kuryachiy-bulyon.jpg',
            ],
            [
                'name' => 'Борщ український',
                'description' => 'свинина,картопля,морква,буряк, томатна заправка,зелень,сметана, капуста, пампушки з часниковою заправкою. Вага: 350/50г',
                'price' => 170,
                'discount_percent' => null,
                'category_id' => 2, // soups
                'img' => 'imgs/categories/soups/borsch-ukranskiy.jpg',
            ],
            [
                'name' => 'Котлета по-київськи з пюре',
                'description' => 'Вага: 130/150г',
                'price' => 240,
                'discount_percent' => null,
                'category_id' => 1, // main_dishes
                'img' => 'imgs/categories/main_dishes/kotleta-po-kivski-z-pyure-.jpg',
            ],
            [
                'name' => 'Дієтична індичка з овочами',
                'description' => 'філе індички, броколі, спаржа, перець, морква, спеції. Вага: 200',
                'price' => 195,
                'discount_percent' => null,
                'category_id' => 1, // main_dishes
                'img' => 'imgs/categories/main_dishes/dtichna-ndichka-z-ovochami.jpg',
            ],
            [
                'name' => 'М\'ясо "ЕдОК"',
                'description' => 'Свинина, помідор, гриби, сир моцарела, гірчична заправка, печериці, часник. Вага: 230г',
                'price' => 230,
                'discount_percent' => 15,
                'category_id' => 1, // main_dishes
                'img' => 'imgs/categories/main_dishes/myaso_edok.jpg',
            ],
            [
                'name' => 'Ребра в гірчично-медовому соусі',
                'description' => 'Вага: 400/40',
                'price' => 355,
                'discount_percent' => 20,
                'category_id' => 1, // main_dishes
                'img' => 'imgs/categories/main_dishes/rebra-v-grchichno-medovomu-s.jpg',
            ],
            [
                'name' => 'Шашлик зі свинини',
                'description' => 'Вага: 200г',
                'price' => 280,
                'discount_percent' => null,
                'category_id' => 1, // main_dishes
                'img' => 'imgs/categories/main_dishes/shashlik-z-svinini.jpg',
            ],
            [
                'name' => 'Смажена картопля по-мисливські',
                'description' => 'Картопля, мисливські ковбаски, бекон, цибуля, кетчуп. Вага: 250',
                'price' => 160,
                'discount_percent' => 10,
                'category_id' => 1, // main_dishes
                'img' => 'imgs/categories/main_dishes/smazhena-kartoplya-po-misliv.jpg',
            ],
            [
                'name' => 'Червоні вареники з сиром та вишневим соусом',
                'description' => 'Заварне вишневе тісто, творог, вишневий соус. Вага: 200/100г',
                'price' => 180,
                'discount_percent' => null,
                'category_id' => 4, // desserts
                'img' => 'imgs/categories/desserts/chervon-vareniki-z-tvorogo.jpg',
            ],
            [
                'name' => 'Вафельний тортик',
                'description' => 'Вага: 120г',
                'price' => 90,
                'discount_percent' => null,
                'category_id' => 4, // desserts
                'img' => 'imgs/categories/desserts/vafelniy-tortik.jpg',
            ],
            [
                'name' => 'Сирники зі сметаною',
                'description' => 'Вага: 120/50',
                'price' => 145,
                'discount_percent' => null,
                'category_id' => 4, // desserts
                'img' => 'imgs/categories/desserts/sirniki.jpg',
            ],
            [
                'name' => 'Морозиво',
                'description' => 'Вага: 150',
                'price' => 100,
                'discount_percent' => 15,
                'category_id' => 4, // desserts
                'img' => 'imgs/categories/desserts/morozivo.jpg',
            ],
        ];


        foreach ($dishes as $dish) {
            Dish::create($dish);
        }
    }
}

