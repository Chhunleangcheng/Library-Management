<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h3 mb-1 text-gray-800 d-flex align-items-center khmer-bold">
                    <div class="page-icon-wrapper me-3">
                        <i class="bi bi-pencil-square text-warning"></i>
                    </div>
                    <span class="gradient-text">កែប្រែសមាជិក</span>
                </h2>
                <p class="text-muted mb-0 khmer-regular">
                    <i class="bi bi-info-circle me-1"></i>
                    កែប្រែព័ត៌មានសមាជិក: <span class="text-primary">{{ $member->name }}</span>
                </p>
            </div>
            <div class="header-actions">
                <a href="{{ route('members.show', $member) }}" class="btn btn-outline-info modern-btn me-2 khmer-medium">
                    <i class="bi bi-eye me-2"></i>មើលលម្អិត
                </a>
                <a href="{{ route('members.index') }}" class="btn btn-outline-secondary modern-btn khmer-medium">
                    <i class="bi bi-arrow-left me-2"></i>ត្រឡប់ក្រោយ
                </a>
            </div>
        </div>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Current Member Info Card -->
            <div class="card modern-card mb-4">
                <div class="card-header bg-gradient-info text-white">
                    <div class="d-flex align-items-center">
                        <div class="current-member-icon me-3">
                            <i class="bi bi-person"></i>
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
                                <small class="text-muted khmer-regular">ឈ្មោះ</small>
                                <div class="fw-semibold khmer-medium">{{ $member->name }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="current-info-item">
                                <small class="text-muted khmer-regular">អីមែល</small>
                                <div class="fw-semibold khmer-regular">{{ $member->email }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="current-info-item">
                                <small class="text-muted khmer-regular">ស្ថានភាព</small>
                                <div class="fw-semibold khmer-regular">
                                    @if($member->membership_status == 'active')
                                        <span class="text-success">សកម្ម</span>
                                    @elseif($member->membership_status == 'inactive')
                                        <span class="text-secondary">អសកម្ម</span>
                                    @else
                                        <span class="text-danger">ផ្អាក</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="current-info-item">
                                <small class="text-muted khmer-regular">ការខ្ចីសកម្ម</small>
                                <div class="fw-semibold khmer-number">{{ $member->activeBorrowings()->count() }}</div>
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
                    <form action="{{ route('members.update', $member) }}" method="POST" class="member-edit-form">
                        @csrf
                        @method('PUT')

                        <!-- Personal Information Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title khmer-semibold">
                                    <i class="bi bi-person text-warning me-2"></i>
                                    ព័ត៌មានផ្ទាល់ខ្លួន
                                </h5>
                                <p class="section-description khmer-regular">កែប្រែព័ត៌មានមូលដ្ឋានរបស់សមាជិក</p>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-8">
                                    <label for="name" class="form-label khmer-medium required">
                                        <i class="bi bi-person me-1"></i>ឈ្មោះពេញ
                                    </label>
                                    <div class="input-comparison">
                                        <div class="input-with-comparison">
                                            <input type="text"
                                                   class="form-control modern-input @error('name') is-invalid @enderror"
                                                   id="name"
                                                   name="name"
                                                   value="{{ old('name', $member->name) }}"
                                                   placeholder="បញ្ចូលឈ្មោះពេញ..."
                                                   required>
                                            @if(old('name', $member->name) !== $member->name)
                                                <small class="text-info khmer-regular">
                                                    <i class="bi bi-arrow-right me-1"></i>
                                                    ពីមុន: {{ $member->name }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
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
                                           value="{{ old('date_of_birth', $member->date_of_birth ? $member->date_of_birth->format('Y-m-d') : '') }}"
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
                                           value="{{ old('email', $member->email) }}"
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
                                           value="{{ old('phone', $member->phone) }}"
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
                                              placeholder="អាសយដ្ឋានលម្អិត...">{{ old('address', $member->address) }}</textarea>
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
                                    <i class="bi bi-card-checklist text-warning me-2"></i>
                                    ព័ត៌មានសមាជិកភាព
                                </h5>
                                <p class="section-description khmer-regular">កែប្រែព័ត៌មានសមាជិកភាព</p>
                                @if($member->activeBorrowings()->count() > 0)
                                    <div class="alert alert-warning khmer-regular" role="alert">
                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                        <strong>ការព្រមាន:</strong> សមាជិកនេះមានការខ្ចីសកម្ម {{ $member->activeBorrowings()->count() }} ក្បាល។
                                        ត្រូវប្រុងប្រយ័ត្នពេលកែប្រែស្ថានភាព។
                                    </div>
                                @endif
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
                                           value="{{ old('membership_date', $member->membership_date->format('Y-m-d')) }}"
                                           required>
                                    <small class="text-muted khmer-regular">
                                        បច្ចុប្បន្ន: {{ $member->membership_date->format('d/m/Y') }}
                                    </small>
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
                                        <option value="active" {{ old('membership_status', $member->membership_status) == 'active' ? 'selected' : '' }}>សកម្ម</option>
                                        <option value="inactive" {{ old('membership_status', $member->membership_status) == 'inactive' ? 'selected' : '' }}>អសកម្ម</option>
                                        <option value="suspended" {{ old('membership_status', $member->membership_status) == 'suspended' ? 'selected' : '' }}>ផ្អាក</option>
                                    </select>
                                    <small class="text-muted khmer-regular">
                                        បច្ចុប្បន្ន:
                                        @if($member->membership_status == 'active')
                                            <span class="text-success">សកម្ម</span>
                                        @elseif($member->membership_status == 'inactive')
                                            <span class="text-secondary">អសកម្ម</span>
                                        @else
                                            <span class="text-danger">ផ្អាក</span>
                                        @endif
                                    </small>
                                    @error('membership_status')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Updated Member Preview Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title khmer-semibold">
                                    <i class="bi bi-eye text-warning me-2"></i>
                                    មើលជាមុនសមាជិកបន្ទាប់ពីកែប្រែ
                                </h5>
                                <p class="section-description khmer-regular">ព័ត៌មានសមាជិកដែលនឹងត្រូវរក្សាទុក</p>
                            </div>

                            <div class="member-preview">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="preview-card">
                                            <div class="preview-avatar" id="preview-avatar">
                                                {{ strtoupper(substr($member->name, 0, 2)) }}
                                            </div>
                                            <div class="preview-info">
                                                <div class="preview-name khmer-semibold" id="preview-name">{{ $member->name }}</div>
                                                <div class="preview-email khmer-regular" id="preview-email">{{ $member->email }}</div>
                                                <div class="preview-status">
                                                    <span class="badge bg-success khmer-regular" id="preview-status">
                                                        @if($member->membership_status == 'active')
                                                            សកម្ម
                                                        @elseif($member->membership_status == 'inactive')
                                                            អសកម្ម
                                                        @else
                                                            ផ្អាក
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="preview-details">
                                            <div class="detail-row">
                                                <span class="detail-label khmer-medium">ទូរសព្ទ:</span>
                                                <span class="detail-value khmer-regular" id="preview-phone">{{ $member->phone ?? '-' }}</span>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label khmer-medium">ថ្ងៃកំណើត:</span>
                                                <span class="detail-value khmer-regular" id="preview-dob">
                                                    {{ $member->date_of_birth ? $member->date_of_birth->format('d/m/Y') : '-' }}
                                                </span>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label khmer-medium">ថ្ងៃចុះឈ្មោះ:</span>
                                                <span class="detail-value khmer-regular" id="preview-membership-date">{{ $member->membership_date->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label khmer-medium">អាសយដ្ឋាន:</span>
                                                <span class="detail-value khmer-regular" id="preview-address">{{ $member->address ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                            <a href="{{ route('members.show', $member) }}" class="btn btn-outline-secondary me-3 khmer-medium">
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

    <!-- Enhanced Styles for Members Edit Page -->
    <style>
        /* Current member info styling */
        .current-member-icon {
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

        /* All other styles remain the same as the books edit page with appropriate color adjustments */
        /* Change detection styling */
        .form-control.changed {
            border-color: #ffc107;
            background-color: #fff8e1;
        }

        .form-control.changed:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
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

        /* Form sections and other styles identical to books edit */
        .member-edit-form {
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

        /* Member preview styling (reuse from create page) */
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

            .detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.25rem;
            }

            .detail-value {
                text-align: left;
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

    <!-- Enhanced JavaScript for Members Edit -->
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

        // Original member data for comparison
        const originalMember = {
            name: {{ Js::from($member->name) }},
            email: {{ Js::from($member->email) }},
            phone: {{ Js::from($member->phone) }},
            address: {{ Js::from($member->address) }},
            date_of_birth: {{ Js::from($member->date_of_birth ? $member->date_of_birth->format('Y-m-d') : null) }},
            membership_date: {{ Js::from($member->membership_date->format('Y-m-d')) }},
            membership_status: {{ Js::from($member->membership_status) }}
        };

        // Real-time member preview update
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
            const name = nameInput.value || originalMember.name;
            previewName.textContent = name;
            if (nameInput.value) {
                const initials = name.split(' ').map(word => word.charAt(0).toUpperCase()).join('').substring(0, 2);
                previewAvatar.textContent = initials;
            }

            // Update other fields
            previewEmail.textContent = emailInput.value || originalMember.email;
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

        // Track form changes and update change summary
        function trackChanges() {
            const form = document.querySelector('.member-edit-form');
            const inputs = form.querySelectorAll('input, select, textarea');

            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    updateChangeSummary();
                    updateMemberPreview();
                    highlightChangedFields();
                });
            });
        }

        // Highlight changed fields
        function highlightChangedFields() {
            const form = document.querySelector('.member-edit-form');
            const inputs = form.querySelectorAll('input, select, textarea');

            inputs.forEach(input => {
                const currentValue = input.value;
                const originalValue = originalMember[input.name];

                if (currentValue != originalValue && originalValue !== null) {
                    input.classList.add('changed');
                } else {
                    input.classList.remove('changed');
                }
            });
        }

        // Update change summary
        function updateChangeSummary() {
            const form = document.querySelector('.member-edit-form');
            const summaryContainer = document.getElementById('change-summary');
            const inputs = form.querySelectorAll('input, select, textarea');

            let changes = [];

            inputs.forEach(input => {
                const currentValue = input.value;
                const originalValue = originalMember[input.name];
                const fieldName = getFieldDisplayName(input.name);

                if (currentValue != originalValue && originalValue !== null) {
                    changes.push({
                        field: fieldName,
                        oldValue: originalValue,
                        newValue: currentValue
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
                'name': 'ឈ្មោះ',
                'email': 'អីមែល',
                'phone': 'ទូរសព្ទ',
                'address': 'អាសយដ្ឋាន',
                'date_of_birth': 'ថ្ងៃកំណើត',
                'membership_date': 'ថ្ងៃចុះឈ្មោះ',
                'membership_status': 'ស្ថានភាព'
            };

            return fieldNames[fieldName] || fieldName;
        }

        // Reset form to original values
        function resetForm() {
            if (confirm('តើអ្នកពិតជាចង់កំណត់ទិន្នន័យឡើងវិញមែនទេ? ការផ្លាស់ប្តូរទាំងអស់នឹងបាត់បង់។')) {
                const form = document.querySelector('.member-edit-form');

                Object.keys(originalMember).forEach(field => {
                    const input = form.querySelector(`[name="${field}"]`);
                    if (input) {
                        input.value = originalMember[field] || '';
                        input.classList.remove('changed');
                    }
                });

                updateChangeSummary();
                updateMemberPreview();
            }
        }

        // Form validation enhancement (reuse from create page)
        function enhanceFormValidation() {
            const form = document.querySelector('.member-edit-form');
            const inputs = form.querySelectorAll('input, select, textarea');

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

            // Email validation
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

        // Form submission enhancement
        function enhanceFormSubmission() {
            const form = document.querySelector('.member-edit-form');
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

            // Setup all enhancements
            trackChanges();
            updateMemberPreview();
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

            // Auto-focus first changed field or name
            const changedField = document.querySelector('.form-control.changed');
            const nameField = document.getElementById('name');

            if (changedField) {
                setTimeout(() => changedField.focus(), 300);
            } else if (nameField) {
                setTimeout(() => nameField.focus(), 300);
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + S to save
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                document.querySelector('.member-edit-form').dispatchEvent(new Event('submit'));
            }

            // Ctrl/Cmd + R to reset
            if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
                e.preventDefault();
                resetForm();
            }

            // Escape to cancel
            if (e.key === 'Escape') {
                if (confirm('តើអ្នកពិតជាចង់បោះបង់ការកែប្រែមែនទេ?')) {
                    window.location.href = "{{ route('members.show', $member) }}";
                }
            }
        });
    </script>
</x-app-layout>
