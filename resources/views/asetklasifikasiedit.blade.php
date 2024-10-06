<x-layout>
    <style>
    hr {
        border: 0.3px solid;
    }
</style>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('aset.tampil') }}">Aset</a></li>
        <li class="breadcrumb-item"><a href="{{ route('asetklasifikasi.tampil',$idaset->first()->id) }}">Klasifikasi Aset</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </x-slot>
    @php
    switch ($idaset->first()->klasifikasi) {
        case 'RAHASIA':
            $buttonClass = 'btn-danger'; // Merah
            break;
        case 'TERBATAS/INTERNAL':
            $buttonClass = 'btn-warning'; // Kuning
            break;
        case 'PUBLIK':
            $buttonClass = 'btn-success'; // Hijau
            break;
    }
    @endphp
    <x-slot name="title">{{ $idaset->first()->nama }}
        <p style="font-size: 0.5em;">Jenis Aset: {{ $idaset->first()->jenis }} |
            Pemilik Aset: {{ $idaset->first()->opdRelation->singkatan }}
            @if($idaset->first()->jenis=='APLIKASI')| <button class="btn btn-sm <?php echo $buttonClass; ?>">Klasifikasi SE: {{ $idaset->first()->klasifikasi }}</button>
            @endif
        </p>
    </x-slot>
    <x-slot name="card_title">
        <strong>UPDATE DATA</strong>
    </x-slot>
    <div class="card-body">

        <form id="modalFormContentEdit" action="{{ route('asetklasifikasi.update') }}" method="POST">
            @csrf
            <input type="hidden" id="aset" name="aset" value="{{ $idaset->first()->id }} ">
            @method('PUT')
            <h1>Confidentiality</h1>
            @foreach ($asetklasifikasis as $no=>$dataItemklasifikasi)
            @if ($dataItemklasifikasi->klasifikasiRelation->domain == 1)
            <input type="hidden" id="id{{ $dataItemklasifikasi->id }}" name="id[{{ $dataItemklasifikasi->id }}]" value="{{ $dataItemklasifikasi->id }}">
            <div class="form-group">
                <strong>{{ $dataItemklasifikasi->klasifikasiRelation->urut }}. Kriteria</strong> <br>
                {{ $dataItemklasifikasi->klasifikasiRelation->tanya }}
            </div>
            <div class="form-group">
                <label for="jawab_{{ $dataItemklasifikasi->id }}">Jawab</label>
                <select name="jawab[{{ $dataItemklasifikasi->id }}]" id="jawab_{{ $dataItemklasifikasi->id }}" class="form-control">
                    @if ($dataItemklasifikasi && $dataItemklasifikasi->klasifikasiRelation)
                            <option value="1" {{ $dataItemklasifikasi->jawab == 1 ? 'selected' : '' }}>{{ $dataItemklasifikasi->klasifikasiRelation->j1 }}</option>
                            <option value="2" {{ $dataItemklasifikasi->jawab == 2 ? 'selected' : '' }}>{{ $dataItemklasifikasi->klasifikasiRelation->j1 }}</option>
                            <option value="3" {{ $dataItemklasifikasi->jawab == 3 ? 'selected' : '' }}>{{ $dataItemklasifikasi->klasifikasiRelation->j3 }}</option>
                            <option value="4" {{ $dataItemklasifikasi->jawab == 4 ? 'selected' : '' }}>{{ $dataItemklasifikasi->klasifikasiRelation->j4 }}</option>
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
            @endif
            @endforeach
            <hr>
            <h1>Integrity</h1>
            @foreach ($asetklasifikasis as $no=>$dataItemklasifikasi)
            @if ($dataItemklasifikasi->klasifikasiRelation->domain == 2)
            <input type="hidden" id="id{{ $dataItemklasifikasi->id }}" name="id[{{ $dataItemklasifikasi->id }}]" value="{{ $dataItemklasifikasi->id }}">
            <div class="form-group">
                <strong>{{ $dataItemklasifikasi->klasifikasiRelation->urut }}. Kriteria</strong> <br>
                {{ $dataItemklasifikasi->klasifikasiRelation->tanya }}
            </div>
            <div class="form-group">
                <label for="jawab_{{ $dataItemklasifikasi->id }}">Jawab</label>
                <select name="jawab[{{ $dataItemklasifikasi->id }}]" id="jawab_{{ $dataItemklasifikasi->id }}" class="form-control">
                    @if ($dataItemklasifikasi && $dataItemklasifikasi->klasifikasiRelation)
                            <option value="1" {{ $dataItemklasifikasi->jawab == 1 ? 'selected' : '' }}>{{ $dataItemklasifikasi->klasifikasiRelation->j1 }}</option>
                            <option value="2" {{ $dataItemklasifikasi->jawab == 2 ? 'selected' : '' }}>{{ $dataItemklasifikasi->klasifikasiRelation->j1 }}</option>
                            <option value="3" {{ $dataItemklasifikasi->jawab == 3 ? 'selected' : '' }}>{{ $dataItemklasifikasi->klasifikasiRelation->j3 }}</option>
                            <option value="4" {{ $dataItemklasifikasi->jawab == 4 ? 'selected' : '' }}>{{ $dataItemklasifikasi->klasifikasiRelation->j4 }}</option>
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
            @endif
            @endforeach
            <h1>Avalaibility</h1>
            @foreach ($asetklasifikasis as $no=>$dataItemklasifikasi)
            @if ($dataItemklasifikasi->klasifikasiRelation->domain == 3)
            <input type="hidden" id="id{{ $dataItemklasifikasi->id }}" name="id[{{ $dataItemklasifikasi->id }}]" value="{{ $dataItemklasifikasi->id }}">
            <div class="form-group">
                <strong>{{ $dataItemklasifikasi->klasifikasiRelation->urut }}. Kriteria</strong> <br>
                {{ $dataItemklasifikasi->klasifikasiRelation->tanya }}
            </div>
            <div class="form-group">
                <label for="jawab_{{ $dataItemklasifikasi->id }}">Jawab</label>
                <select name="jawab[{{ $dataItemklasifikasi->id }}]" id="jawab_{{ $dataItemklasifikasi->id }}" class="form-control">
                    @if ($dataItemklasifikasi && $dataItemklasifikasi->klasifikasiRelation)
                            <option value="1" {{ $dataItemklasifikasi->jawab == 1 ? 'selected' : '' }}>{{ $dataItemklasifikasi->klasifikasiRelation->j1 }}</option>
                            <option value="2" {{ $dataItemklasifikasi->jawab == 2 ? 'selected' : '' }}>{{ $dataItemklasifikasi->klasifikasiRelation->j1 }}</option>
                            <option value="3" {{ $dataItemklasifikasi->jawab == 3 ? 'selected' : '' }}>{{ $dataItemklasifikasi->klasifikasiRelation->j3 }}</option>
                            <option value="4" {{ $dataItemklasifikasi->jawab == 4 ? 'selected' : '' }}>{{ $dataItemklasifikasi->klasifikasiRelation->j4 }}</option>
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
            @endif
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
