<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h3 mb-1 text-gray-800 d-flex align-items-center khmer-bold">
                    <div class="page-icon-wrapper me-3">
                        <i class="bi bi-pencil-square text-warning"></i>
                    </div>
                    <span class="gradient-text">កែប្រែការខ្ចី</span>
                </h2>
                <p class="text-muted mb-0 khmer-regular">
                    <i class="bi bi-info-circle me-1"></i>
                    កែប្រែព័ត៌មានការខ្ចី #<span class="khmer-number">{{ $borrowing->id }}</span>
                </p>
            </div>
            <div class="header-actions">
                <div class="current-time-display me-3">
                    <small class="text-muted khmer-regular">ពេលវេលាបច្ចុប្បន្ន (UTC)</small>
                    <div class="fw-bold text-primary khmer-medium" id="header-time">២០២៥-០៦-២០ ០៦:០៣:២៨</div>
                </div>
                <a href="{{ route('borrowings.show', $borrowing) }}" class="btn btn-outline-info modern-btn me-2 khmer-medium">
                    <i class="bi bi-eye me-2"></i>មើលលម្អិត
                </a>
                <a href="{{ route('borrowings.index') }}" class="btn btn-outline-secondary modern-btn khmer-medium">
                    <i class="bi bi-arrow-left me-2"></i>ត្រឡប់ក្រោយ
                </a>
            </div>
        </div>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Current User & System Info -->
            <div class="card modern-card mb-4">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex align-items-center">
                        <div class="user-icon me-3">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 khmer-semibold">ព័ត៌មានអ្នកប្រើ</h6>
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
                                    <div class="fw-semibold khmer-medium" id="current-time">២០២៥-០៦-២០ ០៦:០៣:២៨</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item">
                                <i class="bi bi-shield-check text-warning me-2"></i>
                                <div>
                                    <small class="text-muted khmer-regular">ស្ថានភាពការខ្ចី</small>
                                    <div class="fw-semibold khmer-medium">
                                        @if($borrowing->returned_at)
                                            <span class="text-success">បានត្រឡប់</span>
                                        @elseif($borrowing->isOverdue())
                                            <span class="text-danger">ហួសកំណត់</span>
                                        @else
                                            <span class="text-warning">កំពុងខ្ចី</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Borrowing Info -->
            <div class="card modern-card mb-4">
                <div class="card-header bg-gradient-info text-white">
                    <div class="d-flex align-items-center">
                        <div class="current-borrowing-icon me-3">
                            <i class="bi bi-arrow-left-right"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 khmer-semibold">ព័ត៌មានបច្ចុប្បន្ន</h6>
                            <small class="opacity-75 khmer-regular">ព័ត៌មានដែលមានស្រាប់</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="current-info-item">
                                <small class="text-muted khmer-regular">សមាជិក</small>
                                <div class="fw-semibold khmer-medium">{{ $borrowing->member->name }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="current-info-item">
                                <small class="text-muted khmer-regular">សៀវភៅ</small>
                                <div class="fw-semibold khmer-regular">{{ Str::limit($borrowing->book->title, 25) }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="current-info-item">
                                <small class="text-muted khmer-regular">ថ្ងៃខ្ចី</small>
                                <div class="fw-semibold khmer-regular">{{ $borrowing->borrowed_at->format('d/m/Y') }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="current-info-item">
                                <small class="text-muted khmer-regular">ថ្ងៃត្រូវត្រឡប់</small>
                                <div class="fw-semibold khmer-regular">{{ $borrowing->due_date->format('d/m/Y') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Form Card -->
            <div class="card modern-card">
                <div class="card-header bg-gradient-warning text-dark">
                    <div class="d-flex align-items-center">
                        <div class="form-icon me-3">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 khmer-semibold">កែប្រែព័ត៌មាន</h6>
                            <small class="opacity-75 khmer-regular">កែប្រែព័ត៌មានដែលចាំបាច់</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('borrowings.update', $borrowing) }}" method="POST" class="borrowing-edit-form">
                        @csrf
                        @method('PUT')

                        <!-- Member and Book Selection Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title khmer-semibold">
                                    <i class="bi bi-people text-warning me-2"></i>
                                    សមាជិក និង សៀវភៅ
                                </h5>
                                <p class="section-description khmer-regular">កែប្រែសមាជិក និង សៀវភៅ</p>
                                @if(!$borrowing->returned_at)
                                    <div class="alert alert-warning khmer-regular" role="alert">
                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                        <strong>ការព្រមាន:</strong> ការខ្ចីនេះនៅតែសកម្ម។ ការផ្លាស់ប្តូរសៀវភៅនឹងប៉ះពាល់ដល់ស្តុក។
                                    </div>
                                @endif
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="member_id" class="form-label khmer-medium required">
                                        <i class="bi bi-person me-1"></i>សមាជិក
                                    </label>
                                    <select class="form-select modern-input @error('member_id') is-invalid @enderror"
                                            id="member_id"
                                            name="member_id"
                                            required>
                                        @foreach($members as $member)
                                            <option value="{{ $member->id }}"
                                                    {{ old('member_id', $borrowing->member_id) == $member->id ? 'selected' : '' }}
                                                    data-email="{{ $member->email }}"
                                                    data-phone="{{ $member->phone }}"
                                                    data-status="{{ $member->membership_status }}">
                                                {{ $member->name }} ({{ $member->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('member_id')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="book_id" class="form-label khmer-medium required">
                                        <i class="bi bi-book me-1"></i>សៀវភៅ
                                    </label>
                                    <select class="form-select modern-input @error('book_id') is-invalid @enderror"
                                            id="book_id"
                                            name="book_id"
                                            required>
                                        @foreach($books as $book)
                                            <option value="{{ $book->id }}"
                                                    {{ old('book_id', $borrowing->book_id) == $book->id ? 'selected' : '' }}
                                                    data-title="{{ $book->title }}"
                                                    data-author="{{ $book->author }}"
                                                    data-available="{{ $book->available_copies }}"
                                                {{ $book->available_copies == 0 && $book->id != $borrowing->book_id ? 'disabled' : '' }}>
                                                {{ $book->title }} - {{ $book->author }}
                                                @if($book->id == $borrowing->book_id)
                                                    (បច្ចុប្បន្ន)
                                                @else
                                                    (មាន: {{ $book->available_copies }})
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('book_id')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Date Information Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title khmer-semibold">
                                    <i class="bi bi-calendar text-warning me-2"></i>
                                    ព័ត៌មានកាលបរិច្ឆេទ
                                </h5>
                                <p class="section-description khmer-regular">កែប្រែកាលបរិច្ឆេទការខ្ចី</p>
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
                                           value="{{ old('borrowed_at', $borrowing->borrowed_at->format('Y-m-d\TH:i')) }}"
                                           required>
                                    @error('borrowed_at')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="due_date" class="form-label khmer-medium required">
                                        <i class="bi bi-calendar-check me-1"></i>ថ្ងៃត្រូវត្រឡប់
                                    </label>
                                    <input type="date"
                                           class="form-control modern-input @error('due_date') is-invalid @enderror"
                                           id="due_date"
                                           name="due_date"
                                           value="{{ old('due_date', $borrowing->due_date->format('Y-m-d')) }}"
                                           required>
                                    @error('due_date')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="returned_at" class="form-label khmer-medium">
                                        <i class="bi bi-calendar-x me-1"></i>ថ្ងៃត្រឡប់
                                    </label>
                                    <input type="datetime-local"
                                           class="form-control modern-input @error('returned_at') is-invalid @enderror"
                                           id="returned_at"
                                           name="returned_at"
                                           value="{{ old('returned_at', $borrowing->returned_at ? $borrowing->returned_at->format('Y-m-d\TH:i') : '') }}">
                                    <div class="form-text khmer-regular">
                                        ទុកឱ្យទទេ ប្រសិនបើមិនទាន់ត្រឡប់
                                    </div>
                                    @error('returned_at')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Duration Display -->
                            <div class="duration-display mt-3">
                                <div class="alert alert-info khmer-regular">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <strong>រយៈពេលខ្ចី:</strong> <span id="duration-display">-</span>
                                </div>
                            </div>
                        </div>

                        <!-- Fine Information Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title khmer-semibold">
                                    <i class="bi bi-currency-dollar text-warning me-2"></i>
                                    ព័ត៌មានការពិន័យ
                                </h5>
                                <p class="section-description khmer-regular">កែប្រែព័ត៌មានការពិន័យ</p>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="fine_amount" class="form-label khmer-medium">
                                        <i class="bi bi-currency-dollar me-1"></i>ចំនួនការពិន័យ ($)
                                    </label>
                                    <input type="number"
                                           class="form-control modern-input @error('fine_amount') is-invalid @enderror"
                                           id="fine_amount"
                                           name="fine_amount"
                                           value="{{ old('fine_amount', $borrowing->fine_amount) }}"
                                           step="0.01"
                                           min="0">
                                    @error('fine_amount')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label khmer-medium">ស្ថានភាពការបង់</label>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               id="fine_paid"
                                               name="fine_paid"
                                               value="1"
                                            {{ old('fine_paid', $borrowing->fine_paid) ? 'checked' : '' }}>
                                        <label class="form-check-label khmer-regular" for="fine_paid">
                                            បានបង់ការពិន័យហើយ
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Fine Calculation Helper -->
                            @if($borrowing->isOverdue() && !$borrowing->returned_at)
                                <div class="fine-helper mt-3">
                                    <div class="alert alert-warning khmer-regular">
                                        <i class="bi bi-calculator me-2"></i>
                                        <strong>ការគណនាស្វ័យប្រវត្តិ:</strong> ហួសកំណត់ <span class="khmer-number">{{ $borrowing->days_overdue }}</span> ថ្ងៃ
                                        = $<span id="calculated-fine">{{ number_format($borrowing->days_overdue * 1.00, 2) }}</span>
                                        <button type="button" class="btn btn-sm btn-outline-warning ms-2 khmer-regular" onclick="applyCalculatedFine()">
                                            <i class="bi bi-check me-1"></i>ប្រើការគណនានេះ
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Change Summary Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title khmer-semibold">
                                    <i class="bi bi-list-check text-warning me-2"></i>
                                    សេចក្តីសង្ខេបការផ្លាស់ប្តូរ
                                </h5>
                                <p class="section-description khmer-regular">ការផ្លាស់ប្តូរដែលនឹងត្រូវរក្សាទុក</p>
                            </div>

                            <div class="change-summary" id="change-summary">
                                <div class="alert alert-info khmer-regular">
                                    <i class="bi bi-info-circle me-2"></i>
                                    កែប្រែការបញ្ចូលទិន្នន័យ ដើម្បីមើលការផ្លាស់ប្តូរ
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
                                            <a href="{{ route('borrowings.show', $borrowing) }}" class="btn btn-outline-secondary me-3 khmer-medium">
                                                <i class="bi bi-x-circle me-1"></i>បោះបង់
                                            </a>
                                            <button type="button" class="btn btn-info me-2 khmer-medium" onclick="resetForm()">
                                                <i class="bi bi-arrow-clockwise me-1"></i>កំណត់ឡើងវិញ
                                            </button>
                                            <button type="submit" class="btn btn-warning modern-btn khmer-medium">
                                                <i class="bi bi-check-circle me-2"></i>រក្សាទុកការកែប្រែ
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

    <!-- Enhanced Styles for Borrowings Edit -->
    <style>
        /* Page header styling */
        .page-icon-wrapper {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #8b4513;
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
        }

        .gradient-text {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
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

        /* Current info styling */
        .current-borrowing-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .current-info-item {
            padding: 0.75rem;
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
            text-align: center;
        }

        .current-info-item small {
            display: block;
            margin-bottom: 0.25rem;
        }

        /* Form styling (reuse from previous forms) */
        .borrowing-edit-form {
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
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.15);
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

        /* Duration display */
        .duration-display .alert {
            border-left: 4px solid #ffc107;
        }

        /* Fine helper */
        .fine-helper .alert {
            border-left: 4px solid #ffc107;
        }

        /* Change summary styling */
        .change-summary {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            border: 2px dashed #dee2e6;
        }

        .change-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            background: white;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            border-left: 4px solid #ffc107;
        }

        .change-item:last-child {
            margin-bottom: 0;
        }

        .change-field {
            font-weight: 600;
            color: #495057;
        }

        .change-values {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .old-value {
            color: #6c757d;
            text-decoration: line-through;
            font-size: 0.9rem;
        }

        .new-value {
            color: #ffc107;
            font-weight: 600;
        }

        .change-arrow {
            color: #ffc107;
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

        .action-buttons .btn-warning {
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
        }

        .action-buttons .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 193, 7, 0.4);
        }

        /* Form icon */
        .form-icon, .user-icon {
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
            .current-info-item {
                margin-bottom: 1rem;
            }

            .form-section {
                margin-bottom: 2rem;
                padding-bottom: 1rem;
            }

            .section-header {
                margin-bottom: 1.5rem;
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

    <!-- Enhanced JavaScript for Borrowings Edit -->
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

        // Original borrowing data for comparison
        const originalBorrowing = {
            member_id: {{ Js::from($borrowing->member_id) }},
            book_id: {{ Js::from($borrowing->book_id) }},
            borrowed_at: {{ Js::from($borrowing->borrowed_at->format('Y-m-d\TH:i')) }},
            due_date: {{ Js::from($borrowing->due_date->format('Y-m-d')) }},
            returned_at: {{ Js::from($borrowing->returned_at ? $borrowing->returned_at->format('Y-m-d\TH:i') : null) }},
            fine_amount: {{ Js::from($borrowing->fine_amount) }},
            fine_paid: {{ Js::from($borrowing->fine_paid) }}
        };

        // Update current time with exact UTC format
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
        }

        // Calculate duration between dates
        function calculateDuration() {
            const borrowedAtInput = document.getElementById('borrowed_at');
            const dueDateInput = document.getElementById('due_date');
            const durationDisplay = document.getElementById('duration-display');

            if (borrowedAtInput.value && dueDateInput.value) {
                const borrowedAt = new Date(borrowedAtInput.value);
                const dueDate = new Date(dueDateInput.value);
                const diffTime = dueDate.getTime() - borrowedAt.getTime();
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                if (diffDays > 0) {
                    durationDisplay.textContent = `${toKhmerNumbers(diffDays)} ថ្ងៃ`;
                } else if (diffDays === 0) {
                    durationDisplay.textContent = 'ថ្ងៃតែមួយ';
                } else {
                    durationDisplay.textContent = 'កាលបរិច្ឆេទមិនត្រឹមត្រូវ';
                    durationDisplay.className = 'text-danger';
                }
            } else {
                durationDisplay.textContent = '-';
            }
        }

        // Apply calculated fine
        function applyCalculatedFine() {
            const calculatedFine = document.getElementById('calculated-fine').textContent;
            document.getElementById('fine_amount').value = calculatedFine;
            updateChangeSummary();
        }

        // Track form changes and update change summary
        function trackChanges() {
            const form = document.querySelector('.borrowing-edit-form');
            const inputs = form.querySelectorAll('input, select');

            inputs.forEach(input => {
                input.addEventListener('change', function() {
                    updateChangeSummary();
                    calculateDuration();
                });

                input.addEventListener('input', function() {
                    updateChangeSummary();
                    calculateDuration();
                });
            });
        }

        // Update change summary
        function updateChangeSummary() {
            const form = document.querySelector('.borrowing-edit-form');
            const summaryContainer = document.getElementById('change-summary');
            const inputs = form.querySelectorAll('input, select');

            let changes = [];

            inputs.forEach(input => {
                let currentValue = input.type === 'checkbox' ? input.checked : input.value;
                let originalValue = originalBorrowing[input.name];

                // Handle null values
                if (originalValue === null) originalValue = '';
                if (currentValue === '') currentValue = null;

                const fieldName = getFieldDisplayName(input.name);

                if (currentValue != originalValue) {
                    changes.push({
                        field: fieldName,
                        oldValue: formatValue(originalValue, input.type),
                        newValue: formatValue(currentValue, input.type)
                    });
                }
            });

            if (changes.length === 0) {
                summaryContainer.innerHTML = `
                    <div class="alert alert-info khmer-regular">
                        <i class="bi bi-info-circle me-2"></i>
                        មិនមានការផ្លាស់ប្តូរ
                    </div>
                `;
            } else {
                let changesHtml = '<div class="changes-list">';
                changes.forEach(change => {
                    changesHtml += `
                        <div class="change-item">
                            <div class="change-field khmer-medium">${change.field}</div>
                            <div class="change-values">
                                <span class="old-value khmer-regular">${change.oldValue || 'ទទេ'}</span>
                                <i class="bi bi-arrow-right change-arrow"></i>
                                <span class="new-value khmer-regular">${change.newValue || 'ទទេ'}</span>
                            </div>
                        </div>
                    `;
                });
                changesHtml += '</div>';
                summaryContainer.innerHTML = changesHtml;
            }
        }

        // Get field display name in Khmer
        function getFieldDisplayName(fieldName) {
            const fieldNames = {
                'member_id': 'សមាជិក',
                'book_id': 'សៀវភៅ',
                'borrowed_at': 'ថ្ងៃខ្ចី',
                'due_date': 'ថ្ងៃត្រូវត្រឡប់',
                'returned_at': 'ថ្ងៃត្រឡប់',
                'fine_amount': 'ចំនួនការពិន័យ',
                'fine_paid': 'ស្ថានភាពការបង់'
            };

            return fieldNames[fieldName] || fieldName;
        }

        // Format value for display
        function formatValue(value, inputType) {
            if (value === null || value === '') return 'ទទេ';

            if (inputType === 'checkbox') {
                return value ? 'បានបង់' : 'មិនទាន់បង់';
            }

            if (inputType === 'datetime-local') {
                return new Date(value).toLocaleString('km-KH');
            }

            if (inputType === 'date') {
                return new Date(value).toLocaleDateString('km-KH');
            }

            return value;
        }

        // Reset form to original values
        function resetForm() {
            if (confirm('តើអ្នកពិតជាចង់កំណត់ទិន្នន័យឡើងវិញមែនទេ? ការផ្លាស់ប្តូរទាំងអស់នឹងបាត់បង់។')) {
                const form = document.querySelector('.borrowing-edit-form');

                Object.keys(originalBorrowing).forEach(field => {
                    const input = form.querySelector(`[name="${field}"]`);
                    if (input) {
                        if (input.type === 'checkbox') {
                            input.checked = originalBorrowing[field] || false;
                        } else {
                            input.value = originalBorrowing[field] || '';
                        }
                    }
                });

                updateChangeSummary();
                calculateDuration();
            }
        }

        // Form validation enhancement
        function enhanceFormValidation() {
            const form = document.querySelector('.borrowing-edit-form');
            const inputs = form.querySelectorAll('input, select');

            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (this.checkValidity()) {
                        this.classList.remove('is-invalid');
                        this.classList.add('is-valid');
                    } else {
                        this.classList.remove('is-valid');
                        this.classList.add('is-invalid');
                    }
                });

                input.addEventListener('focus', function() {
                    this.classList.remove('is-valid', 'is-invalid');
                });
            });

            // Custom validation for dates
            const borrowedAtInput = document.getElementById('borrowed_at');
            const dueDateInput = document.getElementById('due_date');
            const returnedAtInput = document.getElementById('returned_at');

            function validateDates() {
                const borrowedAt = new Date(borrowedAtInput.value);
                const dueDate = new Date(dueDateInput.value);
                const returnedAt = returnedAtInput.value ? new Date(returnedAtInput.value) : null;

                // Due date must be after borrowed date
                if (dueDateInput.value && borrowedAtInput.value) {
                    if (dueDate <= borrowedAt) {
                        dueDateInput.setCustomValidity('ថ្ងៃត្រូវត្រឡប់ត្រូវតែក្រោយថ្ងៃខ្ចី');
                    } else {
                        dueDateInput.setCustomValidity('');
                    }
                }

                // Returned date must be after borrowed date
                if (returnedAtInput.value && borrowedAtInput.value) {
                    if (returnedAt < borrowedAt) {
                        returnedAtInput.setCustomValidity('ថ្ងៃត្រឡប់ត្រូវតែក្រោយថ្ងៃខ្ចី');
                    } else {
                        returnedAtInput.setCustomValidity('');
                    }
                }
            }

            borrowedAtInput.addEventListener('change', validateDates);
            dueDateInput.addEventListener('change', validateDates);
            returnedAtInput.addEventListener('change', validateDates);
        }

        // Form submission enhancement
        function enhanceFormSubmission() {
            const form = document.querySelector('.borrowing-edit-form');
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            form.addEventListener('submit', function(e) {
                submitBtn.classList.add('loading');
                submitBtn.innerHTML = '<i class="spinner-border spinner-border-sm me-2"></i>កំពុងរក្សាទុក...';
                submitBtn.disabled = true;

                if (!form.checkValidity()) {
                    e.preventDefault();
                    submitBtn.classList.remove('loading');
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;

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

            // Setup all enhancements
            trackChanges();
            calculateDuration();
            updateChangeSummary();
            enhanceFormValidation();
            enhanceFormSubmission();

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
            const firstInput = document.getElementById('member_id');
            if (firstInput) {
                setTimeout(() => firstInput.focus(), 300);
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + S to save
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                document.querySelector('.borrowing-edit-form').dispatchEvent(new Event('submit'));
            }

            // Ctrl/Cmd + R to reset
            if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
                e.preventDefault();
                resetForm();
            }

            // Escape to cancel
            if (e.key === 'Escape') {
                if (confirm('តើអ្នកពិតជាចង់បោះបង់ការកែប្រែមែនទេ?')) {
                    window.location.href = "{{ route('borrowings.show', $borrowing) }}";
                }
            }
        });
    </script>
</x-app-layout>
