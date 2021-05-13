@extends('layouts.master')

@section('content')
<div class="container mx-auto flex flex-col items-center max-w-lg">
  <h1 class="text-center text-4xl font-semibold mt-10 mb-12">Sign Up</h1>
  <form class="w-full" method="POST" action="{{ route('register') }}">
    @csrf
    <div>
      <input
        id="name"
        type="text"
        class="w-full py-2 px-4 rounded-xl border border-primary bg-gray-50 placeholder-primary"
        name="name"
        value="{{ old('name') }}"
        autocomplete="name"
        placeholder="Nama Lengkap"
        required
        autofocus
      >
      @error('name')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>

    <div class="mt-6">
      <input
        id="email"
        type="email"
        class="w-full py-2 px-4 rounded-xl border border-primary bg-gray-50 placeholder-primary"
        name="email"
        value="{{ old('email') }}"
        placeholder="Email"
        autocomplete="email"
        required
      >

      @error('email')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>

    <div class="mt-6">
      <input
        id="password"
        type="password"
        class="w-full py-2 px-4 rounded-xl border border-primary bg-gray-50 placeholder-primary"
        name="password"
        placeholder="Password"
        autocomplete="new-password"
        required
      >

      @error('password')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>

    <div class="mt-6">
      <input
        id="password-confirm"
        type="password"
        class="w-full py-2 px-4 rounded-xl border border-primary bg-gray-50 placeholder-primary"
        name="password_confirmation"
        autocomplete="new-password"
        placeholder="Konfirmasi Password"
        required
      >
    </div>

    <div class="flex flex-col justify-center mt-10">
      <button type="submit" class="border-2 rounded-xl border-black bg-primary px-9 py-2 text-white text-sm">
          {{ __('Buat Akun') }}
      </button>

      @if (Route::has('register'))
      <div class="text-center mt-6">
        Sudah mempunyai akun?
        <a class="font-semibold text-sm text-primary" href="{{ route('login') }}">Masuk Sekarang</a>
      </div>
      @endif
    </div>
  </form>
</div>
@endsection
