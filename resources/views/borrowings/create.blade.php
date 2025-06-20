<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h3 mb-1 text-gray-800 d-flex align-items-center khmer-bold">
                    <div class="page-icon-wrapper me-3">
                        <i class="bi bi-plus-circle text-info"></i>
                    </div>
                    <span class="gradient-text">បង្កើតការខ្ចីថ្មី</span>
                </h2>
                <p class="text-muted mb-0 khmer-regular">
                    <i class="bi bi-info-circle me-1"></i>
                    បង្កើតការខ្ចីសៀវភៅថ្មី
                </p>
            </div>
            <div class="header-actions">
                <div class="current-time-display me-3">
                    <small class="text-muted khmer-regular">ពេលវេលាបច្ចុប្បន្ន (UTC)</small>
                    <div class="fw-bold text-primary khmer-medium" id="header-time">២០២៥-០៦-២០ ០៥:៥៦:០២</div>
                </div>
                <a href="{{ route('borrowings.index') }}" class="btn btn-outline-secondary modern-btn khmer-medium">
                    <i class="bi bi-arrow-left me-2"></i>ត្រឡប់ក្រោយ
                </a>
            </div>
        </div>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Current User & Time Info -->
            <div class="card modern-card mb-4">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex align-items-center">
                        <div class="user-icon me-3">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 khmer-semibold">ព័ត៌មានសម័យ</h6>
                            <small class="opacity-75 khmer-regular">អ្នកប្រើ និង ពេលវេលាបច្ចុប្បន្ន</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="info-item">
                                <i class="bi bi-person-check text-success me-2"></i>
                                <div>
                                    <small class="text-muted khmer-regular">អ្នកប្រើបច្ចុប្បន្ន</small>
                                    <div class="fw-semibold khmer-medium">Chhunleangcheng</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item">
                                <i class="bi bi-clock text-primary me-2"></i>
                                <div>
                                    <small class="text-muted khmer-regular">ពេលវេលា UTC</small>
                                    <div class="fw-semibold khmer-medium" id="current-time">២០២៥-០៦-២០ ០៥:៥៦:០២</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item">
                                <i class="bi bi-calendar-event text-warning me-2"></i>
                                <div>
                                    <small class="text-muted khmer-regular">ថ្ងៃនេះ</small>
                                    <div class="fw-semibold khmer-medium" id="today-date">ថ្ងៃសុក្រ ២០ មិថុនា ២០២៥</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Create Borrowing Form -->
            <div class="card modern-card">
                <div class="card-header bg-gradient-info text-white">
                    <div class="d-flex align-items-center">
                        <div class="form-icon me-3">
                            <i class="bi bi-plus-circle"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 khmer-semibold">ព័ត៌មានការខ្ចី</h6>
                            <small class="opacity-75 khmer-regular">សូមបំពេញព័ត៌មានទាំងអស់ដែលចាំបាច់</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('borrowings.store') }}" method="POST" class="borrowing-form">
                        @csrf

                        <!-- Member Selection Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title khmer-semibold">
                                    <i class="bi bi-person text-info me-2"></i>
                                    ជ្រើសរើសសមាជិក
                                </h5>
                                <p class="section-description khmer-regular">ជ្រើសរើសសមាជិកដែលនឹងខ្ចីសៀវភៅ</p>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-12">
                                    <label for="member_id" class="form-label khmer-medium required">
                                        <i class="bi bi-person me-1"></i>សមាជិក
                                    </label>
                                    <select class="form-select modern-input @error('member_id') is-invalid @enderror"
                                            id="member_id"
                                            name="member_id"
                                            required>
                                        <option value="">ជ្រើសរើសសមាជិក...</option>
                                        @foreach($members as $member)
                                            <option value="{{ $member->id }}"
                                                    {{ old('member_id', request('member_id')) == $member->id ? 'selected' : '' }}
                                                    data-email="{{ $member->email }}"
                                                    data-phone="{{ $member->phone }}"
                                                    data-status="{{ $member->membership_status }}"
                                                    data-active-borrowings="{{ $member->activeBorrowings()->count() }}">
                                                {{ $member->name }} ({{ $member->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('member_id')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Member Preview -->
                            <div class="member-preview" id="member-preview" style="display: none;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="preview-avatar" id="preview-member-avatar">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="preview-details">
                                            <h6 class="preview-name khmer-semibold" id="preview-member-name"></h6>
                                            <div class="preview-info">
                                                <div class="info-row">
                                                    <span class="info-label khmer-regular">អីមែល:</span>
                                                    <span class="info-value" id="preview-member-email"></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label khmer-regular">ទូរសព្ទ:</span>
                                                    <span class="info-value" id="preview-member-phone"></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label khmer-regular">ស្ថានភាព:</span>
                                                    <span class="info-value" id="preview-member-status"></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label khmer-regular">កំពុងខ្ចី:</span>
                                                    <span class="info-value khmer-number" id="preview-member-borrowings"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Book Selection Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title khmer-semibold">
                                    <i class="bi bi-book text-info me-2"></i>
                                    ជ្រើសរើសសៀវភៅ
                                </h5>
                                <p class="section-description khmer-regular">ជ្រើសរើសសៀវភៅដែលនឹងខ្ចី</p>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-12">
                                    <label for="book_id" class="form-label khmer-medium required">
                                        <i class="bi bi-book me-1"></i>សៀវភៅ
                                    </label>
                                    <select class="form-select modern-input @error('book_id') is-invalid @enderror"
                                            id="book_id"
                                            name="book_id"
                                            required>
                                        <option value="">ជ្រើសរើសសៀវភៅ...</option>
                                        @foreach($books as $book)
                                            <option value="{{ $book->id }}"
                                                    {{ old('book_id', request('book_id')) == $book->id ? 'selected' : '' }}
                                                    data-title="{{ $book->title }}"
                                                    data-author="{{ $book->author }}"
                                                    data-isbn="{{ $book->isbn }}"
                                                    data-genre="{{ $book->genre }}"
                                                    data-available="{{ $book->available_copies }}"
                                                    data-total="{{ $book->total_copies }}"
                                                {{ $book->available_copies == 0 ? 'disabled' : '' }}>
                                                {{ $book->title }} - {{ $book->author }}
                                                (មាន: {{ $book->available_copies }}/{{ $book->total_copies }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('book_id')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Book Preview -->
                            <div class="book-preview" id="book-preview" style="display: none;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="preview-book-cover">
                                            <i class="bi bi-book"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="preview-details">
                                            <h6 class="preview-name khmer-semibold" id="preview-book-title"></h6>
                                            <div class="preview-info">
                                                <div class="info-row">
                                                    <span class="info-label khmer-regular">អ្នកនិពន្ធ:</span>
                                                    <span class="info-value" id="preview-book-author"></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label khmer-regular">ប្រភេទ:</span>
                                                    <span class="info-value" id="preview-book-genre"></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label khmer-regular">ISBN:</span>
                                                    <span class="info-value" id="preview-book-isbn"></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label khmer-regular">ស្តុក:</span>
                                                    <span class="info-value">
                                                        <span class="khmer-number" id="preview-book-available"></span>/<span class="khmer-number" id="preview-book-total"></span>
                                                        <span class="availability-indicator" id="availability-indicator"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Borrowing Details Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title khmer-semibold">
                                    <i class="bi bi-calendar text-info me-2"></i>
                                    ព័ត៌មានការខ្ចី
                                </h5>
                                <p class="section-description khmer-regular">កំណត់កាលបរិច្ឆេទនិងរយៈពេល</p>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-4">
                                    <label for="borrowed_at" class="form-label khmer-medium required">
                                        <i class="bi bi-calendar-plus me-1"></i>ថ្ងៃខ្ចី
                                    </label>
                                    <input type="datetime-local"
                                           class="form-control modern-input @error('borrowed_at') is-invalid @enderror"
                                           id="borrowed_at"
                                           name="borrowed_at"
                                           value="{{ old('borrowed_at', date('Y-m-d\TH:i')) }}"
                                           required>
                                    @error('borrowed_at')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="loan_duration" class="form-label khmer-medium">
                                        <i class="bi bi-clock me-1"></i>រយៈពេលខ្ចី (ថ្ងៃ)
                                    </label>
                                    <select class="form-select modern-input" id="loan_duration" name="loan_duration">
                                        <option value="7" {{ old('loan_duration', '14') == '7' ? 'selected' : '' }}>៧ ថ្ងៃ</option>
                                        <option value="14" {{ old('loan_duration', '14') == '14' ? 'selected' : '' }}>១៤ ថ្ងៃ (ស្តង់ដារ)</option>
                                        <option value="21" {{ old('loan_duration', '14') == '21' ? 'selected' : '' }}>២១ ថ្ងៃ</option>
                                        <option value="30" {{ old('loan_duration', '14') == '30' ? 'selected' : '' }}>៣០ ថ្ងៃ</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="due_date" class="form-label khmer-medium required">
                                        <i class="bi bi-calendar-check me-1"></i>ថ្ងៃត្រូវត្រឡប់
                                    </label>
                                    <input type="date"
                                           class="form-control modern-input @error('due_date') is-invalid @enderror"
                                           id="due_date"
                                           name="due_date"
                                           value="{{ old('due_date') }}"
                                           required
                                           readonly>
                                    @error('due_date')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Due Date Preview -->
                            <div class="due-date-preview mt-3">
                                <div class="alert alert-info khmer-regular">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <strong>ថ្ងៃត្រូវត្រឡប់:</strong> <span id="due-date-display">សូមជ្រើសរើសរយៈពេលខ្ចី</span>
                                </div>
                            </div>
                        </div>

                        <!-- Summary Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title khmer-semibold">
                                    <i class="bi bi-list-check text-info me-2"></i>
                                    សេចក្តីសង្ខេបការខ្ចី
                                </h5>
                                <p class="section-description khmer-regular">ព័ត៌មានសង្ខេបនៃការខ្ចីដែលនឹងបង្កើត</p>
                            </div>

                            <div class="borrowing-summary">
                                <div class="summary-card">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="summary-title khmer-semibold">
                                                <i class="bi bi-person-circle me-2"></i>សមាជិក
                                            </h6>
                                            <div class="summary-content" id="summary-member">
                                                <div class="placeholder-text khmer-regular">សូមជ្រើសរើសសមាជិក</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="summary-title khmer-semibold">
                                                <i class="bi bi-book me-2"></i>សៀវភៅ
                                            </h6>
                                            <div class="summary-content" id="summary-book">
                                                <div class="placeholder-text khmer-regular">សូមជ្រើសរើសសៀវភៅ</div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="summary-item">
                                                <div class="summary-label khmer-regular">ថ្ងៃខ្ចី</div>
                                                <div class="summary-value khmer-medium" id="summary-borrowed-date">-</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="summary-item">
                                                <div class="summary-label khmer-regular">រយៈពេល</div>
                                                <div class="summary-value khmer-medium" id="summary-duration">១៤ ថ្ងៃ</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="summary-item">
                                                <div class="summary-label khmer-regular">ត្រូវត្រឡប់</div>
                                                <div class="summary-value khmer-medium" id="summary-due-date">-</div>
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
                                            <a href="{{ route('borrowings.index') }}" class="btn btn-outline-secondary me-3 khmer-medium">
                                                <i class="bi bi-x-circle me-1"></i>បោះបង់
                                            </a>
                                            <button type="submit" class="btn btn-info modern-btn khmer-medium">
                                                <i class="bi bi-check-circle me-2"></i>បង្កើតការខ្ចី
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

    <!-- Enhanced Styles for Borrowings Create -->
    <style>
        /* Page header styling */
        .page-icon-wrapper {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #6b46c1;
            box-shadow: 0 4px 15px rgba(168, 237, 234, 0.3);
        }

        .gradient-text {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .current-time-display {
            text-align: right;
        }

        /* Info items */
        .info-item {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            background: rgba(13, 110, 253, 0.05);
            border-radius: 8px;
        }

        .info-item i {
            font-size: 1.2rem;
            margin-right: 0.75rem;
        }

        /* User icon */
        .user-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        /* Form styling */
        .borrowing-form {
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
            border-color: #17a2b8;
            box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.15);
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

        /* Preview sections */
        .member-preview, .book-preview {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 1rem;
            border: 2px dashed #dee2e6;
            transition: all 0.3s ease;
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
            margin: 0 auto;
        }

        .preview-book-cover {
            width: 80px;
            height: 100px;
            border-radius: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin: 0 auto;
        }

        .preview-name {
            margin-bottom: 1rem;
            color: #2d3436;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e9ecef;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #6c757d;
            min-width: 100px;
        }

        .info-value {
            color: #2d3436;
            font-weight: 500;
        }

        .availability-indicator.available {
            color: #28a745;
            font-weight: 600;
        }

        .availability-indicator.unavailable {
            color: #dc3545;
            font-weight: 600;
        }

        /* Borrowing summary */
        .borrowing-summary {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 2rem;
            border: 2px dashed #dee2e6;
        }

        .summary-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .summary-title {
            color: #495057;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        .summary-content {
            min-height: 60px;
            display: flex;
            align-items: center;
        }

        .placeholder-text {
            color: #adb5bd;
            font-style: italic;
        }

        .summary-item {
            text-align: center;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .summary-label {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .summary-value {
            font-size: 1.1rem;
            color: #2d3436;
        }

        /* Due date preview */
        .due-date-preview .alert {
            border-left: 4px solid #17a2b8;
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

        .action-buttons .btn-info {
            box-shadow: 0 4px 15px rgba(23, 162, 184, 0.3);
        }

        .action-buttons .btn-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(23, 162, 184, 0.4);
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

            .preview-avatar, .preview-book-cover {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }

            .info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.25rem;
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

            .current-time-display {
                text-align: center;
                margin-bottom: 1rem;
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

    <!-- Enhanced JavaScript for Borrowings Create -->
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

        // Update current time
        function updateCurrentTime() {
            const now = new Date();
            const year = now.getUTCFullYear();
            const month = String(now.getUTCMonth() + 1).padStart(2, '0');
            const day = String(now.getUTCDate()).padStart(2, '0');
            const hours = String(now.getUTCHours()).padStart(2, '0');
            const minutes = String(now.getUTCMinutes()).padStart(2, '0');
            const seconds = String(now.getUTCSeconds()).padStart(2, '0');

            const timeString = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            const khmerTimeString = toKhmerNumbers(timeString);

            // Update all time displays
            const timeElements = [
                document.getElementById('header-time'),
                document.getElementById('current-time')
            ];

            timeElements.forEach(element => {
                if (element) {
                    element.textContent = khmerTimeString;
                }
            });

            // Update today's date in Khmer
            const todayElement = document.getElementById('today-date');
            if (todayElement) {
                const days = ['ថ្ងៃអាទិត្យ', 'ថ្ងៃច័ន្ទ', 'ថ្ងៃអង្គារ', 'ថ្ងៃពុធ', 'ថ្ងៃព្រហស្បតិ៍', 'ថ្ងៃសុក្រ', 'ថ្ងៃសៅរ៍'];
                const months = ['មករា', 'កុម្ភៈ', 'មីនា', 'មេសា', 'ឧសភា', 'មិថុនា', 'កក្កដា', 'សីហា', 'កញ្ញា', 'តុលា', 'វិច្ឆិកា', 'ធ្នូ'];

                const dayName = days[now.getUTCDay()];
                const dayNum = toKhmerNumbers(now.getUTCDate());
                const monthName = months[now.getUTCMonth()];
                const yearNum = toKhmerNumbers(now.getUTCFullYear());

                todayElement.textContent = `${dayName} ${dayNum} ${monthName} ${yearNum}`;
            }
        }

        // Member selection handler
        function handleMemberSelection() {
            const memberSelect = document.getElementById('member_id');
            const memberPreview = document.getElementById('member-preview');

            memberSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];

                if (this.value) {
                    // Show member preview
                    memberPreview.style.display = 'block';

                    // Update member avatar
                    const memberName = selectedOption.text.split(' (')[0];
                    const initials = memberName.split(' ').map(word => word.charAt(0).toUpperCase()).join('').substring(0, 2);
                    document.getElementById('preview-member-avatar').textContent = initials;

                    // Update member details
                    document.getElementById('preview-member-name').textContent = memberName;
                    document.getElementById('preview-member-email').textContent = selectedOption.dataset.email;
                    document.getElementById('preview-member-phone').textContent = selectedOption.dataset.phone || '-';

                    // Update status
                    const status = selectedOption.dataset.status;
                    const statusText = {
                        'active': 'សកម្ម',
                        'inactive': 'អសកម្ម',
                        'suspended': 'ផ្អាក'
                    };
                    document.getElementById('preview-member-status').innerHTML = `<span class="badge bg-${status === 'active' ? 'success' : status === 'inactive' ? 'secondary' : 'danger'}">${statusText[status]}</span>`;

                    // Update borrowings count
                    document.getElementById('preview-member-borrowings').textContent = toKhmerNumbers(selectedOption.dataset.activeBorrowings);

                    // Update summary
                    document.getElementById('summary-member').innerHTML = `
                        <div class="d-flex align-items-center">
                            <div class="summary-avatar me-2">${initials}</div>
                            <div>
                                <div class="fw-semibold">${memberName}</div>
                                <small class="text-muted">${selectedOption.dataset.email}</small>
                            </div>
                        </div>
                    `;
                } else {
                    memberPreview.style.display = 'none';
                    document.getElementById('summary-member').innerHTML = '<div class="placeholder-text khmer-regular">សូមជ្រើសរើសសមាជិក</div>';
                }

                validateForm();
            });
        }

        // Book selection handler
        function handleBookSelection() {
            const bookSelect = document.getElementById('book_id');
            const bookPreview = document.getElementById('book-preview');

            bookSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];

                if (this.value) {
                    // Show book preview
                    bookPreview.style.display = 'block';

                    // Update book details
                    document.getElementById('preview-book-title').textContent = selectedOption.dataset.title;
                    document.getElementById('preview-book-author').textContent = selectedOption.dataset.author;
                    document.getElementById('preview-book-genre').textContent = selectedOption.dataset.genre;
                    document.getElementById('preview-book-isbn').textContent = selectedOption.dataset.isbn;
                    document.getElementById('preview-book-available').textContent = toKhmerNumbers(selectedOption.dataset.available);
                    document.getElementById('preview-book-total').textContent = toKhmerNumbers(selectedOption.dataset.total);

                    // Update availability indicator
                    const available = parseInt(selectedOption.dataset.available);
                    const indicator = document.getElementById('availability-indicator');
                    if (available > 0) {
                        indicator.textContent = ' ✓ មាន';
                        indicator.className = 'availability-indicator available';
                    } else {
                        indicator.textContent = ' ✗ អស់';
                        indicator.className = 'availability-indicator unavailable';
                    }

                    // Update summary
                    document.getElementById('summary-book').innerHTML = `
                        <div class="d-flex align-items-center">
                            <div class="summary-book-cover me-2"><i class="bi bi-book"></i></div>
                            <div>
                                <div class="fw-semibold">${selectedOption.dataset.title}</div>
                                <small class="text-muted">${selectedOption.dataset.author}</small>
                            </div>
                        </div>
                    `;
                } else {
                    bookPreview.style.display = 'none';
                    document.getElementById('summary-book').innerHTML = '<div class="placeholder-text khmer-regular">សូមជ្រើសរើសសៀវភៅ</div>';
                }

                validateForm();
            });
        }

        // Due date calculation
        function handleDueDateCalculation() {
            const borrowedAtInput = document.getElementById('borrowed_at');
            const loanDurationSelect = document.getElementById('loan_duration');
            const dueDateInput = document.getElementById('due_date');

            function calculateDueDate() {
                const borrowedAt = new Date(borrowedAtInput.value);
                const duration = parseInt(loanDurationSelect.value);

                if (borrowedAtInput.value && duration) {
                    const dueDate = new Date(borrowedAt);
                    dueDate.setDate(dueDate.getDate() + duration);

                    const dueDateString = dueDate.toISOString().split('T')[0];
                    dueDateInput.value = dueDateString;

                    // Update displays
                    const displayDate = dueDate.toLocaleDateString('km-KH');
                    document.getElementById('due-date-display').textContent = displayDate;
                    document.getElementById('summary-due-date').textContent = displayDate;

                    // Update borrowed date display
                    const borrowedDate = borrowedAt.toLocaleDateString('km-KH');
                    document.getElementById('summary-borrowed-date').textContent = borrowedDate;
                }
            }

            borrowedAtInput.addEventListener('change', calculateDueDate);
            loanDurationSelect.addEventListener('change', function() {
                const duration = this.value;
                const durationText = {
                    '7': '៧ ថ្ងៃ',
                    '14': '១៤ ថ្ងៃ',
                    '21': '២១ ថ្ងៃ',
                    '30': '៣០ ថ្ងៃ'
                };
                document.getElementById('summary-duration').textContent = durationText[duration];
                calculateDueDate();
            });

            // Initial calculation
            calculateDueDate();
        }

        // Form validation
        function validateForm() {
            const memberSelect = document.getElementById('member_id');
            const bookSelect = document.getElementById('book_id');
            const submitBtn = document.querySelector('button[type="submit"]');

            const isValid = memberSelect.value && bookSelect.value;
            submitBtn.disabled = !isValid;

            if (isValid) {
                submitBtn.classList.remove('btn-secondary');
                submitBtn.classList.add('btn-info');
            } else {
                submitBtn.classList.remove('btn-info');
                submitBtn.classList.add('btn-secondary');
            }
        }

        // Form submission enhancement
        function enhanceFormSubmission() {
            const form = document.querySelector('.borrowing-form');
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            form.addEventListener('submit', function(e) {
                // Show loading state
                submitBtn.classList.add('loading');
                submitBtn.innerHTML = '<i class="spinner-border spinner-border-sm me-2"></i>កំពុងបង្កើត...';
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

            // Update time immediately and then every second
            updateCurrentTime();
            setInterval(updateCurrentTime, 1000);

            // Setup all handlers
            handleMemberSelection();
            handleBookSelection();
            handleDueDateCalculation();
            enhanceFormSubmission();

            // Initial form validation
            validateForm();

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

            // Auto-focus first select if no preselection
            if (!document.getElementById('member_id').value) {
                setTimeout(() => document.getElementById('member_id').focus(), 300);
            }

            // Add CSS for summary avatars
            const style = document.createElement('style');
            style.textContent = `
                .summary-avatar {
                    width: 30px;
                    height: 30px;
                    border-radius: 50%;
                    background: linear-gradient(135deg, #5ee7df 0%, #66a6ff 100%);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-size: 0.8rem;
                    font-weight: 600;
                }
                .summary-book-cover {
                    width: 30px;
                    height: 35px;
                    border-radius: 4px;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-size: 0.8rem;
                }
            `;
            document.head.appendChild(style);
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + S to save
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                document.querySelector('.borrowing-form').dispatchEvent(new Event('submit'));
            }

            // Escape to cancel
            if (e.key === 'Escape') {
                if (confirm('តើអ្នកពិតជាចង់បោះបង់ការបង្កើតការខ្ចីមែនទេ?')) {
                    window.location.href = "{{ route('borrowings.index') }}";
                }
            }
        });
    </script>
</x-app-layout>
