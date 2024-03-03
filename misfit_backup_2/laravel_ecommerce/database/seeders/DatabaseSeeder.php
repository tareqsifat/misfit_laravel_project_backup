<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\image;
use App\Models\MainCategory;
use App\Models\product;
use App\Models\Publication;
use App\Models\size;
use App\Models\status;
use App\Models\SubCategory;
use App\Models\unit;
use App\Models\vendor;
use App\Models\Writer;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        MainCategory::truncate();
        Category::truncate();
        SubCategory::truncate();
        Brand::truncate();
        Writer::truncate();
        Publication::truncate();
        Color::truncate();
        size::truncate();
        unit::truncate();
        vendor::truncate();
        product::truncate();
        image::truncate();

        //  \App\Models\User::factory(10)->create();

        $category = [
            'main_category' => [
                "Men's" => [
                    "Gent's Watch" => [
                        'rolex',
                        'casio',
                        'apple'
                    ],
                    "Clohing" =>[
                        'shirt',
                        't-shirt',
                        'panjabi',
                    ],
                    "grooming & wellness" => [
                        'body spray',
                        'suit',
                        'face wash'
                    ],
                ],
                "Women's" => [
                    "saree"=> [
                        'jamdani',
                        'dhakai moslin',
                        'benarosi'
                    ],
                    "kurti" => [
                        'boil',
                        'jamdani',
                        'katan'
                    ],
                    "jewelary" => [
                        'nekless',
                        'breslate',
                        'nupur'
                    ],
                ],
                "Baby & kids" => [
                    "toy-games" =>[
                        'Tic toe',
                        'Auto car',
                        'cricket'
                    ],
                    "kids footware" => [
                        'shoe',
                        'moja',
                    ],
                    "Baby food" =>[
                        'Dano',
                        'Nido',
                        'Horlics'
                    ]
                ],
                "Food and Grocery" =>[
                    "Rice" => [
                        'Ataf',
                        'Chini gura',
                        'paijam'
                    ],
                    "Dal" => [
                        'Mosur',
                        'mas kalai',
                        'mug'
                    ],
                    "Oil" =>[
                        'soyabin',
                        'sorisha',
                        'palm oil'
                    ]
                ],
                "Medicine" => [
                    "cream" =>[
                        'vetnovat',
                        'tricodarma',
                        'pevison'
                    ],
                    "Gel" =>[
                        'burn cream',
                        'Rubor gel',
                        'Relif'
                    ],
                    "Spray" =>[
                        'moov',
                        'avaspray',
                        'nasomet'
                    ]
                ],   
                "Mobile" => [
                    "Maximus" => [
                        "mobile",
                        "ear-phone"
                        ],
                    "Huwaui" => [
                        "mobile",
                        "ear-phone"
                        ],
                    "Remax" => [
                        "mobile",
                        "ear-phone"
                        ]
                ],
                "Home & Kitchen" => [
                    "Knife" => [
                        'Henckels Pro',
                        'Wusthof Classic',
                        'Shun Classic'
                    ],
                    "Spice" => [
                        'pran',
                        'radhuni',
                        'bdfood'
                    ],
                    "Noodles" => [
                        'cocola',
                        'maggi',
                        'Mr. noodles'
                    ]
                ],
                "Books" => [
                    "History" => [
                        'sanjak e uthman',
                        'the panther',
                        'polashi theke bangladesh'
                    ],
                    "Islamic" => [
                        'bukhari',
                        'hisnul muslim',
                        'muksedul momenin'
                    ],
                    "Nobel" => [
                        'debdash',
                        'pother dabi',
                        'polli somaj'
                    ]
                ],
                "Service" => [
                    'Desktop' => [],
                    "Laptop" => [],
                    "Ink" => []
                ],
                "Computer" => [
                    'mouse' => [
                        'rapoo',
                        'logitech',
                        'hp'
                    ],
                    "monitor" => [
                        'LG',
                        'HP',
                        'Dell'
                    ],
                    "keyboard" => [
                        'rapoo',
                        'A4tech',
                        'delux'
                    ]
                ],
                "Stationery" => [
                    "Pen" => [
                        'matador',
                        'econo',
                        'LINC'
                    ],
                    "pencil" => [
                        'matador',
                        'fresh', 
                        'deli'
                    ],
                    "Table" => [
                        'rfl',
                        'tanin',
                        'bengal'
                    ]
                ],
                "Gift Item" => [
                    "show peice" => [],
                    "Photo Frame" => [],
                    "Doll" => []
                ],
                "Hot Deal" => [
                    "Combo Offer" => [],
                    "Special Offer" => []
                ],
            ]
        ];
        foreach ($category['main_category'] as $key => $value) {
            $main_id = MainCategory::insertGetId([
                'name' => $key,
                'creator' => 1,
                'slug' => Str::slug(strtolower($key)),
                'created_at' => Carbon::now()->toDateTimeString()
            ]);

            foreach ($value as $key2 => $value2) {
                $category_id = Category::insertGetId([
                    'name' => $key2,
                    'main_category_id' => $main_id,
                    'creator' => 1,
                    'slug' =>Str::slug(strtolower($key2)),
                    'created_at' =>Carbon::now()->toDateTimeString()
                ]);

                foreach ($value2 as $key3 => $value3) {
                    SubCategory::insert([
                    'name' => $value3,
                    'main_category_id' => $main_id,
                    'category_id' => $category_id,
                    'creator' => 1,
                    'slug' =>Str::slug(strtolower($value3)),
                    'created_at' =>Carbon::now()->toDateTimeString()
                    ]);
                }
            }
        }


        //brand
        $data = [
            [
                'name' => 'nike',
                'logo' => 'http://lorempixel.com/400/200/sports/Dummy-Text/',
                'creator' => 1,
                'slug' => 'nike',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => 'adidas',
                'logo' => 'http://lorempixel.com/400/200/sports/1/Dummy-Text/',
                'creator' => 1,
                'slug' => 'adidas',
                'created_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'pila',
                'logo' => 'http://lorempixel.com/400/200/sports/',
                'creator' => 1,
                'slug' => 'pila',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => 'gucci',
                'logo' => 'http://lorempixel.com/200/200/transport/4/',
                'creator' => 1,
                'slug' => 'gucci',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => 'puma',
                'logo' => 'http://lorempixel.com/200/200/transport/5/',
                'creator' => 1,
                'slug' => 'puma',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => 'arong',
                'logo' => 'http://lorempixel.com/200/200/transport/6/',
                'creator' => 1,
                'slug' => 'arong',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => 'easy',
                'logo' => 'http://lorempixel.com/200/200/transport/7/',
                'creator' => 1,
                'slug' => 'easy',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => 'bobin',
                'logo' => 'http://lorempixel.com/200/200/transport/8/',
                'creator' => 1,
                'slug' => 'bobin',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => 'zink',
                'logo' => 'http://lorempixel.com/200/200/transport/9/',
                'creator' => 1,
                'slug' => 'zink',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => 'men look',
                'logo' => 'http://lorempixel.com/200/200/transport/10/',
                'creator' => 1,
                'slug' => 'men-look',
                'created_at' => Carbon::now()->toDateTimeString()
            ],
        ];
        Brand::insert($data);

        //writer
        $data = [
            [
                'name' => strtolower('ABDUL WAHED KHAN'),
                'image' => 'http://lorempixel.com/200/200/people/1/',
                'description' => str_shuffle("Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui, numquam?"),
                'creator' => 1,
                'slug' => Str::slug(strtolower('ABDUL WAHED KHAN')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('ABDULLA WAHED ALI'),
                'image' => 'http://lorempixel.com/200/200/people/2/',
                'description' =>str_shuffle('Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui, numquam?'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('ABDULLAH WAHED ALI')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('AKM SHAFI'),
                'image' => 'http://lorempixel.com/200/200/people/3/',
                'description' =>str_shuffle('Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui, numquam?'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('AKM SHAFI')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('ABDUL-MINIM AL-HASHEMI'),
                'image' => 'http://lorempixel.com/200/200/people/4/',
                'description' =>str_shuffle('Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui, numquam?'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('ABDUL-MINIM AL-HASHEMI')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('ABDUL MLIK MUZAHID'),
                'image' => 'http://lorempixel.com/200/200/people/5/',
                'description' =>str_shuffle('Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui, numquam?'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('ABDUL MLIK MUZAHID')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
        ];
        Writer::insert($data);

        //publication
        $data = [
            [
                'name' => strtolower('GOODWORD'),
                'image' => 'http://lorempixel.com/200/200/business/1/',
                'description' => str_shuffle('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris laoreet'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('GOODWORD')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
        
            [
                'name' => strtolower('Onnesa prokashon'),
                'image' => 'http://lorempixel.com/200/200/business/2/',
                'description' => str_shuffle('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris laoreet'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('Onnesa prokashon')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('Anowar Library'),
                'image' => 'http://lorempixel.com/200/200/business/3/',
                'description' => str_shuffle('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris laoreet'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('Anowar Library')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('Art Publication'),
                'image' => 'http://lorempixel.com/200/200/business/4/',
                'description' => str_shuffle('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris laoreet'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('Art Publication')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
        ];
        Publication::insert($data);

        //color
        $data = [
            [
                'name' => strtolower('red'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('red')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('sayan'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('sayan')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('pink'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('pink')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('green'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('green')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('slyblue'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('slyblue')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('gray'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('gray')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('white'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('white')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('black'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('black')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('yellow'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('yellow')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
        ];
        Color::insert($data);

        //size
        $data = [
            [
                'name' => strtolower('XS'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('XS')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('S'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('S')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('M'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('M')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('L'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('L')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('XL'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('XL')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('XXL'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('XXL')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('XXXL'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('XXXL')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
        ];
        size::insert($data);

        //unit

        $data = [
            [
                'name' => strtolower('meter'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('meter')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('kg'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('kg')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('litre'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('litre')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('pcs'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('pcs')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('foot'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('foot')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('inch'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('inch')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('gellon'),
                'creator' => 1,
                'slug' => Str::slug(strtolower('gellon')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
        ];
        unit::insert($data);

        //status
        $data = [
            [
                'name' => strtolower('Active'),
                'creator' => 1,
                'serial' => 1,
                'slug' => Str::slug(strtolower('Active')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('Pending'),
                'serial' => 2,
                'creator' => 1,
                'slug' => Str::slug(strtolower('Pending')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('Processing'),
                'serial' => 3,
                'creator' => 1,
                'slug' => Str::slug(strtolower('Processing')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('Shipping'),
                'serial' => 4,
                'creator' => 1,
                'slug' => Str::slug(strtolower('Shipping')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('delivered'),
                'serial' => 5,
                'creator' => 1,
                'slug' => Str::slug(strtolower('delivered')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('Cancelled'),
                'serial' => 6,
                'creator' => 1,
                'slug' => Str::slug(strtolower('Cancelled')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('Draft'),
                'serial' => 7,
                'creator' => 1,
                'slug' => Str::slug(strtolower('draft')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
        ];
        status::insert($data);

        //vendor

        $data = [
            [
                'name' => strtolower('Mr. tutul'),
                'email' => 'tutul@gmail.com',
                'address' => 'jatrabari',
                'creator' => 1,
                'slug' => Str::slug(strtolower('tutul')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('Mr. yousuf'),
                'email' => 'yousuf@gmail.com',
                'address' => 'dhanmondi',
                'creator' => 1,
                'slug' => Str::slug(strtolower('yousuf')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => strtolower('Mr. sajid'),
                'email' => 'sajid@gmail.com',
                'address' => 'Chattagram',
                'creator' => 1,
                'slug' => Str::slug(strtolower('sajid')),
                'created_at' => Carbon::now()->toDateTimeString()
            ],
        ];
        vendor::insert($data);

        //images
        for($i = 1; $i <=18; $i++){
            image::insert([
                'name' => 'dummy-products/' . $i . ".jpg",
                'creator' => 1,
                'created_at' =>Carbon::now()->toDateTimeString()
            ]);
        }
            
        //products
        DB::table('main_category_product')->truncate();
        DB::table('category_product')->truncate();
        DB::table('sub_category_product')->truncate();
        DB::table('color_product')->truncate();
        DB::table('product_size')->truncate();
        DB::table('unit_product')->truncate();
        DB::table('product_vendor')->truncate();
        DB::table('writer_product')->truncate();
        DB::table('product_publication')->truncate();
        DB::table('image_product')->truncate();
        
        //insert 20 product
        $product_name =[
            "Men's Wash Denim Pant - Ad003 - 7arnf",
            "CUSTOM MADE FASHION SNEAKERS",
            "Cotton Panjabi (Yellow)",
            "China Cotton Fabric Formal Shirt",
            "Karchupi One Piece",
            "Gold Plated Color Beats Locket Pendant",
            "Women's Fashionable Shirt",
            "Kids toys collection1",
            "Plastic Remote Control World Racing",
            "kodomo bath (gentle soft)",
            "Nokshipitha",
            "Teer sugar",
            "Radhuni biryani masala",
            "Shrimp shutki",
            "Pran Tomato Ketchup",
            "Black Seed",
            "Kheshari Dal",
            "Pran Mustard Oil",
            "Maggi Coconut Milk Powder",
            "Ruchi Mixed Fruit Jam",
        ];

        for($i = 0; $i < 20; $i++){
            $product = new product();
            $product->name = $product_name[$i];
            $product->brand_id = rand(1, Brand::count());
            $product->tax = 15;
            $product->price = rand(200,800);
            $product->sku = 'SKU' . rand(200, 500);
            $product->stock = rand(700,1000);
            $product->discount_price = rand(0,20);
            $product->expiration_date = Carbon::now()->year. '-31-12';
            $product->minimum_amount = rand(25,30);
            $product->free_delivery = rand(0,1);
            $product->total_view = rand(50, 100);
            $product->description = 'Lorem ipsum dolor sit, amet consectetur adipisicing elit.';
            $product->features = "<ul><li>Lorem ipsum dolor sit amet</li><li>consectetur adipisicing elit.</li> <li>Aliquid vel quo facere suscipit consequatur</li><li>fugit dolore aspernatur</li></ul>";
            $product->thumb_image = 'dummy-products/' . rand(1,18) . ".jpg";
            $product->creator = 1;
            $product->created_at = Carbon::now()->toDateTimeString();
            $product->save();

            $product->code = 'PRO-'. Carbon::now()->year . Carbon::now()->month . $product->id;
            $product->slug = Str::slug($product->name) . '-' . Carbon::now()->year . Carbon::now()->month . $product->id;
            $product->save();

            DB::table('main_category_product')->truncate();
            DB::table('main_category_product')->insert(
                ['main_category_id' => 1, 'product_id'=> $product->id]
            );

            DB::table('category_product')->truncate();
            DB::table('category_product')->insert(
                ['category_id' => 1, 'product_id'=> $product->id],
                ['category_id' => 2, 'product_id'=> $product->id],
                ['category_id' => 3, 'product_id'=> $product->id]
            );

            DB::table('sub_category_product')->truncate();
            DB::table('sub_category_product')->insert(
                ['sub_category_id' => 1, 'product_id'=> $product->id],
                ['sub_category_id' => 2, 'product_id'=> $product->id],
                ['sub_category_id' => 3, 'product_id'=> $product->id]
            );

            DB::table('color_product')->truncate();
            DB::table('color_product')->insert(
                ['color_id' => 1, 'product_id'=> $product->id],
                ['color_id' => 2, 'product_id'=> $product->id],
                ['color_id' => 3, 'product_id'=> $product->id]
            );

            DB::table('product_size')->truncate();
            DB::table('product_size')->insert(
                ['size_id' => 1, 'product_id'=> $product->id],
                ['size_id' => 2, 'product_id'=> $product->id],
                ['size_id' => 3, 'product_id'=> $product->id]
            );

            DB::table('unit_product')->truncate();
            DB::table('unit_product')->insert(
                ['unit_id' => 1, 'product_id'=> $product->id],
                ['unit_id' => 2, 'product_id'=> $product->id],
                ['unit_id' => 3, 'product_id'=> $product->id]
            );

            DB::table('product_vendor')->truncate();
            DB::table('product_vendor')->insert(
                ['vendor_id' => 1, 'product_id'=> $product->id],
                ['vendor_id' => 2, 'product_id'=> $product->id],
            );

            DB::table('writer_product')->truncate();
            DB::table('writer_product')->insert(
                ['writer_id' => 1, 'product_id'=> $product->id],
                ['writer_id' => 2, 'product_id'=> $product->id],
            );

            DB::table('product_publication')->truncate();
            DB::table('product_publication')->insert(
                ['publication_id' => 1, 'product_id'=> $product->id],
                ['publication_id' => 2, 'product_id'=> $product->id],
            );

            DB::table('product_publication')->truncate();
            DB::table('product_publication')->insert(
                ['publication_id' => rand(1,6), 'product_id'=> $product->id],
                ['publication_id' => rand(3,18), 'product_id'=> $product->id],
                ['publication_id' => rand(4,15), 'product_id'=> $product->id],
                ['publication_id' => rand(15,18), 'product_id'=> $product->id], 
            );
        }
    }
}