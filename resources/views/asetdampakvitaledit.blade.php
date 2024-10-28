<x-layout>
    <style>
    hr {
        border: 0.3px solid;
    }
</style>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('aset.tampil') }}">Aset</a></li>
        <li class="breadcrumb-item"><a href="{{ route('asetdampakvital.tampil',$idaset->first()->id) }}">Vitalitas SE</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </x-slot>
    @php
    switch ($idaset->first()->dampakvital) {
        case 'SERIUS':
            $buttonClass = 'btn-dark'; // Merah
            break;
        case 'SIGNIFIKAN':
            $buttonClass = 'btn-danger'; // Merah
            break;
        case 'TERBATAS':
            $buttonClass = 'btn-warning'; // Kuning
            break;
        case 'MINOR':
            $buttonClass = 'btn-success'; // Hijau
            break;
    }
    @endphp
    <x-slot name="title">{{ $idaset->first()->nama }}
        <p style="font-size: 0.5em;">Jenis Aset: {{ $idaset->first()->jenis }} |
            Pemilik Aset: {{ $idaset->first()->opdRelation->singkatan }}
            @if($idaset->first()->jenis=='APLIKASI')| <button class="btn btn-sm <?php echo $buttonClass; ?>">Vitalitas : [{{ $idaset->first()->skorvital}}] {{ $idaset->first()->dampakvital }}</button>
            @endif
        </p>
    </x-slot>
    <x-slot name="card_title">
        <strong>UPDATE DATA</strong>
    </x-slot>
    <div class="card-body">

        <form id="modalFormContentEdit" action="{{ route('asetdampakvital.update') }}" method="POST">
            @csrf
            <input type="hidden" id="aset" name="aset" value="{{ $idaset->first()->id }} ">
            @method('PUT')
            @foreach ($asetdampakvitals as $no=>$dataItemdampakvital)
            <input type="hidden" id="id{{ $dataItemdampakvital->id }}" name="id[{{ $dataItemdampakvital->id }}]" value="{{ $dataItemdampakvital->id }}">
            <div class="form-group">
                <strong>{{ ++$no }}. Kriteria</strong> <br>
                {{ $dataItemdampakvital->dampakvitalRelation->tanya }}
            </div>
            <div class="form-group">
                <label for="jawab_{{ $dataItemdampakvital->id }}">Jawab</label>
                <select name="jawab[{{ $dataItemdampakvital->id }}]" id="jawab_{{ $dataItemdampakvital->id }}" class="form-control">
                    @if ($dataItemdampakvital && $dataItemdampakvital->dampakvitalRelation)
                        <option value="1" {{ $dataItemdampakvital->jawab == 1 ? 'selected' : '' }}>{{ $dataItemdampakvital->dampakvitalRelation->j1 }}</option>
                        <option value="2" {{ $dataItemdampakvital->jawab == 2 ? 'selected' : '' }}>{{ $dataItemdampakvital->dampakvitalRelation->j2 }}</option>
                        <option value="3" {{ $dataItemdampakvital->jawab == 3 ? 'selected' : '' }}>{{ $dataItemdampakvital->dampakvitalRelation->j3 }}</option>
                    @else
                        <option value="">Data tidak tersedia</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="keterangan_{{ $dataItemdampakvital->id }}">Jelaskan/Deskripsikan Alasan Jawaban Anda*</label>
                <textarea class="form-control" id="keterangan_{{ $dataItemdampakvital->id }}" name="keterangan[{{ $dataItemdampakvital->id }}]" autocomplete="false">{{ $dataItemdampakvital->keterangan }}</textarea>
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
