@extends('layouts.master') @section('css')
<link rel="stylesheet" href="{{ asset('css/weather.css') }}" />
@endsection @section('content')
<main>
    <p class="desc">
        Sumber Diperoleh Secara Resmi dari
        <a href="https://data.bmkg.go.id">BMKG</a>
        Secara Real Time.
        <span id="date"></span>
        <span id="time"></span>
    </p>

    <section class="weather-section">
        <h1>Weather ⛅️</h1>
        <form action="{{ url('/weather') }}" method="GET">
            <select id="province" name="province" class="search-input" required>
                <option value="" disabled selected>Select Province</option>
            </select>
            <select id="city" name="city" class="search-input" required>
                <option value="" disabled selected>Select City</option>
            </select>
            <br />
            <button type="submit" class="btn btn-dark">Search</button>
        </form>

        @if(isset($getLocation['description']) && isset($getLocation['domain']))
        <h5 class="city">
            Prediksi Cuaca :
            <span class="blinking-text-dugem"
                >{{ $getLocation['description'] }}, {{ $getLocation['domain']
                }}</span
            >
        </h5>
        <div class="table-responsive">
            <table class="table table-responsive table-cuaca">
                <tr>
                    <th>Tanggal</th>
                    <th>Cuaca</th>
                    <th>Jam</th>
                    <th>Celcius</th>
                    <th>Farenheit</th>
                </tr>
                @foreach($getLocation['params'][6]['times'] as $index => $cuaca)
                @if(isset($getLocation['params'][5]['times'][$index])) @php
                $suhu = $getLocation['params'][5]['times'][$index]; @endphp
                <tr>
                    <td>
                        {{ \Carbon\Carbon::createFromFormat('YmdHi',
                        $cuaca['datetime'])->format('d F Y') }}
                    </td>
                    <td>{{ $cuaca['name'] }}</td>
                    <td>
                        {{ \Carbon\Carbon::createFromFormat('YmdHi',
                        $cuaca['datetime'])->format('H:i:s') }}
                    </td>
                    <td>{{ $suhu['celcius'] }}</td>
                    <td>{{ $suhu['fahrenheit'] }}</td>
                </tr>
                @endif @endforeach
            </table>
        </div>
        @else
        <h5 class="city">Data cuaca tidak ditemukan.</h5>
        @endif
    </section>
    <section class="earthquake-section">
        <h1>Earthquake 🌎</h1>
        <h4 class="blinking-text-important">Lastest Earthquake</h4>
        <img
            src="{{ $getQuakeData['shakemap'] }}"
            alt="Earthquake Image"
            style="max-width: 100%"
        />
        <div class="table-responsive">
            <table class="table table-responsive">
                <tr>
                    <th>Tanggal</th>
                    <th>Wilayah</th>
                    <th>Jam</th>
                    <th>Magnitude</th>
                </tr>
                <tr>
                    <td>{{ $getQuakeData['tanggal'] }}</td>
                    <td>{{ $getQuakeData['wilayah'] }}</td>
                    <td>{{ $getQuakeData['jam'] }}</td>
                    <td>{{ $getQuakeData['magnitude'] }}</td>
                </tr>
            </table>
        </div>
        <h4 class="blinking-text-important">Earthquake > 5 Mag</h4>
        <br />
        <div class="table-responsive">
            <table class="table table-responsive">
                <tr>
                    <th>Tanggal</th>
                    <th>Wilayah</th>
                    <th>Jam</th>
                    <th>Magnitude</th>
                    <th>Potensi</th>
                </tr>
                @foreach($quakeBigData as $row)
                <tr>
                    <td>{{ $row['Tanggal'] }}</td>
                    <td>{{ $row['Wilayah'] }}</td>
                    <td>{{ $row['Jam'] }}</td>
                    <td>{{ $row['Magnitude'] }}</td>
                    <td>{{ $row['Potensi'] }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </section>
</main>
@endsection @section('script')
<script src="{{ asset('js/weather.js') }}"></script>
@endsection
