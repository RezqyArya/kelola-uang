@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10">

    <h2 class="text-2xl font-semibold mb-6">Laporan Keuangan</h2>

    <div class="bg-white shadow-md rounded-lg p-6">

        <form method="GET" action="{{ route('laporan.show') }}" class="space-y-4">

            <div>
                <label class="block font-medium mb-2">Pilih Periode</label>
                <select id="periode" name="periode"
                    class="w-full border rounded-lg px-3 py-2 focus:ring">
                    <option value="harian">Harian</option>
                    <option value="bulanan">Bulanan</option>
                    <option value="tahunan">Tahunan</option>
                    <option value="custom">Custom Range</option>
                </select>
            </div>

            <div id="customRange" class="hidden grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm mb-1">Dari Tanggal</label>
                    <input type="date" name="start_date" class="w-full border rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="block text-sm mb-1">Sampai Tanggal</label>
                    <input type="date" name="end_date" class="w-full border rounded-lg px-3 py-2">
                </div>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Tampilkan Laporan
            </button>
        </form>

    </div>
</div>

<script>
document.getElementById('periode').addEventListener('change', e => {
    document.getElementById('customRange').classList.toggle('hidden', e.target.value !== 'custom')
})
</script>
@endsection