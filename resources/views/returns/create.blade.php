<x-app-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => route('dashboard')],
        ['label' => 'Pengembalian', 'href' => route('returns.index')],
        ['label' => 'Tambah'],
    ]" />

    <div class="space-y-6">
        <x-card title="Tambah Pengembalian">
            <form action="{{ route('returns.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="space-y-1">
                        <x-input-label value="Peminjaman" />
                        <x-select-input name="borrowing_id" placeholder="Pilih Peminjaman" required>
                            @foreach ($borrowings as $borrowing)
                                <option value="{{ $borrowing->id }}" {{ old('borrowing_id') == $borrowing->id ? 'selected' : '' }}>
                                    {{ $borrowing->member->name }} - {{ $borrowing->book->title }}
                                </option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('borrowing_id')" />
                    </div>

                    <div class="space-y-1">
                        <x-input-label value="Tanggal Kembali" />
                        <x-text-input type="date" name="return_date" :value="old('return_date', date('Y-m-d'))" required />
                        <x-input-error :messages="$errors->get('return_date')" />
                    </div>

                    <div class="space-y-1">
                        <x-input-label value="Kondisi Buku" />
                        <x-select-input name="condition" placeholder="Pilih Kondisi" required>
                            <option value="good" {{ old('condition') === 'good' ? 'selected' : '' }}>Baik</option>
                            <option value="damaged" {{ old('condition') === 'damaged' ? 'selected' : '' }}>Rusak</option>
                            <option value="lost" {{ old('condition') === 'lost' ? 'selected' : '' }}>Hilang</option>
                        </x-select-input>
                        <x-input-error :messages="$errors->get('condition')" />
                    </div>

                    <div class="space-y-1 sm:col-span-2">
                        <x-input-label value="Catatan" />
                        <textarea name="notes" rows="3" class="block w-full rounded-xl border-cream-200 bg-white px-3.5 py-2 text-sm text-slate-800 shadow-sm transition-all focus:border-accent-300 focus:outline-none focus:ring-2 focus:ring-accent-400/30 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-200">{{ old('notes') }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" />
                    </div>
                </div>

                <div class="mt-6 flex flex-wrap items-center justify-end gap-3">
                    <a href="{{ route('returns.index') }}" class="rounded-xl border border-cream-200 px-4 py-2.5 text-sm font-semibold text-slate-700 transition-all hover:border-accent-300 hover:bg-cream-100 dark:border-slate-600 dark:text-slate-300 dark:hover:bg-slate-700">
                        Batal
                    </a>
                    <x-primary-button>Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
