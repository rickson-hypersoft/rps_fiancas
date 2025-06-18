@extends('dashboard')
@section('content')
    <div class="col-12 mb-6">
        <div id="wizard-validation" class="bs-stepper linear mt-2">

            @php
                $steps = ['step1', 'step2', 'step3', 'step4', 'step5'];
                $currentIndex = array_search($step, $steps);
            @endphp

            <div class="bs-stepper-header">
                {{-- Step 1 --}}
                <div class="step {{ $currentIndex >= 0 ? 'active' : '' }}" data-target="#criar-proposta">
                    <button type="button" class="step-trigger" aria-selected="{{ $currentIndex == 0 ? 'true' : 'false' }}"
                        {{ $currentIndex >= 0 ? '' : 'disabled' }}>
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label mt-1">
                            <span class="bs-stepper-title">Criar proposta</span>
                            <span class="bs-stepper-subtitle">de fianças</span>
                        </span>
                    </button>
                </div>

                <div class="line"><i class="icon-base ti tabler-chevron-right"></i></div>

                {{-- Step 2 --}}
                <div class="step {{ $currentIndex >= 1 ? 'active' : '' }}" data-target="#analise-credito">
                    <button type="button" class="step-trigger" aria-selected="{{ $currentIndex == 1 ? 'true' : 'false' }}"
                        {{ $currentIndex >= 1 ? '' : 'disabled' }}>
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Análise</span>
                            <span class="bs-stepper-subtitle">de crédito</span>
                        </span>
                    </button>
                </div>

                <div class="line"><i class="icon-base ti tabler-chevron-right"></i></div>

                {{-- Step 3 --}}
                <div class="step {{ $currentIndex >= 2 ? 'active' : '' }}" data-target="#dados-complementares">
                    <button type="button" class="step-trigger" aria-selected="{{ $currentIndex == 2 ? 'true' : 'false' }}"
                        {{ $currentIndex >= 2 ? '' : 'disabled' }}>
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Dados</span>
                            <span class="bs-stepper-subtitle">complementares</span>
                        </span>
                    </button>
                </div>

                <div class="line"><i class="icon-base ti tabler-chevron-right"></i></div>

                {{-- Step 4 --}}
                <div class="step {{ $currentIndex >= 3 ? 'active' : '' }}" data-target="#resumo">
                    <button type="button" class="step-trigger" aria-selected="{{ $currentIndex == 3 ? 'true' : 'false' }}"
                        {{ $currentIndex >= 3 ? '' : 'disabled' }}>
                        <span class="bs-stepper-circle">4</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Resumo</span>
                            <span class="bs-stepper-subtitle">proposta</span>
                        </span>
                    </button>
                </div>

                <div class="line"><i class="icon-base ti tabler-chevron-right"></i></div>

                {{-- Step 5 --}}
                <div class="step {{ $currentIndex >= 4 ? 'active' : '' }}" data-target="#proposta-enviada">
                    <button type="button" class="step-trigger" aria-selected="{{ $currentIndex == 4 ? 'true' : 'false' }}"
                        {{ $currentIndex >= 4 ? '' : 'disabled' }}>
                        <span class="bs-stepper-circle">5</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Proposta</span>
                            <span class="bs-stepper-subtitle">concluída</span>
                        </span>
                    </button>
                </div>
            </div>

            <div class="bs-stepper-content">
                @includeWhen(view()->exists("propostal.steps.$step"), "propostal.steps.$step", [
                    'proposta' => $proposta,
                ])

                @unless (view()->exists("propostal.steps.$step"))
                    <p class="text-danger">Step "{{ $step }}" não encontrado.</p>
                @endunless
            </div>
        </div>
    @endsection
