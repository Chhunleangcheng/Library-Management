<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h3 mb-1 text-gray-800 d-flex align-items-center khmer-bold">
                    <div class="page-icon-wrapper me-3">
                        <i class="bi bi-eye text-info"></i>
                    </div>
                    <span class="gradient-text">ព័ត៌មានលម្អិតការខ្ចី</span>
                </h2>
                <p class="text-muted mb-0 khmer-regular">
                    <i class="bi bi-info-circle me-1"></i>
                    ព័ត៌មានពេញលេញអំពីការខ្ចីនេះ
                </p>
            </div>
            <div class="header-actions">
                <div class="current-time-display me-3">
                    <small class="text-muted khmer-regular">ពេលវេលាបច្ចុប្បន្ន (UTC)</small>
                    <div class="fw-bold text-primary khmer-medium" id="header-time">២០២៥-០៦-២០ ០៥:៥៨:៤៦</div>
                </div>
                @if(!$borrowing->returned_at)
                    <button class="btn btn-success modern-btn me-2 khmer-medium" onclick="returnBook({{ $borrowing->id }})">
                        <i class="bi bi-check-circle me-2"></i>បានត្រឡប់
                    </button>
                @endif
                <a href="{{ route('borrowings.edit', $borrowing) }}" class="btn btn-warning modern-btn me-2 khmer-medium">
                    <i class="bi bi-pencil me-2"></i>កែប្រែ
                </a>
                <a href="{{ route('borrowings.index') }}" class="btn btn-outline-secondary modern-btn khmer-medium">
                    <i class="bi bi-arrow-left me-2"></i>ត្រឡប់ក្រោយ
                </a>
            </div>
        </div>
    </x-slot>

    <!-- Current User & Status Bar -->
    <div class="status-bar mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="status-item">
                    <i class="bi bi-person-circle text-success"></i>
                    <div class="status-content">
                        <div class="status-label khmer-regular">អ្នកប្រើបច្ចុប្បន្ន</div>
                        <div class="status-value khmer-medium">Chhunleangcheng</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="status-item">
                    <i class="bi bi-calendar-event text-primary"></i>
                    <div class="status-content">
                        <div class="status-label khmer-regular">កាលបរិច្ឆេទបច្ចុប្បន្ន</div>
                        <div class="status-value khmer-medium" id="current-date">២០២៥-០៦-២០</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="status-item">
                    <i class="bi bi-shield-check {{ $borrowing->returned_at ? 'text-success' : ($borrowing->isOverdue() ? 'text-danger' : 'text-warning') }}"></i>
                    <div class="status-content">
                        <div class="status-label khmer-regular">ស្ថានភាពការខ្ចី</div>
                        <div class="status-value khmer-medium">
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

    <div class="row g-4">
        <!-- Main Borrowing Information -->
        <div class="col-lg-8">
            <!-- Borrowing Details Card -->
            <div class="card modern-card mb-4">
                <div class="card-header bg-gradient-info text-white">
                    <div class="d-flex align-items-center">
                        <div class="borrowing-icon me-3">
                            <i class="bi bi-arrow-left-right"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 khmer-semibold">ព័ត៌មានការខ្ចី #{{ $borrowing->id }}</h6>
                            <small class="opacity-75 khmer-regular">ព័ត៌មានលម្អិតអំពីការខ្ចីនេះ</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <!-- Member Information -->
                        <div class="col-md-6">
                            <div class="info-section">
                                <h6 class="section-title khmer-semibold">
                                    <i class="bi bi-person text-success me-2"></i>ព័ត៌មានសមាជិក
                                </h6>
                                <div class="member-card">
                                    <div class="member-avatar-large">
                                        {{ strtoupper(substr($borrowing->member->name, 0, 2)) }}
                                    </div>
                                    <div class="member-details">
                                        <h6 class="member-name khmer-semibold">{{ $borrowing->member->name }}</h6>
                                        <div class="member-email">{{ $borrowing->member->email }}</div>
                                        @if($borrowing->member->phone)
                                            <div class="member-phone">{{ $borrowing->member->phone }}</div>
                                        @endif
                                        <div class="member-status">
                                            <span class="badge bg-{{ $borrowing->member->membership_status == 'active' ? 'success' : 'secondary' }} khmer-regular">
                                                {{ $borrowing->member->membership_status == 'active' ? 'សកម្ម' : 'អសកម្ម' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="member-stats mt-3">
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <div class="stat-item-small">
                                                <div class="stat-number khmer-number">{{ $borrowing->member->activeBorrowings()->count() }}</div>
                                                <div class="stat-label khmer-regular">កំពុងខ្ចី</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="stat-item-small">
                                                <div class="stat-number khmer-number">{{ $borrowing->member->borrowings()->count() }}</div>
                                                <div class="stat-label khmer-regular">សរុប</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Book Information -->
                        <div class="col-md-6">
                            <div class="info-section">
                                <h6 class="section-title khmer-semibold">
                                    <i class="bi bi-book text-primary me-2"></i>ព័ត៌មានសៀវភៅ
                                </h6>
                                <div class="book-card">
                                    <div class="book-cover-large">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div class="book-details">
                                        <h6 class="book-title khmer-semibold">{{ $borrowing->book->title }}</h6>
                                        <div class="book-author khmer-regular">{{ $borrowing->book->author }}</div>
                                        <div class="book-genre">
                                            <span class="badge bg-light text-dark khmer-regular">{{ $borrowing->book->genre }}</span>
                                        </div>
                                        <div class="book-isbn">ISBN: {{ $borrowing->book->isbn }}</div>
                                    </div>
                                </div>
                                <div class="book-availability mt-3">
                                    <div class="availability-info">
                                        <div class="availability-bar">
                                            <div class="availability-progress"
                                                 style="width: {{ $borrowing->book->total_copies > 0 ? ($borrowing->book->available_copies / $borrowing->book->total_copies) * 100 : 0 }}%">
                                            </div>
                                        </div>
                                        <div class="availability-text khmer-regular">
                                            មាន <span class="khmer-number">{{ $borrowing->book->available_copies }}</span> /
                                            <span class="khmer-number">{{ $borrowing->book->total_copies }}</span> ក្បាល
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Borrowing Timeline Card -->
            <div class="card modern-card">
                <div class="card-header bg-white border-bottom-0">
                    <div class="d-flex align-items-center">
                        <div class="timeline-icon me-3">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 khmer-semibold">កាលវិភាគការខ្ចី</h6>
                            <small class="text-muted khmer-regular">ដំណើរការនៃការខ្ចីនេះ</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <!-- Borrowed -->
                        <div class="timeline-item completed">
                            <div class="timeline-marker">
                                <i class="bi bi-plus-circle"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-title khmer-semibold">បានខ្ចី</div>
                                <div class="timeline-date khmer-regular">{{ $borrowing->borrowed_at->format('d/m/Y H:i') }}</div>
                                <div class="timeline-description khmer-regular">ការខ្ចីត្រូវបានបង្កើតដោយជោគជ័យ</div>
                            </div>
                        </div>

                        <!-- Due Date -->
                        <div class="timeline-item {{ $borrowing->isOverdue() && !$borrowing->returned_at ? 'overdue' : ($borrowing->returned_at ? 'completed' : 'pending') }}">
                            <div class="timeline-marker">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-title khmer-semibold">
                                    ថ្ងៃត្រូវត្រឡប់
                                    @if($borrowing->isOverdue() && !$borrowing->returned_at)
                                        <span class="badge bg-danger ms-2 khmer-regular">ហួសកំណត់</span>
                                    @endif
                                </div>
                                <div class="timeline-date khmer-regular">{{ $borrowing->due_date->format('d/m/Y') }}</div>
                                <div class="timeline-description khmer-regular">
                                    @if($borrowing->returned_at)
                                        បានត្រឡប់ទាន់ពេលវេលា
                                    @elseif($borrowing->isOverdue())
                                        ហួសកំណត់ <span class="khmer-number">{{ $borrowing->days_overdue }}</span> ថ្ងៃ
                                    @else
                                        នៅសល់ <span class="khmer-number">{{ $borrowing->due_date->diffInDays(now()) }}</span> ថ្ងៃ
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Returned -->
                        @if($borrowing->returned_at)
                            <div class="timeline-item completed">
                                <div class="timeline-marker">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title khmer-semibold">បានត្រឡប់</div>
                                    <div class="timeline-date khmer-regular">{{ $borrowing->returned_at->format('d/m/Y H:i') }}</div>
                                    <div class="timeline-description khmer-regular">
                                        សៀវភៅត្រូវបានត្រឡប់ដោយជោគជ័យ
                                        @if($borrowing->returned_at->gt($borrowing->due_date))
                                            <span class="text-warning">(ត្រឡប់យឺត {{ $borrowing->returned_at->diffInDays($borrowing->due_date) }} ថ្ងៃ)</span>
                                        @else
                                            <span class="text-success">(ត្រឡប់ទាន់ពេលវេលា)</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="timeline-item pending">
                                <div class="timeline-marker">
                                    <i class="bi bi-hourglass-split"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title khmer-semibold">រង់ចាំការត្រឡប់</div>
                                    <div class="timeline-description khmer-regular">សៀវភៅនៅតែកំពុងខ្ចី</div>
                                </div>
                            </div>
                        @endif

                        <!-- Fine -->
                        @if($borrowing->fine_amount && $borrowing->fine_amount > 0)
                            <div class="timeline-item {{ $borrowing->fine_paid ? 'completed' : 'warning' }}">
                                <div class="timeline-marker">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title khmer-semibold">ការពិន័យ</div>
                                    <div class="timeline-amount">${{ number_format($borrowing->fine_amount, 2) }}</div>
                                    <div class="timeline-description khmer-regular">
                                        @if($borrowing->fine_paid)
                                            <span class="text-success">បានបង់រួច</span>
                                        @else
                                            <span class="text-danger">មិនទាន់បង់</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card modern-card mb-4">
                <div class="card-header bg-gradient-warning text-dark">
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
                        @if(!$borrowing->returned_at)
                            <button class="quick-action-item success" onclick="returnBook({{ $borrowing->id }})">
                                <div class="action-icon-small">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                                <div class="action-content">
                                    <div class="action-title khmer-semibold">បានត្រឡប់សៀវភៅ</div>
                                    <div class="action-subtitle khmer-regular">បញ្ជាក់ការត្រឡប់</div>
                                </div>
                            </button>

                            @if($borrowing->isOverdue())
                                <button class="quick-action-item warning" onclick="calculateFine({{ $borrowing->id }})">
                                    <div class="action-icon-small">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="action-content">
                                        <div class="action-title khmer-semibold">គណនាការពិន័យ</div>
                                        <div class="action-subtitle khmer-regular">ចំនួន ${{ number_format($borrowing->days_overdue * 1.00, 2) }}</div>
                                    </div>
                                </button>
                            @endif

                            <button class="quick-action-item info" onclick="extendDueDate({{ $borrowing->id }})">
                                <div class="action-icon-small">
                                    <i class="bi bi-calendar-plus"></i>
                                </div>
                                <div class="action-content">
                                    <div class="action-title khmer-semibold">បន្ថែមកាលបរិច្ឆេទ</div>
                                    <div class="action-subtitle khmer-regular">ពន្យាពេលត្រឡប់</div>
                                </div>
                            </button>
                        @endif

                        <a href="{{ route('borrowings.edit', $borrowing) }}" class="quick-action-item primary">
                            <div class="action-icon-small">
                                <i class="bi bi-pencil"></i>
                            </div>
                            <div class="action-content">
                                <div class="action-title khmer-semibold">កែប្រែព័ត៌មាន</div>
                                <div class="action-subtitle khmer-regular">កែប្រែការខ្ចីនេះ</div>
                            </div>
                        </a>

                        <a href="{{ route('borrowings.index') }}" class="quick-action-item secondary">
                            <div class="action-icon-small">
                                <i class="bi bi-list"></i>
                            </div>
                            <div class="action-content">
                                <div class="action-title khmer-semibold">បញ្ជីការខ្ចី</div>
                                <div class="action-subtitle khmer-regular">ត្រឡប់ទៅបញ្ជី</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Borrowing Details -->
            <div class="card modern-card mb-4">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex align-items-center">
                        <div class="details-icon me-3">
                            <i class="bi bi-info-circle"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 khmer-semibold">ព័ត៌មានលម្អិត</h6>
                            <small class="opacity-75 khmer-regular">សេចក្តីលម្អិតការខ្ចី</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="details-list">
                        <div class="detail-item">
                            <div class="detail-label khmer-regular">
                                <i class="bi bi-hash me-2"></i>លេខសម្គាល់
                            </div>
                            <div class="detail-value khmer-number">{{ $borrowing->id }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label khmer-regular">
                                <i class="bi bi-calendar-plus me-2"></i>ថ្ងៃខ្ចី
                            </div>
                            <div class="detail-value khmer-regular">{{ $borrowing->borrowed_at->format('d/m/Y H:i') }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label khmer-regular">
                                <i class="bi bi-calendar-check me-2"></i>ថ្ងៃត្រូវត្រឡប់
                            </div>
                            <div class="detail-value khmer-regular">{{ $borrowing->due_date->format('d/m/Y') }}</div>
                        </div>

                        @if($borrowing->returned_at)
                            <div class="detail-item">
                                <div class="detail-label khmer-regular">
                                    <i class="bi bi-calendar-x me-2"></i>ថ្ងៃត្រឡប់
                                </div>
                                <div class="detail-value khmer-regular">{{ $borrowing->returned_at->format('d/m/Y H:i') }}</div>
                            </div>
                        @endif

                        <div class="detail-item">
                            <div class="detail-label khmer-regular">
                                <i class="bi bi-clock me-2"></i>រយៈពេលខ្ចី
                            </div>
                            <div class="detail-value khmer-regular khmer-number">{{ $borrowing->borrowed_at->diffInDays($borrowing->due_date) }} ថ្ងៃ</div>
                        </div>

                        @if($borrowing->fine_amount && $borrowing->fine_amount > 0)
                            <div class="detail-item">
                                <div class="detail-label khmer-regular">
                                    <i class="bi bi-currency-dollar me-2"></i>ការពិន័យ
                                </div>
                                <div class="detail-value">
                                    ${{ number_format($borrowing->fine_amount, 2) }}
                                    @if($borrowing->fine_paid)
                                        <span class="badge bg-success ms-1 khmer-regular">បានបង់</span>
                                    @else
                                        <span class="badge bg-danger ms-1 khmer-regular">មិនទាន់បង់</span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="detail-item">
                            <div class="detail-label khmer-regular">
                                <i class="bi bi-calendar-event me-2"></i>បានបង្កើតនៅ
                            </div>
                            <div class="detail-value khmer-regular">{{ $borrowing->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Information -->
            <div class="card modern-card">
                <div class="card-header bg-gradient-secondary text-white">
                    <div class="d-flex align-items-center">
                        <div class="system-icon me-3">
                            <i class="bi bi-gear"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 khmer-semibold">ព័ត៌មានប្រព័ន្ធ</h6>
                            <small class="opacity-75 khmer-regular">ព័ត៌មានបច្ចេកទេស</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="system-info">
                        <div class="info-item">
                            <div class="info-label khmer-regular">
                                <i class="bi bi-person-circle me-2"></i>អ្នកប្រើបច្ចុប្បន្ន
                            </div>
                            <div class="info-value">
                                <span class="user-badge khmer-medium">Chhunleangcheng</span>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-label khmer-regular">
                                <i class="bi bi-clock me-2"></i>ពេលវេលាបច្ចុប្បន្ន
                            </div>
                            <div class="info-value">
                                <span class="time-display khmer-medium" id="current-time">២០២៥-០៦-២០ ០៥:៥៨:៤៦</span>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-label khmer-regular">
                                <i class="bi bi-database me-2"></i>មូលដ្ឋានទិន្នន័យ
                            </div>
                            <div class="info-value">
                                <span class="status-indicator online"></span>
                                <span class="khmer-regular">ភ្ជាប់</span>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-label khmer-regular">
                                <i class="bi bi-shield-check me-2"></i>សុវត្ថិភាព
                            </div>
                            <div class="info-value">
                                <span class="status-indicator online"></span>
                                <span class="khmer-regular">សុវត្ថិភាព</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Continue with modals and enhanced styles... -->

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
                    <div class="return-confirmation">
                        <div class="confirmation-item">
                            <strong class="khmer-medium">សមាជិក:</strong> {{ $borrowing->member->name }}<br>
                            <strong class="khmer-medium">សៀវភៅ:</strong> {{ $borrowing->book->title }}<br>
                            <strong class="khmer-medium">ថ្ងៃខ្ចី:</strong> {{ $borrowing->borrowed_at->format('d/m/Y') }}<br>
                            <strong class="khmer-medium">ថ្ងៃត្រូវត្រឡប់:</strong> {{ $borrowing->due_date->format('d/m/Y') }}
                        </div>
                    </div>

                    @if($borrowing->isOverdue())
                        <div class="alert alert-warning khmer-regular mt-3">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>ការព្រមាន:</strong> សៀវភៅនេះហួសកំណត់ {{ $borrowing->days_overdue }} ថ្ងៃ។
                            អាចនឹងមានការពិន័យ ${{ number_format($borrowing->days_overdue * 1.00, 2) }}។
                        </div>
                    @endif

                    <div class="alert alert-info khmer-regular mt-3">
                        <i class="bi bi-info-circle me-2"></i>
                        តើអ្នកពិតជាចង់បញ្ជាក់ការត្រឡប់សៀវភៅនេះមែនទេ?
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary khmer-regular" data-bs-dismiss="modal">បោះបង់</button>
                    <button type="button" class="btn btn-success khmer-medium" onclick="confirmReturn()">បញ្ជាក់ការត្រឡប់</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Styles -->
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

        /* Info sections */
        .info-section {
            padding: 1.5rem;
            background: #f8f9fa;
            border-radius: 12px;
            margin-bottom: 1rem;
        }

        .section-title {
            margin-bottom: 1rem;
            color: #2d3436;
        }

        /* Member card */
        .member-card {
            display: flex;
            align-items: center;
            background: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .member-avatar-large {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #5ee7df 0%, #66a6ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            font-weight: 600;
            margin-right: 1rem;
        }

        .member-name {
            margin-bottom: 0.25rem;
        }

        .member-email, .member-phone {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }

        /* Book card */
        .book-card {
            display: flex;
            align-items: center;
            background: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .book-cover-large {
            width: 50px;
            height: 65px;
            border-radius: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            margin-right: 1rem;
        }

        .book-title {
            margin-bottom: 0.25rem;
        }

        .book-author, .book-isbn {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }

        /* Availability bar */
        .availability-info {
            margin-top: 0.5rem;
        }

        .availability-bar {
            width: 100%;
            height: 8px;
            background: #e9ecef;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }

        .availability-progress {
            height: 100%;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            transition: width 0.3s ease;
        }

        .availability-text {
            font-size: 0.85rem;
            text-align: center;
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 2rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 1rem;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e9ecef;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 2rem;
        }

        .timeline-marker {
            position: absolute;
            left: -2.5rem;
            top: 0;
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            color: white;
            z-index: 1;
        }

        .timeline-item.completed .timeline-marker {
            background: #28a745;
        }

        .timeline-item.pending .timeline-marker {
            background: #ffc107;
        }

        .timeline-item.overdue .timeline-marker {
            background: #dc3545;
        }

        .timeline-item.warning .timeline-marker {
            background: #fd7e14;
        }

        .timeline-content {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .timeline-title {
            margin-bottom: 0.5rem;
            color: #2d3436;
        }

        .timeline-date {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .timeline-description {
            font-size: 0.9rem;
            color: #495057;
        }

        .timeline-amount {
            font-size: 1.1rem;
            font-weight: 600;
            color: #dc3545;
            font-family: monospace;
        }

        /* Quick actions */
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

        .quick-action-item.success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
        }

        .quick-action-item.warning {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            color: #8b4513;
        }

        .quick-action-item.info {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #6b46c1;
        }

        .quick-action-item.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .quick-action-item.secondary {
            background: linear-gradient(135deg, #e2e3e5 0%, #d6d8db 100%);
            color: #383d41;
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

        /* Details list */
        .details-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .detail-label {
            font-size: 0.9rem;
            color: #6c757d;
            display: flex;
            align-items: center;
        }

        .detail-value {
            font-weight: 500;
            color: #2d3436;
            text-align: right;
        }

        /* System info */
        .system-info {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .info-label {
            font-size: 0.85rem;
            color: #6c757d;
            display: flex;
            align-items: center;
        }

        .info-value {
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .user-badge {
            background: #007bff;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.75rem;
        }

        .time-display {
            font-family: monospace;
            color: #007bff;
            font-weight: 600;
        }

        .status-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .status-indicator.online {
            background: #28a745;
        }

        /* Small stats */
        .stat-item-small {
            text-align: center;
            padding: 0.5rem;
            background: rgba(255,255,255,0.5);
            border-radius: 6px;
        }

        .stat-number {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d3436;
        }

        .stat-label {
            font-size: 0.8rem;
            color: #6c757d;
        }

        /* Icons */
        .borrowing-icon, .timeline-icon, .action-icon, .details-icon, .system-icon {
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
            .status-bar .row {
                gap: 0.5rem;
            }

            .status-item {
                padding: 0.75rem;
                margin-bottom: 0.5rem;
            }

            .member-card, .book-card {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .member-avatar-large, .book-cover-large {
                margin-right: 0;
                margin-bottom: 0.5rem;
            }

            .timeline {
                padding-left: 1.5rem;
            }

            .timeline-marker {
                left: -2rem;
                width: 1.5rem;
                height: 1.5rem;
                font-size: 0.8rem;
            }

            .detail-item, .info-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .detail-value, .info-value {
                text-align: left;
            }

            .action-title, .action-subtitle {
                font-size: 0.85rem;
            }

            .current-time-display {
                text-align: center;
                margin-bottom: 1rem;
            }
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

        .return-confirmation {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .confirmation-item {
            line-height: 1.6;
        }
    </style>

    <!-- Enhanced JavaScript for Borrowings Show -->
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

            // Update current date
            const dateElement = document.getElementById('current-date');
            if (dateElement) {
                const dateString = `${year}-${month}-${day}`;
                dateElement.textContent = toKhmerNumbers(dateString);
            }
        }

        // Return book function
        function returnBook(borrowingId) {
            const modal = new bootstrap.Modal(document.getElementById('returnModal'));
            modal.show();
        }

        // Confirm return
        function confirmReturn() {
            const btn = document.querySelector('#returnModal .btn-success');
            const originalText = btn.innerHTML;

            btn.innerHTML = '<i class="spinner-border spinner-border-sm me-2"></i>កំពុងដំណើរការ...';
            btn.disabled = true;

            fetch(`/borrowings/{{ $borrowing->id }}/return`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message and reload
                        const alert = document.createElement('div');
                        alert.className = 'alert alert-success alert-dismissible fade show position-fixed';
                        alert.style.top = '20px';
                        alert.style.right = '20px';
                        alert.style.zIndex = '9999';
                        alert.innerHTML = `
                        <i class="bi bi-check-circle me-2"></i>
                        <span class="khmer-regular">${data.message}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                        document.body.appendChild(alert);

                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        alert('កំហុស: ' + data.message);
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    }
                })
                .catch(error => {
                    alert('កំហុសក្នុងការត្រឡប់សៀវភៅ');
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                });
        }

        // Calculate fine function
        function calculateFine(borrowingId) {
            @if($borrowing->isOverdue())
            const suggestedFine = {{ $borrowing->days_overdue * 1.00 }};
            const confirmed = confirm(`គណនាការពិន័យសម្រាប់ការហួសកំណត់ {{ $borrowing->days_overdue }} ថ្ងៃ។\n\nចំនួនការពិន័យ: $${suggestedFine.toFixed(2)}\n\nតើអ្នកចង់បន្ថែមការពិន័យនេះមែនទេ?`);

            if (confirmed) {
                fetch(`/borrowings/${borrowingId}/fine`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        fine_amount: suggestedFine,
                        fine_paid: false
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
            @endif
        }

        // Extend due date
        function extendDueDate(borrowingId) {
            const days = prompt('បន្ថែមចំនួនថ្ងៃ (១-៣០):', '7');
            if (days && !isNaN(days) && parseInt(days) > 0 && parseInt(days) <= 30) {
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
            } else if (days !== null) {
                alert('សូមបញ្ចូលចំនួនថ្ងៃពី ១ ដល់ ៣០');
            }
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Convert numbers to Khmer
            document.querySelectorAll('.khmer-number').forEach(element => {
                const originalText = element.textContent;
                element.textContent = toKhmerNumbers(originalText);
            });

            // Update time immediately and then every second
            updateCurrentTime();
            setInterval(updateCurrentTime, 1000);

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
            document.querySelectorAll('.detail-item, .info-item').forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.background = '#e3f2fd';
                    this.style.transform = 'translateX(5px)';
                });
                item.addEventListener('mouseleave', function() {
                    this.style.background = '#f8f9fa';
                    this.style.transform = 'translateX(0)';
                });
            });

            // Timeline item interactions
            document.querySelectorAll('.timeline-item').forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.querySelector('.timeline-content').style.boxShadow = '0 4px 20px rgba(0,0,0,0.15)';
                });
                item.addEventListener('mouseleave', function() {
                    this.querySelector('.timeline-content').style.boxShadow = '0 2px 10px rgba(0,0,0,0.05)';
                });
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // R for return book
            if (e.key === 'r' && !e.ctrlKey && !e.metaKey) {
                if (!document.querySelector('input:focus, textarea:focus, select:focus')) {
                    @if(!$borrowing->returned_at)
                    returnBook({{ $borrowing->id }});
                    @endif
                }
            }

            // E for edit
            if (e.key === 'e' && !e.ctrlKey && !e.metaKey) {
                if (!document.querySelector('input:focus, textarea:focus, select:focus')) {
                    window.location.href = "{{ route('borrowings.edit', $borrowing) }}";
                }
            }

            // B for back to list
            if (e.key === 'b' && !e.ctrlKey && !e.metaKey) {
                if (!document.querySelector('input:focus, textarea:focus, select:focus')) {
                    window.location.href = "{{ route('borrowings.index') }}";
                }
            }
        });
    </script>
</x-app-layout>
