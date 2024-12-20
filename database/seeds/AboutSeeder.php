<?php

use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $about = new \App\About;
        $about->caption = '<p>Selamat datang di Kuliner Mojopahit, pujasera yang menawarkan berbagai hidangan lezat khas Indonesia. Kami berlokasi di pusat kuliner, menyajikan pengalaman makan yang nyaman dengan menu yang menggugah selera.</p><p>Dengan suasana yang hangat dan ramah, kami siap memanjakan lidah Anda dengan pilihan makanan yang segar dan berkualitas. Nikmati hidangan favorit Anda atau coba sesuatu yang baru bersama keluarga dan teman-teman di KUliner Mojopahit.</p>';
        $about->image = '1580829269_journey.svg';  // You can update the image if necessary        
        $about->save();
        $this->command->info("About berhasil di insert");
    }
}
