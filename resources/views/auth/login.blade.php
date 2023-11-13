@extends('layouts.app')

@section('content')

<section class="h-100 gradient-form">
    <div class="container py-4 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-12">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                            <div class="text-black-50 px-2 py-2 p-md-5 mx-md-4">
                                <h4 class="mb-4">Selamat datang para pengelolan pendidikan nonformal</h4>
                                <p class="small mb-0">Layanan pendidikan nonformal yang diselenggarakan oleh lembaga
                                    community learning center dan lembaga pendidikan nonformal lainnya harus dikelola
                                    secara bermutu baik dalam aspek input, proses, output, dan outcome pendidikanya.
                                    Untuk ini, penjaminan mutu internal menjadi suatu keharusan untuk dilakukan dengan
                                    cara yang efektif dan bermakna.
                                </p><br><p class="small mb-0">
                                    Agar proses penjaminan mutu internal efektif, maka instrumen pengukuran kinerja
                                    penjaminan mutu internal ini dikembangkan dengan maksud untuk membantu para
                                    pengelola community learning center dan lembaga pendidikan nonformal lainnya
                                    memperoleh pemahaman objektif mengenai kinerja lembaga dan program pendidikannya.
                                    Urgensi instrument ini dikembangkan didasarkan pandangan bahwa pengelolaan mutu
                                    pendidikan nonformal menjadi fungsi penting yang harus terbangun dalam pengelolaan
                                    pendidikan nonformal dan untuk memastikan layanan pendidikan memenuhi kebutuhan
                                    pendidikan individu, kelompok dan/atau masyarakat.
                                </p><br><p class="small mb-0">
                                    Dengan menggunakan instrument ini, para pengelola pendidikan nonformal memiliki
                                    keinginan dan komitmen untuk mengembangkan mutu pendidikan nonformal yang berbasis
                                    pada refleksi diri dan mampu mengambil keputusan yang bermakna dan berkelanjutan bagi
                                    kelompok sasaran, personalia, dan masyarakat luas.
                                </p><br><p class="small mb-0">
                                    Akhirnya, semoga instrument yang dikembangkan ini bermanfaat dalam rangka
                                    mengembangkan pendidikan nonformal. Pendidikan nonformal bermutu….</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">

                                <div class="text-center mb-4">
                                    <img src="{{ asset('backend/img/logo.png') }}"
                                        style="width: 185px;" alt="logo">
                                </div>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <p>Silahkan login dengan akun Anda</p>
                                    <div class="mb-3 row">
                                        <label for="email"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                            type="submit">Log in</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
