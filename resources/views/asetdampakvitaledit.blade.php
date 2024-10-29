<x-layout>
    <style>
    hr {
        border: 0.3px solid;
    }
    /* Mengatur lebar dan tinggi elemen select */
    .select2-container--default .select2-selection--single {
    border: 1px solid #ced4da; /* Same border as Bootstrap form-control */
    border-radius: 0.25rem; /* Same border-radius as Bootstrap form-control */
    height: calc(2.25rem + 2px); /* Height similar to Bootstrap form-control */
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 2.25; /* Adjust the line-height */
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 100%; /* Ensures the arrow aligns correctly */
}

.select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #6c757d; /* Placeholder color */
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
            @if($idaset->first()->jenis=='APLIKASI')| <button class="btn btn-sm <?php echo $buttonClass; ?>">
                @if ($idaset->first()->dampakvital=='SERIUS') {{ '** Infrastruktur Informasi Vital (IIV) **' }}
                @else {{ 'Non IIV' }}
                @endif
            </button>
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

                <select name="jawab[{{ $dataItemdampakvital->id }}]" id="jawab_{{ $dataItemdampakvital->id }}" class="custom-select">
                    @if ($dataItemdampakvital && $dataItemdampakvital->dampakvitalRelation)
                        <option value="" disabled {{ is_null($dataItemdampakvital->jawab) ? 'selected' : '' }}>Pilih jawaban...</option>
                        <option value="1" {{ $dataItemdampakvital->jawab == 1 ? 'selected' : '' }}>{{ $dataItemdampakvital->dampakvitalRelation->j1 }}</option>
                        <option value="2" {{ $dataItemdampakvital->jawab == 2 ? 'selected' : '' }}>{{ $dataItemdampakvital->dampakvitalRelation->j2 }}</option>
                        <option value="3" {{ $dataItemdampakvital->jawab == 3 ? 'selected' : '' }}>{{ $dataItemdampakvital->dampakvitalRelation->j3 }}</option>
                        <option value="4" {{ $dataItemdampakvital->jawab == 4 ? 'selected' : '' }}>{{ $dataItemdampakvital->dampakvitalRelation->j4 }}</option>
                    @else
                        <option value="">Data tidak tersedia</option>
                    @endif
                </select>





                {{-- <select name="jawab[{{ $dataItemdampakvital->id }}]" id="jawab_{{ $dataItemdampakvital->id }}" class="custom-select">
                    @if ($dataItemdampakvital && $dataItemdampakvital->dampakvitalRelation)
                        <option value="1" title="{{ $dataItemdampakvital->dampakvitalRelation->j1 }}" {{ $dataItemdampakvital->jawab == 1 ? 'selected' : '' }}>{{ $dataItemdampakvital->dampakvitalRelation->j1 }}</option>
                        <option value="2" title="{{ $dataItemdampakvital->dampakvitalRelation->j2 }}" {{ $dataItemdampakvital->jawab == 2 ? 'selected' : '' }}>{{ $dataItemdampakvital->dampakvitalRelation->j2 }}</option>
                        <option value="3" title="{{ $dataItemdampakvital->dampakvitalRelation->j3 }}" {{ $dataItemdampakvital->jawab == 3 ? 'selected' : '' }}>{{ $dataItemdampakvital->dampakvitalRelation->j3 }}</option>
                    @else
                        <option value="">Data tidak tersedia</option>
                    @endif
                </select> --}}
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

    <script>
$(document).ready(function() {
    // Initialize Select2 for the custom select
    $('.custom-select').select2({
        // Optional: You can adjust the settings here
        //placeholder: "Pilih jawaban...", // Set the placeholder
        //allowClear: true, // Allow clear option
        width: '100%', // Set the width to 100% or as needed
    });
});

    </script>


</x-layout>
