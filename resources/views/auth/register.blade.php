<x-guest-layout>
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-lg border-0" style="border-radius: 20px; backdrop-filter: blur(10px);">
                        <div class="card-body p-5">
                            <!-- Header -->
                            <div class="text-center mb-4">
                                <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <i class="bi bi-person-plus-fill fs-1 text-white"></i>
                                </div>
                                <h2 class="fw-bold text-success mb-1" style="font-family: 'Khmer OS', Arial, sans-serif;">ចុះឈ្មោះគណនីថ្មី</h2>
                                <p class="text-muted small" style="font-family: 'Khmer OS', Arial, sans-serif;">បំពេញព័ត៌មានដើម្បីបង្កើតគណនី</p>
                            </div>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold text-success" style="font-family: 'Khmer OS', Arial, sans-serif;">ឈ្មោះពេញ</label>
                                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                                           class="form-control form-control-lg border-2 @error('name') is-invalid @enderror"
                                           required autofocus autocomplete="name"
                                           placeholder="បញ្ចូលឈ្មោះពេញរបស់អ្នក"
                                           style="border-radius: 12px; border-color: #dee2e6; font-family: 'Khmer OS', Arial, sans-serif;">
                                    @error('name')
                                    <div class="invalid-feedback" style="font-family: 'Khmer OS', Arial, sans-serif;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email Address -->
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold text-success" style="font-family: 'Khmer OS', Arial, sans-serif;">អ៊ីមែល</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                           class="form-control form-control-lg border-2 @error('email') is-invalid @enderror"
                                           required autocomplete="username"
                                           placeholder="បញ្ចូលអ៊ីមែលរបស់អ្នក"
                                           style="border-radius: 12px; border-color: #dee2e6; font-family: 'Khmer OS', Arial, sans-serif;">
                                    @error('email')
                                    <div class="invalid-feedback" style="font-family: 'Khmer OS', Arial, sans-serif;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold text-success" style="font-family: 'Khmer OS', Arial, sans-serif;">ពាក្យសម្ងាត់</label>
                                    <input id="password" type="password" name="password"
                                           class="form-control form-control-lg border-2 @error('password') is-invalid @enderror"
                                           required autocomplete="new-password"
                                           placeholder="បញ្ចូលពាក្យសម្ងាត់"
                                           style="border-radius: 12px; border-color: #dee2e6; font-family: 'Khmer OS', Arial, sans-serif;">
                                    @error('password')
                                    <div class="invalid-feedback" style="font-family: 'Khmer OS', Arial, sans-serif;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label fw-semibold text-success" style="font-family: 'Khmer OS', Arial, sans-serif;">បញ្ជាក់ពាក្យសម្ងាត់</label>
                                    <input id="password_confirmation" type="password" name="password_confirmation"
                                           class="form-control form-control-lg border-2"
                                           required autocomplete="new-password"
                                           placeholder="បញ្ចូលពាក្យសម្ងាត់ម្តងទៀត"
                                           style="border-radius: 12px; border-color: #dee2e6; font-family: 'Khmer OS', Arial, sans-serif;">
                                    @error('password_confirmation')
                                    <div class="invalid-feedback" style="font-family: 'Khmer OS', Arial, sans-serif;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Login Link & Register Button -->
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <a class="text-decoration-none small" href="{{ route('login') }}" style="font-family: 'Khmer OS', Arial, sans-serif;">
                                        មានគណនីរួចហើយ?
                                    </a>
                                </div>

                                <!-- Register Button -->
                                <button type="submit" class="btn btn-lg w-100 text-white fw-semibold position-relative overflow-hidden"
                                        style="background: var(--success-gradient); border: none; border-radius: 12px; transition: all 0.3s ease; font-family: 'Khmer OS', Arial, sans-serif;">
                                    <i class="bi bi-person-check me-2"></i>
                                    ចុះឈ្មោះ
                                </button>
                            </form>

                            <!-- Login link -->
                            <div class="text-center mt-4">
                                <span class="text-muted small" style="font-family: 'Khmer OS', Arial, sans-serif;">មានគណនីរួចហើយ?</span>
                                <a href="{{ route('login') }}" class="text-decoration-none fw-semibold ms-1" style="font-family: 'Khmer OS', Arial, sans-serif;">ចូលប្រព័ន្ធ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->

        <style>
            /* Additional styles for register form */
            .btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            }

            .form-control:focus {
                border-color: #198754;
                box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
            }

            .card {
                transition: all 0.3s ease;
            }

            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            }

            :root {
                --success-gradient: linear-gradient(90deg, #22c55e 0%, #16a34a 100%);
            }
        </style>
</x-guest-layout>
