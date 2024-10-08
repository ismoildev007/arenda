<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = [
            ['region_id' => 1, 'name' => 'Amudaryo tumani'],
            ['region_id' => 1, 'name' => 'Beruniy tumani'],
            ['region_id' => 1, 'name' => 'Kegayli tumani'],
            ['region_id' => 1, 'name' => 'Qonliko‘l tumani'],
            ['region_id' => 1, 'name' => 'Qorao‘zak tumani'],
            ['region_id' => 1, 'name' => 'Qo‘ng‘irot tumani'],
            ['region_id' => 1, 'name' => 'Mo‘ynoq tumani'],
            ['region_id' => 1, 'name' => 'Nukus tumani'],
            ['region_id' => 1, 'name' => 'Nukus shahri'],
            ['region_id' => 1, 'name' => 'Taxtako‘pir tumani'],
            ['region_id' => 1, 'name' => 'To‘rtko‘l tumani'],
            ['region_id' => 1, 'name' => 'Xo‘jayli tumani'],
            ['region_id' => 1, 'name' => 'Chimboy tumani'],
            ['region_id' => 1, 'name' => 'Shumanay tumani'],
            ['region_id' => 1, 'name' => 'Ellikqal‘a tumani'],
            ['region_id' => 2, 'name' => 'Andijon shahri'],
            ['region_id' => 2, 'name' => 'Andijon tumani'],
            ['region_id' => 2, 'name' => 'Asaka tumani'],
            ['region_id' => 2, 'name' => 'Baliqchi tumani'],
            ['region_id' => 2, 'name' => 'Buloqboshi tumani'],
            ['region_id' => 2, 'name' => 'Bo‘z tumani'],
            ['region_id' => 2, 'name' => 'Jalaquduq tumani'],
            ['region_id' => 2, 'name' => 'Izbosgan tumani'],
            ['region_id' => 2, 'name' => 'Qorasuv shahri'],
            ['region_id' => 2, 'name' => 'Qo‘rg‘ontepa tumani'],
            ['region_id' => 2, 'name' => 'Marhamat tumani'],
            ['region_id' => 2, 'name' => 'Oltinko‘l tumani'],
            ['region_id' => 2, 'name' => 'Paxtaobod tumani'],
            ['region_id' => 2, 'name' => 'Ulug‘nor tumani'],
            ['region_id' => 2, 'name' => 'Xonabod tumani'],
            ['region_id' => 2, 'name' => 'Xo‘jaobod tumani'],
            ['region_id' => 2, 'name' => 'Shahrixon tumani'],
            ['region_id' => 3, 'name' => 'Buxoro shahri'],
            ['region_id' => 3, 'name' => 'Buxoro tumani'],
            ['region_id' => 3, 'name' => 'Vobkent tumani'],
            ['region_id' => 3, 'name' => 'G‘ijduvon tumani'],
            ['region_id' => 3, 'name' => 'Jondor tumani'],
            ['region_id' => 3, 'name' => 'Kogon tumani'],
            ['region_id' => 3, 'name' => 'Kogon shahri'],
            ['region_id' => 3, 'name' => 'Qorako‘l tumani'],
            ['region_id' => 3, 'name' => 'Qorovulbozor tumani'],
            ['region_id' => 3, 'name' => 'Olot tumani'],
            ['region_id' => 3, 'name' => 'Peshku tumani'],
            ['region_id' => 3, 'name' => 'Romitan tumani'],
            ['region_id' => 3, 'name' => 'Shofirkon tumani'],
            ['region_id' => 4, 'name' => 'Arnasoy tumani'],
            ['region_id' => 4, 'name' => 'Baxmal tumani'],
            ['region_id' => 4, 'name' => 'G‘allaorol tumani'],
            ['region_id' => 4, 'name' => 'Do‘stlik tumani'],
            ['region_id' => 4, 'name' => 'Sh.Rashidov tumani'],
            ['region_id' => 4, 'name' => 'Jizzax shahri'],
            ['region_id' => 4, 'name' => 'Zarbdor tumani'],
            ['region_id' => 4, 'name' => 'Zafarobod tumani'],
            ['region_id' => 4, 'name' => 'Zomin tumani'],
            ['region_id' => 4, 'name' => 'Mirzacho‘l tumani'],
            ['region_id' => 4, 'name' => 'Paxtakor tumani'],
            ['region_id' => 4, 'name' => 'Forish tumani'],
            ['region_id' => 4, 'name' => 'Yangiobod tumani'],
            ['region_id' => 5, 'name' => 'G‘uzor tumani'],
            ['region_id' => 5, 'name' => 'Dehqonobod tumani'],
            ['region_id' => 5, 'name' => 'Qamashi tumani'],
            ['region_id' => 5, 'name' => 'Qarshi tumani'],
            ['region_id' => 5, 'name' => 'Qarshi shahri'],
            ['region_id' => 5, 'name' => 'Kasbi tumani'],
            ['region_id' => 5, 'name' => 'Kitob tumani'],
            ['region_id' => 5, 'name' => 'Koson tumani'],
            ['region_id' => 5, 'name' => 'Mirishkor tumani'],
            ['region_id' => 5, 'name' => 'Muborak tumani'],
            ['region_id' => 5, 'name' => 'Nishon tumani'],
            ['region_id' => 5, 'name' => 'Chiroqchi tumani'],
            ['region_id' => 5, 'name' => 'Shahrisabz tumani'],
            ['region_id' => 5, 'name' => 'Yakkabog‘ tumani'],
            ['region_id' => 6, 'name' => 'Zarafshon shahri'],
            ['region_id' => 6, 'name' => 'Karmana tumani'],
            ['region_id' => 6, 'name' => 'Qiziltepa tumani'],
            ['region_id' => 6, 'name' => 'Konimex tumani'],
            ['region_id' => 6, 'name' => 'Navbahor tumani'],
            ['region_id' => 6, 'name' => 'Navoiy shahri'],
            ['region_id' => 6, 'name' => 'Nurota tumani'],
            ['region_id' => 6, 'name' => 'Tomdi tumani'],
            ['region_id' => 6, 'name' => 'Uchquduq tumani'],
            ['region_id' => 6, 'name' => 'Xatirchi tumani'],
            ['region_id' => 7, 'name' => 'Kosonsoy tumani'],
            ['region_id' => 7, 'name' => 'Mingbuloq tumani'],
            ['region_id' => 7, 'name' => 'Namangan tumani'],
            ['region_id' => 7, 'name' => 'Namangan shahri'],
            ['region_id' => 7, 'name' => 'Norin tumani'],
            ['region_id' => 7, 'name' => 'Pop tumani'],
            ['region_id' => 7, 'name' => 'Uchqo‘rg‘on tumani'],
            ['region_id' => 7, 'name' => 'Uychi tumani'],
            ['region_id' => 7, 'name' => 'Chust tumani'],
            ['region_id' => 7, 'name' => 'Bag‘dod tumani'],
            ['region_id' => 7, 'name' => 'O‘rtako‘l tumani'],
            ['region_id' => 7, 'name' => 'Paxtaobod tumani'],
            ['region_id' => 7, 'name' => 'Rishton tumani'],
            ['region_id' => 7, 'name' => 'So‘x tumani'],
            ['region_id' => 7, 'name' => 'Chirchiq shahri'],
            ['region_id' => 7, 'name' => 'Yangiqo‘rg‘on tumani'],
            ['region_id' => 8, 'name' => 'Bektemir tumani'],
            ['region_id' => 8, 'name' => 'Mirzo Ulug\'bek tumani'],
            ['region_id' => 8, 'name' => 'Mirobod tumani'],
            ['region_id' => 8, 'name' => 'Olmazor tumani'],
            ['region_id' => 8, 'name' => 'Sirg\'ali tumani'],
            ['region_id' => 8, 'name' => 'Uchtepa tumani'],
            ['region_id' => 8, 'name' => 'Yashnobod tumani'],
            ['region_id' => 8, 'name' => 'Chilonzor tumani'],
            ['region_id' => 8, 'name' => 'Shayxontohur tumani'],
            ['region_id' => 8, 'name' => 'Yunusobod tumani'],
            ['region_id' => 8, 'name' => 'Yakkasaroy tumani'],

            ['region_id' => 9, 'name' => 'Bulung‘ur tumani'],
            ['region_id' => 9, 'name' => 'G‘uzor tumani'],
            ['region_id' => 9, 'name' => 'Jomboy tumani'],
            ['region_id' => 9, 'name' => 'Kuyichirchik tumani'],
            ['region_id' => 9, 'name' => 'Mang‘it tumani'],
            ['region_id' => 9, 'name' => 'Nurafshon tumani'],
            ['region_id' => 9, 'name' => 'Oqdarya tumani'],
            ['region_id' => 9, 'name' => 'Paxtaobod tumani'],
            ['region_id' => 9, 'name' => 'Samarqand shahri'],
            ['region_id' => 9, 'name' => 'Samarqand tumani'],
            ['region_id' => 9, 'name' => 'Toyloq tumani'],
            ['region_id' => 10, 'name' => 'Bo‘stonliq tumani'],
            ['region_id' => 10, 'name' => 'Guliston shahri'],
            ['region_id' => 10, 'name' => 'Guliston tumani'],
            ['region_id' => 10, 'name' => 'Jomboy tumani'],
            ['region_id' => 10, 'name' => 'Qibray tumani'],
            ['region_id' => 10, 'name' => 'Mirzo Ulug‘bek tumani'],
            ['region_id' => 10, 'name' => 'Oqdarya tumani'],
            ['region_id' => 10, 'name' => 'Sirdaryo tumani'],
            ['region_id' => 11, 'name' => 'Zangiota tumani'],
            ['region_id' => 11, 'name' => 'Zafar tumani'],
            ['region_id' => 11, 'name' => 'Yangiyul tumani'],
            ['region_id' => 11, 'name' => 'Parkent tumani'],
            ['region_id' => 11, 'name' => 'Pskent tumani'],
            ['region_id' => 11, 'name' => 'Ohangaron tumani'],
            ['region_id' => 11, 'name' => 'Tuytepa tumani'],
            ['region_id' => 11, 'name' => 'Yangiyo‘l tumani']
        ];

        DB::table('districts')->insert($districts);
    }
}
