<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h3 mb-1 text-gray-800 d-flex align-items-center khmer-bold">
                    <div class="page-icon-wrapper me-3">
                        <i class="bi bi-book-open text-primary"></i>
                    </div>
                    <span class="gradient-text">ព័ត៌មានលម្អិតសៀវភៅ</span>
                </h2>
                <p class="text-muted mb-0 khmer-regular">
                    <i class="bi bi-info-circle me-1"></i>
                    ព័ត៌មានពេញលេញអំពីសៀវភៅនេះ
                </p>
            </div>
            <div class="header-actions">
                <a href="{{ route('books.edit', $book) }}" class="btn btn-warning modern-btn me-2 khmer-medium">
                    <i class="bi bi-pencil me-2"></i>កែប្រែ
                </a>
                <a href="{{ route('books.index') }}" class="btn btn-outline-secondary modern-btn khmer-medium">
                    <i class="bi bi-arrow-left me-2"></i>ត្រឡប់ក្រោយ
                </a>
            </div>
        </div>
    </x-slot>

    <div class="row g-4">
        <!-- Main Book Information -->
        <div class="col-lg-8">
            <div class="card modern-card mb-4">
                <div class="card-header bg-gradient-primary text-base-100">
                    <div class="d-flex align-items-center">
                        <div class="book-icon me-3">
                            <i class="bi bi-book"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 khmer-semibold">{{ $book->title }}</h6>
                            <small class="opacity-75 khmer-regular">ព័ត៌មានលម្អិតអំពីសៀវភៅ</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <!-- Book Cover & Basic Info -->
                        <div class="col-md-4">
                            <div class="book-cover-large">
                                <i class="bi bi-book"></i>
                                <div class="book-status-overlay">
                                    @if($book->available_copies > 0)
                                        <span class="status-badge success khmer-medium">
                                            <i class="bi bi-check-circle"></i> មាន
                                        </span>
                                    @else
                                        <span class="status-badge danger khmer-medium">
                                            <i class="bi bi-x-circle"></i> អស់
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Book Details -->
                        <div class="col-md-8">
                            <div class="book-details-grid">
                                <div class="detail-row">
                                    <div class="detail-label khmer-medium">
                                        <i class="bi bi-card-text text-primary me-2"></i>ចំណងជើង
                                    </div>
                                    <div class="detail-value khmer-semibold">{{ $book->title }}</div>
                                </div>

                                <div class="detail-row">
                                    <div class="detail-label khmer-medium">
                                        <i class="bi bi-person text-success me-2"></i>អ្នកនិពន្ធ
                                    </div>
                                    <div class="detail-value khmer-regular">{{ $book->author }}</div>
                                </div>

                                <div class="detail-row">
                                    <div class="detail-label khmer-medium">
                                        <i class="bi bi-tag text-info me-2"></i>ប្រភេទ
                                    </div>
                                    <div class="detail-value">
                                        <span class="genre-badge-large khmer-regular">{{ $book->genre }}</span>
                                    </div>
                                </div>

                                <div class="detail-row">
                                    <div class="detail-label khmer-medium">
                                        <i class="bi bi-upc-scan text-warning me-2"></i>លេខ ISBN
                                    </div>
                                    <div class="detail-value">
                                        <code class="isbn-display">{{ $book->isbn }}</code>
                                    </div>
                                </div>

                                @if($book->published_year)
                                    <div class="detail-row">
                                        <div class="detail-label khmer-medium">
                                            <i class="bi bi-calendar3 text-secondary me-2"></i>ឆ្នាំបោះពុម្ព
                                        </div>
                                        <div class="detail-value khmer-regular khmer-number">{{ $book->published_year }}</div>
                                    </div>
                                @endif

                                <div class="detail-row">
                                    <div class="detail-label khmer-medium">
                                        <i class="bi bi-clock text-muted me-2"></i>បានបន្ថែមនៅ
                                    </div>
                                    <div class="detail-value khmer-regular">{{ $book->created_at->format('d/m/Y H:i') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Book Description -->
                    @if($book->description)
                        <div class="book-description mt-4">
                            <h6 class="khmer-semibold mb-3">
                                <i class="bi bi-file-text text-primary me-2"></i>សេចក្តីសង្ខេប
                            </h6>
                            <div class="description-content khmer-regular">
                                {{ $book->description }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Borrowing History -->
            <div class="card modern-card">
                <div class="card-header bg-white border-bottom-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="history-icon me-3">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <div>
                                <h6 class="card-title mb-0 khmer-semibold">ប្រវត្តិការខ្ចី</h6>
                                <small class="text-muted khmer-regular">
                                    ការខ្ចីទាំងអស់របស់សៀវភៅនេះ
                                    (<span class="khmer-number">{{ $book->borrowings->count() }}</span> ដង)
                                </small>
                            </div>
                        </div>
                        @if($book->borrowings->count() > 0)
                            <div class="history-stats">
                                <small class="text-muted khmer-regular">
                                    សកម្ម: <span class="text-primary khmer-number">{{ $book->activeBorrowings->count() }}</span> |
                                    បានត្រឡប់: <span class="text-success khmer-number">{{ $book->borrowings->whereNotNull('returned_at')->count() }}</span>
                                </small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($book->borrowings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover modern-table mb-0">
                                <thead>
                                <tr>
                                    <th class="border-0 khmer-medium">សមាជិក</th>
                                    <th class="border-0 khmer-medium">ថ្ងៃខ្ចី</th>
                                    <th class="border-0 khmer-medium">ថ្ងៃត្រូវត្រឡប់</th>
                                    <th class="border-0 khmer-medium">ថ្ងៃត្រឡប់</th>
                                    <th class="border-0 khmer-medium">ស្ថានភាព</th>
                                    <th class="border-0 khmer-medium">ការពិន័យ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($book->borrowings->sortByDesc('borrowed_at') as $borrowing)
                                    <tr class="borrowing-row">
                                        <td class="border-0">
                                            <div class="member-info-mini">
                                                <div class="member-avatar-small">
                                                    {{ strtoupper(substr($borrowing->member->name, 0, 2)) }}
                                                </div>
                                                <div class="member-details-small">
                                                    <div class="member-name-small khmer-medium">{{ $borrowing->member->name }}</div>
                                                    <small class="text-muted">{{ $borrowing->member->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-0">
                                            <span class="date-display khmer-regular">{{ $borrowing->borrowed_at->format('d/m/Y') }}</span>
                                        </td>
                                        <td class="border-0">
                                                <span class="date-display khmer-regular {{ $borrowing->isOverdue() && !$borrowing->returned_at ? 'text-danger fw-bold' : '' }}">
                                                    {{ $borrowing->due_date->format('d/m/Y') }}
                                                </span>
                                        </td>
                                        <td class="border-0">
                                            @if($borrowing->returned_at)
                                                <span class="date-display khmer-regular">{{ $borrowing->returned_at->format('d/m/Y') }}</span>
                                            @else
                                                <span class="text-muted khmer-regular">-</span>
                                            @endif
                                        </td>
                                        <td class="border-0">
                                            @if($borrowing->returned_at)
                                                <span class="status-badge success khmer-regular">
                                                        <i class="bi bi-check-circle"></i> បានត្រឡប់
                                                    </span>
                                            @elseif($borrowing->isOverdue())
                                                <span class="status-badge danger khmer-regular">
                                                        <i class="bi bi-exclamation-triangle"></i> ហួសកំណត់
                                                    </span>
                                            @else
                                                <span class="status-badge primary khmer-regular">
                                                        <i class="bi bi-clock"></i> កំពុងខ្ចី
                                                    </span>
                                            @endif
                                        </td>
                                        <td class="border-0">
                                            @if($borrowing->fine_amount)
                                                <div class="fine-info">
                                                    <span class="fine-amount">${{ number_format($borrowing->fine_amount, 2) }}</span>
                                                    @if($borrowing->fine_paid)
                                                        <span class="badge bg-success ms-1 khmer-regular">បានបង់</span>
                                                    @else
                                                        <span class="badge bg-danger ms-1 khmer-regular">មិនទាន់បង់</span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-history">
                            <div class="empty-icon">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <h6 class="empty-title khmer-semibold">មិនទាន់មានការខ្ចី</h6>
                            <p class="empty-description khmer-regular">សៀវភៅនេះមិនទាន់ត្រូវបានខ្ចីម្តងណាទេ</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Stock Information -->
            <div class="card modern-card mb-4">
                <div class="card-header bg-gradient-success text-base-100">
                    <div class="d-flex align-items-center">
                        <div class="stock-icon me-3">
                            <i class="bi bi-stack"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 khmer-semibold">ព័ត៌មានស្តុក</h6>
                            <small class="opacity-75 khmer-regular">ចំនួននិងភាពអាចរកបាន</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="stock-summary">
                        <div class="stock-item total">
                            <div class="stock-item-icon">
                                <i class="bi bi-stack"></i>
                            </div>
                            <div class="stock-item-content">
                                <div class="stock-number khmer-bold khmer-number">{{ $book->total_copies }}</div>
                                <div class="stock-label khmer-regular">ចំនួនសរុប</div>
                            </div>
                        </div>

                        <div class="stock-item available">
                            <div class="stock-item-icon">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="stock-item-content">
                                <div class="stock-number khmer-bold khmer-number">{{ $book->available_copies }}</div>
                                <div class="stock-label khmer-regular">អាចខ្ចីបាន</div>
                            </div>
                        </div>

                        <div class="stock-item borrowed">
                            <div class="stock-item-icon">
                                <i class="bi bi-arrow-right-circle"></i>
                            </div>
                            <div class="stock-item-content">
                                <div class="stock-number khmer-bold khmer-number">{{ $book->total_copies - $book->available_copies }}</div>
                                <div class="stock-label khmer-regular">កំពុងខ្ចី</div>
                            </div>
                        </div>
                    </div>

                    <!-- Stock Progress -->
                    <div class="stock-progress mt-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="khmer-regular">អត្រាប្រើប្រាស់</span>
                            <span class="khmer-medium">
                                {{ $book->total_copies > 0 ? number_format((($book->total_copies - $book->available_copies) / $book->total_copies) * 100, 1) : 0 }}%
                            </span>
                        </div>
                        <div class="progress progress-custom">
                            <div class="progress-bar bg-info"
                                 style="width: {{ $book->total_copies > 0 ? (($book->total_copies - $book->available_copies) / $book->total_copies) * 100 : 0 }}%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card modern-card mb-4">
                <div class="card-header bg-gradient-warning text-base-100">
                    <div class="d-flex align-items-center">
                        <div class="action-icon me-3">
                            <i class="bi bi-lightning-fill"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 khmer-semibold">សកម្មភាពរហ័ស</h6>
                            <small class="opacity-75 khmer-regular">ធ្វើការងារលឿន</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="quick-actions-vertical">
                        @if($book->available_copies > 0)
                            <a href="{{ route('borrowings.create', ['book_id' => $book->id]) }}"
                               class="quick-action-item primary">
                                <div class="action-icon-small">
                                    <i class="bi bi-plus-circle"></i>
                                </div>
                                <div class="action-content">
                                    <div class="action-title khmer-semibold">ខ្ចីសៀវភៅនេះ</div>
                                    <div class="action-subtitle khmer-regular">បង្កើតការខ្ចីថ្មី</div>
                                </div>
                            </a>
                        @else
                            <div class="quick-action-item disabled">
                                <div class="action-icon-small">
                                    <i class="bi bi-x-circle"></i>
                                </div>
                                <div class="action-content">
                                    <div class="action-title khmer-semibold">មិនអាចខ្ចីបាន</div>
                                    <div class="action-subtitle khmer-regular">សៀវភៅអស់ហើយ</div>
                                </div>
                            </div>
                        @endif

                        <a href="{{ route('books.edit', $book) }}" class="quick-action-item warning">
                            <div class="action-icon-small">
                                <i class="bi bi-pencil"></i>
                            </div>
                            <div class="action-content">
                                <div class="action-title khmer-semibold">កែប្រែព័ត៌មាន</div>
                                <div class="action-subtitle khmer-regular">កែប្រែសៀវភៅនេះ</div>
                            </div>
                        </a>

                        <a href="{{ route('books.index') }}" class="quick-action-item info">
                            <div class="action-icon-small">
                                <i class="bi bi-list"></i>
                            </div>
                            <div class="action-content">
                                <div class="action-title khmer-semibold">បញ្ជីសៀវភៅ</div>
                                <div class="action-subtitle khmer-regular">ត្រឡប់ទៅបញ្ជី</div>
                            </div>
                        </a>

                        @if($book->activeBorrowings()->count() == 0)
                            <button onclick="confirmDelete()" class="quick-action-item danger">
                                <div class="action-icon-small">
                                    <i class="bi bi-trash"></i>
                                </div>
                                <div class="action-content">
                                    <div class="action-title khmer-semibold">លុបសៀវភៅ</div>
                                    <div class="action-subtitle khmer-regular">លុបចេញពីប្រព័ន្ធ</div>
                                </div>
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <!-- Update the statistics section in the show view -->
            <div class="card modern-card">
                <div class="card-header bg-gradient-info text-base-100">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 khmer-semibold">ស្ថិតិសៀវភៅ</h6>
                            <small class="opacity-75 khmer-regular">ទិន្នន័យសំខាន់ៗ</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-value khmer-bold khmer-number">{{ $book->borrowings->count() }}</div>
                            <div class="stat-label khmer-regular">ដងនៃការខ្ចី</div>
                        </div>

                        <div class="stat-item">
                            <div class="stat-value khmer-bold khmer-number">{{ $book->borrowings->where('returned_at', '!=', null)->count() }}</div>
                            <div class="stat-label khmer-regular">បានត្រឡប់</div>
                        </div>

                        <div class="stat-item">
                            <div class="stat-value khmer-bold khmer-number">{{ $book->borrowings->filter(function($borrowing) { return $borrowing->isOverdue(); })->count() }}</div>
                            <div class="stat-label khmer-regular">ហួសកំណត់</div>
                        </div>

                        <div class="stat-item">
                            <div class="stat-value khmer-bold">
                                ${{ number_format($book->borrowings->whereNotNull('fine_amount')->sum('fine_amount'), 2) }}
                            </div>
                            <div class="stat-label khmer-regular">ការពិន័យសរុប</div>
                        </div>
                    </div>

                    @if($book->borrowings->count() > 0)
                        <div class="stats-additional mt-3">
                            <small class="text-muted khmer-regular">
                                ការខ្ចីចុងក្រោយ:
                                <span class="text-primary">{{ $book->borrowings->sortByDesc('borrowed_at')->first()->borrowed_at->diffForHumans() }}</span>
                            </small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title khmer-semibold">
                        <i class="bi bi-exclamation-triangle text-danger me-2"></i>បញ្ជាក់ការលុប
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="khmer-regular">តើអ្នកពិតជាចង់លុបសៀវភៅ <strong>"{{ $book->title }}"</strong> មែនទេ?</p>
                    <p class="text-warning khmer-regular">
                        <i class="bi bi-warning me-1"></i>
                        សកម្មភាពនេះមិនអាចធ្វើត្រឡប់វិញបានទេ។
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary khmer-regular" data-bs-dismiss="modal">បោះបង់</button>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger khmer-medium">លុបចេញ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Styles for Show Page -->
    <style>
        /* Book cover large */
        .book-cover-large {
            width: 100%;
            height: 300px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: white;
            position: relative;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            margin-bottom: 1rem;
        }

        .book-status-overlay {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        /* Book details grid */
        .book-details-grid {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .detail-row {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            background: #f8f9fa;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .detail-row:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }

        .detail-label {
            min-width: 140px;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .detail-value {
            flex: 1;
            font-size: 1rem;
            color: #2d3436;
        }

        .genre-badge-large {
            background: #e9ecef;
            color: #495057;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .isbn-display {
            background: #f8f9fa;
            color: #6c757d;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-family: monospace;
        }

        /* Book description */
        .book-description {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            border-left: 4px solid #0d6efd;
        }

        .description-content {
            line-height: 1.8;
            color: #495057;
            font-size: 1rem;
        }

        /* History table enhancements */
        .history-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
        }

        .member-info-mini {
            display: flex;
            align-items: center;
        }

        .member-avatar-small {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.8rem;
            margin-right: 0.75rem;
        }

        .member-name-small {
            font-size: 0.9rem;
            margin-bottom: 0.1rem;
        }

        .date-display {
            font-family: monospace;
            font-size: 0.9rem;
        }

        .fine-info {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .fine-amount {
            font-family: monospace;
            font-weight: 600;
            color: #dc3545;
        }

        /* Empty history */
        .empty-history {
            text-align: center;
            padding: 3rem 1rem;
        }

        .empty-history .empty-icon {
            font-size: 3rem;
            color: #dee2e6;
            margin-bottom: 1rem;
        }

        .empty-title {
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .empty-description {
            color: #adb5bd;
        }

        /* Stock information */
        .stock-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .stock-summary {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .stock-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .stock-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .stock-item.total {
            border-left: 4px solid #0d6efd;
        }

        .stock-item.available {
            border-left: 4px solid #198754;
        }

        .stock-item.borrowed {
            border-left: 4px solid #ffc107;
        }

        .stock-item-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.1rem;
        }

        .stock-item.total .stock-item-icon {
            background: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }

        .stock-item.available .stock-item-icon {
            background: rgba(25, 135, 84, 0.1);
            color: #198754;
        }

        .stock-item.borrowed .stock-item-icon {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .stock-number {
            font-size: 1.5rem;
            margin-bottom: 0.25rem;
        }

        .stock-label {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .progress-custom {
            height: 10px;
            border-radius: 5px;
        }

        /* Quick actions vertical */
        .quick-actions-vertical {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .quick-action-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
            background: #f8f9fa;
            color: inherit;
            width: 100%;
            text-align: left;
        }

        .quick-action-item:hover:not(.disabled) {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-decoration: none;
            color: inherit;
        }

        .quick-action-item.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .quick-action-item.warning {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            color: #8b4513;
        }

        .quick-action-item.info {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #6b46c1;
        }

        .quick-action-item.danger {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            color: #dc3545;
        }

        .quick-action-item.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .action-icon-small {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1rem;
        }

        .action-title {
            font-size: 0.95rem;
            margin-bottom: 0.2rem;
        }

        .action-subtitle {
            font-size: 0.8rem;
            opacity: 0.8;
        }

        /* Statistics */
        .stats-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .stat-item {
            text-align: center;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            background: #e9ecef;
            transform: scale(1.05);
        }

        .stat-value {
            font-size: 1.5rem;
            color: #2d3436;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.8rem;
            color: #6c757d;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .book-cover-large {
                height: 200px;
                font-size: 3rem;
            }

            .detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .detail-label {
                min-width: auto;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .stock-summary {
                gap: 0.5rem;
            }

            .action-title,
            .action-subtitle {
                font-size: 0.85rem;
            }
        }

        /* Modal enhancements */
        .modal-content {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }

        .modal-header {
            background: #f8f9fa;
            border-radius: 15px 15px 0 0;
        }

        /* Animations */
        .modern-card {
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

        // Confirm delete function
        function confirmDelete() {
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Convert numbers to Khmer
            document.querySelectorAll('.khmer-number').forEach(element => {
                const originalText = element.textContent;
                element.textContent = toKhmerNumbers(originalText);
            });

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Add smooth animations with delays
            const cards = document.querySelectorAll('.modern-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });

            // Enhanced interactions
            document.querySelectorAll('.detail-row').forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.background = '#e3f2fd';
                });
                row.addEventListener('mouseleave', function() {
                    this.style.background = '#f8f9fa';
                });
            });

            // Stock item interactions
            document.querySelectorAll('.stock-item').forEach(item => {
                item.addEventListener('click', function() {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });

            // Borrowing row highlighting
            document.querySelectorAll('.borrowing-row').forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = 'rgba(102, 126, 234, 0.05)';
                });
                row.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = '';
                });
            });

            // Update relative dates
            setInterval(() => {
                // This could update relative time displays if needed
            }, 60000); // Update every minute
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // E for edit
            if (e.key === 'e' && !e.ctrlKey && !e.metaKey) {
                if (!document.querySelector('input:focus, textarea:focus, select:focus')) {
                    window.location.href = "{{ route('books.edit', $book) }}";
                }
            }

            // B for back to list
            if (e.key === 'b' && !e.ctrlKey && !e.metaKey) {
                if (!document.querySelector('input:focus, textarea:focus, select:focus')) {
                    window.location.href = "{{ route('books.index') }}";
                }
            }

            // Delete key for delete (with confirmation)
            if (e.key === 'Delete' && !e.ctrlKey && !e.metaKey) {
                if (!document.querySelector('input:focus, textarea:focus, select:focus')) {
                    @if($book->activeBorrowings()->count() == 0)
                    confirmDelete();
                    @endif
                }
            }
        });

        // Print functionality
        function printBookInfo() {
            window.print();
        }

        // Add print styles
        const printStyles = `
            @media print {
                .header-actions, .quick-actions-vertical, .navbar, .sidebar {
                    display: none !important;
                }
                .card {
                    box-shadow: none !important;
                    border: 1px solid #ddd !important;
                }
                .modern-card {
                    break-inside: avoid;
                }
            }
        `;

        const styleSheet = document.createElement('style');
        styleSheet.textContent = printStyles;
        document.head.appendChild(styleSheet);
    </script>
</x-app-layout>
