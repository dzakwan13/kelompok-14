
@extends('layouts.app')

@section('title', 'Edit Perangkat - StayCool')

@section('page-heading', 'Edit Perangkat')

@section('content')

    @php
        $selectedMode = old('mode', $fan->setting?->mode ?? 'otomatis');

        $savedRules = $fan->setting?->speedRules
            ->map(function ($rule) {
                return [
                    'temperature_threshold' => $rule->temperature_threshold,
                    'fan_speed' => $rule->fan_speed,
                ];
            })
            ->toArray() ?? [];

        $defaultRules = [
            ['temperature_threshold' => 28, 'fan_speed' => 40],
            ['temperature_threshold' => 30, 'fan_speed' => 70],
            ['temperature_threshold' => 32, 'fan_speed' => 100],
        ];

        $rules = old('rules', !empty($savedRules) ? $savedRules : $defaultRules);
    @endphp

    <div class="section-heading">
        <div>
            <h2>Edit Informasi Perangkat</h2>
            <p>Ubah informasi dan pengaturan perangkat kipas.</p>
        </div>
    </div>

    <div class="fan-form-card">

        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('fans.update', $fan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama Kipas</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $fan->name) }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="device_id">ID Perangkat (ESP32)</label>
                <input
                    type="text"
                    id="device_id"
                    name="device_id"
                    value="{{ old('device_id', $fan->device_id) }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="mode">Mode Operasi</label>
                <select id="mode" name="mode" required>
                    <option value="otomatis" {{ $selectedMode === 'otomatis' ? 'selected' : '' }}>
                        Otomatis
                    </option>

                    <option value="manual" {{ $selectedMode === 'manual' ? 'selected' : '' }}>
                        Manual
                    </option>
                </select>
            </div>

            {{-- Pengaturan Otomatis --}}
            <div id="automaticSettings" style="display: none;">

                <div class="section-heading">
                    <div>
                        <h2>Aturan Suhu dan Kecepatan</h2>
                        <p>
                            Atur suhu mulai dan kecepatan kipas.
                            Jika suhu belum mencapai aturan pertama, kipas akan mati.
                        </p>
                    </div>
                </div>

                <div id="rulesContainer">

                    @foreach ($rules as $index => $rule)
                        <div class="rule-item" style="border: 1px solid #e5e7eb; border-radius: 10px; padding: 16px; margin-bottom: 16px;">

                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                <strong class="rule-title">Aturan {{ $loop->iteration }}</strong>

                                <button type="button" class="btn-danger remove-rule">
                                    Hapus
                                </button>
                            </div>

                            <div class="form-group">
                                <label>Suhu Mulai (°C)</label>

                                <div style="display: flex; align-items: center; gap: 16px;">
                                    <input
                                        type="range"
                                        class="temperature-slider"
                                        min="20"
                                        max="45"
                                        step="0.1"
                                        value="{{ $rule['temperature_threshold'] }}"
                                        style="flex: 1;"
                                    >

                                    <input
                                        type="number"
                                        class="temperature-number"
                                        name="rules[{{ $index }}][temperature_threshold]"
                                        min="20"
                                        max="45"
                                        step="0.1"
                                        value="{{ $rule['temperature_threshold'] }}"
                                        style="width: 85px;"
                                        required
                                    >
                                </div>
                                <small
                                    class="temperature-error"
                                    style="display: none; color: #dc2626; margin-top: 6px;"
                                ></small>
                            </div>

                            <div class="form-group">
                                <label>Kecepatan Kipas (%)</label>

                                <input
                                    type="number"
                                    name="rules[{{ $index }}][fan_speed]"
                                    min="0"
                                    max="100"
                                    step="1"
                                    value="{{ $rule['fan_speed'] }}"
                                    required
                                >
                            </div>

                        </div>
                    @endforeach

                </div>

                <button type="button" id="addRule" class="btn-secondary">
                    + Tambah Aturan
                </button>

            </div>

            {{-- Pengaturan Manual --}}
            <div id="manualSettings" style="display: none;">

                <div class="form-group">
                    <label for="manual_speed">Kecepatan Kipas (%)</label>

                    <input
                        type="number"
                        id="manual_speed"
                        name="manual_speed"
                        min="0"
                        max="100"
                        step="1"
                        value="{{ old('manual_speed', $fan->setting?->speed ?? $fan->speed ?? 0) }}"
                    >

                    <small>Masukkan kecepatan kipas antara 0–100%.</small>
                </div>

            </div>

            <div class="form-actions">
                <a href="{{ route('fans.index') }}" class="btn-secondary">
                    Batal
                </a>

                <button type="submit" class="btn-primary">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const modeSelect = document.getElementById('mode');
            const automaticSettings = document.getElementById('automaticSettings');
            const manualSettings = document.getElementById('manualSettings');
            const rulesContainer = document.getElementById('rulesContainer');
            const addRuleButton = document.getElementById('addRule');
            const manualSpeed = document.getElementById('manual_speed');

            // Menampilkan pengaturan berdasarkan mode
            function updateMode() {
                const isAutomatic = modeSelect.value === 'otomatis';
                const isManual = modeSelect.value === 'manual';

                automaticSettings.style.display = isAutomatic ? 'block' : 'none';
                manualSettings.style.display = isManual ? 'block' : 'none';

                rulesContainer.querySelectorAll('input').forEach(input => {
                    input.disabled = !isAutomatic;
                });

                manualSpeed.disabled = !isManual;
            }

            modeSelect.addEventListener('change', updateMode);

            // Menghubungkan slider dengan input angka
            function connectTemperatureInputs(ruleItem) {
                const slider = ruleItem.querySelector('.temperature-slider');
                const number = ruleItem.querySelector('.temperature-number');
                const errorMessage = ruleItem.querySelector('.temperature-error');

                function validateTemperature() {
                    let message = '';

                    if (number.value !== '') {
                        const value = Number(number.value);

                        if (value < 20) {
                            message = 'Suhu minimal adalah 20°C.';
                        } else if (value > 45) {
                            message = 'Suhu maksimal adalah 45°C.';
                        }
                    }

                    number.setCustomValidity(message);

                    if (errorMessage) {
                        errorMessage.textContent = message;
                        errorMessage.style.display = message ? 'block' : 'none';
                    }

                    return message === '' && number.value !== '';
                }

                // Slider memperbarui input angka
                slider.addEventListener('input', function () {
                    number.value = slider.value;
                    validateTemperature();
                });

                // Input angka memperbarui slider jika nilainya valid
                number.addEventListener('input', function () {
                    if (validateTemperature()) {
                        slider.value = number.value;
                    }
                });
            }

            // Memperbarui nomor dan nama input aturan
            
            function updateRules() {
                const ruleItems = rulesContainer.querySelectorAll('.rule-item');

                ruleItems.forEach((rule, index) => {
                    rule.querySelector('.rule-title').textContent =
                        'Aturan ' + (index + 1);

                    const temperatureInput =
                        rule.querySelector('.temperature-number');

                    if (temperatureInput) {
                        temperatureInput.name =
                            `rules[${index}][temperature_threshold]`;
                    }

                    const speedInput =
                        rule.querySelector('input[type="number"]:not(.temperature-number)');

                    if (speedInput) {
                        speedInput.name = `rules[${index}][fan_speed]`;
                    }

                    const removeButton = rule.querySelector('.remove-rule');

                    if (removeButton) {
                        removeButton.style.display =
                            ruleItems.length > 1 ? 'inline-block' : 'none';
                    }
                });
            }


            // Memasang fungsi pada aturan yang sudah ada
            rulesContainer.querySelectorAll('.rule-item').forEach(rule => {
                connectTemperatureInputs(rule);
            });

            // Menambah aturan baru
            addRuleButton.addEventListener('click', function () {

                const ruleHTML = `
                    <div class="rule-item" style="border: 1px solid #e5e7eb; border-radius: 10px; padding: 16px; margin-bottom: 16px;">

                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                            <strong class="rule-title"></strong>

                            <button type="button" class="btn-danger remove-rule">
                                Hapus
                            </button>
                        </div>

                        <div class="form-group">
                            <label>Suhu Mulai (°C)</label>

                            <div style="display: flex; align-items: center; gap: 16px;">
                                <input
                                    type="range"
                                    class="temperature-slider"
                                    min="20"
                                    max="45"
                                    step="0.1"
                                    value="35"
                                    style="flex: 1;"
                                >

                                <input
                                    type="number"
                                    class="temperature-number"
                                    min="20"
                                    max="45"
                                    step="0.1"
                                    value="35"
                                    style="width: 85px;"
                                    required
                                >
                            </div>
                            <small
                                class="temperature-error"
                                style="display: none; color: #dc2626; margin-top: 6px;"
                            ></small>
                        </div>

                        <div class="form-group">
                            <label>Kecepatan Kipas (%)</label>

                            <input
                                type="number"
                                name="rules[][fan_speed]"
                                min="0"
                                max="100"
                                step="1"
                                value="80"
                                required
                            >
                        </div>

                    </div>
                `;

                rulesContainer.insertAdjacentHTML('beforeend', ruleHTML);

                const newRule = rulesContainer.lastElementChild;

                connectTemperatureInputs(newRule);
                updateRules();
            });

            // Menghapus aturan
            rulesContainer.addEventListener('click', function (event) {
                if (event.target.classList.contains('remove-rule')) {
                    event.target.closest('.rule-item').remove();
                    updateRules();
                }
            });

            updateRules();
            updateMode();

        });
    </script>

@endsection
