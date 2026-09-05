<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Category;
use App\Models\Member;
use App\Models\Publisher;
use App\Models\Rack;
use App\Models\ReturnRecord;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsiteFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function createRolesPermissions(): void
    {
        $this->seed(RolePermissionSeeder::class);
    }

    protected function createUser(string $name, string $email, string $role): User
    {
        $user = User::factory()->create([
            'name' => $name,
            'email' => $email,
            'password' => 'password',
            'role' => $role,
        ]);
        $user->assignRole($role);

        return $user;
    }

    protected function createMasterData(): void
    {
        $category = Category::create(['name' => 'Fiksi']);
        $author = Author::create(['name' => 'Penulis A']);
        $publisher = Publisher::create(['name' => 'Penerbit B']);
        $rack = Rack::create(['name' => 'R1', 'location' => 'Rak 1']);

        $this->category = $category;
        $this->author = $author;
        $this->publisher = $publisher;
        $this->rack = $rack;

        $this->book = Book::create([
            'isbn' => '978-000-001',
            'title' => 'Buku Pertama',
            'category_id' => $category->id,
            'author_id' => $author->id,
            'publisher_id' => $publisher->id,
            'rack_id' => $rack->id,
            'stock' => 5,
            'description' => 'Deskripsi',
        ]);
    }

    // ==================== SISWA (USER) FLOW ====================

    public function test_siswa_catalog_flow(): void
    {
        $this->createRolesPermissions();
        $this->createMasterData();
        $siswa = $this->createUser('Siswa', 'siswa@test.com', 'siswa');
        $member = Member::create(['user_id' => $siswa->id, 'name' => 'Siswa', 'nis' => '12345']);

        $this->actingAs($siswa)
            ->get(route('catalog.index'))
            ->assertOk()
            ->assertSee('Buku Pertama');

        $this->actingAs($siswa)
            ->get(route('catalog.show', $this->book))
            ->assertOk()
            ->assertSee('Buku Pertama');
    }

    public function test_siswa_can_request_borrowing(): void
    {
        $this->createRolesPermissions();
        $this->createMasterData();
        $siswa = $this->createUser('Siswa', 'siswa@test.com', 'siswa');
        $member = Member::create(['user_id' => $siswa->id, 'name' => 'Siswa', 'nis' => '12345']);

        $this->actingAs($siswa)
            ->post(route('borrowings.request'), ['book_id' => $this->book->id])
            ->assertRedirect(route('borrowings.history'));

        $this->assertDatabaseHas('borrowings', [
            'member_id' => $member->id,
            'book_id' => $this->book->id,
            'status' => 'pending',
        ]);
    }

    public function test_siswa_can_view_borrowing_history(): void
    {
        $this->createRolesPermissions();
        $this->createMasterData();
        $siswa = $this->createUser('Siswa', 'siswa@test.com', 'siswa');
        $member = Member::create(['user_id' => $siswa->id, 'name' => 'Siswa', 'nis' => '12345']);

        $this->actingAs($siswa)
            ->get(route('borrowings.history'))
            ->assertOk();
    }

    public function test_siswa_redirected_to_catalog_on_root(): void
    {
        $this->createRolesPermissions();
        $this->createMasterData();
        $siswa = $this->createUser('Siswa', 'siswa@test.com', 'siswa');
        $member = Member::create(['user_id' => $siswa->id, 'name' => 'Siswa', 'nis' => '12345']);

        $this->actingAs($siswa)
            ->get('/')
            ->assertRedirect(route('catalog.index'));
    }

    public function test_siswa_profile_page(): void
    {
        $this->createRolesPermissions();
        $this->createMasterData();
        $siswa = $this->createUser('Siswa', 'siswa@test.com', 'siswa');

        $this->actingAs($siswa)
            ->get(route('profile.edit'))
            ->assertOk();
    }

    // ==================== ADMIN FLOW ====================

    public function test_admin_dashboard(): void
    {
        $this->createRolesPermissions();
        $this->createMasterData();
        $admin = $this->createUser('Admin', 'admin@test.com', 'admin');

        $this->actingAs($admin)
            ->get(route('dashboard'))
            ->assertOk();
    }

    public function test_admin_can_manage_books(): void
    {
        $this->createRolesPermissions();
        $this->createMasterData();
        $admin = $this->createUser('Admin', 'admin@test.com', 'admin');

        $this->actingAs($admin)->get(route('books.index'))->assertOk();
        $this->actingAs($admin)->get(route('books.create'))->assertOk();

        $newBook = $this->actingAs($admin)->post(route('books.store'), [
            'isbn' => '978-000-002',
            'title' => 'Buku Baru',
            'category_id' => $this->category->id,
            'author_id' => $this->author->id,
            'publisher_id' => $this->publisher->id,
            'rack_id' => $this->rack->id,
            'stock' => 3,
            'description' => 'desc',
        ])->assertSessionHasNoErrors();

        $book = Book::where('isbn', '978-000-002')->firstOrFail();
        $book->load('category', 'author', 'publisher', 'rack');

        $this->actingAs($admin)->get(route('books.show', $book))->assertOk();
        $this->actingAs($admin)->get(route('books.edit', $book))->assertOk();

        $this->actingAs($admin)->put(route('books.update', $book), [
            'isbn' => '978-000-002',
            'title' => 'Buku Baru Update',
            'category_id' => $this->category->id,
            'author_id' => $this->author->id,
            'publisher_id' => $this->publisher->id,
            'rack_id' => $this->rack->id,
            'stock' => 4,
            'description' => 'desc',
        ])->assertSessionHasNoErrors();

        $this->actingAs($admin)->delete(route('books.destroy', $book))->assertRedirect();
    }

    public function test_admin_can_manage_categories(): void
    {
        $this->createRolesPermissions();
        $this->createMasterData();
        $admin = $this->createUser('Admin', 'admin@test.com', 'admin');

        $this->actingAs($admin)->get(route('categories.index'))->assertOk();
        $this->actingAs($admin)->get(route('categories.create'))->assertOk();

        $this->actingAs($admin)->post(route('categories.store'), [
            'name' => 'Non-Fiksi',
            'description' => 'desk',
        ])->assertSessionHasNoErrors();

        $cat = Category::where('name', 'Non-Fiksi')->firstOrFail();
        $this->actingAs($admin)->get(route('categories.show', $cat))->assertOk();
        $this->actingAs($admin)->get(route('categories.edit', $cat))->assertOk();
        $this->actingAs($admin)->put(route('categories.update', $cat), [
            'name' => 'Non-Fiksi 2',
            'description' => 'desc2',
        ])->assertSessionHasNoErrors();
        $this->actingAs($admin)->delete(route('categories.destroy', $cat))->assertRedirect();
    }

    public function test_admin_can_manage_authors(): void
    {
        $this->createRolesPermissions();
        $this->createMasterData();
        $admin = $this->createUser('Admin', 'admin@test.com', 'admin');

        $this->actingAs($admin)->get(route('authors.index'))->assertOk();
        $this->actingAs($admin)->get(route('authors.create'))->assertOk();
        $this->actingAs($admin)->post(route('authors.store'), [
            'name' => 'Penulis Baru',
            'bio' => 'bio',
        ])->assertSessionHasNoErrors();

        $author = Author::where('name', 'Penulis Baru')->firstOrFail();
        $this->actingAs($admin)->get(route('authors.show', $author))->assertOk();
        $this->actingAs($admin)->get(route('authors.edit', $author))->assertOk();
        $this->actingAs($admin)->put(route('authors.update', $author), [
            'name' => 'Penulis Baru 2',
            'bio' => 'bio2',
        ])->assertSessionHasNoErrors();
        $this->actingAs($admin)->delete(route('authors.destroy', $author))->assertRedirect();
    }

    public function test_admin_can_manage_publishers(): void
    {
        $this->createRolesPermissions();
        $this->createMasterData();
        $admin = $this->createUser('Admin', 'admin@test.com', 'admin');

        $this->actingAs($admin)->get(route('publishers.index'))->assertOk();
        $this->actingAs($admin)->get(route('publishers.create'))->assertOk();
        $this->actingAs($admin)->post(route('publishers.store'), [
            'name' => 'Penerbit Baru',
        ])->assertSessionHasNoErrors();

        $pub = Publisher::where('name', 'Penerbit Baru')->firstOrFail();
        $this->actingAs($admin)->get(route('publishers.show', $pub))->assertOk();
        $this->actingAs($admin)->get(route('publishers.edit', $pub))->assertOk();
        $this->actingAs($admin)->put(route('publishers.update', $pub), [
            'name' => 'Penerbit Baru 2',
        ])->assertSessionHasNoErrors();
        $this->actingAs($admin)->delete(route('publishers.destroy', $pub))->assertRedirect();
    }

    public function test_admin_can_manage_racks(): void
    {
        $this->createRolesPermissions();
        $this->createMasterData();
        $admin = $this->createUser('Admin', 'admin@test.com', 'admin');

        $this->actingAs($admin)->get(route('racks.index'))->assertOk();
        $this->actingAs($admin)->get(route('racks.create'))->assertOk();
        $this->actingAs($admin)->post(route('racks.store'), [
            'name' => 'R9',
            'location' => 'Rak Sembilan',
        ])->assertSessionHasNoErrors();

        $rack = Rack::where('name', 'R9')->firstOrFail();
        $this->actingAs($admin)->get(route('racks.show', $rack))->assertOk();
        $this->actingAs($admin)->get(route('racks.edit', $rack))->assertOk();
        $this->actingAs($admin)->put(route('racks.update', $rack), [
            'name' => 'R10',
            'location' => 'Rak Sepuluh',
        ])->assertSessionHasNoErrors();
        $this->actingAs($admin)->delete(route('racks.destroy', $rack))->assertRedirect();
    }

    public function test_admin_can_manage_members(): void
    {
        $this->createRolesPermissions();
        $this->createMasterData();
        $admin = $this->createUser('Admin', 'admin@test.com', 'admin');

        $this->actingAs($admin)->get(route('members.index'))->assertOk();
        $this->actingAs($admin)->get(route('members.create'))->assertOk();
        $this->actingAs($admin)->post(route('members.store'), [
            'name' => 'Anggota Baru',
            'nis' => 'NIS-999',
            'phone' => '0812',
            'address' => 'Jl. Satu',
            'password' => 'secret1',
        ])->assertSessionHasNoErrors();

        $member = Member::where('nis', 'NIS-999')->firstOrFail();
        $this->actingAs($admin)->get(route('members.show', $member))->assertOk();
        $this->actingAs($admin)->get(route('members.edit', $member))->assertOk();
        $this->actingAs($admin)->put(route('members.update', $member), [
            'name' => 'Anggota Baru 2',
            'email' => 'anggota@test.com',
            'nis' => 'NIS-999',
            'phone' => '0813',
            'address' => 'Jl. Dua',
        ])->assertSessionHasNoErrors();
        $this->actingAs($admin)->delete(route('members.destroy', $member))->assertRedirect();
    }

    public function test_admin_can_process_borrowing_and_return(): void
    {
        $this->createRolesPermissions();
        $this->createMasterData();
        $admin = $this->createUser('Admin', 'admin@test.com', 'admin');

        $member = Member::create(['user_id' => $admin->id, 'name' => 'Admin Member', 'nis' => 'A-1']);

        $this->actingAs($admin)->get(route('borrowings.index'))->assertOk();
        $this->actingAs($admin)->get(route('borrowings.create'))->assertOk();

        $this->actingAs($admin)->post(route('borrowings.store'), [
            'member_id' => $member->id,
            'book_id' => $this->book->id,
            'borrow_date' => now()->format('Y-m-d'),
            'due_date' => now()->addDays(7)->format('Y-m-d'),
            'notes' => 'note',
        ])->assertSessionHasNoErrors();

        $borrowing = Borrowing::where('member_id', $member->id)->firstOrFail();

        // confirm flow
        $this->actingAs($admin)->patch(route('borrowings.confirm', $borrowing))->assertRedirect();
        $borrowing->refresh();
        $this->assertEquals('borrowed', $borrowing->status);

        $this->actingAs($admin)->get(route('borrowings.show', $borrowing))->assertOk();
        $this->actingAs($admin)->get(route('borrowings.edit', $borrowing))->assertOk();

        // returns
        $this->actingAs($admin)->get(route('returns.index'))->assertOk();
        $this->actingAs($admin)->get(route('returns.create'))->assertOk();

        $this->actingAs($admin)->post(route('returns.store'), [
            'borrowing_id' => $borrowing->id,
            'return_date' => now()->format('Y-m-d'),
            'condition' => 'good',
            'notes' => 'ok',
        ])->assertSessionHasNoErrors();

        $return = ReturnRecord::where('borrowing_id', $borrowing->id)->firstOrFail();
        $this->actingAs($admin)->get(route('returns.show', $return))->assertOk();
        $this->actingAs($admin)->get(route('returns.edit', $return))->assertOk();
        $this->actingAs($admin)->put(route('returns.update', $return), [
            'borrowing_id' => $borrowing->id,
            'return_date' => now()->format('Y-m-d'),
            'condition' => 'good',
            'notes' => 'ok2',
        ])->assertSessionHasNoErrors();
    }

    public function test_admin_can_reject_pending_borrowing(): void
    {
        $this->createRolesPermissions();
        $this->createMasterData();
        $admin = $this->createUser('Admin', 'admin@test.com', 'admin');

        $member = Member::create(['user_id' => $admin->id, 'name' => 'Admin Member', 'nis' => 'A-1']);
        $borrowing = Borrowing::create([
            'member_id' => $member->id,
            'book_id' => $this->book->id,
            'borrow_date' => now(),
            'due_date' => now()->addDays(7),
            'status' => 'pending',
            'notes' => null,
            'requested_at' => now(),
        ]);

        $this->actingAs($admin)->patch(route('borrowings.reject', $borrowing), [
            'rejection_reason' => 'Tidak memenuhi syarat',
        ])->assertRedirect();

        $borrowing->refresh();
        $this->assertEquals('rejected', $borrowing->status);
    }

    public function test_admin_reports_and_activity_log(): void
    {
        $this->createRolesPermissions();
        $this->createMasterData();
        $admin = $this->createUser('Admin', 'admin@test.com', 'admin');

        $this->actingAs($admin)->get(route('reports.index'))->assertOk();
        $this->actingAs($admin)->get(route('activity-log.index'))->assertOk();
    }
}
