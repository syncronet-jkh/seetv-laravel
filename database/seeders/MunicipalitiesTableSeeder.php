<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MunicipalitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('municipalities')->delete();
        
        \DB::table('municipalities')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'København',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0101',
                'created_at' => '2021-02-25 15:19:17',
                'updated_at' => '2021-02-25 15:19:17',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Frederiksberg',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0147',
                'created_at' => '2021-02-25 15:19:18',
                'updated_at' => '2021-02-25 15:19:18',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Ballerup',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0151',
                'created_at' => '2021-02-25 15:19:18',
                'updated_at' => '2021-02-25 15:19:18',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Brøndby',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0153',
                'created_at' => '2021-02-25 15:19:18',
                'updated_at' => '2021-02-25 15:19:18',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Dragør',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0155',
                'created_at' => '2021-02-25 15:19:18',
                'updated_at' => '2021-02-25 15:19:18',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Gentofte',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0157',
                'created_at' => '2021-02-25 15:19:18',
                'updated_at' => '2021-02-25 15:19:18',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Gladsaxe',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0159',
                'created_at' => '2021-02-25 15:19:18',
                'updated_at' => '2021-02-25 15:19:18',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Glostrup',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0161',
                'created_at' => '2021-02-25 15:19:18',
                'updated_at' => '2021-02-25 15:19:18',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Herlev',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0163',
                'created_at' => '2021-02-25 15:19:18',
                'updated_at' => '2021-02-25 15:19:18',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Albertslund',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0165',
                'created_at' => '2021-02-25 15:19:18',
                'updated_at' => '2021-02-25 15:19:18',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Hvidovre',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0167',
                'created_at' => '2021-02-25 15:19:18',
                'updated_at' => '2021-02-25 15:19:18',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Høje-Taastrup',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0169',
                'created_at' => '2021-02-25 15:19:18',
                'updated_at' => '2021-02-25 15:19:18',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Lyngby-Taarbæk',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0173',
                'created_at' => '2021-02-25 15:19:18',
                'updated_at' => '2021-02-25 15:19:18',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Rødovre',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0175',
                'created_at' => '2021-02-25 15:19:18',
                'updated_at' => '2021-02-25 15:19:18',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Ishøj',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0183',
                'created_at' => '2021-02-25 15:19:18',
                'updated_at' => '2021-02-25 15:19:18',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Tårnby',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0185',
                'created_at' => '2021-02-25 15:19:19',
                'updated_at' => '2021-02-25 15:19:19',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Vallensbæk',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0187',
                'created_at' => '2021-02-25 15:19:19',
                'updated_at' => '2021-02-25 15:19:19',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Furesø',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0190',
                'created_at' => '2021-02-25 15:19:19',
                'updated_at' => '2021-02-25 15:19:19',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Allerød',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0201',
                'created_at' => '2021-02-25 15:19:19',
                'updated_at' => '2021-02-25 15:19:19',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Fredensborg',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0210',
                'created_at' => '2021-02-25 15:19:19',
                'updated_at' => '2021-02-25 15:19:19',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Helsingør',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0217',
                'created_at' => '2021-02-25 15:19:19',
                'updated_at' => '2021-02-25 15:19:19',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Hillerød',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0219',
                'created_at' => '2021-02-25 15:19:19',
                'updated_at' => '2021-02-25 15:19:19',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Hørsholm',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0223',
                'created_at' => '2021-02-25 15:19:19',
                'updated_at' => '2021-02-25 15:19:19',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Rudersdal',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0230',
                'created_at' => '2021-02-25 15:19:19',
                'updated_at' => '2021-02-25 15:19:19',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Egedal',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0240',
                'created_at' => '2021-02-25 15:19:19',
                'updated_at' => '2021-02-25 15:19:19',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Frederikssund',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0250',
                'created_at' => '2021-02-25 15:19:19',
                'updated_at' => '2021-02-25 15:19:19',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Greve',
                'region_id' => 27,
                'source' => 'https://dawa.aws.dk/kommuner/0253',
                'created_at' => '2021-02-25 15:19:19',
                'updated_at' => '2021-02-25 15:19:19',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Køge',
                'region_id' => 27,
                'source' => 'https://dawa.aws.dk/kommuner/0259',
                'created_at' => '2021-02-25 15:19:19',
                'updated_at' => '2021-02-25 15:19:19',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Halsnæs',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0260',
                'created_at' => '2021-02-25 15:19:19',
                'updated_at' => '2021-02-25 15:19:19',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Roskilde',
                'region_id' => 27,
                'source' => 'https://dawa.aws.dk/kommuner/0265',
                'created_at' => '2021-02-25 15:19:20',
                'updated_at' => '2021-02-25 15:19:20',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Solrød',
                'region_id' => 27,
                'source' => 'https://dawa.aws.dk/kommuner/0269',
                'created_at' => '2021-02-25 15:19:20',
                'updated_at' => '2021-02-25 15:19:20',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Gribskov',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0270',
                'created_at' => '2021-02-25 15:19:20',
                'updated_at' => '2021-02-25 15:19:20',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Odsherred',
                'region_id' => 27,
                'source' => 'https://dawa.aws.dk/kommuner/0306',
                'created_at' => '2021-02-25 15:19:20',
                'updated_at' => '2021-02-25 15:19:20',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Holbæk',
                'region_id' => 27,
                'source' => 'https://dawa.aws.dk/kommuner/0316',
                'created_at' => '2021-02-25 15:19:20',
                'updated_at' => '2021-02-25 15:19:20',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Faxe',
                'region_id' => 27,
                'source' => 'https://dawa.aws.dk/kommuner/0320',
                'created_at' => '2021-02-25 15:19:20',
                'updated_at' => '2021-02-25 15:19:20',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Kalundborg',
                'region_id' => 27,
                'source' => 'https://dawa.aws.dk/kommuner/0326',
                'created_at' => '2021-02-25 15:19:20',
                'updated_at' => '2021-02-25 15:19:20',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Ringsted',
                'region_id' => 27,
                'source' => 'https://dawa.aws.dk/kommuner/0329',
                'created_at' => '2021-02-25 15:19:20',
                'updated_at' => '2021-02-25 15:19:20',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Slagelse',
                'region_id' => 27,
                'source' => 'https://dawa.aws.dk/kommuner/0330',
                'created_at' => '2021-02-25 15:19:20',
                'updated_at' => '2021-02-25 15:19:20',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Stevns',
                'region_id' => 27,
                'source' => 'https://dawa.aws.dk/kommuner/0336',
                'created_at' => '2021-02-25 15:19:20',
                'updated_at' => '2021-02-25 15:19:20',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Sorø',
                'region_id' => 27,
                'source' => 'https://dawa.aws.dk/kommuner/0340',
                'created_at' => '2021-02-25 15:19:20',
                'updated_at' => '2021-02-25 15:19:20',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Lejre',
                'region_id' => 27,
                'source' => 'https://dawa.aws.dk/kommuner/0350',
                'created_at' => '2021-02-25 15:19:20',
                'updated_at' => '2021-02-25 15:19:20',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Lolland',
                'region_id' => 27,
                'source' => 'https://dawa.aws.dk/kommuner/0360',
                'created_at' => '2021-02-25 15:19:20',
                'updated_at' => '2021-02-25 15:19:20',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Næstved',
                'region_id' => 27,
                'source' => 'https://dawa.aws.dk/kommuner/0370',
                'created_at' => '2021-02-25 15:19:21',
                'updated_at' => '2021-02-25 15:19:21',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'Guldborgsund',
                'region_id' => 27,
                'source' => 'https://dawa.aws.dk/kommuner/0376',
                'created_at' => '2021-02-25 15:19:21',
                'updated_at' => '2021-02-25 15:19:21',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Vordingborg',
                'region_id' => 27,
                'source' => 'https://dawa.aws.dk/kommuner/0390',
                'created_at' => '2021-02-25 15:19:21',
                'updated_at' => '2021-02-25 15:19:21',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'Bornholm',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0400',
                'created_at' => '2021-02-25 15:19:21',
                'updated_at' => '2021-02-25 15:19:21',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Middelfart',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0410',
                'created_at' => '2021-02-25 15:19:21',
                'updated_at' => '2021-02-25 15:19:21',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'Christiansø',
                'region_id' => 1,
                'source' => 'https://dawa.aws.dk/kommuner/0411',
                'created_at' => '2021-02-25 15:19:21',
                'updated_at' => '2021-02-25 15:19:21',
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'Assens',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0420',
                'created_at' => '2021-02-25 15:19:21',
                'updated_at' => '2021-02-25 15:19:21',
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'Faaborg-Midtfyn',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0430',
                'created_at' => '2021-02-25 15:19:21',
                'updated_at' => '2021-02-25 15:19:21',
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'Kerteminde',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0440',
                'created_at' => '2021-02-25 15:19:21',
                'updated_at' => '2021-02-25 15:19:21',
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'Nyborg',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0450',
                'created_at' => '2021-02-25 15:19:21',
                'updated_at' => '2021-02-25 15:19:21',
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'Odense',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0461',
                'created_at' => '2021-02-25 15:19:21',
                'updated_at' => '2021-02-25 15:19:21',
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'Svendborg',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0479',
                'created_at' => '2021-02-25 15:19:22',
                'updated_at' => '2021-02-25 15:19:22',
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'Nordfyns',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0480',
                'created_at' => '2021-02-25 15:19:22',
                'updated_at' => '2021-02-25 15:19:22',
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'Langeland',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0482',
                'created_at' => '2021-02-25 15:19:22',
                'updated_at' => '2021-02-25 15:19:22',
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'Ærø',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0492',
                'created_at' => '2021-02-25 15:19:22',
                'updated_at' => '2021-02-25 15:19:22',
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'Haderslev',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0510',
                'created_at' => '2021-02-25 15:19:22',
                'updated_at' => '2021-02-25 15:19:22',
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'Billund',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0530',
                'created_at' => '2021-02-25 15:19:22',
                'updated_at' => '2021-02-25 15:19:22',
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'Sønderborg',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0540',
                'created_at' => '2021-02-25 15:19:22',
                'updated_at' => '2021-02-25 15:19:22',
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'Tønder',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0550',
                'created_at' => '2021-02-25 15:19:22',
                'updated_at' => '2021-02-25 15:19:22',
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'Esbjerg',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0561',
                'created_at' => '2021-02-25 15:19:22',
                'updated_at' => '2021-02-25 15:19:22',
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'Fanø',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0563',
                'created_at' => '2021-02-25 15:19:22',
                'updated_at' => '2021-02-25 15:19:22',
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'Varde',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0573',
                'created_at' => '2021-02-25 15:19:22',
                'updated_at' => '2021-02-25 15:19:22',
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'Vejen',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0575',
                'created_at' => '2021-02-25 15:19:22',
                'updated_at' => '2021-02-25 15:19:22',
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'Aabenraa',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0580',
                'created_at' => '2021-02-25 15:19:22',
                'updated_at' => '2021-02-25 15:19:22',
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'Fredericia',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0607',
                'created_at' => '2021-02-25 15:19:23',
                'updated_at' => '2021-02-25 15:19:23',
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'Horsens',
                'region_id' => 68,
                'source' => 'https://dawa.aws.dk/kommuner/0615',
                'created_at' => '2021-02-25 15:19:23',
                'updated_at' => '2021-02-25 15:19:23',
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'Kolding',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0621',
                'created_at' => '2021-02-25 15:19:23',
                'updated_at' => '2021-02-25 15:19:23',
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'Vejle',
                'region_id' => 47,
                'source' => 'https://dawa.aws.dk/kommuner/0630',
                'created_at' => '2021-02-25 15:19:23',
                'updated_at' => '2021-02-25 15:19:23',
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'Herning',
                'region_id' => 68,
                'source' => 'https://dawa.aws.dk/kommuner/0657',
                'created_at' => '2021-02-25 15:19:23',
                'updated_at' => '2021-02-25 15:19:23',
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'Holstebro',
                'region_id' => 68,
                'source' => 'https://dawa.aws.dk/kommuner/0661',
                'created_at' => '2021-02-25 15:19:23',
                'updated_at' => '2021-02-25 15:19:23',
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'Lemvig',
                'region_id' => 68,
                'source' => 'https://dawa.aws.dk/kommuner/0665',
                'created_at' => '2021-02-25 15:19:23',
                'updated_at' => '2021-02-25 15:19:23',
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'Struer',
                'region_id' => 68,
                'source' => 'https://dawa.aws.dk/kommuner/0671',
                'created_at' => '2021-02-25 15:19:23',
                'updated_at' => '2021-02-25 15:19:23',
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'Syddjurs',
                'region_id' => 68,
                'source' => 'https://dawa.aws.dk/kommuner/0706',
                'created_at' => '2021-02-25 15:19:23',
                'updated_at' => '2021-02-25 15:19:23',
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'Norddjurs',
                'region_id' => 68,
                'source' => 'https://dawa.aws.dk/kommuner/0707',
                'created_at' => '2021-02-25 15:19:23',
                'updated_at' => '2021-02-25 15:19:23',
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'Favrskov',
                'region_id' => 68,
                'source' => 'https://dawa.aws.dk/kommuner/0710',
                'created_at' => '2021-02-25 15:19:23',
                'updated_at' => '2021-02-25 15:19:23',
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'Odder',
                'region_id' => 68,
                'source' => 'https://dawa.aws.dk/kommuner/0727',
                'created_at' => '2021-02-25 15:19:23',
                'updated_at' => '2021-02-25 15:19:23',
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'Randers',
                'region_id' => 68,
                'source' => 'https://dawa.aws.dk/kommuner/0730',
                'created_at' => '2021-02-25 15:19:24',
                'updated_at' => '2021-02-25 15:19:24',
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'Silkeborg',
                'region_id' => 68,
                'source' => 'https://dawa.aws.dk/kommuner/0740',
                'created_at' => '2021-02-25 15:19:24',
                'updated_at' => '2021-02-25 15:19:24',
            ),
            80 => 
            array (
                'id' => 81,
                'name' => 'Samsø',
                'region_id' => 68,
                'source' => 'https://dawa.aws.dk/kommuner/0741',
                'created_at' => '2021-02-25 15:19:24',
                'updated_at' => '2021-02-25 15:19:24',
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'Skanderborg',
                'region_id' => 68,
                'source' => 'https://dawa.aws.dk/kommuner/0746',
                'created_at' => '2021-02-25 15:19:24',
                'updated_at' => '2021-02-25 15:19:24',
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'Aarhus',
                'region_id' => 68,
                'source' => 'https://dawa.aws.dk/kommuner/0751',
                'created_at' => '2021-02-25 15:19:24',
                'updated_at' => '2021-02-25 15:19:24',
            ),
            83 => 
            array (
                'id' => 84,
                'name' => 'Ikast-Brande',
                'region_id' => 68,
                'source' => 'https://dawa.aws.dk/kommuner/0756',
                'created_at' => '2021-02-25 15:19:24',
                'updated_at' => '2021-02-25 15:19:24',
            ),
            84 => 
            array (
                'id' => 85,
                'name' => 'Ringkøbing-Skjern',
                'region_id' => 68,
                'source' => 'https://dawa.aws.dk/kommuner/0760',
                'created_at' => '2021-02-25 15:19:24',
                'updated_at' => '2021-02-25 15:19:24',
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'Hedensted',
                'region_id' => 68,
                'source' => 'https://dawa.aws.dk/kommuner/0766',
                'created_at' => '2021-02-25 15:19:24',
                'updated_at' => '2021-02-25 15:19:24',
            ),
            86 => 
            array (
                'id' => 87,
                'name' => 'Morsø',
                'region_id' => 87,
                'source' => 'https://dawa.aws.dk/kommuner/0773',
                'created_at' => '2021-02-25 15:19:24',
                'updated_at' => '2021-02-25 15:19:24',
            ),
            87 => 
            array (
                'id' => 88,
                'name' => 'Skive',
                'region_id' => 68,
                'source' => 'https://dawa.aws.dk/kommuner/0779',
                'created_at' => '2021-02-25 15:19:24',
                'updated_at' => '2021-02-25 15:19:24',
            ),
            88 => 
            array (
                'id' => 89,
                'name' => 'Thisted',
                'region_id' => 87,
                'source' => 'https://dawa.aws.dk/kommuner/0787',
                'created_at' => '2021-02-25 15:19:24',
                'updated_at' => '2021-02-25 15:19:24',
            ),
            89 => 
            array (
                'id' => 90,
                'name' => 'Viborg',
                'region_id' => 68,
                'source' => 'https://dawa.aws.dk/kommuner/0791',
                'created_at' => '2021-02-25 15:19:24',
                'updated_at' => '2021-02-25 15:19:24',
            ),
            90 => 
            array (
                'id' => 91,
                'name' => 'Brønderslev',
                'region_id' => 87,
                'source' => 'https://dawa.aws.dk/kommuner/0810',
                'created_at' => '2021-02-25 15:19:24',
                'updated_at' => '2021-02-25 15:19:24',
            ),
            91 => 
            array (
                'id' => 92,
                'name' => 'Frederikshavn',
                'region_id' => 87,
                'source' => 'https://dawa.aws.dk/kommuner/0813',
                'created_at' => '2021-02-25 15:19:25',
                'updated_at' => '2021-02-25 15:19:25',
            ),
            92 => 
            array (
                'id' => 93,
                'name' => 'Vesthimmerlands',
                'region_id' => 87,
                'source' => 'https://dawa.aws.dk/kommuner/0820',
                'created_at' => '2021-02-25 15:19:25',
                'updated_at' => '2021-02-25 15:19:25',
            ),
            93 => 
            array (
                'id' => 94,
                'name' => 'Læsø',
                'region_id' => 87,
                'source' => 'https://dawa.aws.dk/kommuner/0825',
                'created_at' => '2021-02-25 15:19:25',
                'updated_at' => '2021-02-25 15:19:25',
            ),
            94 => 
            array (
                'id' => 95,
                'name' => 'Rebild',
                'region_id' => 87,
                'source' => 'https://dawa.aws.dk/kommuner/0840',
                'created_at' => '2021-02-25 15:19:25',
                'updated_at' => '2021-02-25 15:19:25',
            ),
            95 => 
            array (
                'id' => 96,
                'name' => 'Mariagerfjord',
                'region_id' => 87,
                'source' => 'https://dawa.aws.dk/kommuner/0846',
                'created_at' => '2021-02-25 15:19:25',
                'updated_at' => '2021-02-25 15:19:25',
            ),
            96 => 
            array (
                'id' => 97,
                'name' => 'Jammerbugt',
                'region_id' => 87,
                'source' => 'https://dawa.aws.dk/kommuner/0849',
                'created_at' => '2021-02-25 15:19:25',
                'updated_at' => '2021-02-25 15:19:25',
            ),
            97 => 
            array (
                'id' => 98,
                'name' => 'Aalborg',
                'region_id' => 87,
                'source' => 'https://dawa.aws.dk/kommuner/0851',
                'created_at' => '2021-02-25 15:19:25',
                'updated_at' => '2021-02-25 15:19:25',
            ),
            98 => 
            array (
                'id' => 99,
                'name' => 'Hjørring',
                'region_id' => 87,
                'source' => 'https://dawa.aws.dk/kommuner/0860',
                'created_at' => '2021-02-25 15:19:25',
                'updated_at' => '2021-02-25 15:19:25',
            ),
        ));
        
        
    }
}