@extends('dashboard')
@section('content')
    <div class="col-12 mb-6">
        <div id="wizard-validation" class="bs-stepper linear mt-2">

            @php
                $steps = ['step1', 'step2', 'step3'];
                $currentIndex = array_search($step, $steps);
            @endphp

            <div class="bs-stepper-header">
                {{-- Step 1 --}}
                <div class="step {{ $currentIndex >= 0 ? 'active' : '' }}" data-target="#criar-proposta">
                    <button type="button" class="step-trigger" aria-selected="{{ $currentIndex == 0 ? 'true' : 'false' }}"
                        {{ $currentIndex >= 0 ? '' : 'disabled' }}>
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label mt-1">
                            <span class="bs-stepper-title">Sobre o imóvel</span>
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
                            <span class="bs-stepper-title">Comprovantes</span>
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
                            <span class="bs-stepper-title">Forma de pagamento e Resumo</span>
                        </span>
                    </button>
                </div>

                <div class="line"><i class="icon-base ti tabler-chevron-right"></i></div>
            </div>

            <div class="bs-stepper-content">
                @includeWhen(view()->exists("deliquencies.steps.$step"), "deliquencies.steps.$step")

                @unless (view()->exists("deliquencies.steps.$step"))
                    <p class="text-danger">Step "{{ $step }}" não encontrado.</p>
                @endunless
            </div>
        </div>
    @endsection
