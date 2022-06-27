<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site')->insert([
            'keywords' => "herval embalagens, embalagens para alimentos, papel de presente, embalagem de isopor, bandeja laminada, bobina plástica, copo térmico, copos plásticos, canecas plásticas, caixas de papel, fitas adesivas, papel toalha, saco de papel, talheres descartáveis, bobina picotada, bobina de plástico.",
            'description' => "As melhores soluções em embalagens, papel de presente, higiene e limpeza. Contamos com uma vasta linha de produtos e atendimento especializado aos clientes.",
            'facebook' => "https://www.facebook.com/hervalembalagens",
            'instagram' => "instagram",
            'whatsapp' => "(49) 9915-0405",
            'email' => "vendas@hervalembalagens.com.br",
            'telefone' => "(49) 3554-1916",
            'endereco' => "Rua Frei Bruno, 38 | Herval D'Oeste | SC
            Cep: 89610-000",
            'mapa' => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3549.6059173800804!2d-51.49188978494972!3d-27.168686783017975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94e3e5339062107d:0x93414d3be37b305!2sHerval Embalagens!5e0!3m2!1spt-BR!2sbr!4v1598531019172!5m2!1spt-BR!2sbr"
        ]);
    }
}
