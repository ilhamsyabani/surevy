@extends('layouts.app')

@section('content')
    <!-- Login 5 - Bootstrap Brain Component -->
    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="card border-light-subtle shadow-sm">
                <div class="row g-0">
                    <div class="col-12 col-md-6 text-bg-primary">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="col-12 col-xl-10 py-2">
                                <div class="row no-gutters d-flex align-items-center justify-content-between" >
                                   
                                        <h2 class="h2 mb-0" style="font-weight: 600">Selamat datang para pengelolan pendidikan nonformal</h2>
                                  
                                </div>
                                <hr class="border-primary-subtle mb-4">
                                <p class="small mb-0">Layanan pendidikan nonformal yang diselenggarakan oleh lembaga
                                    community learning center dan lembaga pendidikan nonformal lainnya harus dikelola
                                    secara bermutu baik dalam aspek input, proses, output, dan outcome pendidikanya.
                                    Untuk ini, penjaminan mutu internal menjadi suatu keharusan untuk dilakukan dengan
                                    cara yang efektif dan bermakna.
                                </p><br>
                                <p class="small mb-0">
                                    Agar proses penjaminan mutu internal efektif, maka instrumen pengukuran kinerja
                                    penjaminan mutu internal ini dikembangkan dengan maksud untuk membantu para
                                    pengelola community learning center dan lembaga pendidikan nonformal lainnya
                                    memperoleh pemahaman objektif mengenai kinerja lembaga dan program pendidikannya.
                                    Urgensi instrument ini dikembangkan didasarkan pandangan bahwa pengelolaan mutu
                                    pendidikan nonformal menjadi fungsi penting yang harus terbangun dalam pengelolaan
                                    pendidikan nonformal dan untuk memastikan layanan pendidikan memenuhi kebutuhan
                                    pendidikan individu, kelompok dan/atau masyarakat.
                                </p><br>
                                <p class="small mb-0">
                                    Dengan menggunakan instrument ini, para pengelola pendidikan nonformal memiliki
                                    keinginan dan komitmen untuk mengembangkan mutu pendidikan nonformal yang berbasis
                                    pada refleksi diri dan mampu mengambil keputusan yang bermakna dan berkelanjutan bagi
                                    kelompok sasaran, personalia, dan masyarakat luas.
                                    Akhirnya, semoga instrument yang dikembangkan ini bermanfaat dalam rangka
                                    mengembangkan pendidikan nonformal. Pendidikan nonformal bermutu….</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-5">
                                        <div class="text-center mb-4">
                                            <img src="{{ asset('backend/img/logo.png') }}" style="width: 185px;"
                                                alt="logo">
                                        </div>
                                        <h5>Silahkan isi email dan password untuk login</h4>
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row gy-3 gy-md-4 overflow-hidden">
                                    <div class="col-12">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="remember_me" id="remember_me">
                                            <label class="form-check-label text-secondary" for="remember_me">
                                                Keep me logged in
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn bsb-btn-xl btn-primary" type="submit">Log in now</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-12">
                                    <hr class="mt-5 mb-4 border-secondary-subtle">
                                    <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
