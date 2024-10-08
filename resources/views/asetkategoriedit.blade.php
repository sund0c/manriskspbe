<x-layout>
    <style>
    hr {
        border: 0.3px solid;
    }
</style>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('aset.tampil') }}">Aset</a></li>
        <li class="breadcrumb-item"><a href="{{ route('asetkategori.tampil',$idaset->first()->id) }}">Kategori Aset</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </x-slot>
    @php
    switch ($idaset->first()->kategorise) {
        case 'STRATEGIS':
            $buttonClass = 'btn-danger';
            break;
        case 'TINGGI':
            $buttonClass = 'btn-warning';
            break;
        case 'RENDAH':
            $buttonClass = 'btn-success';
            break;
    }
    @endphp
    <x-slot name="title">{{ $idaset->first()->nama }}
        <p style="font-size: 0.5em;">Jenis Aset: {{ $idaset->first()->jenis }} |
            Pemilik Aset: {{ $idaset->first()->opdRelation->singkatan }}
            @if($idaset->first()->jenis=='APLIKASI')| <button class="btn btn-sm <?php echo $buttonClass; ?>">Kategori : [{{ $idaset->first()->skorkategori }}] {{ $idaset->first()->kategorise }}</button>
            @endif
        </p>
    </x-slot>
    <x-slot name="card_title">
        <strong>UPDATE DATA</strong>
    </x-slot>
    <div class="card-body">

        <form id="modalFormContentEdit" action="{{ route('asetkategori.update') }}" method="POST">
            @csrf
            <input type="hidden" id="aset" name="aset" value="{{ $idaset->first()->id }} ">
            @method('PUT')
            @foreach ($asetkategoris as $no=>$dataItemklasifikasi)
            <input type="hidden" id="id{{ $dataItemklasifikasi->id }}" name="id[{{ $dataItemklasifikasi->id }}]" value="{{ $dataItemklasifikasi->id }}">
            <div class="form-group">
                <strong>{{ ++$no }}. Kriteria</strong> <br>
                {{ $dataItemklasifikasi->kategoriseRelation->tanya }}
            </div>
            <div class="form-group">
                <label for="jawab_{{ $dataItemklasifikasi->id }}">Jawab</label>
                <select name="jawab[{{ $dataItemklasifikasi->id }}]" id="jawab_{{ $dataItemklasifikasi->id }}" class="form-control">
                    @if ($dataItemklasifikasi && $dataItemklasifikasi->kategoriseRelation)
                        <option value="5" {{ $dataItemklasifikasi->jawab == 5 ? 'selected' : '' }}>{{ $dataItemklasifikasi->kategoriseRelation->j1 }}</option>
                        <option value="3" {{ $dataItemklasifikasi->jawab == 3 ? 'selected' : '' }}>{{ $dataItemklasifikasi->kategoriseRelation->j2 }}</option>
                        <option value="1" {{ $dataItemklasifikasi->jawab == 1 ? 'selected' : '' }}>{{ $dataItemklasifikasi->kategoriseRelation->j3 }}</option>
                    @else
                        <option value="">Data tidak tersedia</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="keterangan_{{ $dataItemklasifikasi->id }}">Jelaskan/Deskripsikan Alasan Jawaban Anda*</label>
                <textarea class="form-control" id="keterangan_{{ $dataItemklasifikasi->id }}" name="keterangan[{{ $dataItemklasifikasi->id }}]" autocomplete="false">{{ $dataItemklasifikasi->keterangan }}</textarea>
            </div>
            <hr>
            @endforeach
            <div class="form-group">
                <small id="namaHelp" class="form-text text-muted">*) harus diisi</small>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

</x-layout>
