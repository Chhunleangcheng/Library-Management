<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h3 mb-1 text-gray-800 d-flex align-items-center khmer-bold">
                    <div class="page-icon-wrapper me-3">
                        <i class="bi bi-person text-success"></i>
                    </div>
                    <span class="gradient-text">ព័ត៌មានលម្អិតសមាជិក</span>
                </h2>
                <p class="text-muted mb-0 khmer-regular">
                    <i class="bi bi-info-circle me-1"></i>
                    ព័ត៌មានពេញលេញអំពីសមាជិកនេះ
                </p>
            </div>
            <div class="header-actions">
                <a href="{{ route('members.edit', $member) }}" class="btn btn-warning modern-btn me-2 khmer-medium">
                    <i class="bi bi-pencil me-2"></i>កែប្រែ
                </a>
                <a href="{{ route('members.index') }}" class="btn btn-outline-secondary modern-btn khmer-medium">
                    <i class="bi bi-arrow-left me-2"></i>ត្រឡប់ក្រោយ
                </a>
            </div>
        </div>
    </x-slot>

    <div class="row g-4">
        <!-- Main Member Information -->
        <div class="col-lg-8">
            <!-- Member Profile Card -->
            <div class="card modern-card mb-4">
                <div class="card-header bg-gradient-success text-white">
                    <div class="d-flex align-items-center">
                        <div class="member-icon me-3">
                            <i class="bi bi-person"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 khmer-semibold">{{ $member->name }}</h6>
                            <small class="opacity-75 khmer-regular">ព័ត៌មានលម្អិតអំពីសមាជិក</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <!-- Member Avatar & Basic Info -->
                        <div class="col-md-4">
                            <div class="member-profile-large">
                                <div class="member-avatar-large">
                                    {{ strtoupper(substr($member->name, 0, 2)) }}
                                </div>
                                <div class="member-status-large">
                                    @if($member->membership_status == 'active')
                                        <span class="status-badge-large success khmer-medium">
                                            <i class="bi bi-check-circle"></i> សកម្ម
                                        </span>
                                    @elseif($member->membership_status == 'inactive')
                                        <span class="status-badge-large secondary khmer-medium">
                                            <i class="bi bi-pause-circle"></i> អសកម្ម
                                        </span>
                                    @else
                                        <span class="status-badge-large danger khmer-medium">
                                            <i class="bi bi-x-circle"></i> ផ្អាក
                                        </span>
                                    @endif
                                </div>
                                <div class="member-id-large khmer-regular">
                                    <i class="bi bi-hash"></i> ID: <span class="khmer-number">{{ $member->id }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Member Details -->
                        <div class="col-md-8">
                            <div class="member-details-grid">
                                <div class="detail-row">
                                    <div class="detail-label khmer-medium">
                                        <i class="bi bi-person text-success me-2"></i>ឈ្មោះពេញ
                                    </div>
                                    <div class="detail-value khmer-semibold">{{ $member->name }}</div>
                                </div>

                                <div class="detail-row">
                                    <div class="detail-label khmer-medium">
                                        <i class="bi bi-envelope text-primary me-2"></i>អីមែល
                                    </div>
                                    <div class="detail-value khmer-regular">{{ $member->email }}</div>
                                </div>

                                @if($member->phone)
                                    <div class="detail-row">
                                        <div class="detail-label khmer-medium">
                                            <i class="bi bi-telephone text-info me-2"></i>ទូរសព្ទ
                                        </div>
                                        <div class="detail-value khmer-regular">{{ $member->phone }}</div>
                                    </div>
                                @endif

                                @if($member->date_of_birth)
                                    <div class="detail-row">
                                        <div class="detail-label khmer-medium">
                                            <i class="bi bi-calendar3 text-warning me-2"></i>ថ្ងៃកំណើត
                                        </div>
                                        <div class="detail-value khmer-regular">
                                            {{ \Carbon\Carbon::parse($member->date_of_birth)->format('d/m/Y') }}
                                            <small class="text-muted">
                                                (អាយុ {{ \Carbon\Carbon::parse($member->date_of_birth)->age }} ឆ្នាំ)
                                            </small>
                                        </div>
                                    </div>
                                @endif

                                <div class="detail-row">
                                    <div class="detail-label khmer-medium">
                                        <i class="bi bi-calendar-plus text-secondary me-2"></i>ថ្ងៃចុះឈ្មោះ
                                    </div>
                                    <div class="detail-value khmer-regular">
                                        {{ $member->membership_date->format('d/m/Y') }}
                                        <small class="text-muted">
                                            ({{ $member->membership_date->diffForHumans() }})
                                        </small>
                                    </div>
                                </div>

                                @if($member->address)
                                    <div class="detail-row">
                                        <div class="detail-label khmer-medium">
                                            <i class="bi bi-geo-alt text-danger me-2"></i>អាសយដ្ឋាន
                                        </div>
                                        <div class="detail-value khmer-regular">{{ $member->address }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
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
                                    ការខ្ចីទាំងអស់របស់សមាជិកនេះ
                                    (<span class="khmer-number">{{ $member->borrowings->count() }}</span> ដង)
                                </small>
                            </div>
                        </div>
                        @if($member->borrowings->count() > 0)
                            <div class="history-stats">
                                <small class="text-muted khmer-regular">
                                    សកម្ម: <span class="text-primary khmer-number">{{ $member->activeBorrowings->count() }}</span> |
                                    បានត្រឡប់: <span class="text-success khmer-number">{{ $member->borrowings->whereNotNull('returned_at')->count() }}</span>
                                </small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($member->borrowings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover modern-table mb-0">
                                <thead>
                                <tr>
                                    <th class="border-0 khmer-medium">សៀវភៅ</th>
                                    <th class="border-0 khmer-medium">ថ្ងៃខ្ចី</th>
                                    <th class="border-0 khmer-medium">ថ្ងៃត្រូវត្រឡប់</th>
                                    <th class="border-0 khmer-medium">ថ្ងៃត្រឡប់</th>
                                    <th class="border-0 khmer-medium">ស្ថានភាព</th>
                                    <th class="border-0 khmer-medium">ការពិន័យ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($member->borrowings->sortByDesc('borrowed_at') as $borrowing)
                                    <tr class="borrowing-row">
                                        <td class="border-0">
                                            <div class="book-info-mini">
                                                <div class="book-cover-small">
                                                    <i class="bi bi-book"></i>
                                                </div>
                                                <div class="book-details-small">
                                                    <div class="book-title-small khmer-medium">{{ Str::limit($borrowing->book->title, 30) }}</div>
                                                    <small class="text-muted khmer-regular">{{ $borrowing->book->author }}</small>
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
                                                        <i class="bi bi-exclamation-triangle"></i>
                                                        ហួសកំណត់ <span class="khmer-number">{{ $borrowing->days_overdue }}</span>ថ្ងៃ
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
                            <p class="empty-description khmer-regular">សមាជិកនេះមិនទាន់ធ្វើការខ្ចីសៀវភៅម្តងណាទេ</p>
                            <a href="{{ route('borrowings.create', ['member_id' => $member->id]) }}" class="btn btn-primary">
                                <i class="bi bi-plus me-1"></i>បង្កើតការខ្ចីថ្មី
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Member Statistics -->
            <div class="card modern-card mb-4">
                <div class="card-header bg-gradient-info text-white">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 khmer-semibold">ស្ថិតិសមាជិក</h6>
                            <small class="opacity-75 khmer-regular">ទិន្នន័យសំខាន់ៗ</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-value khmer-bold khmer-number">{{ $member->borrowings->count() }}</div>
                            <div class="stat-label khmer-regular">ដងនៃការខ្ចី</div>
                        </div>

                        <div class="stat-item">
                            <div class="stat-value khmer-bold khmer-number">{{ $member->activeBorrowings->count() }}</div>
                            <div class="stat-label khmer-regular">កំពុងខ្ចី</div>
                        </div>

                        <div class="stat-item">
                            <div class="stat-value khmer-bold khmer-number">{{ $member->borrowings->where('returned_at', '!=', null)->count() }}</div>
                            <div class="stat-label khmer-regular">បានត្រឡប់</div>
                        </div>

                        <div class="stat-item">
                            <div class="stat-value khmer-bold">
                                ${{ number_format($member->borrowings->whereNotNull('fine_amount')->sum('fine_amount'), 2) }}
                            </div>
                            <div class="stat-label khmer-regular">ការពិន័យសរុប</div>
                        </div>
                    </div>

                    @if($member->borrowings->count() > 0)
                        <div class="stats-additional mt-3">
                            <small class="text-muted khmer-regular">
                                ការខ្ចីចុងក្រោយ:
                                <span class="text-primary">{{ $member->borrowings->sortByDesc('borrowed_at')->first()->borrowed_at->diffForHumans() }}</span>
                            </small>
                        </div>
                    @endif
                </div>
            </div>

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
                        <a href="{{ route('borrowings.create', ['member_id' => $member->id]) }}"
                           class="quick-action-item primary">
                            <div class="action-icon-small">
                                <i class="bi bi-plus-circle"></i>
                            </div>
                            <div class="action-content">
                                <div class="action-title khmer-semibold">បង្កើតការខ្ចីថ្មី</div>
                                <div class="action-subtitle khmer-regular">ឲ្យសមាជិកនេះ</div>
                            </div>
                        </a>

                        <a href="{{ route('members.edit', $member) }}" class="quick-action-item warning">
                            <div class="action-icon-small">
                                <i class="bi bi-pencil"></i>
                            </div>
                            <div class="action-content">
                                <div class="action-title khmer-semibold">កែប្រែព័ត៌មាន</div>
                                <div class="action-subtitle khmer-regular">កែប្រែសមាជិកនេះ</div>
                            </div>
                        </a>

                        <a href="{{ route('members.export-history', $member) }}" class="quick-action-item info">
                            <div class="action-icon-small">
                                <i class="bi bi-download"></i>
                            </div>
                            <div class="action-content">
                                <div class="action-title khmer-semibold">ទាញយកប្រវត្តិ</div>
                                <div class="action-subtitle khmer-regular">ឯកសារ PDF</div>
                            </div>
                        </a>

                        <a href="{{ route('members.index') }}" class="quick-action-item info">
                            <div class="action-icon-small">
                                <i class="bi bi-list"></i>
                            </div>
                            <div class="action-content">
                                <div class="action-title khmer-semibold">បញ្ជីសមាជិក</div>
                                <div class="action-subtitle khmer-regular">ត្រឡប់ទៅបញ្ជី</div>
                            </div>
                        </a>

                        @if($member->activeBorrowings()->count() == 0)
                            <button onclick="confirmDelete()" class="quick-action-item danger">
                                <div class="action-icon-small">
                                    <i class="bi bi-trash"></i>
                                </div>
                                <div class="action-content">
                                    <div class="action-title khmer-semibold">លុបសមាជិក</div>
                                    <div class="action-subtitle khmer-regular">លុបចេញពីប្រព័ន្ធ</div>
                                </div>
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Current Status -->
            <div class="card modern-card">
                <div class="card-header bg-gradient-secondary text-white">
                    <div class="d-flex align-items-center">
                        <div class="status-icon me-3">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 khmer-semibold">ស្ថានភាពបច្ចុប្បន្ន</h6>
                            <small class="opacity-75 khmer-regular">ព័ត៌មានបច្ចុប្បន្ន</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="status-details">
                        <div class="status-item">
                            <div class="status-label khmer-regular">
                                <i class="bi bi-shield-check me-2"></i>ស្ថានភាពសមាជិក
                            </div>
                            <div class="status-value">
                                @if($member->membership_status == 'active')
                                    <span class="status-indicator online"></span>
                                    <span class="khmer-medium text-success">សកម្ម</span>
                                @elseif($member->membership_status == 'inactive')
                                    <span class="status-indicator offline"></span>
                                    <span class="khmer-medium text-secondary">អសកម្ម</span>
                                @else
                                    <span class="status-indicator suspended"></span>
                                    <span class="khmer-medium text-danger">ផ្អាក</span>
                                @endif
                            </div>
                        </div>

                        <div class="status-item">
                            <div class="status-label khmer-regular">
                                <i class="bi bi-calendar3 me-2"></i>អតិថិជនតាំងពី
                            </div>
                            <div class="status-value">
                                <span class="khmer-medium">{{ $member->membership_date->diffForHumans() }}</span>
                            </div>
                        </div>

                        <div class="status-item">
                            <div class="status-label khmer-regular">
                                <i class="bi bi-clock me-2"></i>ម៉ោងបច្ចុប្បន្ន (UTC)
                            </div>
                            <div class="status-value">
                                <span class="time-display khmer-medium" id="current-time">២០២៥-០៦-២០ ០៥:៣៧:៣៤</span>
                            </div>
                        </div>

                        <div class="status-item">
                            <div class="status-label khmer-regular">
                                <i class="bi bi-person-circle me-2"></i>កំពុងមើលដោយ
                            </div>
                            <div class="status-value">
                                <span class="user-badge khmer-medium">Chhunleangcheng</span>
                            </div>
                        </div>
                    </div>
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
                    <p class="khmer-regular">តើអ្នកពិតជាចង់លុបសមាជិក <strong>"{{ $member->name }}"</strong> មែនទេ?</p>
                    <p class="text-warning khmer-regular">
                        <i class="bi bi-warning me-1"></i>
                        សកម្មភាពនេះមិនអាចធ្វើត្រឡប់វិញបានទេ។
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary khmer-regular" data-bs-dismiss="modal">បោះបង់</button>
                    <form action="{{ route('members.destroy', $member) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger khmer-medium">លុបចេញ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Styles for Member Show Page -->
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

        /* Member profile large */
        .member-profile-large {
            text-align: center;
            padding: 2rem;
            background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .member-avatar-large {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #5ee7df 0%, #66a6ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            font-weight: 600;
            margin: 0 auto 1.5rem;
            box-shadow: 0 8px 25px rgba(94, 231, 223, 0.3);
        }

        .status-badge-large {
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .status-badge-large.success {
            background: #d4edda;
            color: #155724;
        }

        .status-badge-large.secondary {
            background: #e2e3e5;
            color: #383d41;
        }

        .status-badge-large.danger {
            background: #f8d7da;
            color: #721c24;
        }

        .member-id-large {
            font-size: 1.1rem;
            color: #6c757d;
            font-weight: 500;
        }

        /* Member details grid */
        .member-details-grid {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .detail-row {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .detail-row:hover {
            background: #e3f2fd;
            transform: translateX(5px);
        }

        .detail-label {
            min-width: 150px;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .detail-value {
            flex: 1;
            font-size: 1rem;
            color: #2d3436;
        }

        /* Book info mini */
        .book-info-mini {
            display: flex;
            align-items: center;
        }

        .book-cover-small {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .book-title-small {
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        /* History table enhancements */
        .history-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, #5ee7df 0%, #66a6ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
        }

        .borrowing-row {
            transition: all 0.2s ease;
        }

        .borrowing-row:hover {
            background: rgba(94, 231, 223, 0.05);
            transform: scale(1.005);
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
            margin-bottom: 1.5rem;
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
            background: linear-gradient(135deg, #5ee7df 0%, #66a6ff 100%);
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

        /* Status details */
        .status-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .status-details {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .status-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .status-label {
            font-size: 0.85rem;
            color: #495057;
            flex: 1;
        }

        .status-value {
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .status-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .status-indicator.online {
            background: #28a745;
        }

        .status-indicator.offline {
            background: #6c757d;
        }

        .status-indicator.suspended {
            background: #dc3545;
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

        /* Member icon */
        .member-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .action-icon {
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
            .member-avatar-large {
                width: 80px;
                height: 80px;
                font-size: 2rem;
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

            .status-item {
                flex-direction: column;
                align-items: flex-start;
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

    <!-- Enhanced JavaScript for Member Show -->
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

            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                timeElement.textContent = khmerTimeString;
            }
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
            document.querySelectorAll('.detail-row').forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.background = '#e3f2fd';
                });
                row.addEventListener('mouseleave', function() {
                    this.style.background = '#f8f9fa';
                });
            });

            // Stat item interactions
            document.querySelectorAll('.stat-item').forEach(item => {
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
                    this.style.backgroundColor = 'rgba(94, 231, 223, 0.05)';
                });
                row.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = '';
                });
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // E for edit
            if (e.key === 'e' && !e.ctrlKey && !e.metaKey) {
                if (!document.querySelector('input:focus, textarea:focus, select:focus')) {
                    window.location.href = "{{ route('members.edit', $member) }}";
                }
            }

            // B for back to list
            if (e.key === 'b' && !e.ctrlKey && !e.metaKey) {
                if (!document.querySelector('input:focus, textarea:focus, select:focus')) {
                    window.location.href = "{{ route('members.index') }}";
                }
            }

            // Delete key for delete (with confirmation)
            if (e.key === 'Delete' && !e.ctrlKey && !e.metaKey) {
                if (!document.querySelector('input:focus, textarea:focus, select:focus')) {
                    @if($member->activeBorrowings()->count() == 0)
                    confirmDelete();
                    @endif
                }
            }
        });
    </script>
</x-app-layout>
