<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h3 mb-1 text-gray-800 d-flex align-items-center">
                    <div class="dashboard-icon-wrapper me-3">
                        <i class="bi bi-speedometer2 text-primary"></i>
                    </div>
                    <span class="gradient-text">ផ្ទាំងគ្រប់គ្រង</span>
                </h2>
                <p class="text-muted mb-0 animated-welcome">
                    <i class="bi bi-hand-thumbs-up text-warning me-1"></i>
                    សូមស្វាគមន៍ <span class="text-primary fw-bold">{{ Auth::user()->name }}</span>!
                </p>
            </div>
            <div class="text-end time-display">
                <div class="date-time-card p-3 rounded shadow-sm bg-white">
                    <div class="text-muted small mb-1">
                        <i class="bi bi-calendar3 me-1 text-primary"></i>
                        {{ now()->locale('km')->translatedFormat('l, j F Y') }}
                    </div>
                    <div class="fw-bold text-primary" id="current-time">
                        <i class="bi bi-clock me-1"></i>{{ now()->format('H:i:s') }} UTC
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Enhanced Statistics Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Books -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card stat-card-hover border-start-primary h-100 gradient-card">
                <div class="card-body position-relative">
                    <div class="floating-icon">
                        <i class="bi bi-book"></i>
                    </div>
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="stat-label">
                                <i class="bi bi-book-half me-1"></i>
                                សៀវភៅសរុប
                            </div>
                            <div class="stat-number">
                                {{ number_format($stats['total_books']) }}
                            </div>
                            <div class="stat-detail">
                                <i class="bi bi-check-circle text-success"></i>
                                {{ $stats['available_books'] }} ក្បាល​មាន
                            </div>
                        </div>
                    </div>
                    <div class="card-progress">
                        <div class="progress-bar bg-primary" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Members -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card stat-card-hover border-start-success h-100 gradient-card">
                <div class="card-body position-relative">
                    <div class="floating-icon success">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="stat-label">
                                <i class="bi bi-person-check me-1"></i>
                                សមាជិកសកម្ម
                            </div>
                            <div class="stat-number">
                                {{ number_format($stats['total_members']) }}
                            </div>
                            <div class="stat-detail">
                                <i class="bi bi-shield-check text-info"></i>
                                បានចុះឈ្មោះ
                            </div>
                        </div>
                    </div>
                    <div class="card-progress">
                        <div class="progress-bar bg-success" style="width: 85%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Currently Borrowed -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card stat-card-hover border-start-info h-100 gradient-card">
                <div class="card-body position-relative">
                    <div class="floating-icon info">
                        <i class="bi bi-arrow-left-right"></i>
                    </div>
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="stat-label">
                                <i class="bi bi-bookmark me-1"></i>
                                កំពុងខ្ចី
                            </div>
                            <div class="stat-number">
                                {{ number_format($stats['total_borrowed']) }}
                            </div>
                            <div class="stat-detail">
                                <i class="bi bi-clock text-warning"></i>
                                ការខ្ចីសកម្ម
                            </div>
                        </div>
                    </div>
                    <div class="card-progress">
                        <div class="progress-bar bg-info" style="width: {{ $stats['total_books'] > 0 ? ($stats['total_borrowed'] / $stats['total_books']) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overdue Books -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card stat-card-hover border-start-{{ $stats['overdue_books'] > 0 ? 'danger' : 'warning' }} h-100 gradient-card">
                <div class="card-body position-relative">
                    <div class="floating-icon {{ $stats['overdue_books'] > 0 ? 'danger' : 'warning' }}">
                        <i class="bi bi-exclamation-triangle {{ $stats['overdue_books'] > 0 ? 'pulse-danger' : '' }}"></i>
                    </div>
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="stat-label">
                                <i class="bi bi-alarm me-1"></i>
                                ហួសកំណត់
                            </div>
                            <div class="stat-number text-{{ $stats['overdue_books'] > 0 ? 'danger' : 'warning' }}">
                                {{ number_format($stats['overdue_books']) }}
                            </div>
                            <div class="stat-detail">
                                @if($stats['overdue_books'] > 0)
                                    <i class="bi bi-exclamation-triangle text-danger pulse"></i>
                                    ត្រូវការយកចិត្តទុកដាក់
                                @else
                                    <i class="bi bi-check-circle text-success"></i>
                                    ទាំងអស់ត្រឹមត្រូវ
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-progress">
                        <div class="progress-bar bg-{{ $stats['overdue_books'] > 0 ? 'danger' : 'success' }}" style="width: {{ $stats['overdue_books'] > 0 ? '100' : '0' }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Secondary Stats -->
    <div class="row g-4 mb-4">
        <!-- Financial Overview -->
        <div class="col-md-8">
            <div class="card modern-card h-100">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex align-items-center">
                        <div class="icon-wrapper me-3">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0">ទិដ្ឋភាពហិរញ្ញវត្ថុ</h6>
                            <small class="opacity-75">ព័ត៌មានលម្អិតអំពីការគ្រប់គ្រងហិរញ្ញវត្ថុ</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <div class="financial-stat">
                                <div class="financial-amount text-danger">
                                    ${{ number_format($stats['total_fines'], 2) }}
                                </div>
                                <div class="financial-label">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    ការពិន័យដែលនៅសល់
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center border-start">
                            <div class="financial-stat">
                                <div class="financial-amount text-info">
                                    {{ $stats['total_books'] > 0 ? number_format(($stats['total_borrowed'] / $stats['total_books']) * 100, 1) : 0 }}%
                                </div>
                                <div class="financial-label">
                                    <i class="bi bi-graph-up me-1"></i>
                                    អត្រាប្រើប្រាស់
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center border-start">
                            <div class="financial-stat">
                                <div class="financial-amount text-success">
                                    {{ $stats['total_books'] - $stats['total_borrowed'] }}
                                </div>
                                <div class="financial-label">
                                    <i class="bi bi-check-square me-1"></i>
                                    សៀវភៅនៅសល់
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">ការប្រើប្រាស់បណ្ណាល័យ</span>
                            <span class="fw-bold">{{ $stats['total_books'] > 0 ? number_format(($stats['total_borrowed'] / $stats['total_books']) * 100, 1) : 0 }}%</span>
                        </div>
                        <div class="progress progress-modern">
                            <div class="progress-bar bg-gradient-info" role="progressbar"
                                 style="width: {{ $stats['total_books'] > 0 ? ($stats['total_borrowed'] / $stats['total_books']) * 100 : 0 }}%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Quick Actions -->
        <div class="col-md-4">
            <div class="card modern-card h-100">
                <div class="card-header bg-gradient-success text-white">
                    <div class="d-flex align-items-center">
                        <div class="icon-wrapper me-3">
                            <i class="bi bi-lightning-fill"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0">សកម្មភាពរហ័ស</h6>
                            <small class="opacity-75">ធ្វើការងារបានលឿន</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="quick-actions">
                        <a href="{{ route('borrowings.create') }}" class="quick-action-btn primary">
                            <div class="action-icon">
                                <i class="bi bi-plus-circle"></i>
                            </div>
                            <div class="action-text">
                                <div class="action-title">ការខ្ចីថ្មី</div>
                                <div class="action-subtitle">បង្កើតការខ្ចីថ្មី</div>
                            </div>
                        </a>

                        <a href="{{ route('books.create') }}" class="quick-action-btn success">
                            <div class="action-icon">
                                <i class="bi bi-book-half"></i>
                            </div>
                            <div class="action-text">
                                <div class="action-title">បន្ថែមសៀវភៅ</div>
                                <div class="action-subtitle">សៀវភៅថ្មី</div>
                            </div>
                        </a>

                        <a href="{{ route('members.create') }}" class="quick-action-btn info">
                            <div class="action-icon">
                                <i class="bi bi-person-plus"></i>
                            </div>
                            <div class="action-text">
                                <div class="action-title">បន្ថែមសមាជិក</div>
                                <div class="action-subtitle">សមាជិកថ្មី</div>
                            </div>
                        </a>

                        @if($stats['overdue_books'] > 0)
                            <a href="{{ route('borrowings.index', ['status' => 'overdue']) }}" class="quick-action-btn danger pulse-btn">
                                <div class="action-icon">
                                    <i class="bi bi-exclamation-triangle"></i>
                                </div>
                                <div class="action-text">
                                    <div class="action-title">មើលហួសកំណត់</div>
                                    <div class="action-subtitle">{{ $stats['overdue_books'] }} ការជូនដំណឹង</div>
                                </div>
                            </a>
                        @else
                            <a href="{{ route('borrowings.index') }}" class="quick-action-btn warning">
                                <div class="action-icon">
                                    <i class="bi bi-list-check"></i>
                                </div>
                                <div class="action-text">
                                    <div class="action-title">មើលការខ្ចីទាំងអស់</div>
                                    <div class="action-subtitle">គ្រប់គ្រងការខ្ចី</div>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Main Content -->
    <div class="row g-4">
        <!-- Recent Borrowings -->
        <div class="col-lg-8">
            <div class="card modern-card">
                <div class="card-header bg-white border-bottom-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="header-icon me-3">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <div>
                                <h6 class="card-title mb-0">ការខ្ចីថ្មីៗ</h6>
                                <small class="text-muted">គ្រប់គ្រងការខ្ចីបច្ចុប្បន្ន</small>
                            </div>
                        </div>
                        <a href="{{ route('borrowings.index') }}" class="btn btn-outline-primary btn-sm modern-btn">
                            មើលទាំងអស់ <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($recent_borrowings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover modern-table mb-0">
                                <thead>
                                <tr>
                                    <th class="border-0">សមាជិក</th>
                                    <th class="border-0">សៀវភៅ</th>
                                    <th class="border-0">ថ្ងៃខ្ចី</th>
                                    <th class="border-0">ថ្ងៃត្រូវត្រឡប់</th>
                                    <th class="border-0">ស្ថានភាព</th>
                                    <th class="border-0">សកម្មភាព</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($recent_borrowings->take(8) as $borrowing)
                                    <tr class="table-row-hover">
                                        <td class="border-0">
                                            <div class="member-info">
                                                <div class="member-avatar">
                                                    {{ strtoupper(substr($borrowing->member->name, 0, 2)) }}
                                                </div>
                                                <div class="member-details">
                                                    <div class="member-name">{{ $borrowing->member->name }}</div>
                                                    <div class="member-email">{{ $borrowing->member->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-0">
                                            <div class="book-info">
                                                <div class="book-title">{{ Str::limit($borrowing->book->title, 30) }}</div>
                                                <div class="book-author">{{ $borrowing->book->author }}</div>
                                            </div>
                                        </td>
                                        <td class="border-0">
                                            <div class="date-info">{{ $borrowing->borrowed_at->format('d/m/Y') }}</div>
                                        </td>
                                        <td class="border-0">
                                            <div class="date-info {{ $borrowing->isOverdue() ? 'text-danger fw-bold' : '' }}">
                                                {{ $borrowing->due_date->format('d/m/Y') }}
                                                @if($borrowing->isOverdue())
                                                    <i class="bi bi-exclamation-triangle text-danger ms-1"></i>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="border-0">
                                            @if($borrowing->returned_at)
                                                <span class="status-badge success">
                                                        <i class="bi bi-check-circle"></i> បានត្រឡប់
                                                    </span>
                                            @elseif($borrowing->isOverdue())
                                                <span class="status-badge danger pulse">
                                                        <i class="bi bi-exclamation-triangle"></i>
                                                        ហួសកំណត់ {{ $borrowing->days_overdue }}ថ្ងៃ
                                                    </span>
                                            @else
                                                <span class="status-badge primary">
                                                        <i class="bi bi-clock"></i> កំពុងខ្ចី
                                                    </span>
                                            @endif
                                        </td>
                                        <td class="border-0">
                                            <div class="action-buttons">
                                                <a href="{{ route('borrowings.show', $borrowing) }}"
                                                   class="btn btn-sm btn-outline-info" data-bs-toggle="tooltip" title="មើលលម្អិត">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                @if(!$borrowing->returned_at)
                                                    <form action="{{ route('borrowings.return', $borrowing) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-outline-success"
                                                                data-bs-toggle="tooltip" title="បានត្រឡប់"
                                                                onclick="return confirm('បញ្ជាក់ការត្រឡប់សៀវភៅនេះ?')">
                                                            <i class="bi bi-check"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="bi bi-inbox"></i>
                            </div>
                            <h5 class="empty-title">មិនមានការខ្ចីថ្មីៗ</h5>
                            <p class="empty-description">ចាប់ផ្តើមដោយបង្កើតការខ្ចីដំបូងរបស់អ្នក</p>
                            <a href="{{ route('borrowings.create') }}" class="btn btn-primary modern-btn">
                                <i class="bi bi-plus me-1"></i> បង្កើតការខ្ចី
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Enhanced Sidebar -->
        <div class="col-lg-4">
            <!-- Overdue Alert -->
            @if($stats['overdue_books'] > 0)
                <div class="card alert-card danger mb-4">
                    <div class="card-header alert-header">
                        <div class="d-flex align-items-center">
                            <div class="alert-icon pulse-danger">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <div>
                                <h6 class="card-title mb-0">ការជូនដំណឹងបន្ទាន់</h6>
                                <small class="opacity-75">ត្រូវការយកចិត្តទុកដាក់ភ្លាម</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="alert-number">{{ $stats['overdue_books'] }}</div>
                        <p class="alert-text">សៀវភៅហួសកំណត់ហើយត្រូវការយកចិត្តទុកដាក់ភ្លាម</p>
                        <a href="{{ route('borrowings.index', ['status' => 'overdue']) }}"
                           class="btn btn-danger modern-btn pulse-btn">
                            <i class="bi bi-eye me-1"></i> មើលសៀវភៅហួសកំណត់
                        </a>
                    </div>
                </div>
            @endif

            <!-- Popular Books -->
            <div class="card modern-card mb-4">
                <div class="card-header bg-white">
                    <div class="d-flex align-items-center">
                        <div class="header-icon me-3">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0">សៀវភៅពេញនិយម</h6>
                            <small class="text-muted">ដែលត្រូវបានខ្ចីច្រើនបំផុត</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @php
                        $popularBooks = \App\Models\Book::withCount('borrowings')
                            ->orderBy('borrowings_count', 'desc')
                            ->take(5)
                            ->get();
                    @endphp

                    @if($popularBooks->count() > 0)
                        @foreach($popularBooks as $index => $book)
                            <div class="popular-book-item">
                                <div class="book-rank rank-{{ $index + 1 }}">
                                    {{ $index + 1 }}
                                </div>
                                <div class="book-details">
                                    <div class="book-title">{{ Str::limit($book->title, 25) }}</div>
                                    <div class="book-author">{{ $book->author }}</div>
                                </div>
                                <div class="book-count">
                                    <span class="count-badge">{{ $book->borrowings_count }}</span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="empty-popular">
                            <i class="bi bi-book display-4 text-muted"></i>
                            <p class="mt-2 mb-0 text-muted">មិនទាន់មានទិន្នន័យការខ្ចី</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Enhanced System Status -->
            <div class="card modern-card">
                <div class="card-header bg-white">
                    <div class="d-flex align-items-center">
                        <div class="header-icon me-3">
                            <i class="bi bi-gear-fill"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0">ស្ថានភាពប្រព័ន្ធ</h6>
                            <small class="text-muted">ព័ត៌មានប្រព័ន្ធ</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="system-status">
                        <div class="status-item">
                            <div class="status-label">
                                <i class="bi bi-database me-2"></i>ស្ថានភាពទិន្នន័យ
                            </div>
                            <div class="status-value">
                                <span class="status-indicator online"></span>
                                ដំណើរការ
                            </div>
                        </div>

                        <div class="status-item">
                            <div class="status-label">
                                <i class="bi bi-person-circle me-2"></i>អ្នកប្រើបច្ចុប្បន្ន
                            </div>
                            <div class="status-value">
                                <span class="user-badge">{{ Auth::user()->name }}</span>
                            </div>
                        </div>

                        <div class="status-item">
                            <div class="status-label">
                                <i class="bi bi-shield-check me-2"></i>សុវត្ថិភាព
                            </div>
                            <div class="status-value">
                                <span class="status-indicator secure"></span>
                                បានបំពាក់
                            </div>
                        </div>

                        <div class="status-item">
                            <div class="status-label">
                                <i class="bi bi-clock me-2"></i>ពេលវេលាម៉ាស៊ីនមេ (UTC)
                            </div>
                            <div class="status-value">
                                <span class="time-display" id="server-time">{{ now()->format('H:i:s') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Styles -->
    <style>
        /* Enhanced color palette */
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #5ee7df 0%, #66a6ff 100%);
            --info-gradient: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            --warning-gradient: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            --danger-gradient: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            --shadow-soft: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            --shadow-medium: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            --shadow-strong: 0 1rem 3rem rgba(0, 0, 0, 0.175);
        }

        /* Animated welcome text */
        .animated-welcome {
            animation: fadeInUp 0.8s ease-out;
        }

        .gradient-text {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Enhanced dashboard icon */
        .dashboard-icon-wrapper {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            box-shadow: var(--shadow-medium);
        }

        /* Enhanced time display */
        .time-display .date-time-card {
            background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .time-display .date-time-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        /* Enhanced stat cards */
        .stat-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }

        .stat-card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-strong);
        }

        .gradient-card {
            background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
        }

        .floating-icon {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            opacity: 0.1;
            transition: all 0.3s ease;
        }

        .floating-icon.success {
            background: var(--success-gradient);
        }

        .floating-icon.info {
            background: var(--info-gradient);
        }

        .floating-icon.warning {
            background: var(--warning-gradient);
        }

        .floating-icon.danger {
            background: var(--danger-gradient);
        }

        .stat-card:hover .floating-icon {
            opacity: 0.3;
            transform: rotate(360deg) scale(1.1);
        }

        .stat-label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #2d3436;
            margin-bottom: 0.5rem;
        }

        .stat-detail {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .card-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: rgba(0,0,0,0.1);
        }

        .card-progress .progress-bar {
            height: 100%;
            transition: width 1s ease-in-out;
        }

        /* Enhanced modern cards */
        .modern-card {
            border: none;
            border-radius: 15px;
            box-shadow: var(--shadow-soft);
            transition: all 0.3s ease;
        }

        .modern-card:hover {
            box-shadow: var(--shadow-medium);
        }

        .bg-gradient-primary {
            background: var(--primary-gradient) !important;
        }

        .bg-gradient-success {
            background: var(--success-gradient) !important;
        }

        .icon-wrapper {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        /* Financial stats */
        .financial-stat {
            padding: 1rem 0;
        }

        .financial-amount {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .financial-label {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .progress-modern {
            height: 8px;
            border-radius: 10px;
            background: #e9ecef;
        }

        .bg-gradient-info {
            background: var(--info-gradient) !important;
        }

        /* Enhanced quick actions */
        .quick-actions {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .quick-action-btn {
            display: flex;
            align-items: center;
            padding: 1rem;
            border: 2px solid transparent;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .quick-action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .quick-action-btn:hover::before {
            left: 100%;
        }

        .quick-action-btn.primary {
            background: var(--primary-gradient);
            color: white;
        }

        .quick-action-btn.success {
            background: var(--success-gradient);
            color: white;
        }

        .quick-action-btn.info {
            background: var(--info-gradient);
            color: white;
        }

        .quick-action-btn.danger {
            background: var(--danger-gradient);
            color: white;
        }

        .quick-action-btn:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
            text-decoration: none;
            color: white;
        }

        .action-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .action-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .action-subtitle {
            font-size: 0.8rem;
            opacity: 0.8;
        }

        /* Enhanced table */
        .modern-table {
            font-size: 0.9rem;
        }

        .modern-table thead th {
            background: #f8f9fa;
            font-weight: 600;
            color: #495057;
            border: none;
            padding: 1rem 0.75rem;
        }

        .table-row-hover:hover {
            background: rgba(102, 126, 234, 0.05);
            transform: scale(1.01);
            transition: all 0.2s ease;
        }

        .member-info {
            display: flex;
            align-items: center;
        }

        .member-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 0.75rem;
            font-size: 0.85rem;
        }

        .member-name {
            font-weight: 600;
            color: #2d3436;
        }

        .member-email {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .book-info .book-title {
            font-weight: 600;
            color: #2d3436;
        }

        .book-info .book-author {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .date-info {
            font-weight: 500;
            color: #495057;
        }

        .status-badge {
            padding: 0.4rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
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

        .action-buttons {
            display: flex;
            gap: 0.25rem;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }

        .empty-icon {
            font-size: 4rem;
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

        /* Alert card */
        .alert-card.danger .card-header {
            background: var(--danger-gradient);
            color: white;
        }

        .alert-header {
            border: none;
        }

        .alert-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .alert-number {
            font-size: 3rem;
            font-weight: 700;
            color: #dc3545;
            margin-bottom: 1rem;
        }

        .alert-text {
            color: #6c757d;
            margin-bottom: 1.5rem;
        }

        /* Popular books */
        .popular-book-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f3f4;
        }

        .popular-book-item:last-child {
            border-bottom: none;
        }

        .book-rank {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            margin-right: 1rem;
            font-size: 0.85rem;
        }

        .book-rank.rank-1 {
            background: #ffd700;
            color: #856404;
        }

        .book-rank.rank-2 {
            background: #c0c0c0;
            color: #495057;
        }

        .book-rank.rank-3 {
            background: #cd7f32;
            color: white;
        }

        .book-rank:not(.rank-1):not(.rank-2):not(.rank-3) {
            background: #e9ecef;
            color: #6c757d;
        }

        .count-badge {
            background: #007bff;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* System status */
        .system-status {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .status-item {
            display: flex;
            justify-content: between;
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

        .status-indicator.secure {
            background: #17a2b8;
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

        /* Header icons */
        .header-icon {
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

        /* Modern buttons */
        .modern-btn {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .modern-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        /* Animations */
        .pulse {
            animation: pulse 2s infinite;
        }

        .pulse-danger {
            animation: pulseDanger 1.5s infinite;
        }

        .pulse-btn {
            animation: pulseButton 2s infinite;
        }

        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }

        @keyframes pulseDanger {
            0% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.7;
                transform: scale(1.05);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes pulseButton {
            0% {
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
            }
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

        /* Responsive design */
        @media (max-width: 768px) {
            .stat-number {
                font-size: 1.5rem;
            }

            .financial-amount {
                font-size: 1.3rem;
            }

            .alert-number {
                font-size: 2rem;
            }

            .quick-action-btn {
                padding: 0.75rem;
            }

            .action-icon {
                width: 35px;
                height: 35px;
            }
        }
    </style>

    <!-- Enhanced JavaScript -->
    <script>
        // Enhanced time update function
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', {
                hour12: false,
                timeZone: 'UTC'
            });

            // Update current time in header
            const currentTimeElement = document.getElementById('current-time');
            if (currentTimeElement) {
                currentTimeElement.innerHTML = '<i class="bi bi-clock me-1"></i>' + timeString + ' UTC';
            }

            // Update server time in system status
            const serverTimeElement = document.getElementById('server-time');
            if (serverTimeElement) {
                serverTimeElement.textContent = timeString;
            }
        }

        // Smooth scroll for quick actions
        document.querySelectorAll('.quick-action-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });

        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        // Animate stat numbers on load
        function animateValue(element, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const value = Math.floor(progress * (end - start) + start);
                element.textContent = value.toLocaleString();
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        // Animate stats on page load
        window.addEventListener('load', function() {
            const statNumbers = document.querySelectorAll('.stat-number');
            statNumbers.forEach(stat => {
                const finalValue = parseInt(stat.textContent.replace(/,/g, ''));
                stat.textContent = '0';
                animateValue(stat, 0, finalValue, 1000);
            });
        });

        // Update time every second
        setInterval(updateTime, 1000);
        updateTime();
    </script>
</x-app-layout>
