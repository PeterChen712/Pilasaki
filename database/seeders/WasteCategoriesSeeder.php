<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WasteCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('waste_categories')->insert([
            [
                'class_name' => 'Baterai',
                'category' => 'B3',
                'info' => 'Baterai adalah limbah B3 (Bahan Berbahaya dan Beracun) yang memerlukan penanganan khusus.',
                'handling_info' => 'Limbah B3 harus dibuang ke tempat pembuangan khusus yang disediakan oleh pemerintah.',
                'environmental_impact' => 'Jika tidak ditangani dengan benar, limbah B3 dapat mencemari tanah, air, dan udara serta berbahaya bagi kesehatan.',
                'recycling_potential' => 'Baterai dan elektronik dapat didaur ulang di pusat daur ulang khusus.',
                'decomposition_time' => 'Bahan B3 dapat bertahan di lingkungan selama ratusan tahun jika tidak ditangani dengan benar.',
                'reduction_tips' => 'Kurangi penggunaan baterai sekali pakai dan pilih produk elektronik yang ramah lingkungan.',
                'other_examples' => 'Contoh lain limbah B3: elektronik bekas, bahan kimia rumah tangga.',
                'regulations' => 'Peraturan pemerintah tentang pengelolaan limbah B3 mengharuskan penanganan khusus.',
            ],
            [
                'class_name' => 'Botol Plastik',
                'category' => 'Non-B3',
                'info' => 'Botol plastik adalah sampah non-B3 yang sangat umum ditemukan dalam kehidupan sehari-hari.',
                'handling_info' => 'Botol plastik sebaiknya dibersihkan dan dikumpulkan untuk didaur ulang.',
                'environmental_impact' => 'Botol plastik yang tidak dikelola dengan baik dapat mencemari lingkungan dan membahayakan satwa laut.',
                'recycling_potential' => 'Botol plastik memiliki potensi daur ulang yang tinggi dan dapat diolah menjadi produk baru.',
                'decomposition_time' => 'Botol plastik membutuhkan waktu lebih dari 450 tahun untuk terurai secara alami.',
                'reduction_tips' => 'Kurangi penggunaan botol plastik sekali pakai dengan menggunakan botol minum yang dapat diisi ulang.',
                'other_examples' => 'Contoh lain sampah plastik: kantong plastik, kemasan makanan.',
                'regulations' => 'Pengelolaan sampah plastik diatur dalam peraturan pemerintah tentang pengurangan penggunaan plastik.',
            ],
            [
                'class_name' => 'Kertas',
                'category' => 'Non-B3',
                'info' => 'Kertas adalah sampah non-B3 yang dapat didaur ulang dengan mudah.',
                'handling_info' => 'Kertas yang sudah tidak terpakai sebaiknya dikumpulkan dan disalurkan ke pusat daur ulang.',
                'environmental_impact' => 'Kertas yang dibuang sembarangan dapat menyebabkan penumpukan sampah dan kebakaran.',
                'recycling_potential' => 'Kertas dapat didaur ulang menjadi kertas baru atau produk kertas lainnya.',
                'decomposition_time' => 'Kertas membutuhkan waktu sekitar 2-6 minggu untuk terurai secara alami.',
                'reduction_tips' => 'Kurangi penggunaan kertas dengan memanfaatkan teknologi digital.',
                'other_examples' => 'Contoh lain sampah kertas: karton, koran, majalah.',
                'regulations' => 'Pengelolaan sampah kertas diatur dalam peraturan pemerintah tentang daur ulang.',
            ],
            [
                'class_name' => 'Kaca',
                'category' => 'Non-B3',
                'info' => 'Kaca adalah sampah non-B3 yang dapat didaur ulang secara penuh.',
                'handling_info' => 'Kaca yang sudah tidak terpakai sebaiknya dikumpulkan dan disalurkan ke pusat daur ulang.',
                'environmental_impact' => 'Kaca yang dibuang sembarangan dapat menyebabkan cedera dan mencemari lingkungan.',
                'recycling_potential' => 'Kaca dapat didaur ulang menjadi produk kaca baru tanpa kehilangan kualitas.',
                'decomposition_time' => 'Kaca membutuhkan waktu lebih dari 1 juta tahun untuk terurai secara alami.',
                'reduction_tips' => 'Kurangi penggunaan kaca sekali pakai dan pilih produk kaca yang dapat digunakan kembali.',
                'other_examples' => 'Contoh lain sampah kaca: botol kaca, jendela pecah.',
                'regulations' => 'Pengelolaan sampah kaca diatur dalam peraturan pemerintah tentang daur ulang.',
            ],
            [
                'class_name' => 'Elektronik',
                'category' => 'B3',
                'info' => 'Sampah elektronik adalah limbah B3 yang mengandung bahan berbahaya seperti logam berat.',
                'handling_info' => 'Sampah elektronik harus dibuang ke tempat pembuangan khusus yang disediakan oleh pemerintah.',
                'environmental_impact' => 'Jika tidak ditangani dengan benar, sampah elektronik dapat mencemari tanah dan air serta berbahaya bagi kesehatan.',
                'recycling_potential' => 'Elektronik dapat didaur ulang di pusat daur ulang khusus untuk mengurangi limbah.',
                'decomposition_time' => 'Bahan B3 dalam elektronik dapat bertahan di lingkungan selama ratusan tahun jika tidak ditangani dengan benar.',
                'reduction_tips' => 'Kurangi pembelian elektronik baru dengan memperbaiki atau membeli produk refurbished.',
                'other_examples' => 'Contoh lain sampah elektronik: ponsel bekas, komputer rusak.',
                'regulations' => 'Peraturan pemerintah tentang pengelolaan sampah elektronik mengharuskan penanganan khusus.',
            ],
            [
                'class_name' => 'Aluminium',
                'category' => 'Non-B3',
                'info' => 'Aluminium adalah sampah non-B3 yang dapat didaur ulang dengan efisien.',
                'handling_info' => 'Aluminium yang sudah tidak terpakai sebaiknya dikumpulkan dan disalurkan ke pusat daur ulang.',
                'environmental_impact' => 'Aluminium yang dibuang sembarangan dapat mencemari lingkungan dan merusak ekosistem.',
                'recycling_potential' => 'Aluminium memiliki potensi daur ulang yang sangat tinggi dan dapat diolah menjadi produk baru.',
                'decomposition_time' => 'Aluminium membutuhkan waktu lebih dari 200 tahun untuk terurai secara alami.',
                'reduction_tips' => 'Kurangi penggunaan aluminium sekali pakai dengan memilih produk yang dapat digunakan kembali.',
                'other_examples' => 'Contoh lain sampah aluminium: kaleng minuman, foil aluminium.',
                'regulations' => 'Pengelolaan sampah aluminium diatur dalam peraturan pemerintah tentang daur ulang.',
            ],
            [
                'class_name' => 'Organik',
                'category' => 'Non-B3',
                'info' => 'Sampah organik adalah sampah non-B3 yang berasal dari bahan-bahan alami.',
                'handling_info' => 'Sampah organik sebaiknya diolah menjadi kompos atau dibuang ke tempat pembuangan sampah organik.',
                'environmental_impact' => 'Sampah organik yang dibuang sembarangan dapat menyebabkan bau tidak sedap dan pencemaran.',
                'recycling_potential' => 'Sampah organik dapat diolah menjadi kompos yang bermanfaat untuk pertanian.',
                'decomposition_time' => 'Sampah organik membutuhkan waktu beberapa minggu hingga beberapa bulan untuk terurai.',
                'reduction_tips' => 'Kurangi sampah organik dengan memanfaatkan sisa makanan dan bahan organik lainnya.',
                'other_examples' => 'Contoh lain sampah organik: sisa makanan, daun kering.',
                'regulations' => 'Pengelolaan sampah organik diatur dalam peraturan pemerintah tentang pengomposan.',
            ],
        ]);
    }
}
