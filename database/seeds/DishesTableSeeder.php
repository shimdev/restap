<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dishes')->insert([
        	[
	            'name' => 'Sup Kambing',
	            'price' => 35876,
	            'tags' => 'Soup',
	            'ctg' => 'Food',
	            'desc' => 'Celery quandong swiss chard chicory earthnut pea potato. Salsify taro catsear garlic gram celery bitterleaf wattle seed collard greens nori. Grape wattle seed kombu beetroot horseradish carrot squash brussels sprout chard.',
	            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
	        ],

        	[
	            'name' => 'Sup Buntut',
	            'price' => 55676,
	            'tags' => 'Soup',
	            'ctg' => 'Food',
	            'desc' => 'Beetroot water spinach okra water chestnut ricebean pea catsear courgette summer purslane. Water spinach arugula pea tatsoi aubergine spring onion bush tomato kale radicchio turnip chicory salsify pea sprouts fava bean. Dandelion zucchini burdock yarrow chickpea dandelion sorrel courgette turnip greens tigernut soybean radish artichoke wattle seed endive groundnut broccoli arugula.',
	            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
	        ],

        	[
	            'name' => 'Soto Babat',
	            'price' => 30456,
	            'tags' => 'Soup',
	            'ctg' => 'Food',
	            'desc' => 'Candy donut biscuit jelly-o. Lollipop sweet oat cake candy canes caramels. Dragée tootsie roll lollipop jelly beans wafer cheesecake. Bear claw chupa chups dragée pie marshmallow. Chupa chups gingerbread cookie sugar plum bear claw. Gummi bears apple pie dragée candy canes donut cake jelly beans jelly beans.',
	            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
	        ],

        	[
	            'name' => 'Soto Kudus',
	            'price' => 17960,
	            'tags' => 'Soup',
	            'ctg' => 'Food',
	            'desc' => 'Lemon drops wafer pie topping chupa chups dessert. Toffee halvah icing tart pudding chocolate cake chocolate bar jelly-o danish. Tootsie roll cupcake oat cake pudding candy canes toffee. Caramels sesame snaps croissant lollipop. Soufflé pie muffin jelly beans cake. Cake caramels caramels jujubes cake dessert sweet gummies. Biscuit fruitcake caramels bonbon caramels. Cake lemon drops fruitcake. Bonbon cake oat cake halvah tootsie roll biscuit chocolate.',
	            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
	        ],

        	[
	            'name' => 'Lontong Opor',
	            'price' => 27760,
	            'tags' => 'Rice',
	            'ctg' => 'Food',
	            'desc' => 'Nori grape silver beet broccoli kombu beet greens fava bean potato quandong celery. Bunya nuts black-eyed pea prairie turnip leek lentil turnip greens parsnip. Sea lettuce lettuce water chestnut eggplant winter purslane fennel azuki bean earthnut pea sierra leone bologi leek soko chicory celtuce parsley jícama salsify.',
	            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
	        ]
        ]);
    }
}
