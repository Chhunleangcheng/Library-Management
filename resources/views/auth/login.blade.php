<x-guest-layout>
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-lg border-0" style="border-radius: 20px; backdrop-filter: blur(10px);">
                        <div class="card-body p-5">
                            <!-- Header -->
                            <div class="text-center mb-4">
                                <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <i class="bi bi-book-half fs-1 text-white"></i>
                                </div>
                                <h2 class="fw-bold text-primary mb-1" style="font-family: 'Khmer OS', Arial, sans-serif;">ប្រព័ន្ធគ្រប់គ្រងបណ្ណាល័យ</h2>
                                <p class="text-muted small" style="font-family: 'Khmer OS', Arial, sans-serif;">ចូលទៅកាន់គណនីរបស់អ្នក</p>
                            </div>

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-3" :status="session('status')" />

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email Address -->
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold text-primary" style="font-family: 'Khmer OS', Arial, sans-serif;">អ៊ីមែល</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                           class="form-control form-control-lg border-2 @error('email') is-invalid @enderror"
                                           required autofocus autocomplete="username"
                                           placeholder="បញ្ចូលអ៊ីមែលរបស់អ្នក"
                                           style="border-radius: 12px; border-color: #dee2e6; font-family: 'Khmer OS', Arial, sans-serif;">
                                    @error('email')
                                    <div class="invalid-feedback" style="font-family: 'Khmer OS', Arial, sans-serif;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold text-primary" style="font-family: 'Khmer OS', Arial, sans-serif;">ពាក្យសម្ងាត់</label>
                                    <input id="password" type="password" name="password"
                                           class="form-control form-control-lg border-2 @error('password') is-invalid @enderror"
                                           required autocomplete="current-password"
                                           placeholder="បញ្ចូលពាក្យសម្ងាត់របស់អ្នក"
                                           style="border-radius: 12px; border-color: #dee2e6; font-family: 'Khmer OS', Arial, sans-serif;">
                                    @error('password')
                                    <div class="invalid-feedback" style="font-family: 'Khmer OS', Arial, sans-serif;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Remember Me & Forgot Password -->
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                                        <label class="form-check-label small text-muted" for="remember_me" style="font-family: 'Khmer OS', Arial, sans-serif;">
                                            ចងចាំខ្ញុំ
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="text-decoration-none small" href="{{ route('password.request') }}" style="font-family: 'Khmer OS', Arial, sans-serif;">
                                            ភ្លេចពាក្យសម្ងាត់?
                                        </a>
                                    @endif
                                </div>

                                <!-- Login Button -->
                                <button type="submit" class="btn btn-lg w-100 text-white fw-semibold position-relative overflow-hidden"
                                        style="background: var(--primary-gradient); border: none; border-radius: 12px; transition: all 0.3s ease; font-family: 'Khmer OS', Arial, sans-serif;">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>
                                    ចូលប្រព័ន្ធ
                                </button>
                            </form>

                            <!-- Sign up link -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
