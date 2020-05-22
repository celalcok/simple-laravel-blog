<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages=['Hakkımızda','Kariyer','Vizyonumuz','Misyonumuz'];
        $count=0;
        foreach ($pages as $page) {
            $count++;
            DB::table('pages')->insert([
                'title'=>$page,
                'slug'=>Str::slug($page),
                'image'=>'https://www.google.com/url?sa=i&url=http%3A%2F%2Fbxno.de%2Fstrengthening-your-business-financing-with-proof-of-market&psig=AOvVaw3ttYbOPMEaA5a8eS6qJp1m&ust=1589483795919000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCJiDxNzGsekCFQAAAAAdAAAAABAD',
                'content'=>'Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
                            Neque enim dicta, possimus at aperiam nesciunt modi molestias 
                            id ex atque praesentium saepe accusantium temporibus, 
                            ipsam sint illum itaque magnam. At!',
                'order'=>$count,
                'created_at'=>now(),
                'updated_at'=> now()
                ]);
        }
    }
}
