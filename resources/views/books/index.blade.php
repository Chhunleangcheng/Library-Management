<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h3 mb-1 text-gray-800 d-flex align-items-center khmer-bold">
                    <div class="page-icon-wrapper me-3">
                        <i class="bi bi-book text-primary"></i>
                    </div>
                    <span class="gradient-text">គ្រប់គ្រងសៀវភៅ</span>
                </h2>
                <p class="text-muted mb-0 khmer-regular">
                    <i class="bi bi-collection me-1"></i>
                    គ្រប់គ្រងបណ្ណាល័យសៀវភៅទាំងអស់
                </p>
            </div>
            <div class="header-actions">
                <a href="{{ route('books.create') }}" class="btn btn-primary modern-btn khmer-medium">
                    <i class="bi bi-plus-circle me-2"></i>បន្ថែមសៀវភៅថ្មី
                </a>
            </div>
        </div>
    </x-slot>

    <!-- Enhanced Search and Filter Section -->
    <div class="card modern-card mb-4">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex align-items-center">
                <div class="filter-icon me-3">
                    <i class="bi bi-funnel"></i>
                </div>
                <div>
                    <h6 class="card-title mb-0 khmer-semibold">ស្វែងរក និង ត្រងសៀវភៅ</h6>
                    <small class="opacity-75 khmer-regular">ស្វែងរកសៀវភៅតាមបែបផែនណា</small>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('books.index') }}" class="filter-form">
                <div class="row g-3">
                    <!-- Search Input -->
                    <div class="col-md-4">
                        <label class="form-label khmer-medium">
                            <i class="bi bi-search me-1"></i>ស្វែងរកសៀវភៅ
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control khmer-regular"
                                   placeholder="ស្វែងរកតាមចំណងជើង, អ្នកនិពន្ធ, ISBN..."
                                   value="{{ request('search') }}">
                        </div>
                    </div>

                    <!-- Genre Filter -->
                    <div class="col-md-3">
                        <label class="form-label khmer-medium">
                            <i class="bi bi-tags me-1"></i>ប្រភេទសៀវភៅ
                        </label>
                        <select name="genre" class="form-select khmer-regular">
                            <option value="">ប្រភេទទាំងអស់</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>
                                    {{ $genre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Availability Filter -->
                    <div class="col-md-3">
                        <label class="form-label khmer-medium">
                            <i class="bi bi-check-square me-1"></i>ភាពអាចរកបាន
                        </label>
                        <select name="availability" class="form-select khmer-regular">
                            <option value="">សៀវភៅទាំងអស់</option>
                            <option value="1" {{ request('availability') == '1' ? 'selected' : '' }}>មានសៀវភៅ</option>
                            <option value="0" {{ request('availability') == '0' ? 'selected' : '' }}>អស់សៀវភៅ</option>
                        </select>
                    </div>

                    <!-- Filter Actions -->
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-outline-primary khmer-medium">
                                <i class="bi bi-filter me-1"></i>ត្រង
                            </button>
                            <a href="{{ route('books.index') }}" class="btn btn-outline-secondary btn-sm khmer-regular">
                                <i class="bi bi-arrow-clockwise me-1"></i>កំណត់ឡើងវិញ
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Books Statistics Card -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-mini-card primary">
                <div class="stat-mini-icon">
                    <i class="bi bi-book-half"></i>
                </div>
                <div class="stat-mini-content">
                    <div class="stat-mini-number khmer-bold khmer-number">{{ $books->total() }}</div>
                    <div class="stat-mini-label khmer-regular">សៀវភៅសរុប</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-mini-card success">
                <div class="stat-mini-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-mini-content">
                    <div class="stat-mini-number khmer-bold khmer-number">{{ $books->where('available_copies', '>', 0)->count() }}</div>
                    <div class="stat-mini-label khmer-regular">មានក្នុងស្តុក</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-mini-card warning">
                <div class="stat-mini-icon">
                    <i class="bi bi-exclamation-circle"></i>
                </div>
                <div class="stat-mini-content">
                    <div class="stat-mini-number khmer-bold khmer-number">{{ $books->where('available_copies', 0)->count() }}</div>
                    <div class="stat-mini-label khmer-regular">អស់ស្តុក</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-mini-card info">
                <div class="stat-mini-icon">
                    <i class="bi bi-tags"></i>
                </div>
                <div class="stat-mini-content">
                    <div class="stat-mini-number khmer-bold khmer-number">{{ $genres->count() }}</div>
                    <div class="stat-mini-label khmer-regular">ប្រភេទសៀវភៅ</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Books Table Card -->
    <div class="card modern-card">
        <div class="card-header bg-white border-bottom-0">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="table-icon me-3">
                        <i class="bi bi-table"></i>
                    </div>
                    <div>
                        <h6 class="card-title mb-0 khmer-semibold">បញ្ជីសៀវភៅ</h6>
                        <small class="text-muted khmer-regular">
                            បង្ហាញលទ្ធផល <span class="khmer-number">{{ $books->firstItem() ?? 0 }}</span> -
                            <span class="khmer-number">{{ $books->lastItem() ?? 0 }}</span> នៃ
                            <span class="khmer-number">{{ $books->total() }}</span> សៀវភៅ
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
            @if($books->count() > 0)
                <!-- Table View -->
                <div id="table-view" class="table-responsive">
                    <table class="table table-hover modern-table mb-0">
                        <thead>
                        <tr>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-book me-1"></i>ព័ត៌មានសៀវភៅ
                            </th>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-person me-1"></i>អ្នកនិពន្ធ
                            </th>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-tag me-1"></i>ប្រភេទ
                            </th>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-upc-scan me-1"></i>ISBN
                            </th>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-stack me-1"></i>ចំនួន
                            </th>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-check-circle me-1"></i>ស្ថានភាព
                            </th>
                            <th class="border-0 khmer-semibold">
                                <i class="bi bi-gear me-1"></i>សកម្មភាព
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr class="table-row-hover">
                                <td class="border-0">
                                    <div class="book-info-cell">
                                        <div class="book-cover">
                                            <i class="bi bi-book text-primary"></i>
                                        </div>
                                        <div class="book-details">
                                            <div class="book-title khmer-semibold">{{ $book->title }}</div>
                                            <div class="book-year khmer-regular text-muted">
                                                @if($book->published_year)
                                                    <i class="bi bi-calendar3 me-1"></i>
                                                    ឆ្នាំ <span class="khmer-number">{{ $book->published_year }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-0">
                                    <div class="author-cell khmer-regular">{{ $book->author }}</div>
                                </td>
                                <td class="border-0">
                                    <span class="genre-badge khmer-regular">{{ $book->genre }}</span>
                                </td>
                                <td class="border-0">
                                    <code class="isbn-code">{{ $book->isbn }}</code>
                                </td>
                                <td class="border-0">
                                    <div class="quantity-cell">
                                        <div class="quantity-main khmer-medium">
                                            <span class="available khmer-number">{{ $book->available_copies }}</span>
                                            /
                                            <span class="total khmer-number">{{ $book->total_copies }}</span>
                                        </div>
                                        <div class="quantity-progress">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-{{ $book->available_copies > 0 ? 'success' : 'danger' }}"
                                                     style="width: {{ $book->total_copies > 0 ? ($book->available_copies / $book->total_copies) * 100 : 0 }}%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-0">
                                    @if($book->available_copies > 0)
                                        <span class="status-badge success khmer-regular">
                                                <i class="bi bi-check-circle"></i> មាន
                                            </span>
                                    @else
                                        <span class="status-badge danger khmer-regular">
                                                <i class="bi bi-x-circle"></i> អស់
                                            </span>
                                    @endif
                                </td>
                                <td class="border-0">
                                    <div class="action-buttons">
                                        <a href="{{ route('books.show', $book) }}"
                                           class="btn btn-sm btn-outline-info"
                                           data-bs-toggle="tooltip" title="មើលលម្អិត">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('books.edit', $book) }}"
                                           class="btn btn-sm btn-outline-warning"
                                           data-bs-toggle="tooltip" title="កែប្រែ">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        @if($book->activeBorrowings()->count() == 0)
                                            <form action="{{ route('books.destroy', $book) }}" method="POST"
                                                  class="d-inline" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបសៀវភៅនេះមែនទេ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        data-bs-toggle="tooltip" title="លុប">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-sm btn-outline-secondary" disabled
                                                    data-bs-toggle="tooltip" title="មិនអាចលុបបាន (កំពុងខ្ចី)">
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
                        @foreach($books as $book)
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="book-card">
                                    <div class="book-card-header">
                                        <div class="book-card-cover">
                                            <i class="bi bi-book"></i>
                                        </div>
                                        <div class="book-card-status">
                                            @if($book->available_copies > 0)
                                                <span class="badge bg-success khmer-regular">មាន</span>
                                            @else
                                                <span class="badge bg-danger khmer-regular">អស់</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="book-card-body">
                                        <h6 class="book-card-title khmer-semibold">{{ Str::limit($book->title, 40) }}</h6>
                                        <p class="book-card-author khmer-regular">{{ $book->author }}</p>
                                        <div class="book-card-meta">
                                            <small class="text-muted khmer-regular">
                                                <i class="bi bi-tag me-1"></i>{{ $book->genre }}
                                            </small>
                                        </div>
                                        <div class="book-card-quantity">
                                            <span class="khmer-regular">ចំនួន: </span>
                                            <span class="khmer-number">{{ $book->available_copies }}/{{ $book->total_copies }}</span>
                                        </div>
                                    </div>
                                    <div class="book-card-footer">
                                        <div class="btn-group w-100">
                                            <a href="{{ route('books.show', $book) }}" class="btn btn-outline-primary btn-sm khmer-regular">
                                                <i class="bi bi-eye me-1"></i>មើល
                                            </a>
                                            <a href="{{ route('books.edit', $book) }}" class="btn btn-outline-warning btn-sm khmer-regular">
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
                        <i class="bi bi-book"></i>
                    </div>
                    <h4 class="empty-title khmer-semibold">មិនមានសៀវភៅ</h4>
                    <p class="empty-description khmer-regular">
                        @if(request()->hasAny(['search', 'genre', 'availability']))
                            មិនមានសៀវភៅត្រូវនឹងការស្វែងរករបស់អ្នកទេ។ សាកល្បងស្វែងរកដោយពាក្យគន្លឹះផ្សេង។
                        @else
                            មិនទាន់មានសៀវភៅនៅក្នុងបណ្ណាល័យនេះទេ។ ចាប់ផ្តើមដោយបន្ថែមសៀវភៅដំបូង។
                        @endif
                    </p>
                    <div class="empty-actions">
                        @if(request()->hasAny(['search', 'genre', 'availability']))
                            <a href="{{ route('books.index') }}" class="btn btn-outline-primary khmer-medium">
                                <i class="bi bi-arrow-clockwise me-1"></i>មើលសៀវភៅទាំងអស់
                            </a>
                        @endif
                        <a href="{{ route('books.create') }}" class="btn btn-primary khmer-medium">
                            <i class="bi bi-plus me-1"></i>បន្ថែមសៀវភៅថ្មី
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($books->hasPages())
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="pagination-info khmer-regular text-muted">
                        បង្ហាញ <span class="khmer-number">{{ $books->firstItem() }}</span> -
                        <span class="khmer-number">{{ $books->lastItem() }}</span> នៃ
                        <span class="khmer-number">{{ $books->total() }}</span> លទ្ធផល
                    </div>
                    <div class="pagination-links">
                        {{ $books->withQueryString()->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Enhanced Styles -->
    <style>
        /* Page header styling */
        .page-icon-wrapper {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header-actions .modern-btn {
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 500;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
            transition: all 0.3s ease;
        }

        .header-actions .modern-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
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

        .filter-form .form-control,
        .filter-form .form-select {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .filter-form .form-control:focus,
        .filter-form .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
        }

        .input-group-text {
            border-radius: 8px 0 0 8px;
            border: 2px solid #e9ecef;
            border-right: none;
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
        }

        .stat-mini-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.1;
            transition: opacity 0.3s ease;
        }

        .stat-mini-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .stat-mini-card:hover::before {
            opacity: 0.2;
        }

        .stat-mini-card.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .stat-mini-card.success {
            background: linear-gradient(135deg, #5ee7df 0%, #66a6ff 100%);
            color: white;
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            background: rgba(102, 126, 234, 0.05);
            transform: scale(1.005);
        }

        /* Book info cell */
        .book-info-cell {
            display: flex;
            align-items: center;
        }

        .book-cover {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .book-title {
            font-size: 1rem;
            color: #2d3436;
            margin-bottom: 0.25rem;
            line-height: 1.4;
        }

        .book-year {
            font-size: 0.8rem;
        }

        .author-cell {
            font-weight: 500;
            color: #495057;
        }

        .genre-badge {
            background: #e9ecef;
            color: #495057;
            padding: 0.4rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .isbn-code {
            background: #f8f9fa;
            color: #6c757d;
            padding: 0.3rem 0.6rem;
            border-radius: 4px;
            font-size: 0.85rem;
        }

        /* Quantity cell */
        .quantity-cell {
            text-align: center;
        }

        .quantity-main {
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .available {
            color: #198754;
            font-weight: 600;
        }

        .total {
            color: #6c757d;
        }

        .progress-sm {
            height: 6px;
            border-radius: 3px;
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

        /* Book cards for grid view */
        .book-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            background: white;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .book-card-header {
            position: relative;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2rem;
            text-align: center;
        }

        .book-card-cover {
            font-size: 3rem;
            color: white;
            margin-bottom: 1rem;
        }

        .book-card-status {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        .book-card-body {
            padding: 1.5rem;
        }

        .book-card-title {
            color: #2d3436;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .book-card-author {
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .book-card-meta {
            margin-bottom: 1rem;
        }

        .book-card-quantity {
            font-size: 0.9rem;
            color: #495057;
        }

        .book-card-footer {
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

        /* Pagination */
        .pagination-info {
            font-size: 0.9rem;
        }

        .pagination .page-link {
            border: none;
            color: #6c757d;
            padding: 0.5rem 0.75rem;
            margin: 0 0.125rem;
            border-radius: 6px;
        }

        .pagination .page-item.active .page-link {
            background: #0d6efd;
            color: white;
        }

        .pagination .page-link:hover {
            background: #e9ecef;
            color: #495057;
        }

        /* View toggle buttons */
        .table-actions .btn-group .btn {
            border: 2px solid #e9ecef;
            color: #6c757d;
            transition: all 0.3s ease;
        }

        .table-actions .btn-group .btn.active {
            background: #0d6efd;
            border-color: #0d6efd;
            color: white;
        }

        .table-actions .btn-group .btn:hover {
            border-color: #0d6efd;
            color: #0d6efd;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .book-info-cell {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .book-cover {
                margin-right: 0;
                margin-bottom: 0.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .stat-mini-card {
                margin-bottom: 1rem;
            }

            .filter-form .col-md-2,
            .filter-form .col-md-3,
            .filter-form .col-md-4 {
                margin-bottom: 1rem;
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

        /* Loading states */
        .loading {
            position: relative;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255,255,255,0.8);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Khmer number improvements */
        .khmer-number {
            font-variant-numeric: lining-nums tabular-nums;
            font-feature-settings: "tnum" 1;
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
                tableView.classList.remove('d-none');
                gridView.classList.add('d-none');
                buttons[0].classList.add('active');
                buttons[1].classList.remove('active');
            } else {
                tableView.classList.remove('d-none');
                gridView.classList.add('d-none');
                buttons[0].classList.add('active');
                buttons[1].classList.remove('active');
            }

            // Save preference to localStorage
            localStorage.setItem('booksViewPreference', view);
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
            const savedView = localStorage.getItem('booksViewPreference');
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
        });

        // Search suggestions (future enhancement)
        function initSearchSuggestions() {
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput) {
                // Add debounced search suggestions here
                let timeout;
                searchInput.addEventListener('input', function() {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => {
                        // Implement search suggestions
                    }, 300);
                });
            }
        }

        // Enhanced table interactions
        document.querySelectorAll('.table-row-hover').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.boxShadow = '0 4px 15px rgba(102, 126, 234, 0.15)';
            });

            row.addEventListener('mouseleave', function() {
                this.style.boxShadow = '';
            });
        });
    </script>
</x-app-layout>
