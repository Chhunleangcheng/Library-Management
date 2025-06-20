<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h3 mb-1 text-gray-800 d-flex align-items-center khmer-bold">
                    <div class="page-icon-wrapper me-3">
                        <i class="bi bi-arrow-left-right text-info"></i>
                    </div>
                    <span class="gradient-text">គ្រប់គ្រងការខ្ចី</span>
                </h2>
                <p class="text-muted mb-0 khmer-regular">
                    <i class="bi bi-clock-history me-1"></i>
                    គ្រប់គ្រងការខ្ចីសៀវភៅទាំងអស់
                </p>
            </div>
            <div class="header-actions">
                <button class="btn btn-outline-info modern-btn me-2 khmer-medium" onclick="refreshData()">
                    <i class="bi bi-arrow-clockwise me-2"></i>ធ្វើឱ្យទាន់សម័យ
                </button>
                <a href="{{ route('borrowings.create') }}" class="btn btn-info modern-btn khmer-medium">
                    <i class="bi bi-plus-circle me-2"></i>បង្កើតការខ្ចីថ្មី
                </a>
            </div>
        </div>
    </x-slot>

    <!-- Real-time Status Bar -->
    <div class="status-bar mb-4">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="status-item">
                    <i class="bi bi-clock text-primary"></i>
                    <div class="status-content">
                        <div class="status-label khmer-regular">ពេលវេលាបច្ចុប្បន្ន (UTC)</div>
                        <div class="status-value khmer-medium" id="current-datetime">២០២៥-០៦-២០ ០៥:៤៨:៣៨</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="status-item">
                    <i class="bi bi-person-circle text-success"></i>
                    <div class="status-content">
                        <div class="status-label khmer-regular">អ្នកប្រើបច្ចុប្បន្ន</div>
                        <div class="status-value khmer-medium">Chhunleangcheng</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="status-item">
                    <i class="bi bi-graph-up text-warning"></i>
                    <div class="status-content">
                        <div class="status-label khmer-regular">ការខ្ចីសកម្ម</div>
                        <div class="status-value khmer-medium khmer-number" id="active-borrowings">{{ $stats['active_borrowings'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="status-item">
                    <i class="bi bi-exclamation-triangle text-danger"></i>
                    <div class="status-content">
                        <div class="status-label khmer-regular">ហួសកំណត់</div>
                        <div class="status-value khmer-medium khmer-number" id="overdue-count">{{ $stats['overdue_borrowings'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Search and Filter Section -->
    <div class="card modern-card mb-4">
        <div class="card-header bg-gradient-info text-white">
            <div class="d-flex align-items-center">
                <div class="filter-icon me-3">
                    <i class="bi bi-funnel"></i>
                </div>
                <div>
                    <h6 class="card-title mb-0 khmer-semibold">ស្វែងរក និង ត្រងការខ្ចី</h6>
                    <small class="opacity-75 khmer-regular">ស្វែងរកការខ្ចីតាមលក្ខខណ្ឌផ្សេងៗ</small>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('borrowings.index') }}" class="filter-form">
                <div class="row g-3">
                    <!-- Search Input -->
                    <div class="col-md-3">
                        <label class="form-label khmer-medium">
                            <i class="bi bi-search me-1"></i>ស្វែងរកការខ្ចី
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control khmer-regular"
                                   placeholder="ស្វែងរកតាមសៀវភៅ, សមាជិក..."
                                   value="{{ request('search') }}">
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="col-md-3">
                        <label class="form-label khmer-medium">
                            <i class="bi bi-shield-check me-1"></i>ស្ថានភាពការខ្ចី
                        </label>
                        <select name="status" class="form-select khmer-regular">
                            <option value="">ស្ថានភាពទាំងអស់</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>កំពុងខ្ចី</option>
                            <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>បានត្រឡប់</option>
                            <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>ហួសកំណត់</option>
                        </select>
                    </div>

                    <!-- Date Range Filter -->
                    <div class="col-md-2">
                        <label class="form-label khmer-medium">
                            <i class="bi bi-calendar3 me-1"></i>ចាប់ពីថ្ងៃ
                        </label>
                        <input type="date" name="date_from" class="form-control khmer-regular"
                               value="{{ request('date_from') }}">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label khmer-medium">
                            <i class="bi bi-calendar-check me-1"></i>ដល់ថ្ងៃ
                        </label>
                        <input type="date" name="date_to" class="form-control khmer-regular"
                               value="{{ request('date_to') }}">
                    </div>

                    <!-- Filter Actions -->
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-outline-info khmer-medium">
                                <i class="bi bi-filter me-1"></i>ត្រង
                            </button>
                            <a href="{{ route('borrowings.index') }}" class="btn btn-outline-secondary btn-sm khmer-regular">
                                <i class="bi bi-arrow-clockwise me-1"></i>កំណត់ឡើងវិញ
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Borrowings Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-mini-card info">
                <div class="stat-mini-icon">
                    <i class="bi bi-arrow-left-right"></i>
                </div>
                <div class="stat-mini-content">
                    <div class="stat-mini-number khmer-bold khmer-number">{{ $borrowings->total() }}</div>
                    <div class="stat-mini-label khmer-regular">ការខ្ចីសរុប</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-mini-card primary">
                <div class="stat-mini-icon">
                    <i class="bi bi-clock"></i>
                </div>
                <div class="stat-mini-content">
                    <div class="stat-mini-number khmer-bold khmer-number">{{ $borrowings->whereNull('returned_at')->count() }}</div>
                    <div class="stat-mini-label khmer-regular">កំពុងខ្ចី</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-mini-card success">
                <div class="stat-mini-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-mini-content">
                    <div class="stat-mini-number khmer-bold khmer-number">{{ $borrowings->whereNotNull('returned_at')->count() }}</div>
                    <div class="stat-mini-label khmer-regular">បានត្រឡប់</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-mini-card danger">
                <div class="stat-mini-icon">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <div class="stat-mini-content">
                    @php
                        $overdueCount = $borrowings->filter(function($borrowing) {
                            return $borrowing->isOverdue() && !$borrowing->returned_at;
                        })->count();
                    @endphp
                    <div class="stat-mini-number khmer-bold khmer-number">{{ $overdueCount }}</div>
                    <div class="stat-mini-label khmer-regular">ហួសកំណត់</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Borrowings Table Card -->
    <div class="card modern-card">
        <div class="card-header bg-white border-bottom-0">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="table-icon me-3">
                        <i class="bi bi-table"></i>
                    </div>
                    <div>
                        <h6 class="card-title mb-0 khmer-semibold">បញ្ជីការខ្ចី</h6>
                        <small class="text-muted khmer-regular">
                            បង្ហាញលទ្ធផល <span class="khmer-number">{{ $borrowings->firstItem() ?? 0 }}</span> -
                            <span class="khmer-number">{{ $borrowings->lastItem() ?? 0 }}</span> នៃ
                            <span class="khmer-number">{{ $borrowings->total() }}</span> ការខ្ចី
                        </small>
                    </div>
                </div>
                <div class="table-actions">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle khmer-regular" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots me-1"></i>សកម្មភាព
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item khmer-regular" href="#" onclick="exportToPDF()">
                                    <i class="bi bi-file-pdf me-2"></i>នាំចេញជា PDF
                                </a></li>
                            <li><a class="dropdown-item khmer-regular" href="#" onclick="exportToExcel()">
                                    <i class="bi bi-file-excel me-2"></i>នាំចេញជា Excel
                                </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item khmer-regular" href="#" onclick="printTable()">
                                    <i class="bi bi-printer me-2"></i>បោះពុម្ព
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            @if($borrowings->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover modern-table mb-0" id="borrowings-table">
                        <thead>
                        <tr>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-person me-1"></i>សមាជិក
                            </th>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-book me-1"></i>សៀវភៅ
                            </th>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-calendar me-1"></i>ថ្ងៃខ្ចី
                            </th>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-calendar-check me-1"></i>ថ្ងៃត្រូវត្រឡប់
                            </th>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-calendar-x me-1"></i>ថ្ងៃត្រឡប់
                            </th>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-shield-check me-1"></i>ស្ថានភាព
                            </th>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-currency-dollar me-1"></i>ការពិន័យ
                            </th>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-gear me-1"></i>សកម្មភាព
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($borrowings as $borrowing)
                            <tr class="table-row-hover" data-borrowing-id="{{ $borrowing->id }}">
                                <td class="border-0">
                                    <div class="member-info-cell">
                                        <div class="member-avatar-small">
                                            {{ strtoupper(substr($borrowing->member->name, 0, 2)) }}
                                        </div>
                                        <div class="member-details-small">
                                            <div class="member-name-small khmer-semibold">{{ $borrowing->member->name }}</div>
                                            <div class="member-email-small text-muted">{{ $borrowing->member->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-0">
                                    <div class="book-info-cell">
                                        <div class="book-cover-tiny">
                                            <i class="bi bi-book"></i>
                                        </div>
                                        <div class="book-details-small">
                                            <div class="book-title-small khmer-semibold">{{ Str::limit($borrowing->book->title, 30) }}</div>
                                            <div class="book-author-small text-muted khmer-regular">{{ $borrowing->book->author }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-0">
                                    <div class="date-cell">
                                        <div class="date-main khmer-regular">{{ $borrowing->borrowed_at->format('d/m/Y') }}</div>
                                        <div class="date-time text-muted">{{ $borrowing->borrowed_at->format('H:i') }}</div>
                                    </div>
                                </td>
                                <td class="border-0">
                                    <div class="date-cell {{ $borrowing->isOverdue() && !$borrowing->returned_at ? 'overdue-warning' : '' }}">
                                        <div class="date-main khmer-regular">{{ $borrowing->due_date->format('d/m/Y') }}</div>
                                        <div class="date-countdown text-muted">
                                            @if(!$borrowing->returned_at)
                                                @if($borrowing->isOverdue())
                                                    <span class="text-danger khmer-regular">
                                                            <i class="bi bi-exclamation-triangle"></i>
                                                            ហួស <span class="khmer-number">{{ $borrowing->days_overdue }}</span>ថ្ងៃ
                                                        </span>
                                                @else
                                                    <span class="text-info khmer-regular">
                                                            នៅសល់ <span class="khmer-number">{{ $borrowing->due_date->diffInDays(now()) }}</span>ថ្ងៃ
                                                        </span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="border-0">
                                    @if($borrowing->returned_at)
                                        <div class="date-cell">
                                            <div class="date-main khmer-regular">{{ $borrowing->returned_at->format('d/m/Y') }}</div>
                                            <div class="date-time text-muted">{{ $borrowing->returned_at->format('H:i') }}</div>
                                        </div>
                                    @else
                                        <span class="text-muted khmer-regular">មិនទាន់ត្រឡប់</span>
                                    @endif
                                </td>
                                <td class="border-0">
                                    @if($borrowing->returned_at)
                                        <span class="status-badge success khmer-regular">
                                                <i class="bi bi-check-circle"></i> បានត្រឡប់
                                            </span>
                                    @elseif($borrowing->isOverdue())
                                        <span class="status-badge danger pulse khmer-regular">
                                                <i class="bi bi-exclamation-triangle"></i> ហួសកំណត់
                                            </span>
                                    @else
                                        <span class="status-badge primary khmer-regular">
                                                <i class="bi bi-clock"></i> កំពុងខ្ចី
                                            </span>
                                    @endif
                                </td>
                                <td class="border-0">
                                    @if($borrowing->fine_amount && $borrowing->fine_amount > 0)
                                        <div class="fine-cell">
                                            <div class="fine-amount">${{ number_format($borrowing->fine_amount, 2) }}</div>
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
                                <td class="border-0">
                                    <div class="action-buttons">
                                        <a href="{{ route('borrowings.show', $borrowing) }}"
                                           class="btn btn-sm btn-outline-info"
                                           data-bs-toggle="tooltip" title="មើលលម្អិត">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        @if(!$borrowing->returned_at)
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-success"
                                                    data-bs-toggle="tooltip" title="បានត្រឡប់"
                                                    onclick="returnBook({{ $borrowing->id }})">
                                                <i class="bi bi-check"></i>
                                            </button>
                                            @if($borrowing->isOverdue())
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-warning"
                                                        data-bs-toggle="tooltip" title="គណនាការពិន័យ"
                                                        onclick="calculateFine({{ $borrowing->id }})">
                                                    <i class="bi bi-currency-dollar"></i>
                                                </button>
                                            @endif
                                        @endif
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                    type="button"
                                                    data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item khmer-regular" href="{{ route('borrowings.edit', $borrowing) }}">
                                                        <i class="bi bi-pencil me-2"></i>កែប្រែ
                                                    </a></li>
                                                @if(!$borrowing->returned_at)
                                                    <li><a class="dropdown-item khmer-regular" href="#" onclick="extendDueDate({{ $borrowing->id }})">
                                                            <i class="bi bi-calendar-plus me-2"></i>បន្ថែមកាលបរិច្ឆេទ
                                                        </a></li>
                                                @endif
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger khmer-regular" href="#" onclick="deleteBorrowing({{ $borrowing->id }})">
                                                        <i class="bi bi-trash me-2"></i>លុប
                                                    </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <!-- Empty State -->
                <div class="empty-state-large">
                    <div class="empty-icon">
                        <i class="bi bi-arrow-left-right"></i>
                    </div>
                    <h4 class="empty-title khmer-semibold">មិនមានការខ្ចី</h4>
                    <p class="empty-description khmer-regular">
                        @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                            មិនមានការខ្ចីត្រូវនឹងការស្វែងរករបស់អ្នកទេ។ សាកល្បងស្វែងរកដោយលក្ខខណ្ឌផ្សេង។
                        @else
                            មិនទាន់មានការខ្ចីនៅក្នុងប្រព័ន្ធនេះទេ។ ចាប់ផ្តើមដោយបង្កើតការខ្ចីដំបូង។
                        @endif
                    </p>
                    <div class="empty-actions">
                        @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                            <a href="{{ route('borrowings.index') }}" class="btn btn-outline-primary khmer-medium">
                                <i class="bi bi-arrow-clockwise me-1"></i>មើលការខ្ចីទាំងអស់
                            </a>
                        @endif
                        <a href="{{ route('borrowings.create') }}" class="btn btn-info khmer-medium">
                            <i class="bi bi-plus me-1"></i>បង្កើតការខ្ចីថ្មី
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($borrowings->hasPages())
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="pagination-info khmer-regular text-muted">
                        បង្ហាញ <span class="khmer-number">{{ $borrowings->firstItem() }}</span> -
                        <span class="khmer-number">{{ $borrowings->lastItem() }}</span> នៃ
                        <span class="khmer-number">{{ $borrowings->total() }}</span> លទ្ធផល
                    </div>
                    <div class="pagination-links">
                        {{ $borrowings->withQueryString()->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Quick Return Modal -->
    <div class="modal fade" id="returnModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title khmer-semibold">
                        <i class="bi bi-check-circle text-success me-2"></i>បញ្ជាក់ការត្រឡប់សៀវភៅ
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="return-details"></div>
                    <div class="alert alert-info khmer-regular mt-3">
                        <i class="bi bi-info-circle me-2"></i>
                        តើអ្នកពិតជាចង់បញ្ជាក់ការត្រឡប់សៀវភៅនេះមែនទេ?
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary khmer-regular" data-bs-dismiss="modal">បោះបង់</button>
                    <button type="button" class="btn btn-success khmer-medium" id="confirm-return">បញ្ជាក់ការត្រឡប់</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Calculate Fine Modal -->
    <div class="modal fade" id="fineModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title khmer-semibold">
                        <i class="bi bi-currency-dollar text-warning me-2"></i>គណនាការពិន័យ
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="fine-details"></div>
                    <div class="mb-3">
                        <label for="fine-amount" class="form-label khmer-medium">ចំនួនការពិន័យ ($)</label>
                        <input type="number" class="form-control" id="fine-amount" step="0.01" min="0">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="fine-paid">
                        <label class="form-check-label khmer-regular" for="fine-paid">
                            បានបង់ការពិន័យហើយ
                        </label>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary khmer-regular" data-bs-dismiss="modal">បោះបង់</button>
                    <button type="button" class="btn btn-warning khmer-medium" id="save-fine">រក្សាទុក</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Styles for Borrowings Page -->
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

        /* Status bar */
        .status-bar {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 12px;
            padding: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .status-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .status-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .status-item i {
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        .status-label {
            font-size: 0.8rem;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }

        .status-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2d3436;
        }

        /* Filter card styling */
        .filter-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        /* Mini stat cards */
        .stat-mini-card {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
            color: white;
        }

        .stat-mini-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .stat-mini-card.info {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #6b46c1;
        }

        .stat-mini-card.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stat-mini-card.success {
            background: linear-gradient(135deg, #5ee7df 0%, #66a6ff 100%);
        }

        .stat-mini-card.danger {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            color: #dc3545;
        }

        .stat-mini-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        .stat-mini-number {
            font-size: 1.8rem;
            margin-bottom: 0.25rem;
        }

        .stat-mini-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* Table styling */
        .table-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b46c1;
            font-size: 1.1rem;
        }

        .modern-table {
            font-size: 0.9rem;
        }

        .modern-table thead th {
            background: #f8f9fa;
            font-weight: 600;
            color: #495057;
            border: none;
            padding: 1rem 0.75rem;
            vertical-align: middle;
        }

        .table-row-hover {
            transition: all 0.2s ease;
        }

        .table-row-hover:hover {
            background: rgba(168, 237, 234, 0.05);
            transform: scale(1.005);
        }

        /* Member info cell */
        .member-info-cell {
            display: flex;
            align-items: center;
        }

        .member-avatar-small {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #5ee7df 0%, #66a6ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
            font-weight: 600;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .member-name-small {
            font-size: 0.9rem;
            color: #2d3436;
            margin-bottom: 0.25rem;
        }

        .member-email-small {
            font-size: 0.8rem;
        }

        /* Book info cell */
        .book-info-cell {
            display: flex;
            align-items: center;
        }

        .book-cover-tiny {
            width: 35px;
            height: 35px;
            border-radius: 6px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .book-title-small {
            font-size: 0.9rem;
            color: #2d3436;
            margin-bottom: 0.25rem;
        }

        .book-author-small {
            font-size: 0.8rem;
        }

        /* Date cells */
        .date-cell {
            text-align: center;
        }

        .date-main {
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .date-time, .date-countdown {
            font-size: 0.8rem;
        }

        .overdue-warning {
            background: rgba(220, 53, 69, 0.1);
            border-radius: 8px;
            padding: 0.5rem;
        }

        /* Fine cell */
        .fine-cell {
            text-align: center;
        }

        .fine-amount {
            font-family: monospace;
            font-weight: 600;
            color: #dc3545;
            margin-bottom: 0.25rem;
        }

        /* Status badge */
        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .status-badge.success {
            background: #d4edda;
            color: #155724;
        }

        .status-badge.primary {
            background: #cce5ff;
            color: #004085;
        }

        .status-badge.danger {
            background: #f8d7da;
            color: #721c24;
        }

        .status-badge.pulse {
            animation: pulse 2s infinite;
        }

        /* Action buttons */
        .action-buttons {
            display: flex;
            gap: 0.25rem;
            align-items: center;
            flex-wrap: nowrap;
        }

        .action-buttons .btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            flex-shrink: 0;
        }

        /* Empty state */
        .empty-state-large {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-icon {
            font-size: 5rem;
            color: #dee2e6;
            margin-bottom: 2rem;
        }

        .empty-title {
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .empty-description {
            color: #adb5bd;
            margin-bottom: 2rem;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .empty-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
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

        /* Responsive design */
        @media (max-width: 768px) {
            .status-bar .row {
                gap: 0.5rem;
            }

            .status-item {
                padding: 0.75rem;
                margin-bottom: 0.5rem;
            }

            .status-item i {
                font-size: 1.2rem;
                margin-right: 0.75rem;
            }

            .member-info-cell,
            .book-info-cell {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .member-avatar-small,
            .book-cover-tiny {
                margin-right: 0;
                margin-bottom: 0.25rem;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.25rem;
            }

            .stat-mini-card {
                margin-bottom: 1rem;
            }
        }

        /* Animations */
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
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

        .modern-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .stat-mini-card {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Loading states */
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255,255,255,0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

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
            width: 16px;
            height: 16px;
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

        // Update current date/time
        function updateDateTime() {
            const now = new Date();
            const year = now.getUTCFullYear();
            const month = String(now.getUTCMonth() + 1).padStart(2, '0');
            const day = String(now.getUTCDate()).padStart(2, '0');
            const hours = String(now.getUTCHours()).padStart(2, '0');
            const minutes = String(now.getUTCMinutes()).padStart(2, '0');
            const seconds = String(now.getUTCSeconds()).padStart(2, '0');

            const timeString = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            const khmerTimeString = toKhmerNumbers(timeString);

            const timeElement = document.getElementById('current-datetime');
            if (timeElement) {
                timeElement.textContent = khmerTimeString;
            }
        }

        // Return book function
        function returnBook(borrowingId) {
            // Get borrowing details
            fetch(`/api/borrowings/${borrowingId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('return-details').innerHTML = `
                        <div class="mb-3">
                            <strong class="khmer-medium">សមាជិក:</strong> ${data.member.name}<br>
                            <strong class="khmer-medium">សៀវភៅ:</strong> ${data.book.title}<br>
                            <strong class="khmer-medium">ថ្ងៃខ្ចី:</strong> ${new Date(data.borrowed_at).toLocaleDateString('km-KH')}<br>
                            <strong class="khmer-medium">ថ្ងៃត្រូវត្រឡប់:</strong> ${new Date(data.due_date).toLocaleDateString('km-KH')}
                        </div>
                    `;

                    document.getElementById('confirm-return').onclick = function() {
                        confirmReturn(borrowingId);
                    };

                    new bootstrap.Modal(document.getElementById('returnModal')).show();
                });
        }

        // Confirm return
        function confirmReturn(borrowingId) {
            const btn = document.getElementById('confirm-return');
            btn.classList.add('loading');
            btn.disabled = true;

            fetch(`/borrowings/${borrowingId}/return`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('កំហុស: ' + data.message);
                        btn.classList.remove('loading');
                        btn.disabled = false;
                    }
                })
                .catch(error => {
                    alert('កំហុសក្នុងការត្រឡប់សៀវភៅ');
                    btn.classList.remove('loading');
                    btn.disabled = false;
                });
        }

        // Calculate fine function
        function calculateFine(borrowingId) {
            fetch(`/api/borrowings/${borrowingId}`)
                .then(response => response.json())
                .then(data => {
                    const daysOverdue = Math.max(0, Math.floor((new Date() - new Date(data.due_date)) / (1000 * 60 * 60 * 24)));
                    const suggestedFine = daysOverdue * 1.00; // $1 per day

                    document.getElementById('fine-details').innerHTML = `
                        <div class="mb-3">
                            <strong class="khmer-medium">សមាជិក:</strong> ${data.member.name}<br>
                            <strong class="khmer-medium">សៀវភៅ:</strong> ${data.book.title}<br>
                            <strong class="khmer-medium">ថ្ងៃហួសកំណត់:</strong> <span class="khmer-number">${toKhmerNumbers(daysOverdue)}</span> ថ្ងៃ<br>
                            <strong class="khmer-medium">ការពិន័យដែលបានស្នើ:</strong> $${suggestedFine.toFixed(2)}
                        </div>
                    `;

                    document.getElementById('fine-amount').value = suggestedFine.toFixed(2);
                    document.getElementById('fine-paid').checked = false;

                    document.getElementById('save-fine').onclick = function() {
                        saveFine(borrowingId);
                    };

                    new bootstrap.Modal(document.getElementById('fineModal')).show();
                });
        }

        // Save fine
        function saveFine(borrowingId) {
            const fineAmount = document.getElementById('fine-amount').value;
            const finePaid = document.getElementById('fine-paid').checked;
            const btn = document.getElementById('save-fine');

            btn.classList.add('loading');
            btn.disabled = true;

            fetch(`/borrowings/${borrowingId}/fine`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    fine_amount: fineAmount,
                    fine_paid: finePaid
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('កំហុស: ' + data.message);
                        btn.classList.remove('loading');
                        btn.disabled = false;
                    }
                })
                .catch(error => {
                    alert('កំហុសក្នុងការរក្សាទុកការពិន័យ');
                    btn.classList.remove('loading');
                    btn.disabled = false;
                });
        }

        // Extend due date
        function extendDueDate(borrowingId) {
            const days = prompt('បន្ថែមចំនួនថ្ងៃ:', '7');
            if (days && !isNaN(days) && parseInt(days) > 0) {
                fetch(`/borrowings/${borrowingId}/extend`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        days: parseInt(days)
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('កំហុស: ' + data.message);
                        }
                    });
            }
        }

        // Delete borrowing
        function deleteBorrowing(borrowingId) {
            if (confirm('តើអ្នកពិតជាចង់លុបការខ្ចីនេះមែនទេ?')) {
                fetch(`/borrowings/${borrowingId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('កំហុស: ' + data.message);
                        }
                    });
            }
        }

        // Refresh data
        function refreshData() {
            location.reload();
        }

        // Export functions
        function exportToPDF() {
            window.open('/borrowings/export/pdf?' + new URLSearchParams(window.location.search), '_blank');
        }

        function exportToExcel() {
            window.open('/borrowings/export/excel?' + new URLSearchParams(window.location.search), '_blank');
        }

        function printTable() {
            window.print();
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Convert numbers to Khmer
            document.querySelectorAll('.khmer-number').forEach(element => {
                const originalText = element.textContent;
                element.textContent = toKhmerNumbers(originalText);
            });

            // Update time immediately and then every second
            updateDateTime();
            setInterval(updateDateTime, 1000);

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Add loading states to forms
            const filterForm = document.querySelector('.filter-form');
            if (filterForm) {
                filterForm.addEventListener('submit', function() {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    submitBtn.innerHTML = '<i class="spinner-border spinner-border-sm me-1"></i>កំពុងស្វែងរក...';
                    submitBtn.disabled = true;
                });
            }

            // Animate cards on scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationDelay = `${Math.random() * 0.3}s`;
                        entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                    }
                });
            });

            document.querySelectorAll('.stat-mini-card').forEach(card => {
                observer.observe(card);
            });

            // Enhanced table row interactions
            document.querySelectorAll('.table-row-hover').forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.boxShadow = '0 4px 15px rgba(168, 237, 234, 0.15)';
                });

                row.addEventListener('mouseleave', function() {
                    this.style.boxShadow = '';
                });
            });

            // Auto-refresh every 5 minutes
            setInterval(function() {
                // Update counters without full page reload
                fetch('/api/borrowings/stats')
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('active-borrowings').textContent = toKhmerNumbers(data.active_borrowings);
                        document.getElementById('overdue-count').textContent = toKhmerNumbers(data.overdue_borrowings);
                    });
            }, 300000); // 5 minutes
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl+R to refresh
            if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
                e.preventDefault();
                refreshData();
            }

            // F5 to refresh
            if (e.key === 'F5') {
                e.preventDefault();
                refreshData();
            }

            // N to create new borrowing
            if (e.key === 'n' && !e.ctrlKey && !e.metaKey) {
                if (!document.querySelector('input:focus, textarea:focus, select:focus')) {
                    window.location.href = "{{ route('borrowings.create') }}";
                }
            }
        });
    </script>
</x-app-layout>
