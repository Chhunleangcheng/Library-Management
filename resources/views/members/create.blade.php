<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h3 mb-1 text-gray-800 d-flex align-items-center khmer-bold">
                    <div class="page-icon-wrapper me-3">
                        <i class="bi bi-person-plus text-success"></i>
                    </div>
                    <span class="gradient-text">បន្ថែមសមាជិកថ្មី</span>
                </h2>
                <p class="text-muted mb-0 khmer-regular">
                    <i class="bi bi-info-circle me-1"></i>
                    បំពេញព័ត៌មានលម្អិតរបស់សមាជិកថ្មី
                </p>
            </div>
            <div class="header-actions">
                <a href="{{ route('members.index') }}" class="btn btn-outline-secondary modern-btn khmer-medium">
                    <i class="bi bi-arrow-left me-2"></i>ត្រឡប់ក្រោយ
                </a>
            </div>
        </div>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card modern-card">
                <div class="card-header bg-gradient-success text-white">
                    <div class="d-flex align-items-center">
                        <div class="form-icon me-3">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 khmer-semibold">ព័ត៌មានសមាជិក</h6>
                            <small class="opacity-75 khmer-regular">សូមបំពេញព័ត៌មានទាំងអស់ដែលចាំបាច់</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('members.store') }}" method="POST" class="member-form">
                        @csrf

                        <!-- Personal Information Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title khmer-semibold">
                                    <i class="bi bi-person text-success me-2"></i>
                                    ព័ត៌មានផ្ទាល់ខ្លួន
                                </h5>
                                <p class="section-description khmer-regular">ព័ត៌មានមូលដ្ឋានរបស់សមាជិក</p>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-8">
                                    <label for="name" class="form-label khmer-medium required">
                                        <i class="bi bi-person me-1"></i>ឈ្មោះពេញ
                                    </label>
                                    <input type="text"
                                           class="form-control modern-input @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           placeholder="បញ្ចូលឈ្មោះពេញ..."
                                           required>
                                    @error('name')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="date_of_birth" class="form-label khmer-medium">
                                        <i class="bi bi-calendar3 me-1"></i>ថ្ងៃខែឆ្នាំកំណើត
                                    </label>
                                    <input type="date"
                                           class="form-control modern-input @error('date_of_birth') is-invalid @enderror"
                                           id="date_of_birth"
                                           name="date_of_birth"
                                           value="{{ old('date_of_birth') }}"
                                           max="{{ date('Y-m-d') }}">
                                    @error('date_of_birth')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-4 mt-2">
                                <div class="col-md-6">
                                    <label for="email" class="form-label khmer-medium required">
                                        <i class="bi bi-envelope me-1"></i>អីមែល
                                    </label>
                                    <input type="email"
                                           class="form-control modern-input @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           placeholder="example@email.com"
                                           required>
                                    @error('email')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label khmer-medium">
                                        <i class="bi bi-telephone me-1"></i>លេខទូរសព្ទ
                                    </label>
                                    <input type="tel"
                                           class="form-control modern-input @error('phone') is-invalid @enderror"
                                           id="phone"
                                           name="phone"
                                           value="{{ old('phone') }}"
                                           placeholder="012 345 678">
                                    @error('phone')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-4 mt-2">
                                <div class="col-md-12">
                                    <label for="address" class="form-label khmer-medium">
                                        <i class="bi bi-geo-alt me-1"></i>អាសយដ្ឋាន
                                    </label>
                                    <textarea class="form-control modern-input @error('address') is-invalid @enderror"
                                              id="address"
                                              name="address"
                                              rows="3"
                                              placeholder="អាសយដ្ឋានលម្អិត...">{{ old('address') }}</textarea>
                                    @error('address')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Membership Information Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title khmer-semibold">
                                    <i class="bi bi-card-checklist text-success me-2"></i>
                                    ព័ត៌មានសមាជិកភាព
                                </h5>
                                <p class="section-description khmer-regular">កំណត់ព័ត៌មានសមាជិកភាព</p>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="membership_date" class="form-label khmer-medium required">
                                        <i class="bi bi-calendar-plus me-1"></i>ថ្ងៃចុះឈ្មោះ
                                    </label>
                                    <input type="date"
                                           class="form-control modern-input @error('membership_date') is-invalid @enderror"
                                           id="membership_date"
                                           name="membership_date"
                                           value="{{ old('membership_date', date('Y-m-d')) }}"
                                           required>
                                    @error('membership_date')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="membership_status" class="form-label khmer-medium required">
                                        <i class="bi bi-shield-check me-1"></i>ស្ថានភាពសមាជិក
                                    </label>
                                    <select class="form-select modern-input @error('membership_status') is-invalid @enderror"
                                            id="membership_status"
                                            name="membership_status"
                                            required>
                                        <option value="active" {{ old('membership_status', 'active') == 'active' ? 'selected' : '' }}>សកម្ម</option>
                                        <option value="inactive" {{ old('membership_status') == 'inactive' ? 'selected' : '' }}>អសកម្ម</option>
                                        <option value="suspended" {{ old('membership_status') == 'suspended' ? 'selected' : '' }}>ផ្អាក</option>
                                    </select>
                                    @error('membership_status')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Member Preview Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title khmer-semibold">
                                    <i class="bi bi-eye text-success me-2"></i>
                                    មើលជាមុនសមាជិក
                                </h5>
                                <p class="section-description khmer-regular">ព័ត៌មានសមាជិកដែលនឹងត្រូវបន្ថែម</p>
                            </div>

                            <div class="member-preview">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="preview-card">
                                            <div class="preview-avatar" id="preview-avatar">
                                                <i class="bi bi-person"></i>
                                            </div>
                                            <div class="preview-info">
                                                <div class="preview-name khmer-semibold" id="preview-name">ឈ្មោះសមាជិក</div>
                                                <div class="preview-email khmer-regular" id="preview-email">អីមែល</div>
                                                <div class="preview-status">
                                                    <span class="badge bg-success khmer-regular" id="preview-status">សកម្ម</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="preview-details">
                                            <div class="detail-row">
                                                <span class="detail-label khmer-medium">ទូរសព្ទ:</span>
                                                <span class="detail-value khmer-regular" id="preview-phone">-</span>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label khmer-medium">ថ្ងៃកំណើត:</span>
                                                <span class="detail-value khmer-regular" id="preview-dob">-</span>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label khmer-medium">ថ្ងៃចុះឈ្មោះ:</span>
                                                <span class="detail-value khmer-regular" id="preview-membership-date">{{ date('d/m/Y') }}</span>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label khmer-medium">អាសយដ្ឋាន:</span>
                                                <span class="detail-value khmer-regular" id="preview-address">-</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="form-help">
                                            <small class="text-muted khmer-regular">
                                                <i class="bi bi-info-circle me-1"></i>
                                                កន្លែងដែលមាន <span class="text-danger">*</span> គឺចាំបាច់ត្រូវបំពេញ
                                            </small>
                                        </div>
                                        <div class="action-buttons">
                                            <a href="{{ route('members.index') }}" class="btn btn-outline-secondary me-3 khmer-medium">
                                                <i class="bi bi-x-circle me-1"></i>បោះបង់
                                            </a>
                                            <button type="submit" class="btn btn-success modern-btn khmer-medium">
                                                <i class="bi bi-check-circle me-2"></i>រក្សាទុកសមាជិក
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Styles for Members Create -->
    <style>
        /* Page header styling */
        .page-icon-wrapper {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            background: linear-gradient(135deg, #5ee7df 0%, #66a6ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            box-shadow: 0 4px 15px rgba(94, 231, 223, 0.3);
        }

        .gradient-text {
            background: linear-gradient(135deg, #5ee7df 0%, #66a6ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Form styling */
        .member-form {
            font-family: 'Noto Sans Khmer', sans-serif;
        }

        .form-section {
            margin-bottom: 3rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #e9ecef;
        }

        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 1rem;
        }

        .section-header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .section-title {
            color: #2d3436;
            margin-bottom: 0.5rem;
            font-size: 1.25rem;
        }

        .section-description {
            color: #6c757d;
            font-size: 0.95rem;
        }

        /* Modern input styling */
        .modern-input {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fff;
        }

        .modern-input:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.15);
            background: #fff;
        }

        .modern-input.is-invalid {
            border-color: #dc3545;
        }

        .modern-input.is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
        }

        /* Form labels */
        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .form-label.required::after {
            content: ' *';
            color: #dc3545;
            font-weight: bold;
        }

        /* Member preview */
        .member-preview {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 2rem;
            border: 2px dashed #dee2e6;
        }

        .preview-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
        }

        .preview-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #5ee7df 0%, #66a6ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin: 0 auto 1rem;
            transition: all 0.3s ease;
        }

        .preview-name {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #2d3436;
        }

        .preview-email {
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .preview-details {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f3f4;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #6c757d;
            min-width: 120px;
        }

        .detail-value {
            color: #2d3436;
            text-align: right;
        }

        /* Form actions */
        .form-actions {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 2rem;
            margin-top: 2rem;
        }

        .action-buttons .btn {
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .action-buttons .btn-success {
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .action-buttons .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
        }

        /* Form icon */
        .form-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .form-section {
                margin-bottom: 2rem;
                padding-bottom: 1rem;
            }

            .section-header {
                margin-bottom: 1.5rem;
            }

            .preview-card {
                margin-bottom: 1rem;
            }

            .action-buttons {
                text-align: center;
            }

            .action-buttons .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .form-help {
                text-align: center;
                margin-bottom: 1rem;
            }

            .detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.25rem;
            }

            .detail-value {
                text-align: left;
            }
        }

        /* Animations */
        .form-section {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <!-- Enhanced JavaScript for Members Create -->
    <script>
        // Real-time preview update
        function updateMemberPreview() {
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const phoneInput = document.getElementById('phone');
            const dobInput = document.getElementById('date_of_birth');
            const membershipDateInput = document.getElementById('membership_date');
            const statusInput = document.getElementById('membership_status');
            const addressInput = document.getElementById('address');

            // Update preview elements
            const previewName = document.getElementById('preview-name');
            const previewEmail = document.getElementById('preview-email');
            const previewPhone = document.getElementById('preview-phone');
            const previewDob = document.getElementById('preview-dob');
            const previewMembershipDate = document.getElementById('preview-membership-date');
            const previewStatus = document.getElementById('preview-status');
            const previewAddress = document.getElementById('preview-address');
            const previewAvatar = document.getElementById('preview-avatar');

            // Update name and avatar
            const name = nameInput.value || 'ឈ្មោះសមាជិក';
            previewName.textContent = name;
            if (nameInput.value) {
                const initials = name.split(' ').map(word => word.charAt(0).toUpperCase()).join('').substring(0, 2);
                previewAvatar.textContent = initials;
            } else {
                previewAvatar.innerHTML = '<i class="bi bi-person"></i>';
            }

            // Update other fields
            previewEmail.textContent = emailInput.value || 'អីមែល';
            previewPhone.textContent = phoneInput.value || '-';
            previewAddress.textContent = addressInput.value || '-';

            // Update date of birth
            if (dobInput.value) {
                const dob = new Date(dobInput.value);
                previewDob.textContent = dob.toLocaleDateString('km-KH', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
            } else {
                previewDob.textContent = '-';
            }

            // Update membership date
            if (membershipDateInput.value) {
                const membershipDate = new Date(membershipDateInput.value);
                previewMembershipDate.textContent = membershipDate.toLocaleDateString('km-KH', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
            }

            // Update status
            const statusText = {
                'active': 'សកម្ម',
                'inactive': 'អសកម្ម',
                'suspended': 'ផ្អាក'
            };
            const statusClass = {
                'active': 'bg-success',
                'inactive': 'bg-secondary',
                'suspended': 'bg-danger'
            };

            previewStatus.textContent = statusText[statusInput.value] || 'សកម្ម';
            previewStatus.className = `badge ${statusClass[statusInput.value] || 'bg-success'} khmer-regular`;
        }

        // Form validation enhancement
        function enhanceFormValidation() {
            const form = document.querySelector('.member-form');
            const inputs = form.querySelectorAll('input, select, textarea');

            inputs.forEach(input => {
                // Add real-time validation
                input.addEventListener('input', function() {
                    if (this.checkValidity()) {
                        this.classList.remove('is-invalid');
                        this.classList.add('is-valid');
                    } else {
                        this.classList.remove('is-valid');
                        this.classList.add('is-invalid');
                    }
                });

                // Remove validation classes on focus
                input.addEventListener('focus', function() {
                    this.classList.remove('is-valid', 'is-invalid');
                });
            });

            // Custom validation for email
            const emailInput = document.getElementById('email');
            emailInput.addEventListener('input', function() {
                const email = this.value;
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (email && !emailRegex.test(email)) {
                    this.setCustomValidity('សូមបញ្ចូលអីមែលត្រឹមត្រូវ');
                } else {
                    this.setCustomValidity('');
                }
            });

            // Phone number formatting
            const phoneInput = document.getElementById('phone');
            phoneInput.addEventListener('input', function() {
                let phone = this.value.replace(/\D/g, '');
                if (phone.length > 0) {
                    if (phone.length <= 3) {
                        phone = phone;
                    } else if (phone.length <= 6) {
                        phone = phone.slice(0, 3) + ' ' + phone.slice(3);
                    } else {
                        phone = phone.slice(0, 3) + ' ' + phone.slice(3, 6) + ' ' + phone.slice(6, 9);
                    }
                }
                this.value = phone;
            });
        }

        // Auto-save to localStorage
        function setupAutoSave() {
            const form = document.querySelector('.member-form');
            const inputs = form.querySelectorAll('input, select, textarea');
            const formData = 'memberFormData';

            // Load saved data
            const saved = localStorage.getItem(formData);
            if (saved) {
                const data = JSON.parse(saved);
                Object.keys(data).forEach(key => {
                    const input = form.querySelector(`[name="${key}"]`);
                    if (input && !input.value) {
                        input.value = data[key];
                    }
                });
                updateMemberPreview();
            }

            // Save data on input
            inputs.forEach(input => {
                input.addEventListener('input', debounce(() => {
                    const data = {};
                    inputs.forEach(inp => {
                        if (inp.value) data[inp.name] = inp.value;
                    });
                    localStorage.setItem(formData, JSON.stringify(data));
                }, 500));
            });

            // Clear saved data on successful submit
            form.addEventListener('submit', function() {
                localStorage.removeItem(formData);
            });
        }

        // Debounce function
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Form submission enhancement
        function enhanceFormSubmission() {
            const form = document.querySelector('.member-form');
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            form.addEventListener('submit', function(e) {
                // Show loading state
                submitBtn.classList.add('loading');
                submitBtn.innerHTML = '<i class="spinner-border spinner-border-sm me-2"></i>កំពុងរក្សាទុក...';
                submitBtn.disabled = true;

                // Validate form one more time
                if (!form.checkValidity()) {
                    e.preventDefault();
                    submitBtn.classList.remove('loading');
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;

                    // Show validation message
                    const firstInvalid = form.querySelector(':invalid');
                    if (firstInvalid) {
                        firstInvalid.focus();
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });
        }

        // Initialize everything when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Setup all enhancements
            updateMemberPreview();
            enhanceFormValidation();
            setupAutoSave();
            enhanceFormSubmission();

            // Add event listeners for preview update
            const inputs = document.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('input', updateMemberPreview);
            });

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Add smooth animations
            const sections = document.querySelectorAll('.form-section');
            sections.forEach((section, index) => {
                section.style.animationDelay = `${index * 0.1}s`;
            });

            // Auto-focus first input
            const firstInput = document.getElementById('name');
            if (firstInput) {
                setTimeout(() => firstInput.focus(), 300);
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + S to save
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                document.querySelector('.member-form').dispatchEvent(new Event('submit'));
            }

            // Escape to cancel
            if (e.key === 'Escape') {
                if (confirm('តើអ្នកពិតជាចង់បោះបង់ការបញ្ចូលទិន្នន័យមែនទេ?')) {
                    window.location.href = "{{ route('members.index') }}";
                }
            }
        });
    </script>
</x-app-layout>
