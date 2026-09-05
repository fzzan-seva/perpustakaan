<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Rack;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookDataSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Categories
        $categories = [
            ['name' => 'Education', 'description' => 'Buku-buku pendidikan dan pengembangan diri'],
            ['name' => 'Fantasy', 'description' => 'Buku fiksi fantasi dan imajinasi'],
            ['name' => 'Action', 'description' => 'Buku bergenre aksi, petualangan, dan thriller'],
            ['name' => 'Comedy', 'description' => 'Buku bergenre komedi dan humor'],
            ['name' => 'Romance', 'description' => 'Buku bergenre romansa dan percintaan'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category['name']], $category);
        }

        // Authors
        $authors = [
            ['name' => 'Andrea Hirata', 'bio' => 'Penulis novel Laskar Pelangi yang terkenal asal Belitung'],
            ['name' => 'Tere Liye', 'bio' => 'Penulis novel-novel bestseller Indonesia dengan berbagai genre'],
            ['name' => 'Dee Lestari', 'bio' => 'Penulis dan musisi Indonesia, dikenal lewat trilogi Supernova'],
            ['name' => 'Ahmad Fuadi', 'bio' => 'Penulis novel Negeri 5 Menara, mantan jurnalis'],
            ['name' => 'Raditya Dika', 'bio' => 'Penulis komedi dan content creator Indonesia'],
            ['name' => 'Pramoedya Ananta Toer', 'bio' => 'Sastrawan Indonesia yang produktif dan berpengaruh'],
            ['name' => 'J.K. Rowling', 'bio' => 'Penulis seri novel Harry Potter asal Inggris'],
            ['name' => 'Haruki Murakami', 'bio' => 'Penulis asal Jepang yang dikenal dengan karya surrealismenya'],
        ];

        foreach ($authors as $author) {
            Author::firstOrCreate(['name' => $author['name']], $author);
        }

        // Publishers
        $publishers = [
            ['name' => 'Gramedia Pustaka Utama', 'address' => 'Jl. Palmerah Barat 29-37, Jakarta Pusat', 'phone' => '021-53650110', 'email' => 'redaksi@gramedia.com'],
            ['name' => 'Bentang Pustaka', 'address' => 'Jl. Banteng Raya No. 1, Sleman, Yogyakarta', 'phone' => '0274-123456', 'email' => 'bentang@bentangpustaka.com'],
            ['name' => 'Republika Penerbit', 'address' => 'Jl. Pejaten Barat No. 14, Jakarta Selatan', 'phone' => '021-12345678', 'email' => 'penerbit@republika.co.id'],
            ['name' => 'Bukune', 'address' => 'Jl. Kramat Raya No. 45, Jakarta Pusat', 'phone' => '021-3923456', 'email' => 'redaksi@bukune.com'],
            ['name' => 'GagasMedia', 'address' => 'Jl. Ciputat Raya No. 23, Jakarta Selatan', 'phone' => '021-7654321', 'email' => 'gagasmedia@gmail.com'],
            ['name' => 'Bloomsbury', 'address' => 'London, United Kingdom', 'phone' => '+44-20-7631-5600', 'email' => 'contact@bloomsbury.com'],
            ['name' => 'Kodansha', 'address' => 'Tokyo, Jepang', 'phone' => '+81-3-5395-3500', 'email' => 'info@kodansha.co.jp'],
        ];

        foreach ($publishers as $publisher) {
            Publisher::firstOrCreate(['name' => $publisher['name']], $publisher);
        }

        // Racks
        $racks = [
            ['name' => 'Rak A', 'location' => 'Lantai 1, Sebelah Timur', 'description' => 'Kategori Education'],
            ['name' => 'Rak B', 'location' => 'Lantai 1, Sebelah Barat', 'description' => 'Kategori Fantasy dan Romance'],
            ['name' => 'Rak C', 'location' => 'Lantai 1, Sebelah Selatan', 'description' => 'Kategori Action'],
            ['name' => 'Rak D', 'location' => 'Lantai 2, Sebelah Utara', 'description' => 'Kategori Comedy'],
            ['name' => 'Rak E', 'location' => 'Lantai 2, Sebelah Timur', 'description' => 'Kategori Referensi dan Novel Umum'],
            ['name' => 'Rak F', 'location' => 'Lantai 2, Sebelah Barat', 'description' => 'Kategori Fiksi Asing dan Sastra'],
        ];

        foreach ($racks as $rack) {
            Rack::firstOrCreate(['name' => $rack['name']], $rack);
        }

        // Books
        $books = [
            ['isbn' => '9786020822093', 'title' => 'Laskar Pelangi', 'category' => 'Education', 'author' => 'Andrea Hirata', 'publisher' => 'Bentang Pustaka', 'stock' => 5, 'description' => 'Novel tentang perjuangan anak-anak Belitung untuk mendapatkan pendidikan.'],
            ['isbn' => '9786020822109', 'title' => 'Sang Pemimpi', 'category' => 'Education', 'author' => 'Andrea Hirata', 'publisher' => 'Bentang Pustaka', 'stock' => 3, 'description' => 'Sekuel dari Laskar Pelangi, tentang mimpi dan persahabatan.'],
            ['isbn' => '9786020822116', 'title' => 'Edensor', 'category' => 'Action', 'author' => 'Andrea Hirata', 'publisher' => 'Bentang Pustaka', 'stock' => 2, 'description' => 'Petualangan Ikal yang menjelajahi negera-negara di Eropa.'],
            ['isbn' => '9786020361547', 'title' => 'Hujan', 'category' => 'Romance', 'author' => 'Tere Liye', 'publisher' => 'Gramedia Pustaka Utama', 'stock' => 4, 'description' => 'Novel bergenre remaja tentang cinta dan masa depan.'],
            ['isbn' => '9786020821935', 'title' => 'Ayah', 'category' => 'Romance', 'author' => 'Tere Liye', 'publisher' => 'Republika Penerbit', 'stock' => 3, 'description' => 'Kisah tentang pengorbanan dan cinta seorang ayah.'],
            ['isbn' => '9786020822406', 'title' => 'Bumi Manusia', 'category' => 'Romance', 'author' => 'Pramoedya Ananta Toer', 'publisher' => 'Gramedia Pustaka Utama', 'stock' => 4, 'description' => 'Novel sejarah yang berlatar di Hindia Belanda era kolonial.'],
            ['isbn' => '9786028803915', 'title' => 'Supernova: Ksatria, Puteri dan Bintang Jatuh', 'category' => 'Fantasy', 'author' => 'Dee Lestari', 'publisher' => 'Bentang Pustaka', 'stock' => 2, 'description' => 'Awal dari trilogi Supernova yang fenomenal.'],
            ['isbn' => '9786024262842', 'title' => 'Negeri 5 Menara', 'category' => 'Action', 'author' => 'Ahmad Fuadi', 'publisher' => 'Gramedia Pustaka Utama', 'stock' => 5, 'description' => 'Novel tentang mimpi dan perjuangan santri di pesantren.'],
            ['isbn' => '9786028944373', 'title' => 'Kambing Jantan', 'category' => 'Comedy', 'author' => 'Raditya Dika', 'publisher' => 'GagasMedia', 'stock' => 6, 'description' => 'Kumpulan cerita komedi tentang kehidupan di Australia.'],
            ['isbn' => '9786028944854', 'title' => 'Marmut Merah Jambu', 'category' => 'Comedy', 'author' => 'Raditya Dika', 'publisher' => 'GagasMedia', 'stock' => 4, 'description' => 'Cerita humor tentang kisah cinta monyet masa SMA.'],
            ['isbn' => '9780747532699', 'title' => 'Harry Potter and the Philosopher\'s Stone', 'category' => 'Fantasy', 'author' => 'J.K. Rowling', 'publisher' => 'Bloomsbury', 'stock' => 5, 'description' => 'Buku pertama dari seri Harry Potter.'],
            ['isbn' => '9780747538486', 'title' => 'Harry Potter and the Chamber of Secrets', 'category' => 'Fantasy', 'author' => 'J.K. Rowling', 'publisher' => 'Bloomsbury', 'stock' => 4, 'description' => 'Buku kedua dari seri Harry Potter.'],
            ['isbn' => '9780747542155', 'title' => 'Harry Potter and the Prisoner of Azkaban', 'category' => 'Fantasy', 'author' => 'J.K. Rowling', 'publisher' => 'Bloomsbury', 'stock' => 3, 'description' => 'Buku ketiga dari seri Harry Potter.'],
            ['isbn' => '9784062109325', 'title' => 'Norwegian Wood', 'category' => 'Romance', 'author' => 'Haruki Murakami', 'publisher' => 'Kodansha', 'stock' => 3, 'description' => 'Novel romantis yang berlatar di Jepang tahun 1960-an.'],
            ['isbn' => '9784062110482', 'title' => 'Kafka on the Shore', 'category' => 'Fantasy', 'author' => 'Haruki Murakami', 'publisher' => 'Kodansha', 'stock' => 2, 'description' => 'Novel surrealisme yang menggabungkan realitas dan mimpi.'],
        ];

        foreach ($books as $book) {
            $category = Category::where('name', $book['category'])->first();
            $author = Author::where('name', $book['author'])->first();
            $publisher = Publisher::where('name', $book['publisher'])->first();

            $rack = match ($category?->name) {
                'Education' => Rack::where('name', 'Rak A')->first(),
                'Fantasy', 'Romance' => Rack::where('name', 'Rak B')->first(),
                'Action' => Rack::where('name', 'Rak C')->first(),
                'Comedy' => Rack::where('name', 'Rak D')->first(),
                default => Rack::where('name', 'Rak E')->first(),
            };

            Book::firstOrCreate(['isbn' => $book['isbn']], [
                'title' => $book['title'],
                'category_id' => $category?->id,
                'author_id' => $author?->id,
                'publisher_id' => $publisher?->id,
                'rack_id' => $rack?->id,
                'stock' => $book['stock'],
                'description' => $book['description'],
            ]);
        }
    }
}
