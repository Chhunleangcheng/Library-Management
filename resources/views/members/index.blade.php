<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h3 mb-1 text-gray-800 d-flex align-items-center khmer-bold">
                    <div class="page-icon-wrapper me-3">
                        <i class="bi bi-people text-success"></i>
                    </div>
                    <span class="gradient-text">គ្រប់គ្រងសមាជិក</span>
                </h2>
                <p class="text-muted mb-0 khmer-regular">
                    <i class="bi bi-person-check me-1"></i>
                    គ្រប់គ្រងសមាជិកបណ្ណាល័យទាំងអស់
                </p>
            </div>
            <div class="header-actions">
                <a href="{{ route('members.create') }}" class="btn btn-success modern-btn khmer-medium">
                    <i class="bi bi-person-plus me-2"></i>បន្ថែមសមាជិកថ្មី
                </a>
            </div>
        </div>
    </x-slot>

    <!-- Enhanced Search and Filter Section -->
    <div class="card modern-card mb-4">
        <div class="card-header bg-gradient-success text-white">
            <div class="d-flex align-items-center">
                <div class="filter-icon me-3">
                    <i class="bi bi-funnel"></i>
                </div>
                <div>
                    <h6 class="card-title mb-0 khmer-semibold">ស្វែងរក និង ត្រងសមាជិក</h6>
                    <small class="opacity-75 khmer-regular">ស្វែងរកសមាជិកតាមបែបផែនណា</small>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('members.index') }}" class="filter-form">
                <div class="row g-3">
                    <!-- Search Input -->
                    <div class="col-md-4">
                        <label class="form-label khmer-medium">
                            <i class="bi bi-search me-1"></i>ស្វែងរកសមាជិក
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control khmer-regular"
                                   placeholder="ស្វែងរកតាមឈ្មោះ, អីមែល, ទូរសព្ទ..."
                                   value="{{ request('search') }}">
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="col-md-3">
                        <label class="form-label khmer-medium">
                            <i class="bi bi-shield-check me-1"></i>ស្ថានភាពសមាជិក
                        </label>
                        <select name="status" class="form-select khmer-regular">
                            <option value="">ស្ថានភាពទាំងអស់</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>សកម្ម</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>អសកម្ម</option>
                            <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>ផ្អាក</option>
                        </select>
                    </div>

                    <!-- Registration Period Filter -->
                    <div class="col-md-3">
                        <label class="form-label khmer-medium">
                            <i class="bi bi-calendar3 me-1"></i>រយៈពេលចុះឈ្មោះ
                        </label>
                        <select name="period" class="form-select khmer-regular">
                            <option value="">រយៈពេលទាំងអស់</option>
                            <option value="today" {{ request('period') == 'today' ? 'selected' : '' }}>ថ្ងៃនេះ</option>
                            <option value="week" {{ request('period') == 'week' ? 'selected' : '' }}>សប្តាហ៍នេះ</option>
                            <option value="month" {{ request('period') == 'month' ? 'selected' : '' }}>ខែនេះ</option>
                            <option value="year" {{ request('period') == 'year' ? 'selected' : '' }}>ឆ្នាំនេះ</option>
                        </select>
                    </div>

                    <!-- Filter Actions -->
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-outline-success khmer-medium">
                                <i class="bi bi-filter me-1"></i>ត្រង
                            </button>
                            <a href="{{ route('members.index') }}" class="btn btn-outline-secondary btn-sm khmer-regular">
                                <i class="bi bi-arrow-clockwise me-1"></i>កំណត់ឡើងវិញ
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Members Statistics Card -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-mini-card success">
                <div class="stat-mini-icon">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-mini-content">
                    <div class="stat-mini-number khmer-bold khmer-number">{{ $members->total() }}</div>
                    <div class="stat-mini-label khmer-regular">សមាជិកសរុប</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-mini-card primary">
                <div class="stat-mini-icon">
                    <i class="bi bi-person-check"></i>
                </div>
                <div class="stat-mini-content">
                    <div class="stat-mini-number khmer-bold khmer-number">{{ $members->where('membership_status', 'active')->count() }}</div>
                    <div class="stat-mini-label khmer-regular">សកម្ម</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-mini-card warning">
                <div class="stat-mini-icon">
                    <i class="bi bi-book"></i>
                </div>
                <div class="stat-mini-content">
                    @php
                        $activeBorrowers = \App\Models\Member::whereHas('borrowings', function($q) {
                            $q->whereNull('returned_at');
                        })->count();
                    @endphp
                    <div class="stat-mini-number khmer-bold khmer-number">{{ $activeBorrowers }}</div>
                    <div class="stat-mini-label khmer-regular">កំពុងខ្ចី</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-mini-card info">
                <div class="stat-mini-icon">
                    <i class="bi bi-calendar-plus"></i>
                </div>
                <div class="stat-mini-content">
                    @php
                        $newThisMonth = \App\Models\Member::whereMonth('membership_date', now()->month)
                                                         ->whereYear('membership_date', now()->year)
                                                         ->count();
                    @endphp
                    <div class="stat-mini-number khmer-bold khmer-number">{{ $newThisMonth }}</div>
                    <div class="stat-mini-label khmer-regular">ថ្មីខែនេះ</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Members Table Card -->
    <div class="card modern-card">
        <div class="card-header bg-white border-bottom-0">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="table-icon me-3">
                        <i class="bi bi-table"></i>
                    </div>
                    <div>
                        <h6 class="card-title mb-0 khmer-semibold">បញ្ជីសមាជិក</h6>
                        <small class="text-muted khmer-regular">
                            បង្ហាញលទ្ធផល <span class="khmer-number">{{ $members->firstItem() ?? 0 }}</span> -
                            <span class="khmer-number">{{ $members->lastItem() ?? 0 }}</span> នៃ
                            <span class="khmer-number">{{ $members->total() }}</span> សមាជិក
                        </small>
                    </div>
                </div>
                <div class="table-actions">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-secondary btn-sm active khmer-regular">
                            <i class="bi bi-table me-1"></i>តារាង
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm khmer-regular" onclick="toggleView('grid')">
                            <i class="bi bi-grid-3x3-gap me-1"></i>ក្រឡា
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            @if($members->count() > 0)
                <!-- Table View -->
                <div id="table-view" class="table-responsive">
                    <table class="table table-hover modern-table mb-0">
                        <thead>
                        <tr>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-person me-1"></i>ព័ត៌មានសមាជិក
                            </th>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-envelope me-1"></i>ទំនាក់ទំនង
                            </th>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-calendar3 me-1"></i>ថ្ងៃចុះឈ្មោះ
                            </th>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-book me-1"></i>ការខ្ចី
                            </th>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-shield-check me-1"></i>ស្ថានភាព
                            </th>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-gear me-1"></i>សកម្មភាព
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $member)
                            <tr class="table-row-hover">
                                <td class="border-0">
                                    <div class="member-info-cell">
                                        <div class="member-avatar">
                                            {{ strtoupper(substr($member->name, 0, 2)) }}
                                        </div>
                                        <div class="member-details">
                                            <div class="member-name khmer-semibold">{{ $member->name }}</div>
                                            <div class="member-id khmer-regular text-muted">
                                                <i class="bi bi-hash me-1"></i>ID: <span class="khmer-number">{{ $member->id }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-0">
                                    <div class="contact-cell">
                                        <div class="contact-email khmer-regular">
                                            <i class="bi bi-envelope text-primary me-1"></i>{{ $member->email }}
                                        </div>
                                        @if($member->phone)
                                            <div class="contact-phone khmer-regular text-muted">
                                                <i class="bi bi-telephone me-1"></i>{{ $member->phone }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="border-0">
                                    <div class="date-cell">
                                        <div class="date-main khmer-regular">{{ $member->membership_date->format('d/m/Y') }}</div>
                                        <div class="date-relative text-muted">{{ $member->membership_date->diffForHumans() }}</div>
                                    </div>
                                </td>
                                <td class="border-0">
                                    <div class="borrowing-stats">
                                        <div class="borrowing-active">
                                            <span class="badge bg-primary khmer-number">{{ $member->activeBorrowings()->count() }}</span>
                                            <small class="text-muted khmer-regular">សកម្ម</small>
                                        </div>
                                        <div class="borrowing-total mt-1">
                                            <span class="text-muted khmer-regular">សរុប: </span>
                                            <span class="khmer-number">{{ $member->borrowings()->count() }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-0">
                                    @if($member->membership_status == 'active')
                                        <span class="status-badge success khmer-regular">
                                                <i class="bi bi-check-circle"></i> សកម្ម
                                            </span>
                                    @elseif($member->membership_status == 'inactive')
                                        <span class="status-badge secondary khmer-regular">
                                                <i class="bi bi-pause-circle"></i> អសកម្ម
                                            </span>
                                    @else
                                        <span class="status-badge danger khmer-regular">
                                                <i class="bi bi-x-circle"></i> ផ្អាក
                                            </span>
                                    @endif
                                </td>
                                <td class="border-0">
                                    <div class="action-buttons">
                                        <a href="{{ route('members.show', $member) }}"
                                           class="btn btn-sm btn-outline-info"
                                           data-bs-toggle="tooltip" title="មើលលម្អិត">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('members.edit', $member) }}"
                                           class="btn btn-sm btn-outline-warning"
                                           data-bs-toggle="tooltip" title="កែប្រែ">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        @if($member->borrowings()->active()->count() == 0)
                                            <form action="{{ route('members.destroy', $member) }}" method="POST"
                                                  class="d-inline" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបសមាជិកនេះមែនទេ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        data-bs-toggle="tooltip" title="លុប">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-sm btn-outline-secondary" disabled
                                                    data-bs-toggle="tooltip" title="មិនអាចលុបបាន (មានការខ្ចី)">
                                                <i class="bi bi-lock"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Grid View (Hidden by default) -->
                <div id="grid-view" class="d-none">
                    <div class="row g-4 p-4">
                        @foreach($members as $member)
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="member-card">
                                    <div class="member-card-header">
                                        <div class="member-card-avatar">
                                            {{ strtoupper(substr($member->name, 0, 2)) }}
                                        </div>
                                        <div class="member-card-status">
                                            @if($member->membership_status == 'active')
                                                <span class="badge bg-success khmer-regular">សកម្ម</span>
                                            @elseif($member->membership_status == 'inactive')
                                                <span class="badge bg-secondary khmer-regular">អសកម្ម</span>
                                            @else
                                                <span class="badge bg-danger khmer-regular">ផ្អាក</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="member-card-body">
                                        <h6 class="member-card-name khmer-semibold">{{ Str::limit($member->name, 25) }}</h6>
                                        <p class="member-card-email khmer-regular">{{ $member->email }}</p>
                                        <div class="member-card-meta">
                                            <small class="text-muted khmer-regular">
                                                <i class="bi bi-calendar3 me-1"></i>{{ $member->membership_date->format('d/m/Y') }}
                                            </small>
                                        </div>
                                        <div class="member-card-stats">
                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <div class="stat-number khmer-number">{{ $member->activeBorrowings()->count() }}</div>
                                                    <div class="stat-label khmer-regular">កំពុងខ្ចី</div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="stat-number khmer-number">{{ $member->borrowings()->count() }}</div>
                                                    <div class="stat-label khmer-regular">សរុប</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="member-card-footer">
                                        <div class="btn-group w-100">
                                            <a href="{{ route('members.show', $member) }}" class="btn btn-outline-primary btn-sm khmer-regular">
                                                <i class="bi bi-eye me-1"></i>មើល
                                            </a>
                                            <a href="{{ route('members.edit', $member) }}" class="btn btn-outline-warning btn-sm khmer-regular">
                                                <i class="bi bi-pencil me-1"></i>កែ
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="empty-state-large">
                    <div class="empty-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <h4 class="empty-title khmer-semibold">មិនមានសមាជិក</h4>
                    <p class="empty-description khmer-regular">
                        @if(request()->hasAny(['search', 'status', 'period']))
                            មិនមានសមាជិកត្រូវនឹងការស្វែងរករបស់អ្នកទេ។ សាកល្បងស្វែងរកដោយលក្ខខណ្ឌផ្សេង។
                        @else
                            មិនទាន់មានសមាជិកនៅក្នុងបណ្ណាល័យនេះទេ។ ចាប់ផ្តើមដោយបន្ថែមសមាជិកដំបូង។
                        @endif
                    </p>
                    <div class="empty-actions">
                        @if(request()->hasAny(['search', 'status', 'period']))
                            <a href="{{ route('members.index') }}" class="btn btn-outline-primary khmer-medium">
                                <i class="bi bi-arrow-clockwise me-1"></i>មើលសមាជិកទាំងអស់
                            </a>
                        @endif
                        <a href="{{ route('members.create') }}" class="btn btn-success khmer-medium">
                            <i class="bi bi-plus me-1"></i>បន្ថែមសមាជិកថ្មី
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($members->hasPages())
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="pagination-info khmer-regular text-muted">
                        បង្ហាញ <span class="khmer-number">{{ $members->firstItem() }}</span> -
                        <span class="khmer-number">{{ $members->lastItem() }}</span> នៃ
                        <span class="khmer-number">{{ $members->total() }}</span> លទ្ធផល
                    </div>
                    <div class="pagination-links">
                        {{ $members->withQueryString()->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Enhanced Styles for Members Page -->
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

        .stat-mini-card.success {
            background: linear-gradient(135deg, #5ee7df 0%, #66a6ff 100%);
        }

        .stat-mini-card.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stat-mini-card.warning {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            color: #8b4513;
        }

        .stat-mini-card.info {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #6b46c1;
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
            background: linear-gradient(135deg, #5ee7df 0%, #66a6ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
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
            background: rgba(94, 231, 223, 0.05);
            transform: scale(1.005);
        }

        /* Member info cell */
        .member-info-cell {
            display: flex;
            align-items: center;
        }

        .member-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #5ee7df 0%, #66a6ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .member-name {
            font-size: 1rem;
            color: #2d3436;
            margin-bottom: 0.25rem;
            line-height: 1.4;
        }

        .member-id {
            font-size: 0.8rem;
        }

        /* Contact cell */
        .contact-cell {
            font-size: 0.9rem;
        }

        .contact-email {
            margin-bottom: 0.25rem;
        }

        .contact-phone {
            font-size: 0.8rem;
        }

        /* Date cell */
        .date-cell {
            text-align: center;
        }

        .date-main {
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .date-relative {
            font-size: 0.8rem;
        }

        /* Borrowing stats */
        .borrowing-stats {
            text-align: center;
        }

        .borrowing-active {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 0.25rem;
        }

        .borrowing-total {
            font-size: 0.8rem;
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

        .status-badge.secondary {
            background: #e2e3e5;
            color: #383d41;
        }

        .status-badge.danger {
            background: #f8d7da;
            color: #721c24;
        }

        /* Action buttons */
        .action-buttons {
            display: flex;
            gap: 0.3rem;
        }

        .action-buttons .btn {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
        }

        /* Member cards for grid view */
        .member-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            background: white;
        }

        .member-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .member-card-header {
            position: relative;
            background: linear-gradient(135deg, #5ee7df 0%, #66a6ff 100%);
            padding: 2rem;
            text-align: center;
        }

        .member-card-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 600;
            color: white;
            margin: 0 auto 1rem;
        }

        .member-card-status {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        .member-card-body {
            padding: 1.5rem;
        }

        .member-card-name {
            color: #2d3436;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .member-card-email {
            color: #6c757d;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .member-card-meta {
            margin-bottom: 1rem;
        }

        .member-card-stats .stat-number {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d3436;
        }

        .member-card-stats .stat-label {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .member-card-footer {
            padding: 1rem 1.5rem;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
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

        /* Responsive design */
        @media (max-width: 768px) {
            .member-info-cell {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .member-avatar {
                margin-right: 0;
                margin-bottom: 0.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .stat-mini-card {
                margin-bottom: 1rem;
            }

            .contact-cell {
                font-size: 0.8rem;
            }
        }

        /* Animations */
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

        // Toggle between table and grid view
        function toggleView(view) {
            const tableView = document.getElementById('table-view');
            const gridView = document.getElementById('grid-view');
            const buttons = document.querySelectorAll('.table-actions .btn');

            if (view === 'grid') {
                tableView.classList.add('d-none');
                gridView.classList.remove('d-none');
                buttons[0].classList.remove('active');
                buttons[1].classList.add('active');
            } else {
                tableView.classList.remove('d-none');
                gridView.classList.add('d-none');
                buttons[0].classList.add('active');
                buttons[1].classList.remove('active');
            }

            // Save preference to localStorage
            localStorage.setItem('membersViewPreference', view);
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Convert numbers to Khmer
            const numberElements = document.querySelectorAll('.khmer-number');
            numberElements.forEach(element => {
                const originalText = element.textContent;
                element.textContent = toKhmerNumbers(originalText);
            });

            // Load saved view preference
            const savedView = localStorage.getItem('membersViewPreference');
            if (savedView === 'grid') {
                toggleView('grid');
            }

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

            // Animate stat cards on scroll
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

            // Enhanced table interactions
            document.querySelectorAll('.table-row-hover').forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.boxShadow = '0 4px 15px rgba(94, 231, 223, 0.15)';
                });

                row.addEventListener('mouseleave', function() {
                    this.style.boxShadow = '';
                });
            });
        });
    </script>
</x-app-layout>
