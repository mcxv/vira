<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Note;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $user1 = User::create([
            'first_name' => 'حافظ',
            'last_name' => 'شیرازی',
            'mobile' => '09011111111'
        ]);

        $user2 = User::create([
            'first_name' => 'خیام',
            'last_name' => 'نیشابوری',
            'mobile' => '09022222222'
        ]);

        $user3 = User::create([
            'first_name' => 'سعدی',
            'last_name' => 'شیرازی',
            'mobile' => '09033333333'
        ]);

        Note::create([
            'title' => 'واعظ',
            'content' => 'دور شو از برم ای واعظ و بیهوده مگوی / من نه آنم که دگر گوش به تزویر کنم',
            'status' => false,
            'user_id' => $user1->id
        ]);

        Note::create([
            'title' => 'راز نهان',
            'content' => 'بخت از دهانِ دوست نشانم نمی‌دهد / دولت خبر ز رازِ نهانم نمی‌دهد',
            'status' => true,
            'user_id' => $user1->id
        ]);


        Note::create([
            'title' => 'کوزه',
            'content' => 'از کوزه‌گری کوزه خریدم باری / آن کوزه سخن گفت ز هر اسراری',
            'status' => true,
            'user_id' => $user2->id
        ]);


        Note::create([
            'title' => 'دارو',
            'content' => 'داروی مشتاق چیست زهر ز دست نگار / مرهم عشاق چیست زخم ز بازوی دوست',
            'status' => true,
            'user_id' => $user3->id
        ]);

        Note::create([
            'title' => 'دوست',
            'content' => 'به قول دشمنان برگشتی از دوست / نگردد هیچ کس با دوست دشمن',
            'status' => false,
            'user_id' => $user1->id
        ]);


        Note::create([
            'title' => 'دلبر عیار',
            'content' => 'من در این جایْ همین صورت بی‌جانم و بس / دلم آنجاست که آن دلبر عیار آنجاست',
            'status' => true,
            'user_id' => $user3->id
        ]);

        Note::create([
            'title' => 'گردون',
            'content' => 'از آمدنم نبود گردون را سود / وز رفتن من جلال و جاهش نفزود',
            'status' => true,
            'user_id' => $user2->id
        ]);

        Note::create([
            'title' => 'غریب',
            'content' => 'ما در این شهر غریبیم و در این ملک فقیر / به کمند تو گرفتار و به دام تو اسیر',
            'status' => true,
            'user_id' => $user3->id
        ]);
    }
}
