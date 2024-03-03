<?php

namespace Database\Seeders;

use App\Models\CompanyProfile\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Company::truncate();
        $company = new Company();
        $company->name = 'Youtube';
        $company->description = 'Youtube is an American multinational technology company focusing on artificial intelligence, online advertising, search engine technology, cloud computing, computer software, quantum computing, e-commerce, and consumer electronics.';
        $company->establishment_date = '2007-09-04';
        $company->company_website_url = 'https://www.youtube.com';
        $company->image = 'images/utube.jpg';
        $company->team_size = '10000-50000';
        $company->location = 'California, USA';
        $company->is_top = 1;
        $company->save();

        $company = new Company();
        $company->name = 'Facebook';
        $company->description = 'Facebook is an multinational technology company focusing on artificial intelligence, online advertising, search engine technology, cloud computing, computer software, quantum computing, e-commerce, and consumer electronics.';
        $company->establishment_date = '1998-09-04';
        $company->company_website_url = 'https://www.facebook.com';
        $company->image = 'images/fb.jpg';
        $company->team_size = '10000-50000';
        $company->location = 'California, USA';
        $company->is_top = 1;
        $company->save();

        $company = new Company();
        $company->name = 'Twitter';
        $company->description = 'Twitter is an American multinational technology company focusing on artificial intelligence, online advertising, search engine technology, cloud computing, computer software, quantum computing, e-commerce, and consumer electronics.';
        $company->establishment_date = '1998-09-04';
        $company->company_website_url = 'https://www.x.com';
        $company->image = 'images/twitter.jpg';
        $company->team_size = '10000-50000';
        $company->location = 'California, USA';
        $company->is_top = 1;
        $company->save();

        $company = new Company();
        $company->name = 'Linkedin';
        $company->description = 'Linkedin is an American multinational technology company focusing on artificial intelligence, online advertising, search engine technology, cloud computing, computer software, quantum computing, e-commerce, and consumer electronics.';
        $company->establishment_date = '1998-09-04';
        $company->company_website_url = 'https://www.linkedin.com';
        $company->image = 'images/linkedin.jpg';
        $company->team_size = '10000-50000';
        $company->location = 'California, USA';
        $company->is_top = 1;
        $company->save();

        $company = new Company();
        $company->name = 'Telegram';
        $company->description = 'Telegram is an American multinational technology company focusing on artificial intelligence, online advertising, search engine technology, cloud computing, computer software, quantum computing, e-commerce, and consumer electronics';
        $company->establishment_date = '1998-09-04';
        $company->company_website_url = 'https://www.telegram.com';
        $company->image = 'images/telegram.jpg';
        $company->team_size = '10000-50000';
        $company->location = 'California, USA';
        $company->is_top = 1;
        $company->save();

        $company = new Company();
        $company->name = 'Github';
        $company->description = 'Github is an American multinational technology company focusing on artificial intelligence, online advertising, search engine technology, cloud computing, computer software, quantum computing, e-commerce, and consumer electronics';
        $company->establishment_date = '2000-09-04';
        $company->company_website_url = 'https://www.github.com';
        $company->image = 'images/github.png';
        $company->team_size = '10000-50000';
        $company->location = 'California, USA';
        $company->is_top = 1;
        $company->save();

        $company = new Company();
        $company->name = 'Envato';
        $company->description = 'Envato is an American multinational technology company focusing on artificial intelligence, online advertising, search engine technology, cloud computing, computer software, quantum computing, e-commerce, and consumer electronics';
        $company->establishment_date = '2000-09-04';
        $company->company_website_url = 'https://www.envato.com';
        $company->image = 'images/envato.png';
        $company->team_size = '50-100';
        $company->location = 'California, USA';
        $company->is_top = 1;
        $company->save();
        Schema::enableForeignKeyConstraints();
    }
}
