<?php

namespace Database\Seeders;
use App\Models\SmsService;

use Illuminate\Database\Seeder;

class SmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
   
        $data = SmsService::create([
        'name' => 'MoneyLion',
        'us_amount' => '3.5',
        'us_code' => '4683',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'moneylion.png',
        ]);

        $data = SmsService::create([
        'name' => 'eBay',
        'us_amount' => '3.5',
        'us_code' => '4584',
        'uk_amount' => "2",
        'uk_code' => '4646',
        'image' => 'ebay.png',
        ]);
        $data = SmsService::create([
        'name' => 'Womply',
        'us_amount' => '3',
        'us_code' => '8265',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'womply.png',
        ]);
        $data = SmsService::create([
        'name' => 'Walmart',
        'us_amount' => '3',
        'us_code' => '4627',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'walmart.png',
        ]);
        $data = SmsService::create([
        'name' => 'Dave',
        'us_amount' => '3',
        'us_code' => '7493',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'dave.png',
        ]);
        $data = SmsService::create([
        'name' => 'PayPal',
        'us_amount' => '3',
        'us_code' => '1187',
        'uk_amount' => "2",
        'uk_code' => '1389',
        'image' => 'paypal.png',
        ]);
        $data = SmsService::create([
        'name' => 'Plenty Of Fish',
        'us_amount' => '3',
        'us_code' => '1186',
        'uk_amount' => "1.5",
        'uk_code' => '1388',
        'image' => 'plentyoffish.png',
        ]);
        $data = SmsService::create([
        'name' => 'Match.com',
        'us_amount' => '3',
        'us_code' => '4643',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'matchcom.png',
        ]);
        $data = SmsService::create([
        'name' => 'WhatsApp',
        'us_amount' => '3',
        'us_code' => '1219',
        'uk_amount' => "2",
        'uk_code' => '1421',
        'image' => 'whatsapp.png',
        ]);
        $data = SmsService::create([
        'name' => 'Go2Bank',
        'us_amount' => '3',
        'us_code' => '8643',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'go2bank.png',
        ]);
        $data = SmsService::create([
        'name' => 'Green Dot',
        'us_amount' => '3',
        'us_code' => '4636',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'greendot.png',
        ]);
        $data = SmsService::create([
        'name' => 'Chase',
        'us_amount' => '3',
        'us_code' => '4632',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'chase.png',
        ]);
        $data = SmsService::create([
        'name' => 'Tinder',
        'us_amount' => '3',
        'us_code' => '1207',
        'uk_amount' => "2.5",
        'uk_code' => '1409',
        'image' => 'tinder.png',
        ]);
        $data = SmsService::create([
        'name' => 'Gmail',
        'us_amount' => '2.5',
        'us_code' => '1155',
        'uk_amount' => "2",
        'uk_code' => '1357',
        'image' => 'gmail.png',
        ]);
        $data = SmsService::create([
        'name' => 'Google Voice',
        'us_amount' => '4',
        'us_code' => '4659',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'googlevoice.png',
        ]);
        $data = SmsService::create([
        'name' => 'GoBank',
        'us_amount' => '3',
        'us_code' => '4671',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'gobank.png',
        ]);
        $data = SmsService::create([
        'name' => 'Facebook',
        'us_amount' => '3',
        'us_code' => '1150',
        'uk_amount' => "2",
        'uk_code' => '1352',
        'image' => 'facebook.png',
        ]);
        $data = SmsService::create([
        'name' => 'Venmo',
        'us_amount' => '3',
        'us_code' => '1214',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'venmo.png',
        ]);
        $data = SmsService::create([
        'name' => 'Inspire',
        'us_amount' => '3',
        'us_code' => '7195',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'inspire.png',
        ]);
        $data = SmsService::create([
        'name' => 'Microsoft/Hotmail',
        'us_amount' => '3',
        'us_code' => '4673',
        'uk_amount' => "2",
        'uk_code' => '1376',
        'image' => 'microsofthotmail.png',
        ]);
        $data = SmsService::create([
        'name' => 'Telegram',
        'us_amount' => '3',
        'us_code' => '1203',
        'uk_amount' => "2.3",
        'uk_code' => '1405',
        'image' => 'telegram.png',
        ]);
        $data = SmsService::create([
        'name' => 'Ourtime',
        'us_amount' => '3',
        'us_code' => '5224',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'ourtime.png',
        ]);
        $data = SmsService::create([
        'name' => 'Yahoo',
        'us_amount' => '3',
        'us_code' => '1220',
        'uk_amount' => "1.7",
        'uk_code' => '1422',
        'image' => 'yahoo.png',
        ]);
        $data = SmsService::create([
        'name' => 'OkCupid',
        'us_amount' => '3',
        'us_code' => '4661',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'okcupid.png',
        ]);
        $data = SmsService::create([
        'name' => 'AOL',
        'us_amount' => '3',
        'us_code' => '1126',
        'uk_amount' => "1.7",
        'uk_code' => '1329',
        'image' => 'aol.png',
        ]);
        $data = SmsService::create([
        'name' => 'Zoosk',
        'us_amount' => '3',
        'us_code' => '5223',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'zoosk.png',
        ]);
        $data = SmsService::create([
        'name' => 'Chime',
        'us_amount' => '3',
        'us_code' => '5759',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'chime.png',
        ]);
        $data = SmsService::create([
        'name' => 'Cash App',
        'us_amount' => '3',
        'us_code' => '4602',
        'uk_amount' => "2",
        'uk_code' => '5516',
        'image' => 'cashapp.png',
        ]);
        $data = SmsService::create([
        'name' => 'GoFundMe',
        'us_amount' => '3',
        'us_code' => '8553',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'gofundme.png',
        ]);
        $data = SmsService::create([
        'name' => 'Credit Karma',
        'us_amount' => '3',
        'us_code' => '4649',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'creditkarma.png',
        ]);
        $data = SmsService::create([
        'name' => 'OfferUp',
        'us_amount' => '3',
        'us_code' => '4599',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'offerup.png',
        ]);
        $data = SmsService::create([
        'name' => 'Craigslist',
        'us_amount' => '3',
        'us_code' => '1140',
        'uk_amount' => "2.3",
        'uk_code' => '1342',
        'image' => 'craigslist.png',
        ]);
        $data = SmsService::create([
        'name' => 'Netflix',
        'us_amount' => '3',
        'us_code' => '1181',
        'uk_amount' => "2.3",
        'uk_code' => '1383',
        'image' => 'netflix.png',
        ]);
        $data = SmsService::create([
        'name' => 'ID.me',
        'us_amount' => '3',
        'us_code' => '5950',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'idme.png',
        ]);
        $data = SmsService::create([
        'name' => 'Amazon',
        'us_amount' => '3',
        'us_code' => '1129',
        'uk_amount' => "2.1",
        'uk_code' => '1332',
        'image' => 'amazon.png',
        ]);
        $data = SmsService::create([
        'name' => 'ICQ',
        'us_amount' => '3',
        'us_code' => '1225',
        'uk_amount' => "2",
        'uk_code' => '1427',
        'image' => 'icq.png',
        ]);
        $data = SmsService::create([
        'name' => 'Twitter',
        'us_amount' => '3',
        'us_code' => '1210',
        'uk_amount' => "2",
        'uk_code' => '1412',
        'image' => 'twitter.png',
        ]);
        $data = SmsService::create([
        'name' => 'Instagram',
        'us_amount' => '3',
        'us_code' => '1163',
        'uk_amount' => "1.8",
        'uk_code' => '1365',
        'image' => 'instagram.png',
        ]);
        $data = SmsService::create([
        'name' => 'Paxful',
        'us_amount' => '2',
        'us_code' => '4586',
        'uk_amount' => "2",
        'uk_code' => '4866',
        'image' => 'paxful.png',
        ]);
        $data = SmsService::create([
        'name' => 'Apple',
        'us_amount' => '3',
        'us_code' => '6621',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'apple.png',
        ]);
        $data = SmsService::create([
        'name' => 'BlueAcorn',
        'us_amount' => '3',
        'us_code' => '8331',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'blueacorn.png',
        ]);
        $data = SmsService::create([
        'name' => 'LinkedIn',
        'us_amount' => '3',
        'us_code' => '1170',
        'uk_amount' => "2.2",
        'uk_code' => '1372',
        'image' => 'linkedin.png',
        ]);
        $data = SmsService::create([
        'name' => 'ZoomInfo',
        'us_amount' => '3',
        'us_code' => '7788',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'zoominfo.png',
        ]);
        $data = SmsService::create([
        'name' => 'Bumble',
        'us_amount' => '3',
        'us_code' => '4596',
        'uk_amount' => "2",
        'uk_code' => '5747',
        'image' => 'bumble.png',
        ]);
        $data = SmsService::create([
        'name' => 'Nike',
        'us_amount' => '2.5',
        'us_code' => '1223',
        'uk_amount' => "2.3",
        'uk_code' => '1425',
        'image' => 'nike.png',
        ]);
        $data = SmsService::create([
        'name' => 'MS Office 365',
        'us_amount' => '3',
        'us_code' => '1173',
        'uk_amount' => "2",
        'uk_code' => '1375',
        'image' => 'msoffice365.png',
        ]);
        $data = SmsService::create([
        'name' => 'Stripe',
        'us_amount' => '3',
        'us_code' => '4601',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'stripe.png',
        ]);
        $data = SmsService::create([
        'name' => 'TikTok',
        'us_amount' => '2.5',
        'us_code' => '1206',
        'uk_amount' => "1.7",
        'uk_code' => '1408',
        'image' => 'tiktok.png',
        ]);
        $data = SmsService::create([
        'name' => 'Crypto.com',
        'us_amount' => '3',
        'us_code' => '9015',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'crypto.png',
        ]);
        $data = SmsService::create([
        'name' => 'PNC Bank',
        'us_amount' => '3',
        'us_code' => '5113',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'pncbank.png',
        ]);
        $data = SmsService::create([
        'name' => 'Coinbase',
        'us_amount' => '3',
        'us_code' => '4585',
        'uk_amount' => "2",
        'uk_code' => '4587',
        'image' => 'coinbase.png',
        ]);
        $data = SmsService::create([
        'name' => 'Protonmail',
        'us_amount' => '3',
        'us_code' => '1189',
        'uk_amount' => "1.7",
        'uk_code' => '1391',
        'image' => 'protonmail.png',
        ]);
        $data = SmsService::create([
        'name' => 'Gemini',
        'us_amount' => '3',
        'us_code' => '7648',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'gemini.png',
        ]);
        $data = SmsService::create([
        'name' => 'Skype',
        'us_amount' => '3',
        'us_code' => '4637',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'skype.png',
        ]);
        $data = SmsService::create([
        'name' => 'Snapchat',
        'us_amount' => '3',
        'us_code' => '1195',
        'uk_amount' => "1.6",
        'uk_code' => '1397',
        'image' => 'snapchat.png',
        ]);
        $data = SmsService::create([
        'name' => 'Grindr',
        'us_amount' => '3',
        'us_code' => '7326',
        'uk_amount' => "2",
        'uk_code' => '7528',
        'image' => 'grindr.png',
        ]);
        $data = SmsService::create([
        'name' => 'Fiverr',
        'us_amount' => '3',
        'us_code' => '1152',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'fiverr.png',
        ]);
        $data = SmsService::create([
        'name' => 'TransferWise',
        'us_amount' => '3',
        'us_code' => '4657',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'transferwise.png',
        ]);
        $data = SmsService::create([
        'name' => 'Simple Bank',
        'us_amount' => '3',
        'us_code' => '5779',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'simplebank.png',
        ]);
        $data = SmsService::create([
        'name' => 'Airbnb',
        'us_amount' => '3',
        'us_code' => '1128',
        'uk_amount' => "2",
        'uk_code' => '1331',
        'image' => 'airbnb.png',
        ]);
        $data = SmsService::create([
        'name' => 'Alibaba',
        'us_amount' => '3',
        'us_code' => '6418',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'alibaba.png',
        ]);
        $data = SmsService::create([
        'name' => 'Steam',
        'us_amount' => '3',
        'us_code' => '1197',
        'uk_amount' => "1.7",
        'uk_code' => '1399',
        'image' => 'steam.png',
        ]);
        $data = SmsService::create([
        'name' => 'WebMoney',
        'us_amount' => '2',
        'us_code' => '1217',
        'uk_amount' => "1.6",
        'uk_code' => '1419',
        'image' => 'webmoney.png',
        ]);
        $data = SmsService::create([
        'name' => 'Capital One',
        'us_amount' => '3',
        'us_code' => '4631',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'capitalone.png',
        ]);
        $data = SmsService::create([
        'name' => 'BlueVine',
        'us_amount' => '3',
        'us_code' => '5424',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'bluevine.png',
        ]);
        $data = SmsService::create([
        'name' => 'Novo',
        'us_amount' => '3',
        'us_code' => '5168',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'novo.png',
        ]);
        $data = SmsService::create([
        'name' => 'SecretBenefits',
        'us_amount' => '3',
        'us_code' => '4654',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'secretbenefits.png',
        ]);
        $data = SmsService::create([
        'name' => 'YouTube',
        'us_amount' => '3',
        'us_code' => '4663',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'youtube.png',
        ]);
        $data = SmsService::create([
        'name' => 'Target',
        'us_amount' => '3',
        'us_code' => '4597',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'target.png',
        ]);
        $data = SmsService::create([
        'name' => 'TD Bank',
        'us_amount' => '3',
        'us_code' => '5436',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'tdbank.png',
        ]);
        $data = SmsService::create([
        'name' => 'Zelle',
        'us_amount' => '3',
        'us_code' => '4633',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'zelle.png',
        ]);
        $data = SmsService::create([
        'name' => 'US Bank',
        'us_amount' => '3',
        'us_code' => '7186',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'usbank.png',
        ]);
        $data = SmsService::create([
        'name' => 'LocalBitcoins',
        'us_amount' => '3',
        'us_code' => '3959',
        'uk_amount' => "2",
        'uk_code' => '3961',
        'image' => 'localbitcoins.png',
        ]);
        $data = SmsService::create([
        'name' => 'Binance',
        'us_amount' => '3',
        'us_code' => '7612',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'binance.png',
        ]);
        $data = SmsService::create([
        'name' => 'MeetMe',
        'us_amount' => '2.5',
        'us_code' => '1178',
        'uk_amount' => "1.5",
        'uk_code' => '1380',
        'image' => 'meetme.png',
        ]);
        $data = SmsService::create([
        'name' => 'TurboTax',
        'us_amount' => '3',
        'us_code' => '8080',
        'uk_amount' => "2",
        'uk_code' => '8081',
        'image' => 'turbotax.png',
        ]);
        $data = SmsService::create([
        'name' => 'WeChat',
        'us_amount' => '3',
        'us_code' => '1216',
        'uk_amount' => "2",
        'uk_code' => '1418',
        'image' => 'wechat.png',
        ]);
        $data = SmsService::create([
        'name' => 'Skrill',
        'us_amount' => '2.5',
        'us_code' => '4493',
        'uk_amount' => "2.5",
        'uk_code' => '4495',
        'image' => 'skrill.png',
        ]);
        $data = SmsService::create([
        'name' => 'Citibank',
        'us_amount' => '4',
        'us_code' => '5704',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'citibank.png',
        ]);
        $data = SmsService::create([
        'name' => 'Adidas',
        'us_amount' => '3',
        'us_code' => '1127',
        'uk_amount' => "2.3",
        'uk_code' => '1330',
        'image' => 'adidas.png',
        ]);
        $data = SmsService::create([
        'name' => 'Movo',
        'us_amount' => '3',
        'us_code' => '5169',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'movo.png',
        ]);
        $data = SmsService::create([
        'name' => 'SunTrust',
        'us_amount' => '3',
        'us_code' => '5849',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'suntrust.png',
        ]);
        $data = SmsService::create([
        'name' => 'Badoo',
        'us_amount' => '3',
        'us_code' => '1133',
        'uk_amount' => "2",
        'uk_code' => '1335',
        'image' => 'badoo.png',
        ]);
        $data = SmsService::create([
        'name' => 'LiveScore',
        'us_amount' => '2.5',
        'us_code' => '1171',
        'uk_amount' => "2.3",
        'uk_code' => '1373',
        'image' => 'livescore.png',
        ]);
        $data = SmsService::create([
        'name' => 'OLX',
        'us_amount' => '2',
        'us_code' => '1183',
        'uk_amount' => "1.5",
        'uk_code' => '1385',
        'image' => 'olx.png',
        ]);
        $data = SmsService::create([
        'name' => 'Spotify',
        'us_amount' => '3',
        'us_code' => '1196',
        'uk_amount' => "2.3",
        'uk_code' => '1398',
        'image' => 'spotify.png',
        ]);
        $data = SmsService::create([
        'name' => 'BBVA',
        'us_amount' => '3',
        'us_code' => '6897',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'bbva.png',
        ]);
        $data = SmsService::create([
        'name'=>'MoneyGram',
        'us_amount' => '3',
        'us_code' => '8267',
        'uk_amount' => "",
        'uk_code' => '',
        'image' => 'moneygram.png',
        ]);
        $data = SmsService::create([
          'name'=>'Other Website',
          'us_amount' => '3',
          'us_code' => '1184',
          'uk_amount' => "2",
          'uk_code' => '1386',
          'image' => 'otherwebsite.png',
          ]);
          $data = SmsService::create([
            'name'=>'Hinge',
            'us_amount' => '3',
            'us_code' => '6297',
            'uk_amount' => "2",
            'uk_code' => '6724',
            'image' => 'hinge.png',
            ]);
          $data = SmsService::create([
            'name'=>'Discord',
            'us_amount' => '2.75',
            'us_code' => '1143',
            'uk_amount' => "1.7",
            'uk_code' => '1345',
            'image' => 'discord.png',
           ]);
         $data = SmsService::create([
          'name'=>'Deliveroo',
          'us_amount' => '3',
          'us_code' => '7400',
          'uk_amount' => "2",
          'uk_code' => '4908',
          'image' => 'deliveroo.png',
          ]);
         $data = SmsService::create([
          'name'=>'PaddyPower',
          'us_amount' => '',
          'us_code' => '',
          'uk_amount' => "2",
          'uk_code' => '4650',
          'image' => 'paddypower.png',
           ]);
        $data = SmsService::create([
          'name'=>'Bolt',
          'us_amount' => '2',
          'us_code' => '1135',
          'uk_amount' => "1.6",
          'uk_code' => '1337',
          'image' => 'bolt.png',
           ]);
        $data = SmsService::create([
            'name'=>'The Insider',
            'us_amount' => '2',
            'us_code' => '1205',
            'uk_amount' => "1.7",
            'uk_code' => '1407',
            'image' => 'theinsider.png',
             ]);
        $data = SmsService::create([
          'name'=>'Microsoft Azure',
          'us_amount' => '3',
          'us_code' => '4582',
          'uk_amount' => "2",
          'uk_code' => '6029',
          'image' => 'microsoftazure.png',
             ]);
        $data = SmsService::create([
          'name'=>'JD.com',
          'us_amount' => '2',
          'us_code' => '1164',
          'uk_amount' => "1.5",
          'uk_code' => '1366',
          'image' => 'jdcom.png',
           ]);
        $data = SmsService::create([
          'name'=>'DoorDash',
          'us_amount' => '3',
          'us_code' => '1145',
          'uk_amount' => "2",
          'uk_code' => '1347',
          'image' => 'doordash.png',
           ]);
        $data = SmsService::create([
          'name'=>'BitClout',
          'us_amount' => '3',
          'us_code' => '8397',
          'uk_amount' => "2",
          'uk_code' => '8220',
          'image' => 'bitclout.png',
           ]);
        $data = SmsService::create([
          'name'=>'Amazon Web Services',
          'us_amount' => '3',
          'us_code' => '4607',
          'uk_amount' => "2.1",
          'uk_code' => '6678',
          'image' => 'amazonwebservices.png',
            ]);
        $data = SmsService::create([
          'name'=>'TaoBao',
          'us_amount' => '3',
          'us_code' => '1201',
          'uk_amount' => "1.5",
          'uk_code' => '1403',
          'image' => 'taobao.png',
            ]);
        $data = SmsService::create([
          'name'=>'Nifty',
          'us_amount' => '',
          'us_code' => '',
          'uk_amount' => "2",
          'uk_code' => '8029',
          'image' => 'nifty.png',
           ]);
        $data = SmsService::create([
          'name'=>'Blizzard',
          'us_amount' => '3',
          'us_code' => '4641',
          'uk_amount' => "2",
          'uk_code' => '8117',
          'image' => 'blizzard.png',
          ]);
       $data = SmsService::create([
            'name'=>'VK',
            'us_amount' => '3',
            'us_code' => '1213',
            'uk_amount' => "2",
            'uk_code' => '1415',
            'image' => 'vk.png',
             ]);
      $data = SmsService::create([
              'name'=>'DiDi',
              'us_amount' => '2.5',
              'us_code' => '1142',
              'uk_amount' => "2",
              'uk_code' => '1344',
              'image' => 'didi.png',
               ]);
      $data = SmsService::create([
             'name'=>'Viber',
             'us_amount' => '2.5',
             'us_code' => '1215',
             'uk_amount' => "1.8",
             'uk_code' => '1417',
             'image' => 'viber.png',
              ]);
      $data = SmsService::create([
             'name'=>'Twilio',
             'us_amount' => '3',
             'us_code' => '1209',
             'uk_amount' => "1.7",
             'uk_code' => '1411',
             'image' => 'twilio.png',
              ]);
      $data = SmsService::create([
             'name'=>'Zoho',
             'us_amount' => '3',
             'us_code' => '1222',
             'uk_amount' => "1.8",
             'uk_code' => '1424',
             'image' => 'zoho.png',
              ]);
       $data = SmsService::create([
            'name'=>'Tencent QQ',
            'us_amount' => '2',
            'us_code' => '1204',
            'uk_amount' => "1.5",
            'uk_code' => '1406',
            'image' => 'tencentqq.png',
             ]);
        $data = SmsService::create([
           'name'=>'Yandex',
           'us_amount' => '3',
           'us_code' => '1221',
           'uk_amount' => "1.7",
           'uk_code' => '1423',
           'image' => 'yandex.png',
           ]);
        $data = SmsService::create([
          'name'=>'VK.com',
          'us_amount' => '2.5',
          'us_code' => '1176',
          'uk_amount' => "2",
          'uk_code' => '1378',
          'image' => 'vkcom.png',
          ]);
        $data = SmsService::create([
          'name'=>'ICard',
          'us_amount' => '2.6',
          'us_code' => '1162',
          'uk_amount' => "2",
          'uk_code' => '1364',
          'image' => 'icard.png',
          ]);

        $data = SmsService::create([
          'name'=>'BetFair',
          'us_amount' => '2',
          'us_code' => '1134',
          'uk_amount' => "1.6",
          'uk_code' => '1336',
          'image' => 'betfair.png',
          ]);
       $data = SmsService::create([
          'name'=>'Naver',
          'us_amount' => '2.5',
          'us_code' => '1180',
          'uk_amount' => "2",
          'uk_code' => '1382',
          'image' => 'naver.png',
           ]);
      $data = SmsService::create([
          'name'=>'Lazada',
          'us_amount' => '2',
          'us_code' => '1168',
          'uk_amount' => "1.6",
          'uk_code' => '1370',
          'image' => 'lazada.png',
          ]);
      $data = SmsService::create([
         'name'=>'Mamba',
         'us_amount' => '2',
         'us_code' => '1177',
         'uk_amount' => "1.7",
         'uk_code' => '1379',
         'image' => 'mamba.png',
          ]);
      $data = SmsService::create([
         'name'=>'Kakao Talk',
         'us_amount' => '3',
         'us_code' => '1165',
         'uk_amount' => "2.3",
         'uk_code' => '1367',
         'image' => 'kakaotalk.png',
          ]);
      $data = SmsService::create([
         'name'=>'CD Keys.com',
         'us_amount' => '2',
         'us_code' => '1137',
         'uk_amount' => "2",
         'uk_code' => '1339',
         'image' => 'cdkeyscom.png',
          ]);
     $data = SmsService::create([
         'name'=>'SweetRing',
         'us_amount' => '3',
         'us_code' => '6475',
         'uk_amount' => "2",
         'uk_code' => '6472',
         'image' => 'sweetring.png',
          ]);
      $data = SmsService::create([
         'name'=>'SneakersnStuff',
         'us_amount' => '3',
         'us_code' => '7255',
         'uk_amount' => "2.5",
         'uk_code' => '7258',
         'image' => 'sneakersnstuff.png',
            ]);
     $data = SmsService::create([
          'name'=>'1688.com',
          'us_amount' => '2',
          'us_code' => '1125',
          'uk_amount' => "1.5",
          'uk_code' => '1328',
          'image' => '1688com.png',
           ]);
    $data = SmsService::create([
        'name'=>'Qiwi',
        'us_amount' => '2',
        'us_code' => '1190',
        'uk_amount' => "2",
        'uk_code' => '1392',
        'image' => 'qiwi.png',
         ]);
    $data = SmsService::create([
        'name'=>'Gameflip',
        'us_amount' => '3',
        'us_code' => '1156',
        'uk_amount' => "1.7",
        'uk_code' => '1358',
        'image' => 'gameflip.png',
         ]);
    $data = SmsService::create([
        'name'=>'Player Auction',
        'us_amount' => '3',
        'us_code' => '5814',
        'uk_amount' => "2",
        'uk_code' => '5815',
        'image' => 'playerauction.png',
         ]);
    $data = SmsService::create([
        'name'=>'Dapper',
        'us_amount' => '',
        'us_code' => '',
        'uk_amount' => "2",
        'uk_code' => '8087',
        'image' => 'dapper.png',
        ]);
    $data = SmsService::create([
        'name'=>'Fastmail',
        'us_amount' => '3',
        'us_code' => '1151',
        'uk_amount' => "1.7",
        'uk_code' => '1353',
        'image' => 'fastmail.png',
         ]);
    $data = SmsService::create([
        'name'=>'GetTaxi',
        'us_amount' => '',
        'us_code' => '',
        'uk_amount' => "1.7",
        'uk_code' => '1359',
        'image' => 'gettaxi.png',
         ]);
    $data = SmsService::create([
        'name'=>'GrabTaxi',
        'us_amount' => '2',
        'us_code' => '1158',
        'uk_amount' => "1.5",
        'uk_code' => '1360',
        'image' => 'grabtaxi.png',
         ]);
    $data = SmsService::create([
        'name'=>'Lyft',
        'us_amount' => '3',
        'us_code' => '1172',
        'uk_amount' => "2",
        'uk_code' => '1374',
        'image' => 'lyft.png',
         ]);
    $data = SmsService::create([
        'name'=>'OlaCabs',
        'us_amount' => '2.6',
        'us_code' => '1185',
        'uk_amount' => "2",
        'uk_code' => '1387',
        'image' => 'olacabs.png',
          ]);
    $data = SmsService::create([
        'name'=>'Weebly',
        'us_amount' => '2',
        'us_code' => '1218',
        'uk_amount' => "1.5",
        'uk_code' => '1420',
        'image' => 'weebly.png',
         ]);
    $data = SmsService::create([
        'name'=>'G2A',
        'us_amount' => '3',
        'us_code' => '1154',
        'uk_amount' => "1.5",
        'uk_code' => '1356',
        'image' => 'g2a.png',
         ]);
    $data = SmsService::create([
      'name'=>'Grailed',
      'us_amount' => '3',
      'us_code' => '1159',
      'uk_amount' => "2",
      'uk_code' => '1361',
      'image' => 'grailed.png',
        ]);
    $data = SmsService::create([
      'name'=>'LINE',
      'us_amount' => '2.5',
      'us_code' => '1169',
      'uk_amount' => "1.7",
      'uk_code' => '1371',
      'image' => 'line.png',
          ]);
    $data = SmsService::create([
       'name'=>'Prolific',
       'us_amount' => '3',
       'us_code' => '4707',
       'uk_amount' => "2",
        'uk_code' => '6782',
        'image' => 'prolific.png',
        ]);
    $data = SmsService::create([
      'name'=>'Auto.RU',
      'us_amount' => '2',
      'us_code' => '1131',
      'uk_amount' => "1.7",
      'uk_code' => '1333',
      'image' => 'autoru.png',
       ]);
    $data = SmsService::create([
      'name'=>'Avito',
      'us_amount' => '2',
      'us_code' => '1132',
      'uk_amount' => "2",
      'uk_code' => '1334',
      'image' => 'avito.png',
        ]);
    $data = SmsService::create([
      'name'=>'BurgerKing',
      'us_amount' => '2',
      'us_code' => '1136',
      'uk_amount' => "1.5",
      'uk_code' => '1338',
      'image' => 'burgerking.png',
       ]);
    $data = SmsService::create([
      'name'=>'Careem',
      'us_amount' => '2.5',
      'us_code' => '1138',
      'uk_amount' => "1.8",
      'uk_code' => '1340',
      'image' => 'careem.png',
        ]);
    $data = SmsService::create([
      'name'=>'CityMobil',
      'us_amount' => '2.5',
      'us_code' => '1139',
      'uk_amount' => "1.5",
      'uk_code' => '1341',
      'image' => 'citymobil.png',
       ]);
    $data = SmsService::create([
      'name'=>'DENT',
      'us_amount' => '2.5',
      'us_code' => '1141',
      'uk_amount' => "2.1",
      'uk_code' => '1343',
      'image' => 'dent.png',
       ]);
    $data = SmsService::create([
      'name'=>'Dodopizza',
      'us_amount' => '2',
      'us_code' => '1144',
      'uk_amount' => "1.7",
      'uk_code' => '1346',
      'image' => 'dodopizza.png',
       ]);
    $data = SmsService::create([
      'name'=>'Drom.RU',
      'us_amount' => '2',
      'us_code' => '1146',
      'uk_amount' => "1.7",
      'uk_code' => '1348',
      'image' => 'dromru.png',
       ]);
    $data = SmsService::create([
      'name'=>'Drug Vokrug',
      'us_amount' => '2',
      'us_code' => '1147',
      'uk_amount' => "1.7",
      'uk_code' => '1349',
      'image' => 'drugvokrug.png',
       ]);
    $data = SmsService::create([
      'name'=>'Dukascopy',
      'us_amount' => '2.5',
      'us_code' => '1148',
      'uk_amount' => "1.7",
      'uk_code' => '1350',
      'image' => 'dukascopy.png',
       ]);
    $data = SmsService::create([
      'name'=>'Enjin Wallet',
      'us_amount' => '2.5',
      'us_code' => '1149',
      'uk_amount' => "2.1",
      'uk_code' => '1351',
      'image' => 'enjinwallet.png',
        ]);
    $data = SmsService::create([
      'name'=>'Fotostrana',
      'us_amount' => '2',
      'us_code' => '1153',
      'uk_amount' => "1.7",
      'uk_code' => '1355',
      'image' => 'fotostrana.png',
        ]);
   $data = SmsService::create([
      'name'=>'HQ Trivia',
      'us_amount' => '3',
      'us_code' => '1160',
      'uk_amount' => "2",
      'uk_code' => '1362',
      'image' => 'hqtrivia.png',
             ]);
    $data = SmsService::create([
      'name'=>'Holvi',
      'us_amount' => '2',
      'us_code' => '1161',
      'uk_amount' => "1.6",
      'uk_code' => '1363',
      'image' => 'holvi.png',
       ]);
    $data = SmsService::create([
      'name'=>'Keybase',
      'us_amount' => '3',
      'us_code' => '1166',
      'uk_amount' => "2.3",
      'uk_code' => '1368',
      'image' => 'keybase.png',
        ]);
    $data = SmsService::create([
      'name'=>'Kriptomat.io',
      'us_amount' => '2',
      'us_code' => '1167',
      'uk_amount' => "1.7",
      'uk_code' => '1369',
      'image' => 'kriptomatio.png',
       ]);
   $data = SmsService::create([
      'name'=>'Mail.RU',
      'us_amount' => '2',
      'us_code' => '1175',
      'uk_amount' => "1.7",
      'uk_code' => '1377',
      'image' => 'mailru.png',
        ]);
  $data = SmsService::create([
      'name'=>'MiChat',
      'us_amount' => '2',
      'us_code' => '1179',
      'uk_amount' => "1.5",
      'uk_code' => '1381',
      'image' => 'michat.png',
         ]);
    $data = SmsService::create([
      'name'=>'OD',
      'us_amount' => '2',
      'us_code' => '1182',
      'uk_amount' => "2.1",
      'uk_code' => '1384',
      'image' => 'od.png',
       ]);
    $data = SmsService::create([
      'name'=>'Post Bank',
      'us_amount' => '2.5',
      'us_code' => '1188',
      'uk_amount' => "2",
      'uk_code' => '1390',
      'image' => 'postbank.png',
        ]);
   $data = SmsService::create([
      'name'=>'Rambler',
      'us_amount' => '2',
      'us_code' => '1191',
      'uk_amount' => "1.7",
      'uk_code' => '1393',
      'image' => 'rambler.png',
       ]);
    $data = SmsService::create([
      'name'=>'SEOSprint.net',
      'us_amount' => '2',
      'us_code' => '1192',
      'uk_amount' => "1.7",
      'uk_code' => '1394',
      'image' => 'seosprintnet.png',
      ]);
  $data = SmsService::create([
      'name'=>'Saicmobility',
      'us_amount' => '2.5',
      'us_code' => '1193',
      'uk_amount' => "2",
      'uk_code' => '1395',
      'image' => 'saicmobility.png',
      ]);
  $data = SmsService::create([
      'name'=>'Sipnet.ru',
      'us_amount' => '2',
      'us_code' => '1194',
      'uk_amount' => "1.7",
      'uk_code' => '1396',
      'image' => 'sipnetru.png',
        ]);
  $data = SmsService::create([
     'name'=>'Steemit',
     'us_amount' => '2',
     'us_code' => '1198',
     'uk_amount' => "2.5",
     'uk_code' => '1400',
     'image' => 'steemit.png',
      ]);
  $data = SmsService::create([
      'name'=>'Suomi24',
      'us_amount' => '2',
      'us_code' => '1199',
      'uk_amount' => "2",
      'uk_code' => '1401',
      'image' => 'suomi24.png',
       ]);
  $data = SmsService::create([
      'name'=>'TAN',
      'us_amount' => '2.5',
      'us_code' => '1200',
      'uk_amount' => "2",
      'uk_code' => '1402',
      'image' => 'tan.png',
       ]);
  $data = SmsService::create([
      'name'=>'Taxi Maksim',
      'us_amount' => '2',
      'us_code' => '1202',
      'uk_amount' => "1.7",
      'uk_code' => '1404',
      'image' => 'taximaksim.png',
        ]);
  $data = SmsService::create([
    'name'=>'Tinkoff',
    'us_amount' => '2',
    'us_code' => '1208',
    'uk_amount' => "1.7",
    'uk_code' => '1401',
    'image' => 'tinkoff.png',
     ]);
  $data = SmsService::create([
    'name'=>'Ubank.ru',
    'us_amount' => '2',
    'us_code' => '1211',
    'uk_amount' => "1.7",
    'uk_code' => '1413',
    'image' => 'ubankru.png',
     ]);
  $data = SmsService::create([
    'name'=>'PapaJohns',
    'us_amount' => '2',
    'us_code' => '1224',
    'uk_amount' => "1.7",
    'uk_code' => '1426',
    'image' => 'papajohns.png',
     ]);
  $data = SmsService::create([
    'name'=>'Papara',
    'us_amount' => '',
    'us_code' => '',
    'uk_amount' => "2",
    'uk_code' => '5627',
    'image' => 'papara.png',
     ]);
  $data = SmsService::create([
   'name'=>'TravelT',
    'us_amount' => '',
    'us_code' => '',
    'uk_amount' => "2.5",
    'uk_code' => '7874',
    'image' => 'travelt.png',
     ]);
  $data = SmsService::create([
    'name'=>'Eneba',
    'us_amount' => '',
    'us_code' => '',
    'uk_amount' => "2",
    'uk_code' => '8749',
    'image' => 'eneba.png',
     ]);

  $data = SmsService::create([
    'name'=>'Jerry',
    'us_amount' => '3',
    'us_code' => '7420',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'jerry.png',
     ]);
  $data = SmsService::create([
    'name'=>'PayActiv',
    'us_amount' => '3',
    'us_code' => '8556',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'payactiv.png',
     ]);
  $data = SmsService::create([
    'name'=>'Uber Eats',
    'us_amount' => '3',
    'us_code' => '4581',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'ubereats.png',
     ]);
  $data = SmsService::create([
    'name'=>'Mercari',
    'us_amount' => '3',
    'us_code' => '7342',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'mercari.png',
      ]);
  $data = SmsService::create([
    'name'=>'Swagbucks',
    'us_amount' => '3',
    'us_code' => '4580',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'swagbucks.png',
       ]);
  $data = SmsService::create([
    'name'=>'OffGamers',
    'us_amount' => '3',
    'us_code' => '4620',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'offgamers.png',
     ]);

  $data = SmsService::create([
    'name'=>'Current',
    'us_amount' => '3',
    'us_code' => '4642',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'current.png',
      ]);
  $data = SmsService::create([
    'name'=>'QuadPay',
    'us_amount' => '3',
    'us_code' => '8429',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'quadpay.png',
     ]);
  $data = SmsService::create([
    'name'=>'Google Suite',
    'us_amount' => '3',
    'us_code' => '4648',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'googlesuite.png',
     ]);

  $data = SmsService::create([
    'name'=>'Kamatera',
    'us_amount' => '3',
    'us_code' => '6949',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'kamatera.png',
     ]);
  $data = SmsService::create([
    'name'=>'Liberty Tax',
    'us_amount' => '3.5',
    'us_code' => '7125',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'libertytax.png',
      ]);
  $data = SmsService::create([
    'name'=>'Scaleway',
    'us_amount' => '3',
    'us_code' => '6562',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'scaleway.png',
     ]);
  $data = SmsService::create([
    'name'=>'Ando',
    'us_amount' => '3',
    'us_code' => '8098',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'ando.png',
     ]);
  $data = SmsService::create([
    'name'=>'Coffee Meets Bagel',
    'us_amount' => '3',
    'us_code' => '8798',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'coffeemeetsbagel.png',
     ]);
  $data = SmsService::create([
    'name'=>'Payoneer',
    'us_amount' => '3',
    'us_code' => '4645',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'payoneer.png',
     ]);
  $data = SmsService::create([
    'name'=>'Microsoft Rewards',
    'us_amount' => '3',
    'us_code' => '4623',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'microsoftrewards.png',
     ]);
  $data = SmsService::create([
    'name'=>'Postmates',
    'us_amount' => '3',
    'us_code' => '4651',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'postmates.png',
     ]);
  $data = SmsService::create([
    'name'=>'Oracle Cloud',
    'us_amount' => '3',
    'us_code' => '4608',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'oraclecloud.png',
     ]);
  $data = SmsService::create([
    'name'=>'Nexmo',
    'us_amount' => '2.5',
    'us_code' => '4697',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'nexmo.png',
     ]);
  $data = SmsService::create([
    'name'=>'Skout',
    'us_amount' => '3',
    'us_code' => '5734',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'skout.png',
     ]);
  $data = SmsService::create([
    'name'=>'Affirm',
    'us_amount' => '3',
    'us_code' => '4678',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'affirm.png',
    ]);
  $data = SmsService::create([
    'name'=>'Ticketmaster',
    'us_amount' => '2.5',
    'us_code' => '4578',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'ticketmaster.png',
     ]);
  $data = SmsService::create([
    'name'=>'Thumbtack',
    'us_amount' => '3',
    'us_code' => '4655',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'thumbtack.png',
     ]);
  $data = SmsService::create([
    'name'=>'Step',
    'us_amount' => '3.5',
    'us_code' => '5111',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'step.png',
     ]);
  $data = SmsService::create([
    'name'=>'Doublelist',
    'us_amount' => '3',
    'us_code' => '4604',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'doublelist.png',
     ]);
  $data = SmsService::create([
    'name'=>'Privacy',
    'us_amount' => '3',
    'us_code' => '5401',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'privacy.png',
     ]);
  $data = SmsService::create([
    'name'=>'G2G',
    'us_amount' => '3',
    'us_code' => '4681',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'g2g.png',
     ]);
  $data = SmsService::create([
    'name'=>'ySense',
    'us_amount' => '3',
    'us_code' => '5062',
    'uk_amount' => "",
    'uk_code' => '',
    'image' => 'ysense.png',
     ]);
   $data = SmsService::create([
    'name'=>'eToro',
    'us_amount' => '3',
    'us_code' => '4668',
    'uk_amount' => "",
     'uk_code' => '',
     'image' => 'etoro.png',
     ]);
  $data = SmsService::create([
      'name'=>'Free TaxUSA',
      'us_amount' => '3',
      'us_code' => '4628',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'freetaxusa.png',
       ]);
  $data = SmsService::create([
      'name'=>'Opinion Outpost',
      'us_amount' => '3',
      'us_code' => '5064',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'opinionoutpost.png',
      ]);

  $data = SmsService::create([
      'name'=>'Yubo',
      'us_amount' => '3',
      'us_code' => '6199',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'yubo.png',
       ]);
  $data = SmsService::create([
      'name'=>'Valued Opinions',
      'us_amount' => '3',
      'us_code' => '4658',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'valuedopinions.png',
       ]);
  $data = SmsService::create([
      'name'=>'Upward',
      'us_amount' => '3',
      'us_code' => '9018',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'upward.png',
      ]);
   $data = SmsService::create([
      'name'=>'Finish Line',
      'us_amount' => '2.5',
      'us_code' => '4662',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'finishline.png',
       ]);
  $data = SmsService::create([
      'name'=>'MoonPay',
      'us_amount' => '3',
      'us_code' => '9116',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'moonpay.png',
       ]);
  $data = SmsService::create([
      'name'=>'InboxDollars',
      'us_amount' => '3',
      'us_code' => '6865',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'inboxdollars.png',
        ]);
  $data = SmsService::create([
      'name'=>'OneOpinion',
      'us_amount' => '3',
      'us_code' => '4629',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'oneopinion.png',
       ]);
  $data = SmsService::create([
      'name'=>'Hily',
      'us_amount' => '3',
      'us_code' => '7224',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'hily.png',
       ]);
 $data = SmsService::create([
      'name'=>'CoinFlip',
      'us_amount' => '3',
      'us_code' => '7806',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'coinflip.png',
       ]);
  $data = SmsService::create([
      'name'=>'iPoll',
      'us_amount' => '3.5',
      'us_code' => '5911',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'ipoll.png',
       ]);
  $data = SmsService::create([
      'name'=>'Revolut',
      'us_amount' => '3',
      'us_code' => '4603',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'revolut.png',
         ]);

  $data = SmsService::create([
      'name'=>'Branded Surveys',
      'us_amount' => '3',
      'us_code' => '5268',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'brandedsurveys.png',
       ]);
  $data = SmsService::create([
      'name'=>'MoneyRawr',
      'us_amount' => '3',
      'us_code' => '4605',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'moneyrawr.png',
       ]);
  $data = SmsService::create([
      'name'=>'Crypto Voucher',
      'us_amount' => '3',
      'us_code' => '4598',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'cryptovoucher.png',
      ]);
  $data = SmsService::create([
      'name'=>'Raise',
      'us_amount' => '3',
      'us_code' => '4624',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'raise.png',
       ]);
  $data = SmsService::create([
      'name'=>'Signal',
      'us_amount' => '3',
      'us_code' => '4594',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'signal.png',
       ]);
  $data = SmsService::create([
      'name'=>'AppStation',
      'us_amount' => '3',
      'us_code' => '4616',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'appstation.png',
      ]);
  $data = SmsService::create([
      'name'=>'Gopuff',
      'us_amount' => '3',
      'us_code' => '8333',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'gopuff.png',
      ]);
  $data = SmsService::create([
      'name'=>'Burner',
      'us_amount' => '3',
      'us_code' => '8538',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'burner.png',
       ]);
  $data = SmsService::create([
      'name'=>'Pinhead',
      'us_amount' => '3',
      'us_code' => '7471',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'pinhead.png',
       ]);
  $data = SmsService::create([
      'name'=>'Klarna',
      'us_amount' => '3',
      'us_code' => '9103',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'klarna.png',
       ]);
  $data = SmsService::create([
      'name'=>'Survey Junkie',
      'us_amount' => '3',
      'us_code' => '4675',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'surveyjunkie.png',
       ]);
  $data = SmsService::create([
      'name'=>'First Internet Bank',
      'us_amount' => '3',
      'us_code' => '6377',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'firstinternetbank.png',
       ]);
  $data = SmsService::create([
      'name'=>'Golden Farmery',
      'us_amount' => '3',
      'us_code' => '4610',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'goldenfarmery.png',
       ]);
  $data = SmsService::create([
      'name'=>'CashAlarm',
      'us_amount' => '3',
      'us_code' => '4609',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'cashalarm.png',
        ]);
  $data = SmsService::create([
      'name'=>'AppFlame',
      'us_amount' => '3',
      'us_code' => '4611',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'appflame.png',
        ]);
  $data = SmsService::create([
      'name'=>'Bitwage',
      'us_amount' => '3',
      'us_code' => '4679',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'bitwage.png',
       ]);
  $data = SmsService::create([
      'name'=>'Simplex',
      'us_amount' => '3',
      'us_code' => '4685',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'simplex.png',
       ]);
  $data = SmsService::create([
      'name'=>'Opinion World',
      'us_amount' => '3',
      'us_code' => '5445',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'opinionworld.png',
       ]);
  $data = SmsService::create([
      'name'=>'MyOpinions',
      'us_amount' => '3',
      'us_code' => '5446',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'myopinions.png',
       ]);
  $data = SmsService::create([
      'name'=>'ProOpinion',
      'us_amount' => '3',
      'us_code' => '5447',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'proopinion.png',
      ]);
  $data = SmsService::create([
      'name'=>'Fitplay',
      'us_amount' => '3',
      'us_code' => '5448',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'fitplay.png',
       ]);
  $data = SmsService::create([
      'name'=>'Seated',
      'us_amount' => '3.5',
      'us_code' => '5715',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'seated.png',
      ]);
  $data = SmsService::create([
      'name'=>'RLOVE',
      'us_amount' => '3',
      'us_code' => '5279',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'rlove.png',
      ]);
  $data = SmsService::create([
      'name'=>'Chowbus',
      'us_amount' => '3',
      'us_code' => '5921',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'chowbus.png',
      ]);
  $data = SmsService::create([
      'name'=>'7-Eleven',
      'us_amount' => '3',
      'us_code' => '9026',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => '7eleven.png',
       ]);
  $data = SmsService::create([
      'name'=>'Mistplay',
      'us_amount' => '3',
      'us_code' => '9059',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'mistplay.png',
      ]);
  $data = SmsService::create([
      'name'=>'Luna Node',
      'us_amount' => '3.5',
      'us_code' => '4595',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'lunanode.png',
       ]);
  $data = SmsService::create([
      'name'=>'CoinPop',
      'us_amount' => '3',
      'us_code' => '4612',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'coinpop.png',
       ]);
  $data = SmsService::create([
      'name'=>'MyGiftCardSupply',
      'us_amount' => '3',
      'us_code' => '4614',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'mygiftcardsupply.png',
       ]);
  $data = SmsService::create([
      'name'=>'Potato Chat',
      'us_amount' => '3.5',
      'us_code' => '5769',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'potatochat.png',
       ]);
  $data = SmsService::create([
      'name'=>'Nonoh',
      'us_amount' => '3',
      'us_code' => '6423',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'nonoh.png',
      ]);
  $data = SmsService::create([
      'name'=>'Strike',
      'us_amount' => '3',
      'us_code' => '7831',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'strike.png',
       ]);
  $data = SmsService::create([
      'name'=>'Ebyo',
      'us_amount' => '3',
      'us_code' => '9029',
      'uk_amount' => "",
      'uk_code' => '',
      'image' => 'ebyo.png',
        ]);            
            

      }







          
          


    
}
