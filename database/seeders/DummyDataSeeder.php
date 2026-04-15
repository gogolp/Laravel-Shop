<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\NewsFeed;
use App\Models\Location;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        // 1. Locations
        $locations = [
            [
                'name' => 'Центральне кафе',
                'address' => 'вул. Хрещатик, 1',
                'phone' => '+380501234567',
                'working_hours' => '08:00 - 22:00',
                'description' => 'Затишне кафе в центрі міста.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Кав\'ярня на Подолі',
                'address' => 'вул. Сагайдачного, 10',
                'phone' => '+380671234567',
                'working_hours' => '09:00 - 21:00',
                'description' => 'Найкраща кава на Подолі.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        Location::insert($locations);

        // 2. Categories
        $categories = [
            ['name' => 'Кава', 'icon_url' => 'coffee-icon.png', 'parent_id' => null],
            ['name' => 'Чай', 'icon_url' => 'tea-icon.png', 'parent_id' => null],
            ['name' => 'Десерти', 'icon_url' => 'dessert-icon.png', 'parent_id' => null],
        ];
        
        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $coffeeCategory = Category::where('name', 'Кава')->first();
        $teaCategory = Category::where('name', 'Чай')->first();
        $dessertCategory = Category::where('name', 'Десерти')->first();

        // 3. Products
        $products = [];

        if ($coffeeCategory) {
            $products = array_merge($products, [
                [
                    'category_id' => $coffeeCategory->id,
                    'name' => 'Еспресо',
                    'description' => 'Міцна чорна кава',
                    'price_uah' => 45.00,
                    'price_it_coins' => 10,
                    'cashback_percent' => 5,
                    'is_active' => true,
                    'tag' => 'Популярне',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'category_id' => $coffeeCategory->id,
                    'name' => 'Капучино',
                    'description' => 'Кава з молоком та пінкою',
                    'price_uah' => 65.00,
                    'price_it_coins' => 15,
                    'cashback_percent' => 5,
                    'is_active' => true,
                    'tag' => 'Хіт',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ]);
        }

        if ($teaCategory) {
            $products = array_merge($products, [
                [
                    'category_id' => $teaCategory->id,
                    'name' => 'Зелений чай з жасмином',
                    'description' => 'Освіжаючий зелений чай з ніжним ароматом жасмину.',
                    'price_uah' => 40.00,
                    'price_it_coins' => 5,
                    'cashback_percent' => 5,
                    'is_active' => true,
                    'tag' => 'Новинка',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'category_id' => $teaCategory->id,
                    'name' => 'Чорний чай Earl Grey',
                    'description' => 'Класичний чорний чай з насиченим смаком бергамоту.',
                    'price_uah' => 40.00,
                    'price_it_coins' => 5,
                    'cashback_percent' => 5,
                    'is_active' => true,
                    'tag' => '',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'category_id' => $teaCategory->id,
                    'name' => 'Фруктовий мікс',
                    'description' => 'Гарячий напій на основі лісових ягід, малини та меду.',
                    'price_uah' => 60.00,
                    'price_it_coins' => 10,
                    'cashback_percent' => 3,
                    'is_active' => true,
                    'tag' => 'Популярне',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            ]);
        }

        if ($dessertCategory) {
            $products = array_merge($products, [
                [
                    'category_id' => $dessertCategory->id,
                    'name' => 'Чізкейк',
                    'description' => 'Класичний нью-йоркський чізкейк',
                    'price_uah' => 85.00,
                    'price_it_coins' => 20,
                    'cashback_percent' => 2,
                    'is_active' => true,
                    'tag' => 'Новинка',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'category_id' => $dessertCategory->id,
                    'name' => 'Мигдалевий круасан',
                    'description' => 'Свіжоспечений хрусткий круасан із мигдалевою начинкою.',
                    'price_uah' => 75.00,
                    'price_it_coins' => 12,
                    'cashback_percent' => 4,
                    'is_active' => true,
                    'tag' => 'Хіт',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'category_id' => $dessertCategory->id,
                    'name' => 'Тірамісу',
                    'description' => 'Ніжний італійський десерт на основі маскарпоне та еспресо.',
                    'price_uah' => 110.00,
                    'price_it_coins' => 20,
                    'cashback_percent' => 5,
                    'is_active' => true,
                    'tag' => 'Новинка',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'category_id' => $dessertCategory->id,
                    'name' => 'Набір Макарун (3 шт)',
                    'description' => 'Легкі французькі тістечка з різними смаками: фісташка, малина, шоколад.',
                    'price_uah' => 90.00,
                    'price_it_coins' => 15,
                    'cashback_percent' => 5,
                    'is_active' => true,
                    'tag' => '',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            ]);
        }

        Product::insert($products);

        // 4. Promotions
        $promotions = [
            [
                'title' => 'Ранкова кава зі знижкою',
                'description' => 'Купуй каву до 10:00 зі знижкою 20%',
                'valid_until' => Carbon::now()->addDays(30),
                'start_date' => Carbon::now()->subDays(1),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Комбо: Кава + Круасан',
                'description' => 'Замовляй будь-яку каву разом із мигдалевим круасаном та отримуй знижку 15% на загальний чек!',
                'valid_until' => Carbon::now()->addDays(14),
                'start_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];
        Promotion::insert($promotions);

        // 5. NewsFeed
        $news = [
            [
                'title' => 'Ми відкрили новий заклад!',
                'description' => 'Чекаємо на вас за новою адресою.',
                'type' => 'info',
                'is_active' => true,
                'start_date' => Carbon::now()->subDays(2),
                'end_date' => Carbon::now()->addDays(14),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Дегустація нових десертів',
                'description' => 'Приходьте цими вихідними на безкоштовну дегустацію нашого нового Тірамісу та Макарун. До кожної чашки кави - міні-десерт у подарунок!',
                'type' => 'event',
                'is_active' => true,
                'start_date' => Carbon::now()->addDays(2),
                'end_date' => Carbon::now()->addDays(4),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'IT-Meetup: Знайомство з ШІ',
                'description' => 'У вівторок ввечері наш IT-Hub приймає спікерів з провідних компаній для обговорення застосування штучного інтелекту. Вхід для розробників вільний.',
                'type' => 'event',
                'is_active' => true,
                'start_date' => Carbon::now()->addDays(5),
                'end_date' => Carbon::now()->addDays(5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Нові позиції чаю в меню',
                'description' => 'Ми розширили асортимент чаю! Спробуйте наш фірмовий ягідний мікс або заспокійливий зелений чай з жасмином. Зігрівайтеся разом з ByteBar.',
                'type' => 'info',
                'is_active' => true,
                'start_date' => Carbon::now()->subDays(1),
                'end_date' => Carbon::now()->addDays(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];
        NewsFeed::insert($news);
    }
}
