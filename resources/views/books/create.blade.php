<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h3 mb-1 text-gray-800 d-flex align-items-center khmer-bold">
                    <div class="page-icon-wrapper me-3">
                        <i class="bi bi-plus-circle text-primary"></i>
                    </div>
                    <span class="gradient-text">បន្ថែមសៀវភៅថ្មី</span>
                </h2>
                <p class="text-muted mb-0 khmer-regular">
                    <i class="bi bi-info-circle me-1"></i>
                    បំពេញព័ត៌មានលម្អិតរបស់សៀវភៅថ្មី
                </p>
            </div>
            <div class="header-actions">
                <a href="{{ route('books.index') }}" class="btn btn-outline-secondary modern-btn khmer-medium">
                    <i class="bi bi-arrow-left me-2"></i>ត្រឡប់ក្រោយ
                </a>
            </div>
        </div>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card modern-card">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex align-items-center">
                        <div class="form-icon me-3">
                            <i class="bi bi-book-half"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 khmer-semibold">ព័ត៌មានសៀវភៅ</h6>
                            <small class="opacity-75 khmer-regular">សូមបំពេញព័ត៌មានទាំងអស់ដែលចាំបាច់</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('books.store') }}" method="POST" class="book-form">
                        @csrf

                        <!-- Basic Information Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title khmer-semibold">
                                    <i class="bi bi-info-circle text-primary me-2"></i>
                                    ព័ត៌មានមូលដ្ឋាន
                                </h5>
                                <p class="section-description khmer-regular">ព័ត៌មានទូទៅអំពីសៀវភៅ</p>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-8">
                                    <label for="title" class="form-label khmer-medium required">
                                        <i class="bi bi-card-text me-1"></i>ចំណងជើងសៀវភៅ
                                    </label>
                                    <input type="text"
                                           class="form-control modern-input @error('title') is-invalid @enderror"
                                           id="title"
                                           name="title"
                                           value="{{ old('title') }}"
                                           placeholder="បញ្ចូលចំណងជើងសៀវភៅ..."
                                           required>
                                    @error('title')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="published_year" class="form-label khmer-medium">
                                        <i class="bi bi-calendar3 me-1"></i>ឆ្នាំបោះពុម្ព
                                    </label>
                                    <input type="number"
                                           class="form-control modern-input @error('published_year') is-invalid @enderror"
                                           id="published_year"
                                           name="published_year"
                                           value="{{ old('published_year') }}"
                                           min="1000"
                                           max="{{ date('Y') }}"
                                           placeholder="ឆ្នាំ">
                                    @error('published_year')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-4 mt-2">
                                <div class="col-md-6">
                                    <label for="author" class="form-label khmer-medium required">
                                        <i class="bi bi-person me-1"></i>អ្នកនិពន្ធ
                                    </label>
                                    <input type="text"
                                           class="form-control modern-input @error('author') is-invalid @enderror"
                                           id="author"
                                           name="author"
                                           value="{{ old('author') }}"
                                           placeholder="ឈ្មោះអ្នកនិពន្ធ..."
                                           required>
                                    @error('author')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="genre" class="form-label khmer-medium required">
                                        <i class="bi bi-tag me-1"></i>ប្រភេទសៀវភៅ
                                    </label>
                                    <select class="form-select modern-input @error('genre') is-invalid @enderror"
                                            id="genre"
                                            name="genre"
                                            required>
                                        <option value="">ជ្រើសរើសប្រភេទសៀវភៅ</option>
                                        <option value="Fiction" {{ old('genre') == 'Fiction' ? 'selected' : '' }}>Fiction (រឿងប្រលោមលោក)</option>
                                        <option value="Non-Fiction" {{ old('genre') == 'Non-Fiction' ? 'selected' : '' }}>Non-Fiction (មិនមែនប្រលោមលោក)</option>
                                        <option value="Science Fiction" {{ old('genre') == 'Science Fiction' ? 'selected' : '' }}>Science Fiction (រឿងប្រលោមលោកវិទ្យាសាស្ត្រ)</option>
                                        <option value="Fantasy" {{ old('genre') == 'Fantasy' ? 'selected' : '' }}>Fantasy (ការស្រមើលស្រមៃ)</option>
                                        <option value="Mystery" {{ old('genre') == 'Mystery' ? 'selected' : '' }}>Mystery (អាថ៌កំបាំង)</option>
                                        <option value="Romance" {{ old('genre') == 'Romance' ? 'selected' : '' }}>Romance (ស្នេហា)</option>
                                        <option value="Biography" {{ old('genre') == 'Biography' ? 'selected' : '' }}>Biography (ជីវប្រវត្តិ)</option>
                                        <option value="History" {{ old('genre') == 'History' ? 'selected' : '' }}>History (ប្រវត្តិសាស្ត្រ)</option>
                                        <option value="Education" {{ old('genre') == 'Education' ? 'selected' : '' }}>Education (អប់រំ)</option>
                                        <option value="Children" {{ old('genre') == 'Children' ? 'selected' : '' }}>Children (កុមារ)</option>
                                    </select>
                                    @error('genre')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-4 mt-2">
                                <div class="col-md-12">
                                    <label for="isbn" class="form-label khmer-medium required">
                                        <i class="bi bi-upc-scan me-1"></i>លេខ ISBN
                                    </label>
                                    <input type="text"
                                           class="form-control modern-input @error('isbn') is-invalid @enderror"
                                           id="isbn"
                                           name="isbn"
                                           value="{{ old('isbn') }}"
                                           placeholder="978-0-123-45678-9"
                                           pattern="[0-9\-]+"
                                           required>
                                    <div class="form-text khmer-regular">
                                        <i class="bi bi-info-circle me-1"></i>
                                        បញ្ចូលលេខ ISBN ១០ ខ្ទង់ ឬ ១៣ ខ្ទង់
                                    </div>
                                    @error('isbn')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title khmer-semibold">
                                    <i class="bi bi-file-text text-primary me-2"></i>
                                    បរិយាយអំពីសៀវភៅ
                                </h5>
                                <p class="section-description khmer-regular">ព័ត៌មានលម្អិតអំពីខ្លឹមសារសៀវភៅ</p>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-12">
                                    <label for="description" class="form-label khmer-medium">
                                        <i class="bi bi-card-text me-1"></i>សេចក្តីសង្ខេប
                                    </label>
                                    <textarea class="form-control modern-input @error('description') is-invalid @enderror"
                                              id="description"
                                              name="description"
                                              rows="5"
                                              placeholder="បរិយាយសង្ខេបអំពីខ្លឹមសារ និងចំណុចសំខាន់នៃសៀវភៅ...">{{ old('description') }}</textarea>
                                    <div class="form-text khmer-regular">
                                        <i class="bi bi-lightbulb me-1"></i>
                                        បរិយាយអំពីខ្លឹមសារ ប្រធានបទ និងចំណុចសំខាន់នៃសៀវភៅ
                                    </div>
                                    @error('description')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Inventory Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title khmer-semibold">
                                    <i class="bi bi-stack text-primary me-2"></i>
                                    ការគ្រប់គ្រងស្តុក
                                </h5>
                                <p class="section-description khmer-regular">ចំនួនសៀវភៅនិងភាពអាចរកបាន</p>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="total_copies" class="form-label khmer-medium required">
                                        <i class="bi bi-stack me-1"></i>ចំនួនសៀវភៅសរុប
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-book-half"></i>
                                        </span>
                                        <input type="number"
                                               class="form-control modern-input @error('total_copies') is-invalid @enderror"
                                               id="total_copies"
                                               name="total_copies"
                                               value="{{ old('total_copies', 1) }}"
                                               min="1"
                                               max="999"
                                               required>
                                        <span class="input-group-text khmer-regular">ក្បាល</span>
                                    </div>
                                    @error('total_copies')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="available_copies" class="form-label khmer-medium required">
                                        <i class="bi bi-check-circle me-1"></i>ចំនួនដែលអាចខ្ចីបាន
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-check-square"></i>
                                        </span>
                                        <input type="number"
                                               class="form-control modern-input @error('available_copies') is-invalid @enderror"
                                               id="available_copies"
                                               name="available_copies"
                                               value="{{ old('available_copies', 1) }}"
                                               min="0"
                                               max="999"
                                               required>
                                        <span class="input-group-text khmer-regular">ក្បាល</span>
                                    </div>
                                    <div class="form-text khmer-regular">
                                        <i class="bi bi-info-circle me-1"></i>
                                        ត្រូវតែតិចជាង ឬ ស្មើនឹងចំនួនសរុប
                                    </div>
                                    @error('available_copies')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Stock Status Preview -->
                            <div class="row g-4 mt-2">
                                <div class="col-md-12">
                                    <div class="stock-preview">
                                        <h6 class="khmer-medium mb-3">
                                            <i class="bi bi-eye me-1"></i>មើលជាមុនស្ថានភាពស្តុក
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="preview-card total">
                                                    <div class="preview-icon">
                                                        <i class="bi bi-stack"></i>
                                                    </div>
                                                    <div class="preview-content">
                                                        <div class="preview-number khmer-bold" id="preview-total">១</div>
                                                        <div class="preview-label khmer-regular">សរុប</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="preview-card available">
                                                    <div class="preview-icon">
                                                        <i class="bi bi-check-circle"></i>
                                                    </div>
                                                    <div class="preview-content">
                                                        <div class="preview-number khmer-bold" id="preview-available">១</div>
                                                        <div class="preview-label khmer-regular">អាចខ្ចីបាន</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="preview-card borrowed">
                                                    <div class="preview-icon">
                                                        <i class="bi bi-arrow-right-circle"></i>
                                                    </div>
                                                    <div class="preview-content">
                                                        <div class="preview-number khmer-bold" id="preview-borrowed">០</div>
                                                        <div class="preview-label khmer-regular">កំពុងខ្ចី</div>
                                                    </div>
                                                </div>
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
                                            <a href="{{ route('books.index') }}" class="btn btn-outline-secondary me-3 khmer-medium">
                                                <i class="bi bi-x-circle me-1"></i>បោះបង់
                                            </a>
                                            <button type="submit" class="btn btn-primary modern-btn khmer-medium">
                                                <i class="bi bi-check-circle me-2"></i>រក្សាទុកសៀវភៅ
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

    <!-- Enhanced Styles -->
    <style>
        /* Form styling */
        .book-form {
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
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
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

        /* Input groups */
        /* Input groups continued */
        .input-group-text {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            background: #f8f9fa;
            color: #6c757d;
        }

        .input-group .modern-input {
            border-radius: 0;
        }

        .input-group .modern-input:first-child {
            border-radius: 10px 0 0 10px;
        }

        .input-group .modern-input:last-child {
            border-radius: 0 10px 10px 0;
        }

        .input-group-text:first-child {
            border-radius: 10px 0 0 10px;
            border-right: none;
        }

        .input-group-text:last-child {
            border-radius: 0 10px 10px 0;
            border-left: none;
        }

        /* Stock preview */
        .stock-preview {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            border: 2px dashed #dee2e6;
        }

        .preview-card {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .preview-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .preview-card.total {
            border-left: 4px solid #0d6efd;
        }

        .preview-card.available {
            border-left: 4px solid #198754;
        }

        .preview-card.borrowed {
            border-left: 4px solid #ffc107;
        }

        .preview-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .preview-card.total .preview-icon {
            background: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }

        .preview-card.available .preview-icon {
            background: rgba(25, 135, 84, 0.1);
            color: #198754;
        }

        .preview-card.borrowed .preview-icon {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .preview-number {
            font-size: 1.5rem;
            margin-bottom: 0.25rem;
        }

        .preview-label {
            font-size: 0.9rem;
            color: #6c757d;
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

        .action-buttons .btn-primary {
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        }

        .action-buttons .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
        }

        /* Form help text */
        .form-text {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 0.5rem;
        }

        /* Form validation */
        .invalid-feedback {
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        /* Icons in form */
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
                margin-bottom: 0.5rem;
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
        }

        /* Loading states */
        .btn.loading {
            position: relative;
            color: transparent;
        }

        .btn.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            border: 2px solid currentColor;
            border-radius: 50%;
            border-right-color: transparent;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        /* Animation for form sections */
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

    <!-- Enhanced JavaScript -->
    <script>
        // Khmer number conversion
        const khmerNumbers = {
            '0': '០', '1': '១', '2': '២', '3': '៣', '4': '៤',
            '5': '៥', '6': '៦', '7': '៧', '8': '៨', '9': '៩'
        };

        function toKhmerNumbers(str) {
            return str.toString().replace(/[0-9]/g, function(match) {
                return khmerNumbers[match];
            });
        }

        // Real-time stock preview update
        function updateStockPreview() {
            const totalInput = document.getElementById('total_copies');
            const availableInput = document.getElementById('available_copies');

            const total = parseInt(totalInput.value) || 0;
            const available = parseInt(availableInput.value) || 0;
            const borrowed = Math.max(0, total - available);

            document.getElementById('preview-total').textContent = toKhmerNumbers(total);
            document.getElementById('preview-available').textContent = toKhmerNumbers(available);
            document.getElementById('preview-borrowed').textContent = toKhmerNumbers(borrowed);

            // Update available input max value
            availableInput.max = total;

            // Validate available copies
            if (available > total) {
                availableInput.setCustomValidity('ចំនួនដែលអាចខ្ចីបានមិនអាចច្រើនជាងចំនួនសរុបទេ');
            } else {
                availableInput.setCustomValidity('');
            }
        }

        // Form validation enhancement
        function enhanceFormValidation() {
            const form = document.querySelector('.book-form');
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

            // Custom validation for ISBN
            const isbnInput = document.getElementById('isbn');
            isbnInput.addEventListener('input', function() {
                const isbn = this.value.replace(/[^\d]/g, '');
                if (isbn.length === 10 || isbn.length === 13) {
                    this.setCustomValidity('');
                } else if (this.value.length > 0) {
                    this.setCustomValidity('លេខ ISBN ត្រូវតែមាន ១០ ឬ ១៣ ខ្ទង់');
                }
            });

            // Auto-format ISBN
            isbnInput.addEventListener('blur', function() {
                let isbn = this.value.replace(/[^\d]/g, '');
                if (isbn.length === 10) {
                    this.value = isbn.replace(/(\d{1})(\d{3})(\d{5})(\d{1})/, '$1-$2-$3-$4');
                } else if (isbn.length === 13) {
                    this.value = isbn.replace(/(\d{3})(\d{1})(\d{3})(\d{5})(\d{1})/, '$1-$2-$3-$4-$5');
                }
            });
        }

        // Auto-save to localStorage
        function setupAutoSave() {
            const form = document.querySelector('.book-form');
            const inputs = form.querySelectorAll('input, select, textarea');
            const formData = 'bookFormData';

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
                updateStockPreview();
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

        // Character counter for description
        function setupCharacterCounter() {
            const textarea = document.getElementById('description');
            const maxLength = 1000;

            // Create counter element
            const counter = document.createElement('div');
            counter.className = 'form-text text-end khmer-regular';
            counter.innerHTML = `<span id="char-count">០</span>/${toKhmerNumbers(maxLength)} តួអក្សរ`;
            textarea.parentNode.appendChild(counter);

            // Update counter
            function updateCounter() {
                const count = textarea.value.length;
                document.getElementById('char-count').textContent = toKhmerNumbers(count);

                if (count > maxLength * 0.9) {
                    counter.className = 'form-text text-end text-warning khmer-regular';
                } else if (count > maxLength) {
                    counter.className = 'form-text text-end text-danger khmer-regular';
                } else {
                    counter.className = 'form-text text-end text-muted khmer-regular';
                }
            }

            textarea.addEventListener('input', updateCounter);
            textarea.setAttribute('maxlength', maxLength);
            updateCounter();
        }

        // Smart suggestions
        function setupSmartSuggestions() {
            const genreSelect = document.getElementById('genre');
            const titleInput = document.getElementById('title');

            // Auto-suggest genre based on title keywords
            const genreKeywords = {
                'Fiction': ['story', 'novel', 'tale', 'រឿង', 'ប្រលោមលោក'],
                'Science Fiction': ['space', 'future', 'robot', 'sci-fi', 'វិទ្យាសាស្ត្រ'],
                'Fantasy': ['magic', 'dragon', 'wizard', 'ម្ចាស់', 'អាថ៌កំបាំង'],
                'Biography': ['life', 'biography', 'memoir', 'ជីវិត', 'ប្រវត្តិ'],
                'History': ['history', 'war', 'ancient', 'ប្រវត្តិសាស្ត្រ'],
                'Education': ['learn', 'teach', 'study', 'school', 'អប់រំ', 'សិក្សា'],
                'Children': ['kid', 'child', 'baby', 'កុមារ', 'ក្មេង']
            };

            titleInput.addEventListener('input', debounce(() => {
                const title = titleInput.value.toLowerCase();
                let suggestedGenre = '';
                let maxMatches = 0;

                Object.keys(genreKeywords).forEach(genre => {
                    const matches = genreKeywords[genre].filter(keyword =>
                        title.includes(keyword.toLowerCase())
                    ).length;

                    if (matches > maxMatches) {
                        maxMatches = matches;
                        suggestedGenre = genre;
                    }
                });

                if (suggestedGenre && !genreSelect.value) {
                    genreSelect.value = suggestedGenre;
                    genreSelect.style.backgroundColor = '#fff3cd';
                    setTimeout(() => {
                        genreSelect.style.backgroundColor = '';
                    }, 2000);
                }
            }, 1000));
        }

        // Form submission enhancement
        function enhanceFormSubmission() {
            const form = document.querySelector('.book-form');
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
            // Convert existing numbers to Khmer
            document.querySelectorAll('.khmer-number').forEach(element => {
                element.textContent = toKhmerNumbers(element.textContent);
            });

            // Setup all enhancements
            updateStockPreview();
            enhanceFormValidation();
            setupAutoSave();
            setupCharacterCounter();
            setupSmartSuggestions();
            enhanceFormSubmission();

            // Add event listeners for stock preview
            document.getElementById('total_copies').addEventListener('input', updateStockPreview);
            document.getElementById('available_copies').addEventListener('input', updateStockPreview);

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
            const firstInput = document.getElementById('title');
            if (firstInput) {
                setTimeout(() => firstInput.focus(), 300);
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + S to save (prevent default and trigger form submit)
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                document.querySelector('.book-form').dispatchEvent(new Event('submit'));
            }

            // Escape to cancel
            if (e.key === 'Escape') {
                if (confirm('តើអ្នកពិតជាចង់បោះបង់ការបញ្ចូលទិន្នន័យមែនទេ?')) {
                    window.location.href = "{{ route('books.index') }}";
                }
            }
        });
    </script>
</x-app-layout>
