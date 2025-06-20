<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h3 mb-1 text-gray-800 d-flex align-items-center khmer-bold">
                    <div class="page-icon-wrapper me-3">
                        <i class="bi bi-pencil-square text-warning"></i>
                    </div>
                    <span class="gradient-text">កែប្រែសៀវភៅ</span>
                </h2>
                <p class="text-muted mb-0 khmer-regular">
                    <i class="bi bi-info-circle me-1"></i>
                    កែប្រែព័ត៌មានសៀវភៅ: <span class="text-primary">{{ $book->title }}</span>
                </p>
            </div>
            <div class="header-actions">
                <a href="{{ route('books.show', $book) }}" class="btn btn-outline-info modern-btn me-2 khmer-medium">
                    <i class="bi bi-eye me-2"></i>មើលលម្អិត
                </a>
                <a href="{{ route('books.index') }}" class="btn btn-outline-secondary modern-btn khmer-medium">
                    <i class="bi bi-arrow-left me-2"></i>ត្រឡប់ក្រោយ
                </a>
            </div>
        </div>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Current Book Info Card -->
            <div class="card modern-card mb-4">
                <div class="card-header bg-gradient-info text-white">
                    <div class="d-flex align-items-center">
                        <div class="current-book-icon me-3">
                            <i class="bi bi-book"></i>
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
                                <small class="text-muted khmer-regular">ចំណងជើង</small>
                                <div class="fw-semibold khmer-medium">{{ $book->title }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="current-info-item">
                                <small class="text-muted khmer-regular">អ្នកនិពន្ធ</small>
                                <div class="fw-semibold khmer-regular">{{ $book->author }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="current-info-item">
                                <small class="text-muted khmer-regular">ប្រភេទ</small>
                                <div class="fw-semibold khmer-regular">{{ $book->genre }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="current-info-item">
                                <small class="text-muted khmer-regular">ចំនួនស្តុក</small>
                                <div class="fw-semibold khmer-number">{{ $book->available_copies }}/{{ $book->total_copies }}</div>
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
                    <form action="{{ route('books.update', $book) }}" method="POST" class="book-edit-form">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title khmer-semibold">
                                    <i class="bi bi-info-circle text-warning me-2"></i>
                                    ព័ត៌មានមូលដ្ឋាន
                                </h5>
                                <p class="section-description khmer-regular">កែប្រែព័ត៌មានទូទៅអំពីសៀវភៅ</p>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-8">
                                    <label for="title" class="form-label khmer-medium required">
                                        <i class="bi bi-card-text me-1"></i>ចំណងជើងសៀវភៅ
                                    </label>
                                    <div class="input-comparison">
                                        <div class="input-with-comparison">
                                            <input type="text"
                                                   class="form-control modern-input @error('title') is-invalid @enderror"
                                                   id="title"
                                                   name="title"
                                                   value="{{ old('title', $book->title) }}"
                                                   placeholder="បញ្ចូលចំណងជើងសៀវភៅ..."
                                                   required>
                                            @if(old('title', $book->title) !== $book->title)
                                                <small class="text-info khmer-regular">
                                                    <i class="bi bi-arrow-right me-1"></i>
                                                    ពីមុន: {{ $book->title }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
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
                                           value="{{ old('published_year', $book->published_year) }}"
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
                                           value="{{ old('author', $book->author) }}"
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
                                        <option value="Fiction" {{ old('genre', $book->genre) == 'Fiction' ? 'selected' : '' }}>Fiction (រឿងប្រលោមលោក)</option>
                                        <option value="Non-Fiction" {{ old('genre', $book->genre) == 'Non-Fiction' ? 'selected' : '' }}>Non-Fiction (មិនមែនប្រលោមលោក)</option>
                                        <option value="Science Fiction" {{ old('genre', $book->genre) == 'Science Fiction' ? 'selected' : '' }}>Science Fiction (រឿងប្រលោមលោកវិទ្យាសាស្ត្រ)</option>
                                        <option value="Fantasy" {{ old('genre', $book->genre) == 'Fantasy' ? 'selected' : '' }}>Fantasy (ការស្រមើលស្រមៃ)</option>
                                        <option value="Mystery" {{ old('genre', $book->genre) == 'Mystery' ? 'selected' : '' }}>Mystery (អាថ៌កំបាំង)</option>
                                        <option value="Romance" {{ old('genre', $book->genre) == 'Romance' ? 'selected' : '' }}>Romance (ស្នេហា)</option>
                                        <option value="Biography" {{ old('genre', $book->genre) == 'Biography' ? 'selected' : '' }}>Biography (ជីវប្រវត្តិ)</option>
                                        <option value="History" {{ old('genre', $book->genre) == 'History' ? 'selected' : '' }}>History (ប្រវត្តិសាស្ត្រ)</option>
                                        <option value="Education" {{ old('genre', $book->genre) == 'Education' ? 'selected' : '' }}>Education (អប់រំ)</option>
                                        <option value="Children" {{ old('genre', $book->genre) == 'Children' ? 'selected' : '' }}>Children (កុមារ)</option>
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
                                           value="{{ old('isbn', $book->isbn) }}"
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
                                    <i class="bi bi-file-text text-warning me-2"></i>
                                    បរិយាយអំពីសៀវភៅ
                                </h5>
                                <p class="section-description khmer-regular">កែប្រែព័ត៌មានលម្អិតអំពីខ្លឹមសារសៀវភៅ</p>
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
                                              placeholder="បរិយាយសង្ខេបអំពីខ្លឹមសារ និងចំណុចសំខាន់នៃសៀវភៅ...">{{ old('description', $book->description) }}</textarea>
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

                        <!-- Inventory Section with Warning -->
                        <div class="form-section">
                            <div class="section-header">
                                <h5 class="section-title khmer-semibold">
                                    <i class="bi bi-stack text-warning me-2"></i>
                                    ការគ្រប់គ្រងស្តុក
                                </h5>
                                <p class="section-description khmer-regular">កែប្រែចំនួនសៀវភៅនិងភាពអាចរកបាន</p>
                                @if($book->activeBorrowings()->count() > 0)
                                    <div class="alert alert-warning khmer-regular" role="alert">
                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                        <strong>ការព្រមាន:</strong> សៀវភៅនេះមានការខ្ចីសកម្ម {{ $book->activeBorrowings()->count() }} ក្បាល។
                                        ត្រូវប្រុងប្រយ័ត្នពេលកែប្រែចំនួន។
                                    </div>
                                @endif
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
                                               value="{{ old('total_copies', $book->total_copies) }}"
                                               min="1"
                                               max="999"
                                               required>
                                        <span class="input-group-text khmer-regular">ក្បាល</span>
                                    </div>
                                    <small class="text-muted khmer-regular">
                                        បច្ចុប្បន្ន: <span class="khmer-number">{{ $book->total_copies }}</span> ក្បាល
                                    </small>
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
                                               value="{{ old('available_copies', $book->available_copies) }}"
                                               min="0"
                                               max="999"
                                               required>
                                        <span class="input-group-text khmer-regular">ក្បាល</span>
                                    </div>
                                    <small class="text-muted khmer-regular">
                                        បច្ចុប្បន្ន: <span class="khmer-number">{{ $book->available_copies }}</span> ក្បាល |
                                        កំពុងខ្ចី: <span class="khmer-number">{{ $book->total_copies - $book->available_copies }}</span> ក្បាល
                                    </small>
                                    @error('available_copies')
                                    <div class="invalid-feedback khmer-regular">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Updated Stock Status Preview -->
                            <div class="row g-4 mt-2">
                                <div class="col-md-12">
                                    <div class="stock-preview">
                                        <h6 class="khmer-medium mb-3">
                                            <i class="bi bi-eye me-1"></i>មើលជាមុនស្ថានភាពស្តុកបន្ទាប់ពីកែប្រែ
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="preview-card total">
                                                    <div class="preview-icon">
                                                        <i class="bi bi-stack"></i>
                                                    </div>
                                                    <div class="preview-content">
                                                        <div class="preview-number khmer-bold" id="preview-total">{{ $book->total_copies }}</div>
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
                                                        <div class="preview-number khmer-bold" id="preview-available">{{ $book->available_copies }}</div>
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
                                                        <div class="preview-number khmer-bold" id="preview-borrowed">{{ $book->total_copies - $book->available_copies }}</div>
                                                        <div class="preview-label khmer-regular">កំពុងខ្ចី</div>
                                                    </div>
                                                </div>
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
                                            <a href="{{ route('books.show', $book) }}" class="btn btn-outline-secondary me-3 khmer-medium">
                                                <i class="bi bi-x-circle me-1"></i>បោះបង់
                                            </a>
                                            <button type="button" class="btn btn-info me-2 khmer-medium" onclick="resetForm()">
                                                <i class="bi bi-arrow-clockwise me-1"></i>កំណត់ឡើងវិញ
                                            </button>
                                            <button type="submit" class="btn btn-success modern-btn khmer-medium">
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

    <!-- Enhanced Styles for Edit Page -->
    <style>
        /* Current book info styling */
        .current-book-icon {
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

        /* Input comparison styling */
        .input-comparison {
            position: relative;
        }

        .input-with-comparison .form-control {
            margin-bottom: 0.25rem;
        }

        /* Change detection styling */
        .form-control.changed {
            border-color: #ffc107;
            background-color: #fff8e1;
        }

        .form-control.changed:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
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

        /* Enhanced form styling */
        .book-edit-form {
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

        /* Input groups */
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

        /* Stock preview (reuse from create page) */
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

        .action-buttons .btn-success {
            box-shadow: 0 4px 15px rgba(25, 135, 84, 0.3);
        }

        .action-buttons .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(25, 135, 84, 0.4);
        }

        /* Form help text */
        .form-text {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 0.5rem;
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
    </style>

    <!-- Enhanced JavaScript for Edit Page -->
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

        // Original book data for comparison
        const originalBook = {
            title: {{ Js::from($book->title) }},
            author: {{ Js::from($book->author) }},
            genre: {{ Js::from($book->genre) }},
            isbn: {{ Js::from($book->isbn) }},
            description: {{ Js::from($book->description) }},
            published_year: {{ Js::from($book->published_year) }},
            total_copies: {{ Js::from($book->total_copies) }},
            available_copies: {{ Js::from($book->available_copies) }}
        };

        // Track form changes
        function trackChanges() {
            const form = document.querySelector('.book-edit-form');
            const inputs = form.querySelectorAll('input, select, textarea');

            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    updateChangeSummary();
                    updateStockPreview();
                    highlightChangedFields();
                });
            });
        }

        // Highlight changed fields
        function highlightChangedFields() {
            const form = document.querySelector('.book-edit-form');
            const inputs = form.querySelectorAll('input, select, textarea');

            inputs.forEach(input => {
                const currentValue = input.value;
                const originalValue = originalBook[input.name];

                if (currentValue != originalValue && originalValue !== null) {
                    input.classList.add('changed');
                } else {
                    input.classList.remove('changed');
                }
            });
        }

        // Update change summary
        function updateChangeSummary() {
            const form = document.querySelector('.book-edit-form');
            const summaryContainer = document.getElementById('change-summary');
            const inputs = form.querySelectorAll('input, select, textarea');

            let changes = [];

            inputs.forEach(input => {
                const currentValue = input.value;
                const originalValue = originalBook[input.name];
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
                'title': 'ចំណងជើង',
                'author': 'អ្នកនិពន្ធ',
                'genre': 'ប្រភេទ',
                'isbn': 'លេខ ISBN',
                'description': 'សេចក្តីសង្ខេប',
                'published_year': 'ឆ្នាំបោះពុម្ព',
                'total_copies': 'ចំនួនសរុប',
                'available_copies': 'ចំនួនអាចខ្ចី'
            };

            return fieldNames[fieldName] || fieldName;
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

        // Reset form to original values
        function resetForm() {
            if (confirm('តើអ្នកពិតជាចង់កំណត់ទិន្នន័យឡើងវិញមែនទេ? ការផ្លាស់ប្តូរទាំងអស់នឹងបាត់បង់។')) {
                const form = document.querySelector('.book-edit-form');

                Object.keys(originalBook).forEach(field => {
                    const input = form.querySelector(`[name="${field}"]`);
                    if (input) {
                        input.value = originalBook[field] || '';
                        input.classList.remove('changed');
                    }
                });

                updateChangeSummary();
                updateStockPreview();
            }
        }

        // Form validation enhancement
        function enhanceFormValidation() {
            const form = document.querySelector('.book-edit-form');
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

        // Form submission enhancement
        function enhanceFormSubmission() {
            const form = document.querySelector('.book-edit-form');
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
            trackChanges();
            updateStockPreview();
            updateChangeSummary();
            enhanceFormValidation();
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

            // Auto-focus first changed field or title
            const changedField = document.querySelector('.form-control.changed');
            const titleField = document.getElementById('title');

            if (changedField) {
                setTimeout(() => changedField.focus(), 300);
            } else if (titleField) {
                setTimeout(() => titleField.focus(), 300);
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + S to save
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                document.querySelector('.book-edit-form').dispatchEvent(new Event('submit'));
            }

            // Ctrl/Cmd + R to reset
            if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
                e.preventDefault();
                resetForm();
            }

            // Escape to cancel
            if (e.key === 'Escape') {
                if (confirm('តើអ្នកពិតជាចង់បោះបង់ការកែប្រែមែនទេ?')) {
                    window.location.href = "{{ route('books.show', $book) }}";
                }
            }
        });

        // Auto-save draft
        function setupAutoSave() {
            const form = document.querySelector('.book-edit-form');
            const inputs = form.querySelectorAll('input, select, textarea');
            const draftKey = `bookEditDraft_${{{ $book->id }}}`;

            // Load saved draft
            const savedDraft = localStorage.getItem(draftKey);
            if (savedDraft) {
                const draftData = JSON.parse(savedDraft);
                Object.keys(draftData).forEach(key => {
                    const input = form.querySelector(`[name="${key}"]`);
                    if (input && input.value === originalBook[key]) {
                        input.value = draftData[key];
                    }
                });
                updateChangeSummary();
                updateStockPreview();
                highlightChangedFields();
            }

            // Save draft on input
            inputs.forEach(input => {
                input.addEventListener('input', debounce(() => {
                    const draftData = {};
                    inputs.forEach(inp => {
                        if (inp.value !== originalBook[inp.name]) {
                            draftData[inp.name] = inp.value;
                        }
                    });

                    if (Object.keys(draftData).length > 0) {
                        localStorage.setItem(draftKey, JSON.stringify(draftData));
                    } else {
                        localStorage.removeItem(draftKey);
                    }
                }, 500));
            });

            // Clear draft on successful submit
            form.addEventListener('submit', function() {
                localStorage.removeItem(draftKey);
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

        // Initialize auto-save
        setupAutoSave();
    </script>
</x-app-layout>
